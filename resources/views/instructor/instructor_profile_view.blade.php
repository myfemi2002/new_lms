@extends('instructor.instructor_master')
@section('title', 'Profile')
@section('instructor')
<div class="_216b01">
   <div class="container-fluid">
      <div class="row justify-content-md-center">
         <div class="col-md-10">
            <div class="section3125 rpt145">
               <div class="row">
                  <div class="col-lg-7">
                     <a href="#" class="_216b22">										
                     <span><i class="uil uil-cog"></i></span>Setting
                     </a>
                     <div class="dp_dt150">
                        <div class="img148">
                           <img src="{{ ($instructorData->photo) ? url('upload/instructor_images/'.$instructorData->photo) : asset('instructor/assets/images/hd_dp.jpg') }}" alt="">
                        </div>
                        <div class="prfledt1">
                           <h2>{{ $instructorData->name }}</h2>
                           <span>{{ $instructorData->role }}</span>
                        </div>
                     </div>
                     <ul class="_ttl120">
                        <li>
                           <div class="_ttl121">
                              <div class="_ttl122">Enroll Students</div>
                              <div class="_ttl123">612K</div>
                           </div>
                        </li>
                        <li>
                           <div class="_ttl121">
                              <div class="_ttl122">Courses</div>
                              <div class="_ttl123">8</div>
                           </div>
                        </li>
                        <li>
                           <div class="_ttl121">
                              <div class="_ttl122">Reviews</div>
                              <div class="_ttl123">11K</div>
                           </div>
                        </li>
                        <li>
                           <div class="_ttl121">
                              <div class="_ttl122">Subscriptions</div>
                              <div class="_ttl123">452K</div>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="col-lg-5">
                     <div class="rgt-145">
                        <ul class="tutor_social_links">
                           <li><a href="#" class="fb"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="#" class="tw"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
                           <li><a href="#" class="yu"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                     </div>
                     <ul class="_bty149">
                        <li><button class="studio-link-btn btn500" onclick="window.location.href = '#';">Cursus Studio</button></li>
                        <li><button class="msg125 btn500" onclick="window.location.href = '#';">Edit</button></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="_215b15">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="course_tabs">
               <nav>
                  <div class="nav nav-tabs tab_crse" id="nav-tab" role="tablist">
                     <a class="nav-item nav-link active" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-selected="true">Edit Profile</a>
                     <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-selected="false">Change Password</a>
                     <a class="nav-item nav-link" id="nav-bio-tab" data-toggle="tab" href="#nav-bio" role="tab" aria-selected="false">Bio</a>
                     <a class="nav-item nav-link" id="nav-courses-tab" data-toggle="tab" href="#nav-courses" role="tab" aria-selected="false">Courses</a>
                     <a class="nav-item nav-link" id="nav-purchased-tab" data-toggle="tab" href="#nav-purchased" role="tab" aria-selected="false">Purchased</a>
                     <a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-selected="false">Discussion</a>
                     <a class="nav-item nav-link" id="nav-subscriptions-tab" data-toggle="tab" href="#nav-subscriptions" role="tab" aria-selected="false">Subscriptions</a>
                  </div>
               </nav>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="_215b17">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="course_tab_content">
               <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-about" role="tabpanel">
                     <div class="_htg451">
                        <div class="_htg452">
                           <div class="col-lg-7">
                              <div class="card">
                                 <div class="card-body">
                                    <form method="post" action="{{ route('instructor.profile.store') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="row mb-3">
                                          <div class="col-sm-3">
                                             <h6 class="mb-0">Full Name <span class="text-danger">*</span></h6>
                                          </div>
                                          <div class="col-sm-8 text-secondary">
                                             <input type="text" name="name" class="form-control" value="{{ $instructorData->name }}" />
                                          </div>
                                       </div>
                                       <div class="row mb-3">
                                          <div class="col-sm-3">
                                             <h6 class="mb-0">Email <span class="text-danger">*</span></h6>
                                          </div>
                                          <div class="col-sm-8 text-secondary">
                                             <input type="email" class="form-control" value="{{ $instructorData->email }}" readonly />
                                          </div>
                                       </div>
                                       <div class="row mb-3">
                                          <div class="col-sm-3">
                                             <h6 class="mb-0">Phone <span class="text-danger">*</span></h6>
                                          </div>
                                          <div class="col-sm-8 text-secondary">
                                             <input type="tel" name="phone" class="form-control" value="{{ $instructorData->phone }}" />
                                          </div>
                                       </div>
                                       <div class="row mb-3">
                                          <div class="col-sm-3">
                                             <h6 class="mb-0">Address</h6>
                                          </div>
                                          <div class="col-sm-8 text-secondary">
                                             <textarea type="text" name="address" rows="2" class="form-control">{{ $instructorData->address }}</textarea>
                                          </div>
                                       </div>
                                       <div class="row mb-3">
                                          <div class="col-sm-3">
                                             <h6 class="mb-0">Photo</h6>
                                          </div>
                                          <div class="col-sm-8 text-secondary">
                                             <input type="file" name="photo" class="form-control" id="image" />
                                          </div>
                                       </div>
                                       <div class="row mb-3">
                                          <div class="col-sm-3">
                                             <h6 class="mb-0"></h6>
                                          </div>
                                          <div class="col-sm-8 text-secondary">
                                             @if ($errors->any())
                                             <div class="alert alert-danger alert-sm">
                                                <ul>
                                                   @foreach ($errors->all() as $error)
                                                   <li>{{ $error }}</li>
                                                   @endforeach
                                                </ul>
                                             </div>
                                             @endif
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-sm-3"></div>
                                          <div class="col-sm-8 text-secondary">
                                             <input type="submit" class="btn btn-primary" value="Save Changes">
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="nav-password" role="tabpanel">
                     <div class="crse_content">
                        <div class="_14d25">
                           <div class="row">
                              <div class="col-lg-8 ">
                                 <div class="card">
                                    <div class="card-body">
                                       <form method="post" action="{{ route('instructor.update.password') }}">
                                          @csrf
                                          <div class="row mb-3">
                                             <div class="col-sm-3">
                                                <h6 class="mb-0">Old Password</h6>
                                             </div>
                                             <div class="col-sm-9 text-secondary">
                                                <input type="password" name="old_password" class="form-control  id="current_password"   placeholder="Old Password" required/>
                                                @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="row mb-3">
                                             <div class="col-sm-3">
                                                <h6 class="mb-0">New Password</h6>
                                             </div>
                                             <div class="col-sm-9 text-secondary">
                                                <input type="password" name="new_password" class="form-control  id="new_password"   placeholder="New Password" required/>
                                                @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="row mb-3">
                                             <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm Password</h6>
                                             </div>
                                             <div class="col-sm-9 text-secondary">
                                                <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation"   placeholder="Confirm Password" required/>
                                                @error('new_password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-sm-3"></div>
                                             <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                             </div>
                                          </div>
                                    </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="tab-pane fade" id="nav-bio" role="tabpanel">
                     <div class="crse_content">
                        <div class="_14d25">
                           <div class="row">
                              <div class="col-12">
                                 <div class="step-content">
                                    <div class="step-tab-panel step-tab-info active" id="tab_step1">
                                       <div class="tab-from-content">
                                          <form  method="post" action="{{ route('instructor.update.bio') }}">
                                             @csrf
                                             <div class="course__form">
                                                <div class="general_info10">
                                                   <div class="row">
                                                      <!-- Add this script to your HTML file -->
                                                      <div class="col-lg-12 col-md-12">
                                                         <div class="ui search focus mt-10 lbel25">
                                                            <label>Headline <span class="text-danger"> *</span></label>
                                                            <div class="ui left icon input swdh19">
                                                               <input class="prompt srch_explore" type="text" placeholder="Course title here" name="headline" value="{{ $instructorData->headline }}">
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <!-- Updated HTML with added character count elements -->
                                                      <div class="col-lg-12 col-md-12">
                                                         <div class="ui search focus lbel25 mt-30">
                                                            <label>Bio <span class="text-danger"> *</span></label>
                                                            <div class="ui form swdh30">
                                                               <div class="field">
                                                                  <textarea name="bio" id="bio_textarea" placeholder="Bio here..." oninput="updateCharacterCount('bio_textarea', 'count_bio_textarea', 650)">{{ $instructorData->bio }}</textarea>
                                                                  <div id="count_bio_textarea" class="text-right">Characters left: 650</div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-12 col-md-12">
                                                         <div class="ui search focus lbel25 mt-30">
                                                            <label>Professional Profile <span class="text-danger"> *</span></label>
                                                            <div class="ui form swdh30">
                                                               <div class="field">
                                                                  <textarea name="professional_profile" id="profile_textarea" placeholder="Professional Profile here..." oninput="updateCharacterCount('profile_textarea', 'count_profile_textarea', 750)">{{ $instructorData->professional_profile}}</textarea>
                                                                  <div id="count_profile_textarea" class="text-right">Characters left: 750</div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      
                                          <div class="row mt-5">
                                             <div class="col-sm-3"></div>
                                             <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                             </div>
                                          </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="tab-pane fade" id="nav-courses" role="tabpanel">
                     <div class="crse_content">
                        <h3>My courses (8)</h3>
                        <div class="_14d25">
                           <div class="row">
                              <div class="col-lg-3 col-md-4">
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="fcrse_img">
                                       <img src="images/courses/img-1.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="badge_seller">Bestseller</div>
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>4.5
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             25 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="fcrse_content">
                                       <div class="eps_dots more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-share-alt"></i>Share</span>
                                             <span><i class="uil uil-edit-alt"></i>Edit</span>
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">109k views</span>
                                          <span class="vdt14">15 days ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s">Complete Python Bootcamp: Go from zero to hero in Python 3</a>
                                       <a href="#" class="crse-cate">Web Development | Python</a>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">John Doe</a></p>
                                          <div class="prce142">$10</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-4">
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="fcrse_img">
                                       <img src="images/courses/img-2.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="badge_seller">Bestseller</div>
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>4.5
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             28 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="fcrse_content">
                                       <div class="eps_dots more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-share-alt"></i>Share</span>
                                             <span><i class="uil uil-edit-alt"></i>Edit</span>
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">5M views</span>
                                          <span class="vdt14">15 days ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s">The Complete JavaScript Course 2020: Build Real Projects!</a>
                                       <a href="#" class="crse-cate">Development | JavaScript</a>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">John Doe</a></p>
                                          <div class="prce142">$5</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-4">
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="fcrse_img">
                                       <img src="images/courses/img-20.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>5.0
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             21 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="fcrse_content">
                                       <div class="eps_dots more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-share-alt"></i>Share</span>
                                             <span><i class="uil uil-edit-alt"></i>Edit</span>
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">200 Views</span>
                                          <span class="vdt14">4 days ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s">WordPress Development - Themes, Plugins &amp; Gutenberg</a>
                                       <a href="#" class="crse-cate">Design | Wordpress</a>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">John Doe</a></p>
                                          <div class="prce142">$14</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-4">
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="fcrse_img">
                                       <img src="images/courses/img-4.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="badge_seller">Bestseller</div>
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>5.0
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             1 hour
                                          </div>
                                       </div>
                                    </a>
                                    <div class="fcrse_content">
                                       <div class="eps_dots more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-share-alt"></i>Share</span>
                                             <span><i class="uil uil-edit-alt"></i>Edit</span>
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">153k views</span>
                                          <span class="vdt14">3 months ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s">The Complete Digital Marketing Course - 12 Courses in 1</a>
                                       <a href="#" class="crse-cate">Digital Marketing | Marketing</a>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">John Doe</a></p>
                                          <div class="prce142">$12</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-4">
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="fcrse_img">
                                       <img src="images/courses/img-13.jpg" alt="">
                                       <div class="course-overlay">
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             30 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="fcrse_content">
                                       <div class="eps_dots more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-share-alt"></i>Share</span>
                                             <span><i class="uil uil-edit-alt"></i>Edit</span>
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">20 Views</span>
                                          <span class="vdt14">1 day ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s">The Complete Node.js Developer Course (3rd Edition)</a>
                                       <a href="#" class="crse-cate">Development | Node.js</a>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">John Doe</a></p>
                                          <div class="prce142">$3</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-4">
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="fcrse_img">
                                       <img src="images/courses/img-7.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="badge_seller">Bestseller</div>
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>5.0
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             5.4 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="fcrse_content">
                                       <div class="eps_dots more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-share-alt"></i>Share</span>
                                             <span><i class="uil uil-edit-alt"></i>Edit</span>
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">109k views</span>
                                          <span class="vdt14">15 days ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s">WordPress for Beginners: Create a Website Step by Step</a>
                                       <a href="#" class="crse-cate">Design | Wordpress</a>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">John Doe</a></p>
                                          <div class="prce142">$18</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-4">
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="fcrse_img">
                                       <img src="images/courses/img-8.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="badge_seller">Bestseller</div>
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>4.0
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             23 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="fcrse_content">
                                       <div class="eps_dots more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-share-alt"></i>Share</span>
                                             <span><i class="uil uil-edit-alt"></i>Edit</span>
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">196k views</span>
                                          <span class="vdt14">1 month ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s">CSS - The Complete Guide 2020 (incl. Flexbox, Grid &amp; Sass)</a>
                                       <a href="#" class="crse-cate">Design | CSS</a>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">John Doe</a></p>
                                          <div class="prce142">$10</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-4">
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="fcrse_img">
                                       <img src="images/courses/img-16.jpg" alt="">
                                       <div class="course-overlay">
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             22 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="fcrse_content">
                                       <div class="eps_dots more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-share-alt"></i>Share</span>
                                             <span><i class="uil uil-edit-alt"></i>Edit</span>
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">11 Views</span>
                                          <span class="vdt14">5 Days ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s">Vue JS 2 - The Complete Guide (incl. Vue Router &amp; Vuex)</a>
                                       <a href="#" class="crse-cate">Development | Vue JS</a>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">John Doe</a></p>
                                          <div class="prce142">$10</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade show" id="nav-purchased" role="tabpanel">
                     <div class="_htg451">
                        <div class="_htg452">
                           <h3>Purchased Courses</h3>
                           <div class="row">
                              <div class="col-md-9">
                                 <div class="fcrse_1 mt-20">
                                    <a href="course_detail_view.html" class="hf_img">
                                       <img src="images/courses/img-1.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="badge_seller">Bestseller</div>
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>4.5
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             25 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="hs_content">
                                       <div class="eps_dots eps_dots10 more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-download-alt"></i>Download</span>															
                                             <span><i class="uil uil-trash-alt"></i>Delete</span>															
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">109k views</span>
                                          <span class="vdt14">15 days ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s title900">Complete Python Bootcamp: Go from zero to hero in Python 3</a>
                                       <a href="#" class="crse-cate">Web Development | Python</a>
                                       <div class="purchased_badge">Purchased</div>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">John Doe</a></p>
                                          <div class="prce142">$10</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="hf_img">
                                       <img src="images/courses/img-2.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="badge_seller">Bestseller</div>
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>4.5
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             28 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="hs_content">
                                       <div class="eps_dots eps_dots10 more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-download-alt"></i>Download</span>															
                                             <span><i class="uil uil-trash-alt"></i>Delete</span>															
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">5M views</span>
                                          <span class="vdt14">15 days ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s title900">The Complete JavaScript Course 2020: Build Real Projects!</a>
                                       <a href="#" class="crse-cate">Development | JavaScript</a>
                                       <div class="purchased_badge">Purchased</div>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">Jassica William</a></p>
                                          <div class="prce142">$5</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="hf_img">
                                       <img src="images/courses/img-3.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="badge_seller">Bestseller</div>
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>4.5
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             12 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="hs_content">
                                       <div class="eps_dots eps_dots10 more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-download-alt"></i>Download</span>															
                                             <span><i class="uil uil-trash-alt"></i>Delete</span>															
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">1M views</span>
                                          <span class="vdt14">18 days ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s title900">Beginning C++ Programming - From Beginner to Beyond</a>
                                       <a href="#" class="crse-cate">Development | C++</a>
                                       <div class="purchased_badge">Purchased</div>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">{{ $instructorData->name }}</a></p>
                                          <div class="prce142">$13</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="fcrse_1 mt-30">
                                    <a href="course_detail_view.html" class="hf_img">
                                       <img src="images/courses/img-4.jpg" alt="">
                                       <div class="course-overlay">
                                          <div class="badge_seller">Bestseller</div>
                                          <div class="crse_reviews">
                                             <i class="uil uil-star"></i>5.0
                                          </div>
                                          <span class="play_btn1"><i class="uil uil-play"></i></span>
                                          <div class="crse_timer">
                                             1 hours
                                          </div>
                                       </div>
                                    </a>
                                    <div class="hs_content">
                                       <div class="eps_dots eps_dots10 more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class="uil uil-download-alt"></i>Download</span>															
                                             <span><i class="uil uil-trash-alt"></i>Delete</span>															
                                          </div>
                                       </div>
                                       <div class="vdtodt">
                                          <span class="vdt14">153k views</span>
                                          <span class="vdt14">3 months ago</span>
                                       </div>
                                       <a href="course_detail_view.html" class="crse14s title900">The Complete Digital Marketing Course - 12 Courses in 1</a>
                                       <a href="#" class="crse-cate">Digital Marketing | Marketing</a>
                                       <div class="purchased_badge">Purchased</div>
                                       <div class="auth1lnkprce">
                                          <p class="cr1fot">By <a href="#">Poonam Verma</a></p>
                                          <div class="prce142">$12</div>
                                          <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                     <div class="student_reviews">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="review_right">
                                 <div class="review_right_heading">
                                    <h3>Discussions</h3>
                                 </div>
                              </div>
                              <div class="cmmnt_1526">
                                 <div class="cmnt_group">
                                    <div class="img160">
                                       <img src="images/hd_dp.jpg" alt="">									
                                    </div>
                                    <textarea class="_cmnt001" placeholder="Add a public comment"></textarea>
                                 </div>
                                 <button class="cmnt-btn" type="submit">Comment</button>
                              </div>
                              <div class="review_all120">
                                 <div class="review_item">
                                    <div class="review_usr_dt">
                                       <img src="images/left-imgs/img-1.jpg" alt="">
                                       <div class="rv1458">
                                          <h4 class="tutor_name1">John Doe</h4>
                                          <span class="time_145">2 hour ago</span>
                                       </div>
                                       <div class="eps_dots more_dropdown">
                                          <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                          <div class="dropdown-content">
                                             <span><i class='uil uil-comment-alt-edit'></i>Edit</span>
                                             <span><i class='uil uil-trash-alt'></i>Delete</span>
                                          </div>
                                       </div>
                                    </div>
                                    <p class="rvds10">Nam gravida elit a velit rutrum, eget dapibus ex elementum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
                                    <div class="rpt101">
                                       <a href="#" class="report155"><i class='uil uil-thumbs-up'></i> 10</a>
                                       <a href="#" class="report155"><i class='uil uil-thumbs-down'></i> 1</a>
                                       <a href="#" class="report155"><i class='uil uil-heart'></i></a>
                                       <a href="#" class="report155 ml-3">Reply</a>
                                    </div>
                                 </div>
                                 <div class="review_reply">
                                    <div class="review_item">
                                       <div class="review_usr_dt">
                                          <img src="images/left-imgs/img-3.jpg" alt="">
                                          <div class="rv1458">
                                             <h4 class="tutor_name1">Rock Doe</h4>
                                             <span class="time_145">1 hour ago</span>
                                          </div>
                                          <div class="eps_dots more_dropdown">
                                             <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                             <div class="dropdown-content">
                                                <span><i class='uil uil-trash-alt'></i>Delete</span>
                                             </div>
                                          </div>
                                       </div>
                                       <p class="rvds10">Fusce lacinia, nunc sit amet tincidunt venenatis.</p>
                                       <div class="rpt101">
                                          <a href="#" class="report155"><i class='uil uil-thumbs-up'></i> 4</a>
                                          <a href="#" class="report155"><i class='uil uil-thumbs-down'></i> 2</a>
                                          <a href="#" class="report155"><i class='uil uil-heart'></i></a>
                                          <a href="#" class="report155 ml-3">Reply</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="tab-pane fade show" id="nav-subscriptions" role="tabpanel">
                     <div class="_htg451">
                     	<div class="_htg452">
                     		<h3>Subscriptions</h3>
                     		<div class="row">
                     			<div class="col-lg-3 col-md-4">
                     				<div class="fcrse_1 mt-30">
                     					<div class="tutor_img">
                     						<a href="#"><img src="images/left-imgs/img-1.jpg" alt=""></a>												
                     					</div>
                     					<div class="tutor_content_dt">
                     						<div class="tutor150">
                     							<a href="#" class="tutor_name">John Doe</a>
                     							<div class="mef78" title="Verify">
                     								<i class="uil uil-check-circle"></i>
                     							</div>
                     						</div>
                     						<div class="tutor_cate">Wordpress &amp; Plugin Tutor</div>
                     						<ul class="tutor_social_links">
                     							<li><button class="sbbc145">Subscribed</button></li>
                     							<li><button class="sbbc146"><i class="uil uil-bell"></i></button></li>
                     						</ul>
                     						<div class="tut1250">
                     							<span class="vdt15">100K Students</span>
                     							<span class="vdt15">15 Courses</span>
                     						</div>
                     					</div>
                     				</div>										
                     			</div>
                     			<div class="col-lg-3 col-md-4">
                     				<div class="fcrse_1 mt-30">
                     					<div class="tutor_img">
                     						<a href="#"><img src="images/left-imgs/img-2.jpg" alt=""></a>											
                     					</div>
                     					<div class="tutor_content_dt">
                     						<div class="tutor150">
                     							<a href="#" class="tutor_name">Kerstin Cable</a>
                     							<div class="mef78" title="Verify">
                     								<i class="uil uil-check-circle"></i>
                     							</div>
                     						</div>
                     						<div class="tutor_cate">Language Learning Coach, Writer, Online Tutor</div>
                     						<ul class="tutor_social_links">
                     							<li><button class="sbbc145">Subscribed</button></li>
                     							<li><button class="sbbc146"><i class="uil uil-bell"></i></button></li>
                     						</ul>
                     						<div class="tut1250">
                     							<span class="vdt15">14K Students</span>
                     							<span class="vdt15">11 Courses</span>
                     						</div>
                     					</div>
                     				</div>										
                     			</div>
                     			<div class="col-lg-3 col-md-4">
                     				<div class="fcrse_1 mt-30">
                     					<div class="tutor_img">
                     						<a href="#"><img src="images/left-imgs/img-3.jpg" alt=""></a>												
                     					</div>
                     					<div class="tutor_content_dt">
                     						<div class="tutor150">
                     							<a href="#" class="tutor_name">Jose Portilla</a>
                     							<div class="mef78" title="Verify">
                     								<i class="uil uil-check-circle"></i>
                     							</div>
                     						</div>
                     						<div class="tutor_cate">Head of Data Science, Pierian Data Inc.</div>
                     						<ul class="tutor_social_links">
                     							<li><button class="sbbc145">Subscribed</button></li>
                     							<li><button class="sbbc146"><i class="uil uil-bell"></i></button></li>
                     						</ul>
                     						<div class="tut1250">
                     							<span class="vdt15">1M Students</span>
                     							<span class="vdt15">25 Courses</span>
                     						</div>
                     					</div>
                     				</div>										
                     			</div>
                     			<div class="col-lg-3 col-md-4">
                     				<div class="fcrse_1 mt-30">
                     					<div class="tutor_img">
                     						<a href="#"><img src="images/left-imgs/img-3.jpg" alt=""></a>												
                     					</div>
                     					<div class="tutor_content_dt">
                     						<div class="tutor150">
                     							<a href="#" class="tutor_name">Jose Portilla</a>
                     							<div class="mef78" title="Verify">
                     								<i class="uil uil-check-circle"></i>
                     							</div>
                     						</div>
                     						<div class="tutor_cate">Head of Data Science, Pierian Data Inc.</div>
                     						<ul class="tutor_social_links">
                     							<li><button class="sbbc145">Subscribed</button></li>
                     							<li><button class="sbbc146"><i class="uil uil-bell"></i></button></li>
                     						</ul>
                     						<div class="tut1250">
                     							<span class="vdt15">1M Students</span>
                     							<span class="vdt15">25 Courses</span>
                     						</div>
                     					</div>
                     				</div>										
                     			</div>
                     		</div>				
                     	</div>																	
                     </div>							
                     </div> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'ckeditor' );
   CKEDITOR.replace( 'ckeditor1' );
