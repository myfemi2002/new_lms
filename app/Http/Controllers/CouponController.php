<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    public function adminViewCoupon(){
        $allData = Coupon::latest()->get();
        return view('backend.coupon.index',compact('allData'));
    }

    // public function AdminStoreCoupon(Request $request){
    //     Coupon::insert([
    //         'coupon_name' => strtoupper($request->coupon_name),
    //         'coupon_discount' => $request->coupon_discount,
    //         'coupon_validity' => $request->coupon_validity,
    //         'created_at' => Carbon::now(),
    //     ]);

    //     $notification = array(
    //         'message' => 'Coupon Inserted Successfully',
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->back()->with($notification);  


    // }

    


    public function AdminStoreCoupon(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'coupon_name' => 'required|string|max:255',
            'coupon_discount' => 'required|numeric',
            'coupon_validity' => 'required|date_format:d-m-Y',
            'status' => 'required|boolean',
        ]);

        // Create a new coupon instance
        $coupon = new Coupon();
        $coupon->coupon_name = strtoupper($validatedData['coupon_name']);
        $coupon->coupon_discount = $validatedData['coupon_discount'];
        $coupon->coupon_validity = \Carbon\Carbon::createFromFormat('d-m-Y', $validatedData['coupon_validity']);
        $coupon->status = $validatedData['status'];

        // Save the coupon
        $coupon->save();

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }

    public function adminUpdateCoupon(Request $request, $id) {
        // dd($request);
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'coupon_name' => 'required|string|max:255',
                'coupon_discount' => 'required|numeric',
                'coupon_validity' => 'required|date_format:d-m-Y',
                'status' => 'required|boolean',
            ]);

            $coupon = Coupon::findOrFail($id);
            $coupon->coupon_name = strtoupper($request->coupon_name);
            $coupon->coupon_discount = $request->coupon_discount;
            $coupon->coupon_validity = \Carbon\Carbon::createFromFormat('d-m-Y', $validatedData['coupon_validity']);
            $coupon->status = $request->status;
            // $coupon->updated_by = auth()->user()->id;
            $coupon->save(); 
    
            // Prepare a notification for a successful update
            $notification = [
                'message' => 'Coupon updated successfully',
                'alert-type' => 'success'
            ];
    
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error('Failed to update coupon. Error: ' . $e->getMessage());
    
            // Prepare a notification for a failed update
            $notification = [
                'message' => 'Failed to update coupon. Please try again later.',
                'alert-type' => 'error'
            ];
        }
    
        // Redirect back with a notification
        return redirect()->back()->with($notification); 
    }
   
    public function adminDeleteCoupon ($id){
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    
}
