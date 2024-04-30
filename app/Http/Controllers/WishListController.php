<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseGoal;
use App\Models\Subcategory;
use App\Models\User;
use Carbon\Carbon;

class WishListController extends Controller
{
    public function addToWishList(Request $request, $course_id)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the course is already in the user's wishlist
            $exists = Wishlist::where('user_id', Auth::id())->where('course_id', $course_id)->first();

            // If the course is not in the wishlist, add it
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'course_id' => $course_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully added to your wishlist']);
            } else {
                return response()->json(['error' => 'This product is already in your wishlist']);
            }
        } else {
            return response()->json(['error' => 'Please log in to your account first']);
        }
    }

    // public function addToWishList(Request $request, $course_id){

    //     if (Auth::check()) {
    //        $exists = Wishlist::where('user_id',Auth::id())->where('course_id',$course_id)->first();

    //        if (!$exists) {
    //         Wishlist::insert([
    //             'user_id' => Auth::id(),
    //             'course_id' => $course_id,
    //             'created_at' => Carbon::now(),
    //         ]);
    //         return response()->json(['success' => 'Successfully Added on your Wishlist']);
    //        }else {
    //         return response()->json(['error' => 'This Product Has Already on your withlist']);
    //        }

    //     }else{
    //         return response()->json(['error' => 'At First Login Your Account']);
    //     } 

    // } 

    // public function addToWishList(Request $request, $course_id){

    //     if (Auth::check()) {
    //        $exists = Wishlist::where('user_id',Auth::id())->where('course_id',$course_id)->first();

    //        if (!$exists) {
    //         Wishlist::insert([
    //             'user_id' => Auth::id(),
    //             'course_id' => $course_id,
    //             'created_at' => Carbon::now(),
    //         ]);
    //         return response()->json(['success' => 'Successfully Added on your Wishlist']);
    //        }else {
    //         return response()->json(['error' => 'This Product Has Already on your withlist']);
    //        }

    //     }else{
    //         return response()->json(['error' => 'At First Login Your Account']);
    //     } 

    // } 

    public function userWishList()
    {
        return view('user.pages.wishlist.index');
    }

    // public function userWishlistCourse()
    // {
    //     $wishlist = Wishlist::with('course')
    //                         ->where('user_id', Auth::id())
    //                         ->latest()
    //                         ->get();

    //     return response()->json(['wishlist' => $wishlist]);
    // }

    public function userWishlistCourse()
    {
        $wishlist = Wishlist::with('course')->where('user_id', Auth::id())->latest()->get();
        $wishQty = Wishlist::where('user_id', Auth::id())->count();
    
        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    }

   public function removeWishlist($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Course Remove']);

    }
    
 




}
