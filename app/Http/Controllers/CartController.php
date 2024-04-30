<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{  
    public function checkLogin()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Please log in to add courses to your cart']);
        }
    
        return response()->json(['success' => 'You are logged in.']);
    }
    
    public function addToCart(Request $request, $id){
    
        $course = Course::find($id);
        
        // Check if the course exists
        if (!$course) {
            return response()->json(['error' => 'Course not found']);
        }
    
        // Check if the course is already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });
    
        if ($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is already in your cart']);
        }
    
        // Clear any existing coupon from the session
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
    
        // If everything is fine, add the course to the cart
        $price = $course->discount_price ?? $course->selling_price;
    
        Cart::add([
            'id' => $id, 
            'name' => $request->course_name, 
            'qty' => 1, 
            'price' => $price, 
            'weight' => 1, 
            'options' => [
                'image' => 'upload/course_images/' . $course->course_image,
                'slug' => $request->course_name_slug,
                'user' => $request->user,
            ],
        ]); 
    
        return response()->json(['success' => 'Successfully Added on Your Cart']); 
    }
    

    // public function AddToCart(Request $request, $id){

    //     $course = Course::find($id);

    //     if (Session::has('coupon')) {
    //         Session::forget('coupon');
    //     }

    //     // Check if the course is already in the cart
    //     $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
    //         return $cartItem->id === $id;
    //     });

    //     if ($cartItem->isNotEmpty()) {
    //         return response()->json(['error' => 'Course is already in your cart']);
    //     }

    //     if ($course->discount_price == NULL) {

    //         Cart::add([
    //             'id' => $id, 
    //             'name' => $request->course_name, 
    //             'qty' => 1, 
    //             'price' => $course->selling_price, 
    //             'weight' => 1, 
    //             'options' => [
    //                 'image' => $course->course_image,
    //                 'slug' => $request->course_name_slug,
    //                 'instructor' => $request->instructor,
    //             ],
    //         ]); 

    //     }else{

    //         Cart::add([
    //             'id' => $id, 
    //             'name' => $request->course_name, 
    //             'qty' => 1, 
    //             'price' => $course->discount_price, 
    //             'weight' => 1, 
    //             'options' => [
    //                 'image' => $course->course_image,
    //                 'slug' => $request->course_name_slug,
    //                 'instructor' => $request->instructor,
    //             ],
    //         ]);  
    //     }

    //     return response()->json(['success' => 'Successfully Added on Your Cart']); 

    // }
    

    public function cartData(){
        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));

    }

    public function getMiniCart(){

        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));

    }

    public function removeMiniCart($rowId){

        Cart::remove($rowId);
        return response()->json(['success' => 'Course Remove From Cart']);

    }

    public function showCart(){
        return view('user.pages.cart.index');
    }

    public function getCartCourse(){

        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));

    }

    public function RemoveGetCartCourse($rowId){

        Cart::remove($rowId);

        if (Session::has('coupon')) {
           $coupon_name = Session::get('coupon')['coupon_name'];
           $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
            'coupon_name' => $coupon->coupon_name,
            'coupon_discount' => $coupon->coupon_discount,
            'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
            'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
        ]);

        }
        return response()->json(['success' => 'Course Remove From Cart']);

    }

    public function couponApply(Request $request)
    {
        $couponName = $request->coupon_name;
    
        // Check if coupon name is provided
        if (!$couponName) {
            return response()->json(['error' => 'Coupon code is required']);
        }
    
        $coupon = Coupon::where('coupon_name', $couponName)
                        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                        ->first();
    
        // Check if coupon exists
        if (!$coupon) {
            return response()->json(['error' => 'Invalid or expired coupon']);
        }
    
        // Check if the coupon is already applied
        if (Session::has('coupon')) {
            return response()->json(['error' => 'A coupon is already applied. Remove it first before applying a new one.']);
        }
    
        // Calculate discount and total amount
        $couponDiscount = $coupon->coupon_discount;
        $total = Cart::total();
        $discountAmount = round($total * $couponDiscount / 100);
        $totalAmount = round($total - $discountAmount);
    
        // Store coupon details in session
        Session::put('coupon', [
            'coupon_name' => $couponName,
            'coupon_discount' => $couponDiscount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
        ]);

        return response()->json([
            'validity' => true,
            'success' => 'Coupon Applied Successfully'
        ]);
    }   

    public function couponCalculation(){

        if (Session::has('coupon')) {
           return response()->json(array(
            'subtotal' => Cart::total(),
            'coupon_name' => session()->get('coupon')['coupon_name'],
            'coupon_discount' => session()->get('coupon')['coupon_discount'],
            'discount_amount' => session()->get('coupon')['discount_amount'],
            'total_amount' => session()->get('coupon')['total_amount'],
           ));
        } else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }

    }

    public function couponRemove(){

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);

    }

    public function createCheckout(){
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the cart is not empty
            if (Cart::count() > 0) {
                // Retrieve cart details
                $carts = Cart::content();
                $cartTotal = Cart::total();
                $cartQty = Cart::count();
    
                // Proceed to checkout page
                return view('user.pages.checkout.index', compact('carts', 'cartTotal', 'cartQty'));
            } else {
                // Redirect with error message if cart is empty
                return redirect()->to('/')->with([
                    'message' => 'Add at least one course to your cart before checkout',
                    'alert-type' => 'error'
                ]);
            }
        } else {
            // Redirect to login page if user is not authenticated
            return redirect()->route('login')->with([
                'message' => 'Please login to proceed to checkout',
                'alert-type' => 'error'
            ]);
        }
    }

    // public function Payment(Request $request)
    // {
    //     // Calculate total amount
    //     if (Session::has('coupon')) {
    //         $total_amount = Session::get('coupon')['total_amount'];
    //      }else {
    //          $total_amount = round(Cart::total());
        

    //     // Create a new Payment record
    //     $data = new Payment([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'address' => $request->address,
    //         'cash_delivery' => $request->cash_delivery,
    //         'total_amount' => $total_amount,
    //         'payment_type' => 'Direct Payment',
    //         'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
    //         'order_date' => Carbon::now()->toDateString(),
    //         'order_month' => Carbon::now()->format('F'),
    //         'order_year' => Carbon::now()->format('Y'),
    //         'status' => 'pending',
    //         'created_at' => Carbon::now()
    //     ]);

    //     $data->save();

    //     foreach ($request->course_title as $key => $course_title) {

    //         $existingOrder = Order::where('user_id',Auth::user()->id)->where('course_id',$request->course_id[$key])->first();

    //         if ($existingOrder) {

    //             $notification = array(
    //                 'message' => 'You Have already enrolled in this course',
    //                 'alert-type' => 'error'
    //             );
    //             return redirect()->back()->with($notification); 
    //         } // end if 

    //         $order = new Order();
    //         $order->payment_id = $data->id;
    //         $order->user_id = Auth::user()->id;
    //         $order->course_id = $request->course_id[$key];
    //         $order->instructor_id = $request->instructor_id[$key];
    //         $order->course_title = $course_title;
    //         $order->price = $request->price[$key];
    //         $order->save();

    //        } // end foreach 

    //        $request->session()->forget('cart');

    //         if ($request->cash_delivery == 'stripe') {
    //            echo "stripe";
    //         }else{

    //             $notification = array(
    //                 'message' => 'Cash Payment Submit Successfully',
    //                 'alert-type' => 'success'
    //             );
    //             return view('frontend.index')->with($notification); 
    //             // return redirect()->route('/')->with($notification); 

    //         } 
    // }

    // public function payment(Request $request)
    // {
    //     try {
    //         // Start a database transaction
    //         DB::beginTransaction();
    
    //         // Calculate total amount
    //         if (Session::has('coupon')) {
    //             $total_amount = Session::get('coupon')['total_amount'];
    //         } else {
    //             $total_amount = round(Cart::total());
    //         }
    
    //         // Create a new Payment record
    //         $payment = new Payment([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'phone' => $request->phone,
    //             'address' => $request->address,
    //             'cash_delivery' => $request->cash_delivery,
    //             'total_amount' => $total_amount,
    //             'payment_type' => 'Direct Payment',
    //             'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
    //             'order_date' => Carbon::now()->toDateString(),
    //             'order_month' => Carbon::now()->format('F'),
    //             'order_year' => Carbon::now()->format('Y'),
    //             'status' => 'pending',
    //             'created_at' => Carbon::now()
    //         ]);
    
    //         $payment->save();
    
    //         foreach ($request->course_title as $key => $course_title) {
    //             $existingOrder = Order::where('user_id', Auth::user()->id)->where('course_id', $request->course_id[$key])->first();
    
    //             if ($existingOrder) {
    //                 $notification = [
    //                     'message' => 'You have already enrolled in this course',
    //                     'alert-type' => 'error'
    //                 ];
    //                 // Rollback the transaction and return with the notification
    //                 DB::rollBack();
    //                 return redirect()->back()->with($notification);
    //             }
    
    //             $order = new Order();
    //             $order->payment_id = $payment->id;
    //             $order->user_id = Auth::user()->id;
    //             $order->course_id = $request->course_id[$key];
    //             $order->instructor_id = $request->instructor_id[$key];
    //             $order->course_title = $course_title;
    //             $order->price = $request->price[$key];
    //             $order->save();
    //         }
    
    //         // If everything is successful, commit the transaction
    //         DB::commit();
    
    //         $request->session()->forget('cart');
    
    //         if ($request->cash_delivery == 'stripe') {
    //             echo "stripe";
    //         } else {
    //             $notification = [
    //                 'message' => 'Cash payment submitted successfully',
    //                 'alert-type' => 'success'
    //             ];
    //             return view('frontend.index')->with($notification);
    //         }
    //     } catch (\Exception $e) {
    //         // Something went wrong, rollback the transaction and handle the error
    //         DB::rollBack();
    //         // You can log the exception or return a generic error message
    //         $notification = [
    //             'message' => 'An error occurred while processing your payment',
    //             'alert-type' => 'error'
    //         ];
    //         return redirect()->back()->with($notification);
    //     }
    // }  

    // public function payment(Request $request)
    // {
    //     try {
    //         // Start a database transaction
    //         DB::beginTransaction();

    //         // Calculate total amount
    //         if (Session::has('coupon')) {
    //             $total_amount = Session::get('coupon')['total_amount'];
    //         } else {
    //             $total_amount = round(Cart::total());
    //         }

    //         // Create a new Payment record
    //         $payment = new Payment([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'phone' => $request->phone,
    //             'address' => $request->address,
    //             'cash_delivery' => $request->cash_delivery,
    //             'total_amount' => $total_amount,
    //             'payment_type' => 'Direct Payment',
    //             'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
    //             'order_date' => Carbon::now()->toDateString(),
    //             'order_month' => Carbon::now()->format('F'),
    //             'order_year' => Carbon::now()->format('Y'),
    //             'status' => 'pending',
    //             'created_at' => Carbon::now()
    //         ]);

    //         $payment->save();

    //         foreach ($request->course_title as $key => $course_title) {
    //             $existingOrder = Order::where('user_id', Auth::user()->id)->where('course_id', $request->course_id[$key])->first();

    //             if ($existingOrder) {
    //                 $notification = [
    //                     'message' => 'You have already enrolled in this course',
    //                     'alert-type' => 'error'
    //                 ];
    //                 // Rollback the transaction and return with the notification
    //                 DB::rollBack();
    //                 return redirect()->back()->with($notification);
    //             }

    //             $order = new Order();
    //             $order->payment_id = $payment->id;
    //             $order->user_id = Auth::user()->id;
    //             $order->course_id = $request->course_id[$key];
    //             $order->instructor_id = $request->instructor_id[$key];
    //             $order->course_title = $course_title;
    //             $order->price = $request->price[$key];
    //             $order->save();
    //         }

    //         // If everything is successful, commit the transaction
    //         DB::commit();

    //         // Send email to student
    //         $data = [
    //             'invoice_no' => $payment->invoice_no,
    //             'amount' => $total_amount,
    //             'name' => $request->name,
    //             'email' => $request->email,
    //         ];

    //         Mail::to($request->email)->send(new OrderConfirmation($data));

    //         $request->session()->forget('cart');


    //         if ($request->cash_delivery == 'stripe') {
    //             echo "stripe";
    //         } else {
                        
    //         $notification = [
    //             'message' => 'Cash payment submitted successfully',
    //             'alert-type' => 'success'
    //         ];
    //         return redirect()->route('index')->with($notification); 
    //             // return view('/')->with($notification);
    //         }
    //     } catch (\Exception $e) {
    //         // Something went wrong, rollback the transaction and handle the error
    //         DB::rollBack();
    //         // You can log the exception or return a generic error message
    //         $notification = [
    //             'message' => 'An error occurred while processing your payment',
    //             'alert-type' => 'error'
    //         ];
    //         return redirect()->back()->with($notification);
    //     }
    // }


    public function payment(Request $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Calculate total amount
            $total_amount = Session::get('coupon')['total_amount'] ?? round(Cart::total());

            // Create a new Payment record
            $payment = new Payment([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'cash_delivery' => $request->cash_delivery,
                'total_amount' => $total_amount,
                'payment_type' => 'Direct Payment',
                'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->toDateString(),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'pending',
                'created_at' => Carbon::now()
            ]);

            $payment->save();

            foreach ($request->course_title as $key => $course_title) {
                $existingOrder = Order::where('user_id', Auth::user()->id)->where('course_id', $request->course_id[$key])->first();

                if ($existingOrder) {
                    $notification = [
                        'message' => 'You have already enrolled in this course',
                        'alert-type' => 'error'
                    ];
                    // Rollback the transaction and return with the notification
                    DB::rollBack();
                    return redirect()->back()->with($notification);
                }

                $order = new Order();
                $order->payment_id = $payment->id;
                $order->user_id = Auth::user()->id;
                $order->course_id = $request->course_id[$key];
                $order->instructor_id = $request->instructor_id[$key];
                $order->course_title = $course_title;
                $order->price = $request->price[$key];
                $order->save();
            }

            // If everything is successful, commit the transaction
            DB::commit();

            // Send email to student
            $data = [
                'invoice_no' => $payment->invoice_no,
                'amount' => $total_amount,
                'name' => $request->name,
                'email' => $request->email,
                'course_title' =>$course_title,
            ];

            Mail::to($request->email)->send(new OrderConfirmation($data));

            $request->session()->forget('cart');

            if ($request->cash_delivery == 'stripe') {
                echo "stripe";
            } else {
                $notification = [
                    'message' => 'Cash payment submitted successfully',
                    'alert-type' => 'success'
                ];
                return redirect()->route('index')->with($notification);
            }
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction and handle the error
            DB::rollBack();
            // Get the real error message from the exception object
            $errorMessage = $e->getMessage();
            // Log the exception for further analysis if needed
            Log::error('Payment processing error: ' . $errorMessage);
            // Return a more descriptive error message
            $notification = [
                'message' => 'An error occurred while processing your payment: ' . $errorMessage,
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }

    


    
    


 

    
    




}