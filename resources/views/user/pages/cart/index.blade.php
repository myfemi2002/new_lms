@extends('user.user_master')
@section('title', 'My Cart')
@section('user')
  
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">@yield('title')</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="/">Home</a></li>
                <li>Pages</li>
                <li>@yield('title')</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START CONTACT AREA
================================= -->
<section class="cart-area section-padding">
    <div class="container">
        <div class="table-responsive">
            <table class="table generic-table">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Course Details</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="cartPage">


                </tbody>
            </table>
            <div class="d-flex flex-wrap align-items-center justify-content-between pt-4">
                
            @if(Session::has('coupon'))
            @else 
             <!-- json_encode(Session::get('coupon'), JSON_PRETTY_PRINT)   -->
                
            <form  action="#">
                    <div class="input-group mb-2" id="couponField">
                        <input class="form-control form--control pl-3" type="text"  id="coupon_name" placeholder="Coupon code">
                        <div class="input-group-append">
                            <a type="submit" onclick="applyCoupon()" class="btn theme-btn text-white">Apply Code</a>
                        </div>
                    </div>
            </form>
            @endif

                <a href="#" class="btn theme-btn mb-2">Update Cart</a>
            </div>
        </div>

        <div class="col-lg-4 ml-auto">
            <div class="bg-gray p-4 rounded-rounded mt-40px" id="couponCalField">

                
            </div>
            <a href="{{ route('checkout') }}" class="btn theme-btn w-100">Checkout <i class="la la-arrow-right icon ml-1"></i></a>
            
        </div>
        
    </div><!-- end container -->
</section>
<!-- ================================
       END CONTACT AREA
================================= -->

<!--======================================
        START COURSE AREA
======================================-->
@php
$courses = App\Models\Course::where('status', 1)->inRandomOrder()->get();
@endphp
<section class="course-area section--padding bg-gray">
    <div class="course-wrapper">
        <div class="container">
            <div class="section-heading">
                <h2 class="section__title">You may also like</h2>
            </div>
            <!-- end section-heading -->
            <div class="course-carousel owl-action-styled owl--action-styled mt-30px">
                @foreach ($courses as $course)
                <div class="card card-item">
                    <div class="card-image">
                        <a href="course-details.html" class="d-block">
                        <img class="card-img-top" src="{{ asset('upload/course_images/' . ($course->course_image ? $course->course_image : 'no_image.jpg')) }}" alt="Card image cap">
                        </a>
                        @php
                        $amount = $course->selling_price - $course->discount_price;
                        $discount = ($amount/$course->selling_price) * 100;
                        @endphp
                        <div class="course-badge-labels">
                            @if ($course->bestseller == 1)
                            <div class="course-badge">Bestseller</div>
                            @else
                            @endif
                            @if ($course->highestrated == 1)
                            <div class="course-badge sky-blue">Highest Rated</div>
                            @else
                            @endif
                            @if ($course->discount_price == NULL)
                            <div class="course-badge blue">New</div>
                            @else
                            <div class="course-badge blue">{{ round($discount) }}%</div>
                            @endif
                        </div>
                    </div>
                    <!-- end card-image -->
                    <div class="card-body">
                        <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ ucfirst($course->level) }}</h6>
                        <h5 class="card-title"><a href="{{ url('course-details/'.$course->id.'/'.$course->course_name_slug) }}">{{ ucfirst($course->course_name) }}</a></h5>
                        <p class="card-text"><a href="{{ route('instructor.details', $course->user) }}">{{ $course['user']['name'] }}</a></p>
                        <div class="rating-wrap d-flex align-items-center py-2">
                            <div class="review-stars">
                                <span class="rating-number">4.4</span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star-o"></span>
                            </div>
                            <span class="rating-total pl-1">(20,230)</span>
                        </div>
                        <!-- end rating-wrap -->
                        <div class="d-flex justify-content-between align-items-center">
                            @if ($course->discount_price == NULL)
                            <p class="card-price text-black font-weight-bold">${{ number_format($course->selling_price, 2) }}  </p>
                            @else
                            <p class="card-price text-black font-weight-bold">${{ number_format($course->discount_price, 2) }} <span class="before-price font-weight-medium">${{ $course->selling_price }}</span></p>
                            @endif
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist" id="{{ $course->id }}" onclick="addToWishList(this.id)" ><i class="la la-heart-o"></i></div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
                @endforeach
            </div>
            <!-- end tab-content -->
        </div>
        <!-- end container -->
    </div>
    <!-- end course-wrapper -->
</section>
<!-- end courses-area -->

<!--======================================
        END COURSE AREA
======================================-->


@endsection