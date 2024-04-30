@extends('admin.admin_master')
@section('title', 'Course Details')
@section('admin')


<div class="content container-fluid">
    <div class="page-header">
        <div class="content-page-header">
            <h5>@yield('title')</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><strong>Course Title: </strong>{{$course->course_title}}</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Level:</strong> {{$course->level}}</li>
                                <li class="list-group-item"><strong>Duration:</strong> {{$course->duration}}</li>
                                <li class="list-group-item"><strong>Price:</strong> ${{$course->selling_price}}</li>
                                
                                
                                @if ($course->bestseller == 0)
                                <li class="list-group-item"><strong>Bestseller:</strong> No</li>
                                @else
                                <li class="list-group-item"><strong>Bestseller:</strong> Yes</li>
                                @endif

                                <li class="list-group-item"><strong>Instructor :</strong> {{ $course['user']['name'] }}</li>
                                <li class="list-group-item"><strong>Price:</strong> {{$course->prerequisites}}</li>
                                
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Category:</strong> {{ $course['category']['category_name'] }}</li>
                                <li class="list-group-item"><strong>Subcategory:</strong> {{ $course['subcategory']['subcategory_name'] }}</li>
                                <li class="list-group-item"><strong>Created At:</strong> {{$course->created_at}}</li>
                                <li class="list-group-item"><strong>Status:</strong> 
                                @if ($course->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif</li>
                                
                                <li class="list-group-item"><strong>Duration Time:</strong> {{$course->duration}} </li>
                                <li class="list-group-item"><strong>Certificate :</strong> {{$course->certificate }}</li>
                            </ul>
                        </div>
                    </div>
                    
                    <p class="card-text mt-2"><strong>Course Description:</strong> {!! $course->description !!} </p>

                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Course Image</h5>
                    <img src="{{ asset('upload/course_images/'.$course->course_image) }}" class="img-fluid" alt="{{$course->course_title}}">

                    <h5 class="card-title mt-4">Video</h5>
                    <video controls style="width: 100%;" class="mt-3">
                        <source src="{{ asset($course->video) }}" type="video/mp4">
                    </video>

                </div>
            </div>
        </div>


    </div>
</div>
@endsection






