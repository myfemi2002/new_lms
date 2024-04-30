<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class UserController extends Controller
{
    public function userDashboard(){
        return view('user.index');
    }

    public function UserLogin(){
        return view('user.user_login');
    } 

    public function UserDestroy(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );
        activity()->log('Logout Successfully');
        // return redirect('/user/login')->with($notification);
        return redirect('/login')->with($notification);
    }

    public function userProfile(){
        // Get the authenticated user
        $user = Auth::user();
    
        // Pass the user details to the view
        return view('user.user_profile_view', compact('user'));
    }

    public function userProfileEdit(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('user.profile_edit',compact('userData'));
    }

    // public function userProfileStore(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'phone' => 'required',
    //         'photo' => 'image|mimes:jpeg,png,jpg|max:5120',
    //     ],
    //     [
    //         'name.required' => 'Please Input name',
    //         'email.required' => 'Please Input email',
    //         'phone.required' => 'Please Input phone',
    //         'photo.min' => 'Image Longer Than 4 Characters',
    //     ]);
    
    //     $id = Auth::user()->id;
    //     $data = User::find($id);
    //     $data->name = $request->name;
    //     $data->email = $request->email;
    //     $data->phone = $request->phone;
    //     $data->address = $request->address;
    
    //     // Delete old photo if present
    //     if ($data->photo) {
    //         $oldPhotoPath = public_path('upload/user_images/' . $data->photo);
    //         if (file_exists($oldPhotoPath)) {
    //             unlink($oldPhotoPath);
    //         }
    //     }
    
    //     if ($request->file('photo')) {
    //         $manager = new ImageManager(new Driver());
    //         $name_gen = hexdec(uniqid()) . '.' . $request->file('photo')->getClientOriginalExtension();
    
    //         $img = $manager->read($request->file('photo'));
    //         $img = $img->resize(200, 200);
    
    //         $img->tojpeg(80)->save(public_path('upload/user_images/' . $name_gen));
    //         $save_url = $name_gen;
    
    //         $data->photo = $save_url;
    //     }
    
    //     $data->save();

    //     activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('profile updated');
    
    //     $notification = array(
    //         'message' => 'Profile Updated Successfully',
    //         'alert-type' => 'success'
    //     );
    
    //     return redirect()->back()->with($notification);
    // }

    public function userProfileStore(Request $request)
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
            $oldPhotoPath = public_path('upload/user_images/' . $data->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // Process and resize the new photo
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $request->file('photo')->getClientOriginalExtension();

        $img = $manager->read($request->file('photo')->getRealPath())->resize(200, 200);

        $img->save(public_path('upload/user_images/' . $name_gen));

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


public function userUpdatePassword(Request $request)
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



    






}