<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class AdminController extends Controller
{
    public function adminDashboard(){
            try {
                // $usersIp = User::get('last_login_ip');
                $usersIp = Auth::user();
        
                // Check for internet connection
                if (!$this->isInternetAvailable()) {
                    return view('admin.index', ['error' => 'No internet connection. Please check your network connection and try again.']);
                }
        
                $userIpAddress = filter_var(request()->ip(), FILTER_VALIDATE_IP);
                $fallbackIp = '72.229.28.185';
                $userIpAddress = $userIpAddress ?: $fallbackIp;
        
                $apiToken = 'f20072e31a720d';
                $apiUrl = "https://ipinfo.io/{$userIpAddress}/json?token={$apiToken}";
                
                try {
                    $ipInfoResponse = Http::timeout(10)->get($apiUrl);
        
                    if ($ipInfoResponse->failed()) {
                        // Check for cURL error and handle it gracefully
                        $curlErrorCode = $ipInfoResponse->clientError();
                        if ($curlErrorCode == 28) {
                            throw new \Exception('Unable to connect to IP geolocation service. Please check your internet connection.');
                        } else {
                            throw new \Exception('Failed to fetch IP geolocation data.');
                        }
                    }
        
                    $ipInfoData = $ipInfoResponse->json();
    
                if (isset($ipInfoData['country'])) {
                    $countryCode = strtoupper($ipInfoData['country']);
    
                    $restcountriesApiUrl = "https://restcountries.com/v3.1/alpha/";
                    $restcountriesResponse = Http::get("{$restcountriesApiUrl}{$countryCode}");
                    $restcountriesData = $restcountriesResponse->json();
    
                    if (isset($restcountriesData[0]['name']['common'])) {
                        $countryAbbreviation = $restcountriesData[0]['name']['common'];
                        $flagImage = $restcountriesData[0]['flags']['png'];
                    }
                } else {
                    $countryAbbreviation = 'United Kingdom';
                    $flagImage = asset('backend/assets/images/svgs/icon-flag-en.svg');
                }
    
            // Pass the variables to the view
            return view('admin.index', compact('userIpAddress', 'countryAbbreviation', 'flagImage', 'usersIp'));
            
        } catch (\Exception $curlException) {
            // Handle cURL-specific exceptions
            throw $curlException;
        }

    } catch (\Exception $e) {
        // Handle other exceptions, log or display an error message
        return view('admin.index', ['error' => $e->getMessage()]);
    }
}

private function isInternetAvailable() {
    $connected = @fsockopen("www.google.com", 80);
    if ($connected){
        fclose($connected);
        return true; // Online
    } else {
        return false; // Offline
    }}
    
  

    public function adminLogin(){
        return view('admin.admin_login');
    }
    
    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );
        activity()->log('Logout Successfully');
        // return redirect('/admin/login')->with($notification);
        return redirect('/login')->with($notification);
    } 

    public function adminProfile()
    {
        $id = Auth::id();
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    
    public function adminProfileStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:1024',
        ],
        [
            'name.required' => 'Please Input name',
            'email.required' => 'Please Input email',
            'phone.required' => 'Please Input phone',
            'photo.min' => 'Image Longer Than 4 Characters',
        ]);
    
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
    
        // Delete old photo if present
        if ($data->photo) {
            $oldPhotoPath = public_path('upload/admin_images/' . $data->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
    
        if ($request->file('photo')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('photo')->getClientOriginalExtension();
    
            $img = $manager->read($request->file('photo'));
            $img = $img->resize(60, 60);
    
            $img->tojpeg(80)->save(public_path('upload/admin_images/' . $name_gen));
            $save_url = $name_gen;
    
            $data->photo = $save_url;
        }
    
        $data->save();

        activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('profile updated');
    
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    }

    public function adminChangePassword(){
        return view('admin.admin_change_password');
    }

    // public function adminUpdatePassword(Request $request){
    //     $validateData = $request->validate([
    //         'old_password' => 'required',
    //         'new_password' => 'required|confirmed',
    //             ],
    //             [
    //                 'old_password.required' => 'Please Input Old password',
    //                 // 'new_password_confirmation.required' => 'Please Input confirm password',
    //             ]);

    //     // Match The Old Password
    //     if (!Hash::check($request->old_password, auth::user()->password)) {

    //     $notification = array(
    //         'message' => 'Wrong old password',
    //         'alert-type' => 'error'
    //     );
    //     return Redirect()->back()->with($notification);
    //     }
    //     // Update The new password
    //     User::whereId(auth()->user()->id)->update([
    //         'password' => Hash::make($request->new_password)
    //     ]);
    //     Auth::guard('web')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     $notification = array(
    //         'message' => 'Password Successfully Changed',
    //         'alert-type' => 'success'
    //     );
    //     activity()->log('Logout Successfully');
    //     return redirect('/admin/login')->with($notification);
    // }

    public function adminUpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ], [
            'old_password.required' => 'Please Input Old password',
        ]);
    
        // Check if there is an authenticated user
        if (!$user = auth()->user()) {
            $notification = [
                'message' => 'User not authenticated',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
        }
    
        // Match The Old Password
        if (!Hash::check($request->old_password, $user->password)) {
            $notification = [
                'message' => 'Wrong old password',
                'alert-type' => 'error',
            ];
                
        // Log password change activity before attempting update
        activity()->performedOn($user)->causedBy($user)->withProperties(['action' => 'Wrong old password provided'])->log('Wrong old password provided');
        
        return redirect()->back()->with($notification);
        }
    
        // Log password change activity before attempting update
        activity() ->performedOn($user)->causedBy($user)->withProperties(['action' => 'password update attempt'])->log('Password update attempt');
    
        try {
            // Update The new password
            User::whereId($user->id)->update(['password' => Hash::make($request->new_password),]);
    
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            $notification = [
                'message' => 'Password Successfully Changed',
                'alert-type' => 'success',
            ];
    
            // Log password change success activity
            activity()->performedOn($user)->causedBy($user)->withProperties(['action' => 'password updated'])->log('Password changed');
        } catch (\Exception $e) {
            // Log password change failure activity
            activity()->performedOn($user)->causedBy($user)->withProperties(['action' => 'password update failed'])->log('Password change failed: ' . $e->getMessage());
    
            $notification = [
                'message' => 'Failed to update password',
                'alert-type' => 'error',
            ];
        }    
        return redirect('/login')->with($notification);
    }

    public function instructorView(){
        $allData = User::where('role', 'instructor')->latest()->get();
        return view('backend.instructor.index', compact('allData'));
    }

    public function activateInstructor(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = '1';
        $user->save();        
        
        $notification = [
            'message' => 'Customer Activated',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function deactivateInstructor(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = '0';
        $user->save();
        $notification = [
            'message' => 'Customer deactivated',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);

    }

    public function loadAllCourses()
    {
        $allData = Course::latest()->get();
        return view('backend.courses.index', compact('allData'));
    }    
    
    public function activateCourse(Request $request, $id)
    {
        $user = Course::findOrFail($id);
        $user->status = '1';
        $user->save();        
        
        $notification = [
            'message' => 'Course Activated',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function deactivateCourse(Request $request, $id)
    {
        $user = Course::findOrFail($id);
        $user->status = '0';
        $user->save();
        $notification = [
            'message' => 'Course deactivated',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function loadCourseDetails($id){
        $course = Course::find($id);
        return view('backend.courses.course_details',compact('course'));

    }
        
    
    

    
    

    





}
