<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\BecomeInstructorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Prevent Back Starts Here
Route::group(['middleware' => 'prevent-back-history'],function(){

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index'])->name('index');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

// Admin Routes
Route::middleware(['auth','roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin-profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin-profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');   
    Route::get('/admin-change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin-update/password', [AdminController::class, 'adminUpdatePassword'])->name('update.password');
    

    // Category Route
    Route::prefix('category')->controller(CategoryController::class)->group(function () {
        Route::get('/view', 'categoryView')->name('category.view');
        Route::post('/store', 'categorystore')->name('category.store');
        Route::post('/update/{id}', 'categoryUpdate')->name('category.update');
        Route::get('/delete/{id}', 'categoryDelete')->name('category.delete');
    });
    // Subcategory Route
    Route::prefix('sub-category')->controller(SubCategoryController::class)->group(function () {
        Route::get('/view', 'subCategoryView')->name('subcategory.view');
        Route::post('/store', 'subCategorystore')->name('subcategory.store');
        Route::post('/update/{id}', 'subCategoryUpdate')->name('subcategory.update');
        Route::get('/delete/{id}', 'subCategoryDelete')->name('subcategory.delete');
    });
    // Instructor All Route 
    Route::prefix('instructor')->controller(AdminController::class)->group(function () {
        Route::get('/view', 'instructorView')->name('instructor.view');
        Route::post('/instructor-stauts','updateInstructorStatus')->name('instructor.status');   
        Route::get('/activate/{id}', 'activateInstructor')->name('activate.instructor');
        Route::get('/deactivate/{id}', 'deactivateInstructor')->name('deactivate.instructor');
    
    });
    // Course Route
    Route::prefix('load-courses')->controller(AdminController::class)->group(function () {
        Route::get('/view', 'loadAllCourses')->name('load.course.view');   
        Route::get('/activate/{id}', 'activateCourse')->name('activate.course');
        Route::get('/deactivate/{id}', 'deactivateCourse')->name('deactivate.course');
        Route::get('/course-details/{id}', 'loadCourseDetails')->name('load.course.details');
    });
    
    // Coupon Route 
    Route::prefix('coupon')->controller(CouponController::class)->group(function () {
        Route::get('/admin-view-coupon', 'adminViewCoupon')->name('admin.view.coupon');
        Route::post('/admin-store-coupon','adminStoreCoupon')->name('admin.store.coupon');
        Route::post('/admin-update-coupon/{id}','adminUpdateCoupon')->name('admin.update.coupon');
        Route::get('/delete/{id}' , 'adminDeleteCoupon')->name('admin.delete.coupon');

    });

    // SMTP All Route 
    Route::prefix('setting')->controller(SettingsController::class)->group(function () {
        Route::get('/smtp-setting', 'smtpSettings')->name('smtp.setting');
        Route::post('update-smtp','smtpUpdate')->name('update.smtp');

        // Route::post('/instructor-stauts','updateInstructorStatus')->name('instructor.status');   
        // Route::get('/activate/{id}', 'activateInstructor')->name('activate.instructor');
        // Route::get('/deactivate/{id}', 'deactivateInstructor')->name('deactivate.instructor');
    
    });



    


   
    
});


// Instructor Routes
Route::middleware(['auth','roles:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'instructorDashboard'])->name('instructor.dashboard');    
    Route::get('/instructor-logout', [InstructorController::class, 'instructorDestroy'])->name('instructor.logout');
    Route::get('/instructor-profile', [InstructorController::class, 'instructorProfile'])->name('instructor.profile');
    Route::post('/instructor-profile/store', [InstructorController::class, 'instructorProfileStore'])->name('instructor.profile.store');   
    Route::get('/instructor-change/password', [InstructorController::class, 'instructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor-update/password', [InstructorController::class, 'instructorUpdatePassword'])->name('instructor.update.password');
   
    Route::post('/instructor-update/bio', [InstructorController::class, 'instructorUpdateBio'])->name('instructor.update.bio');
    
    // course Route
    Route::prefix('course')->controller(CourseController::class)->group(function () {
        Route::get('/view', 'CourseView')->name('course.view');
        Route::get('/create-course', 'createCourse')->name('create.course');
        Route::post('/store-course', 'storeCourse')->name('store.course');       
        Route::get('/create-course', 'createCourse')->name('create.course');
        Route::get('/edit-course/{id}','editCourse')->name('edit.course');

        Route::get('/getSubcategories/{category_id}', [CourseController::class, 'getSubcategories'])->name('getSubcategories');

        // Route::post('/update/{id}', 'subCategoryUpdate')->name('subcategory.update');
        // Route::get('/delete/{id}', 'subCategoryDelete')->name('subcategory.delete');

        Route::post('/update-course','updateCourse')->name('update.course');
        Route::get('/delete-course/{id}','deleteCourse')->name('delete.course');
        
        Route::get('/add-course-lecture/{id}','addCourseLecture')->name('add.course.lecture');
        Route::post('/add-course-section','addCourseSection')->name('add.course.section');
        Route::post('/save-lecture','saveLecture')->name('save-lecture');
        Route::get('/edit-lecture/{id}','editLecture')->name('edit.lecture');

        Route::post('/update-course-lecture','updateCourseLecture')->name('update.course.lecture');

        Route::post('/delete/section/{id}','deleteSection')->name('delete.section');
        Route::get('/delete/lecture/{id}','deleteLecture')->name('delete.lecture');
    });  

});

// User Routes
Route::middleware(['auth','roles:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashobard'); 
    Route::get('/logout', [UserController::class, 'userDestroy'])->name('user.logout');

    Route::get('/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::get('/setting', [UserController::class, 'userProfileEdit'])->name('user.profile.edit');
    
    Route::post('/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::post('/update/password', [UserController::class, 'userUpdatePassword'])->name('user.update.password');
    // Route::post('/update/password', [UserController::class, 'userUpdatePassword'])->name('user.update.password');

    // Wishlist Route 
    Route::prefix('wishlist')->controller(WishListController::class)->group(function () {
        Route::get('/wishlist-view', 'userWishList')->name('user.wishlist');
        Route::get('/wishlist-course','userWishlistCourse');
        Route::get('/wishlist-remove/{id}','removeWishlist');
    });

    // Cart Routes.
    Route::prefix('cart')->controller(CartController::class)->group(function () {
        
        Route::post('/data-store/{id}', 'addToCart')->name('add.cart');
        Route::get('/data', 'cartData');

        Route::get('/mini/cart', 'getMiniCart');
        Route::get('/minicart/course/remove/{rowId}','removeMiniCart');
        
        Route::get('/show-mycart','showCart')->name('show.cart');
        Route::get('/get-cart-course','getCartCourse');
        Route::get('/remove-get-cart-course/{rowId}','RemoveGetCartCourse');



    });
    

   
});


// All Login Route
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/instructor/login', [InstructorController::class, 'instructorLogin'])->name('instructor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/user/login', [UserController::class, 'UserLogin'])->name('user.login')->middleware(RedirectIfAuthenticated::class);

//Accessibile Routes
Route::get('/become/instructor', [BecomeInstructorController ::class, 'becomeInstructorForm'])->name('become.instructor');    
Route::post('/store/become-instructor', [BecomeInstructorController::class, 'becomeInstructorStore'])->name('become.instructor.store');
Route::get('/course-details/{id}/{slug}', [IndexController::class, 'courseDetails'])->name('course.details');
Route::get('/category/{id}/{slug}', [IndexController::class, 'courseCategory']);
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'courseSubCategory']);
Route::get('/instructor-details/{id}', [IndexController::class, 'instructorDetails'])->name('instructor.details');
Route::post('/add-to-wishlist/{course_id}', [WishListController::class, 'addToWishList']);

Route::post('/coupon-apply', [CartController::class, 'couponApply']);
Route::get('/coupon-calculation', [CartController::class, 'couponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'couponRemove']);

Route::get('/check-login', [CartController::class, 'checkLogin'])->name('check.login');
Route::get('/checkout', [CartController::class, 'createCheckout'])->name('checkout');
Route::post('/payment', [CartController::class, 'payment'])->name('payment');
Route::post('/redirectWithDelay', [CartController::class, 'redirectWithDelay'])->name('redirectWithDelay');



Route::get('/get-states/{country}', [BecomeInstructorController::class, 'getStates']);
Route::get('/get-cities/{state}', [BecomeInstructorController::class, 'getCities']);




});

