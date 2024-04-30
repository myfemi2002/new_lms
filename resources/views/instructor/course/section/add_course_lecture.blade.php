@extends('instructor.instructor_master')
@section('title', 'Add Course Lecture Section')
@section('instructor')
<!-- Bootstrap CSS -->
<div class="sa4d25">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <h2 class="st_title"><i class="uil uil-book-alt"></i> @yield('title')</h2>
         </div>
         <div class="col-md-12">
            <div class="cmmnt_1526">
               <div class="cmnt_group">
                  <div class="img160">
                     @if($course->course_image)
                     <img src="{{ asset('upload/course_images/'.$course->course_image) }}" alt="">
                     @else
                     <img src="{{ url('upload/no_image.jpg') }}" alt="No Image">
                     @endif
                  </div>
                  <div class="card_dash_left1 ml-5">
                     <h5 class="mt-0">{{ $course->course_name }}</h5>
                  </div>
               </div>
               <div class="card_dash_left1" style="margin-left: 80px;">
                  <p class="mb-0">{{$course->course_title}}</p>
               </div>
               <div class="card_dash_right1">
                  <!-- Button to trigger modal -->
                  <button class="create_btn_dash"  data-bs-toggle="modal" data-bs-target="#exampleModal">Add Section</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Add Section Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Section </h5>
         </div>
         <div class="modal-body">
            <form action="{{ route('add.course.section')}}" method="POST">
               @csrf
               <input type="hidden" name="id" value="{{ $course->id }}">
               <div class="col-lg-12 col-md-12">
                  <div class="ui search focus mt-10 lbel25">
                     <label>Course Section <span class="text-danger"> *</span></label>
                     <div class="ui left icon input swdh19">
                        <input class="prompt srch_explore" type="text" placeholder="Course title here" name="section_title">
                     </div>
                  </div>
               </div>
         </div>
         <div class="modal-footer">   
         <button type="submit" class="create_btn_dash">Save</button> 
         <button type="button" class="create_btn_close" data-bs-dismiss="modal" aria-label="Close"> Close</button>
         </div>
         </form>
      </div>
   </div>
</div>
@foreach ($section as $key => $item )
<div class="sa4d25 mb-5">
   <div class="container-fluid">
      <div class="main-body">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body p-4 d-flex justify-content-between">
                     <h4>Section {{ $key + 1 }}: {{ $item->section_title }}</h4>
                     <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary ml-2" onclick="addLectureDiv({{ $course->id }}, {{ $item->id }}, 'lectureContainer{{ $key }}')">Add Lecture</button>
                        <!-- Selection Delete starts -->
                        <!-- <form action="{{ route('delete.section', ['id' => $item->id]) }}" method="POST">@csrf
                           <button type="submit" class="btn btn-danger px-2 ms-auto"> Delete Section</button>
                           </form> -->
                        <!-- Selection Delete ends -->
                        <form action="{{ route('delete.section', ['id' => $item->id]) }}" method="POST" id="deleteSectionForm">@csrf
                           <input type="hidden" name="confirmed" value="true">
                           <button type="submit" class="btn btn-danger px-2 ms-auto" onclick="return confirmDelete()">Delete Section</button>
                        </form>
                     </div>
                  </div>
                  <div class="courseHide" id="lectureContainer{{ $key }}">
                     <div class="sa4d25">
                        <div class="container-fluid">
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Lecture Title</th>
                                    <th>Duration</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($item->lectures as $lecture) 
                                 <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lecture->lecture_title }}</td>
                                    <td>{{ $lecture->duration !== null ? $lecture->duration : '0:00' }}</td>
                                    <td>
                                       <div class="btn-group">
                                          <a href="{{ route('edit.lecture',['id' => $lecture->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                          <a href="{{ route('delete.lecture',['id' => $lecture->id]) }}" id="delete_data" class="btn btn-sm btn-danger">Delete</a>
                                       </div>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endforeach


<script>
   document.addEventListener('DOMContentLoaded', function () {
      CKEDITOR.replace('ckeditor');
   });
</script>


<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include toastr CSS and JavaScript -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
   function addLectureDiv(courseId, sectionId, containerId) {
       const lectureContainer = document.getElementById(containerId);
       const newLectureDiv = document.createElement('div');
       newLectureDiv.classList.add('lectureDiv', 'mb-3');
       newLectureDiv.innerHTML = `
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="step-content">
                     <div class="step-tab-panel step-tab-info active" id="tab_step1">
                        <div class="tab-from-content">
                           <div class="course__form">
                              <div class="general_info10">
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                       <div class="ui search focus mt-30 lbel25">
                                          <label>Lecture Title<span class="text-danger"> *</span></label>
                                          <div class="ui left icon input swdh19">
                                             <input class="prompt srch_explore" type="text" placeholder="Enter Lecture Title" name="lecture_title" >															
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
                                          <label> Lecture Content <span class="text-danger"> *</span></label>
                                          <div class="ui form swdh30">
                                             <div class="field">
                                             <textarea name="content" id="ckeditor"  placeholder="Lecture Content here..."></textarea>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <button class="btn btn-primary mt-3" onclick="saveLecture('${courseId}',${sectionId},'${containerId}')">Save Lecture</button>
                                    <button class="btn btn-secondary mt-3" onclick="hideLectureContainer('${containerId}')">Cancel</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
       `;
       lectureContainer.appendChild(newLectureDiv);
   }
   
   function hideLectureContainer(containerId) {
        const lectureContainer = document.getElementById(containerId);
        lectureContainer.style.display = 'none';
        location.reload();
    }
   
    function saveLecture(courseId, sectionId, containerId){
    const lectureContainer = document.getElementById(containerId);
    const lectureTitle = lectureContainer.querySelector('input[name="lecture_title"]').value;
    const lectureContent = lectureContainer.querySelector('textarea').value;
    const videoFile = lectureContainer.querySelector('#videoInput').files[0]; // Get the selected video file
    const formData = new FormData(); // Create a FormData object to send files
    
    formData.append('course_id', courseId);
    formData.append('course_section_id', sectionId);
    formData.append('lecture_title', lectureTitle);
    formData.append('content', lectureContent);
    formData.append('video', videoFile); // Append the video file to the FormData
    
    fetch('/course/save-lecture', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData, // Send the FormData object
    })
    .then(response => response.json())
    .then(data => {
        toastr.success(data.success, 'Success');
        // Reload the page or do any other necessary action
        location.reload();
    })
    .catch(error => {
        console.error(error);
        toastr.error('Something went wrong!', 'Error');
    });
}

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
   function confirmDelete() {
       Swal.fire({
           title: 'Are you sure?',
           text: 'You are about to delete this section. This action cannot be undone.',
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Yes, delete it',
           cancelButtonText: 'Cancel'
       }).then((result) => {
           if (result.isConfirmed) {
               document.getElementById('deleteSectionForm').submit(); // Submit the form
           }
       });
       return false; // Prevent form submission until user confirms
   }
</script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'ckeditor' );
</script>
@endsection