</script>
<!-- Add this script to your HTML file -->
<script>
   // Function to limit the number of characters for a textarea
   function limitTextareaCharacters(textareaId, maxLength) {
       const textarea = document.getElementById(textareaId);
       if (textarea.value.length > maxLength) {
           textarea.value = textarea.value.substring(0, maxLength);
       }
   }
   
   // Function to update character count for a textarea
   function updateCharacterCount(textareaId, countId, maxLength) {
       const textarea = document.getElementById(textareaId);
       const countElement = document.getElementById(countId);
       const remainingCharacters = maxLength - textarea.value.length;
       countElement.textContent = `Characters left: ${remainingCharacters}`;
       
       if (remainingCharacters <= 0) {
           textarea.value = textarea.value.substring(0, maxLength);
           textarea.setAttribute('readonly', 'true');
       } else {
           textarea.removeAttribute('readonly');
       }
   }
   
   // Attach event listeners to the textareas
   document.getElementById('bio_textarea').addEventListener('input', function () {
       limitTextareaCharacters('bio_textarea', 650);
       updateCharacterCount('bio_textarea', 'count_bio_textarea', 650);
   });
   
   document.getElementById('profile_textarea').addEventListener('input', function () {
       limitTextareaCharacters('profile_textarea', 750);
       updateCharacterCount('profile_textarea', 'count_profile_textarea', 750);
   });
   
   // Initial character count update
   updateCharacterCount('bio_textarea', 'count_bio_textarea', 650);
   updateCharacterCount('profile_textarea', 'count_profile_textarea', 750);
</script>
@endsection
