@extends('instructor.instructor_master')
@section('title', 'Edit Course Lecture Section')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="sa4d25">
   <div class="container-fluid"">
      <div class="row">
         <div class="col-lg-12">
            <h2 class="st_title"><i class="uil uil-analysis"></i> @yield('title')</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
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
         <div class="col-12">
            <div class="step-content">
               <div class="step-tab-panel step-tab-info active" id="tab_step1">
                  <div class="tab-from-content">
                     <div class="course__form">
                        <div class="general_info10">
                           <form action="{{ route('update.course.lecture') }}" method="post"  enctype="multipart/form-data">
                                 @csrf
                                 <input type="hidden" name="id" value="{{ $clecture->id }}">
                              <div class="row">
                                 <div class="col-lg-6 col-md-6">
                                    <div class="ui search focus mt-30 lbel25">
                                       <label>Lecture Title <span class="text-danger"> *</span></label>
                                       <div class="ui left icon input swdh19">
                                          <input class="prompt srch_explore" type="text" placeholder="Lecture Title here" name="lecture_title" value="{{ $clecture->lecture_title }}" >															
                                       </div>
                                    </div>
                                 </div>
                                 <input class="prompt srch_explore" type="hidden" placeholder="Enter Add Video Url" name="url" >															
                                          
                                          <div class="col-lg-6 col-md-6">
                                             <div class="ui search focus mt-30 lbel25">
                                                <label>Video<span class="text-danger"> *</span></label>
                                                   <div class="ui left icon input swdh19">
                                                      <input type="file" accept="video/*" name="video" id="videoInput">
                                                   </div>
                                             </div>
                                          </div>
                                 <div class="col-lg-12 col-md-12">
                                    <div class="ui search focus lbel25 mt-30">
                                       <label>Lecture Content <span class="text-danger"> *</span></label>
                                       <div class="ui form swdh30">
                                          <div class="field">
                                             <textarea name="content" placeholder="Lecture Content here...">{{ $clecture->content }}</textarea>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="step-footer step-tab-pager mt-5">
                                    <div class="text-right">
                                       <button data-direction="finish" class="btn btn-default steps_btn">Update</button>
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
   </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'ckeditor' );
</script>
@endsection
