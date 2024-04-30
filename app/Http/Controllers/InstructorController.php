<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;;

class InstructorController extends Controller
{
    public function instructorDashboard(){
        return view ('instructor.index');
    }    

    public function instructorLogin(){
        return view('instructor.instructor_login');
    }
    
    public function instructorDestroy(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );
        activity()->log('Logout Successfully');
        // return redirect('/instructor/login')->with($notification);
        return redirect('/login')->with($notification);
    } 

    public function instructorProfile()
    {
        $id = Auth::id();
        $instructorData = User::find($id);
        return view('instructor.instructor_profile_view', compact('instructorData'));
    }


    public function instructorProfileStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            // 'email' => 'required',
            'phone' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:5120',
        ],
        [
            'name.required' => 'Please Input name',
            // 'email.required' => 'Please Input email',
            'phone.required' => 'Please Input phone',
            'photo.min' => 'Image Longer Than 4 Characters',
        ]);
    
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        // $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
    
        // Check if a new photo is provided
        if ($request->hasFile('photo')) {
            // Delete old photo if present
            if ($data->photo) {
                $oldPhotoPath = public_path('upload/instructor_images/' . $data->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
    
            // Process and resize the new photo
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('photo')->getClientOriginalExtension();
    
            $img = $manager->read($request->file('photo')->getRealPath())->resize(80, 80);
    
            $img->save(public_path('upload/instructor_images/' . $name_gen));
    
            $data->photo = $name_gen;
        }
    
        $data->save();
    
        activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('profile updated');
    
        $notification = [
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->back()->with($notification);
    }

    public function instructorChangePassword(){
        return view('instructor.instructor_change_password');
    }

    public function instructorUpdatePassword(Request $request)
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
    

    public function instructorUpdateBio(Request $request){
        
            $id = Auth::user()->id;
            $data = User::find($id);
            $data->headline = $request->headline;
            $data->bio = $request->bio;
            $data->professional_profile = $request->professional_profile;
               
            $data->save();
        
            activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('bio updated');
        
            $notification = [
                'message' => 'Bio Updated Successfully',
                'alert-type' => 'success',
            ];
        
            return redirect()->back()->with($notification);
    }
}
