<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseSection;
use App\Models\CourseLecture;
use App\Models\CourseGoal;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Redirect;
use getID3;


class CourseController extends Controller
{
    public function courseView(){
        $id = Auth::user()->id;
        $courses = Course::where('user_id',$id)->orderBy('id','desc')->paginate(10);
        return view('instructor.course.index',compact('courses'));
    }

    public function createCourse(){
        $categories = Category::latest()->get();
        return view('instructor.course.create_course', compact('categories'));
    }

    public function getSubcategories(Request $request, $category_id)
    {
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }

    public function storeCourse(Request $request)
    {
        // Validate the request parameters
        $validatedData = $request->validate([
            'course_title' => 'required',
            'course_name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'course_image' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg|max:10240',
            'video' => 'required|file|mimetypes:video/mp4|max:102400',
            'level' => 'required',
            // 'duration' => 'required',
            'resources' => 'required',
            'certificate' => 'required',
            'selling_price' => 'required|numeric',
            // 'discount_price' => 'required|numeric',
            'prerequisites' => 'required',
            'description' => 'required',
            'course_goals.*' => 'required',

       
  

        ], [
            // Custom validation messages if needed
        ]);

        // Initialize data to be saved
        $data = new Course();

        // Process course image if provided
        if ($request->hasFile('course_image')) {
            // Generate a unique name for the image
            $uniqueName = hexdec(uniqid()) . '.' . $request->file('course_image')->getClientOriginalExtension();

            // Create an instance of the ImageManager with the specified driver
            $imageManager = new ImageManager(new Driver());

            // Read the uploaded image, resize it, and convert it to JPEG format with 80% quality
            $processedImage = $imageManager
                ->read($request->file('course_image'))
                ->resize(600, 400)
                ->tojpeg(80);

            // Define the upload path for the processed image
            $uploadPath = public_path('upload/course_images/' . $uniqueName);

            // Save the processed image to the specified upload path
            $processedImage->save($uploadPath);

            // Set the course_image field in the data to the generated unique name
            $data->course_image = $uniqueName;
        }

            // Process course video if provided
            $video = $request->file('video');

            // Check if a video file is present in the request
            if ($video) {
                $videoName = time() . '.' . $video->getClientOriginalExtension();

                // Move the video file to the specified upload path
                $video->move(public_path('upload/course/video/'), $videoName);

                // Set the video field in the data to the generated unique name
                $data->video = 'upload/course/video/' . $videoName;

                // Calculate video duration
                $videoPath = public_path($data->video);
                $duration = $this->getVideoDuration($videoPath);

                // Save the duration to the database
                $data->duration = $duration;
            }

                // Set other fields in the data
                $data->category_id = $request->category_id;
                $data->subcategory_id = $request->subcategory_id;
                $data->user_id = Auth::user()->id;
                $data->course_title = $request->course_title;
                $data->course_name = $request->course_name;
                $data->course_name_slug = strtolower(str_replace(' ', '-', $request->course_name));
                $data->description = $request->description;
                $data->level = $request->level;
                $data->resources = $request->resources;
                $data->certificate = $request->certificate;
                $data->selling_price = $request->selling_price;
                $data->discount_price = $request->discount_price;
                $data->discount_expiry_date = $request->discount_expiry_date;
                $data->prerequisites = $request->prerequisites;
                $data->bestseller = $request->bestseller;
                $data->featured = $request->featured;
                $data->highestrated = $request->highestrated;
                $data->status = 1;
                $data->created_at = now();
            
                // Save the data to the database
                    
                $data->save();

                // Insert course goals
                $courseGoals = $request->course_goals;
                if (!empty($courseGoals)) {
                    foreach ($courseGoals as $goal) {
                        $courseGoal = new CourseGoal();
                        $courseGoal->course_id = $data->id;
                        $courseGoal->goal_name = $goal;
                        $courseGoal->save();
                    }
                }
                activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('course and course Goal added ');
            
                // Redirect with success message
                $notification = [
                    'message' => 'Course Inserted Successfully',
                    'alert-type' => 'success'
                ];

                return redirect()->route('course.view')->with($notification);
            }

    
            public function getVideoDuration($filePath)
            {
                $getID3 = new getID3();
                $fileInfo = $getID3->analyze($filePath);
            
                if (isset($fileInfo['playtime_seconds'])) {
                    $hours = floor($fileInfo['playtime_seconds'] / 3600);
                    $minutes = floor(($fileInfo['playtime_seconds'] % 3600) / 60);
                    $seconds = $fileInfo['playtime_seconds'] % 60;
            
                    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                }
            
                return null;
            }
            

        public function editCourse($id){
            $course = Course::find($id);
            $categories = Category::latest()->get();
            $subcategories = SubCategory::latest()->get();
            $goals = CourseGoal::where('course_id',$id)->get();

            return view('instructor.course.edit_course', compact('course','categories','subcategories','goals'));

        }

        public function updateCourse(Request $request)
        {
            try {
                // Validate the request parameters
                $validatedData = $request->validate([
                    'course_title' => 'required',
                    'course_name' => 'required',
                    'category_id' => 'required',
                    'subcategory_id' => 'required',
                    'course_image' => 'file|mimetypes:image/jpeg,image/png,image/jpg|max:10240',
                    'video' => 'file|mimetypes:video/mp4|max:102400',
                    'level' => 'required',
                    // 'duration' => 'required', // This line is commented out as we are not updating duration here
                    'resources' => 'required',
                    'certificate' => 'required',
                    'selling_price' => 'required|numeric',
                    'discount_price' => 'required|numeric',
                    'prerequisites' => 'required',
                    'description' => 'required',
                    'course_goals.*' => 'required',
                ], [
                    // Custom validation messages if needed
                ]);
        
                $cid = $request->course_id;
                // Find the existing course by ID
                $course = Course::findOrFail($cid);
        
                // Update existing course fields
                $course->category_id = $request->category_id;
                $course->subcategory_id = $request->subcategory_id;
                $course->course_title = $request->course_title;
                $course->course_name = $request->course_name;
                $course->user_id = Auth::user()->id;
                $course->course_name_slug = strtolower(str_replace(' ', '-', $request->course_name));
                $course->description = $request->description;
                $course->level = $request->level;
                $course->resources = $request->resources;
                $course->certificate = $request->certificate;
                $course->selling_price = $request->selling_price;
                $course->discount_price = $request->discount_price;
                $course->discount_expiry_date = $request->discount_expiry_date;
                $course->prerequisites = $request->prerequisites;
                $course->bestseller = $request->bestseller;
                $course->featured = $request->featured;
                $course->highestrated = $request->highestrated;
                $course->status = 1;
                $course->updated_at = now();
        
                // Process course image if provided
                if ($request->hasFile('course_image')) {
                    // Delete existing image if it exists
                    if (!empty($course->course_image)) {
                        $existingImagePath = public_path('upload/course_images/' . $course->course_image);
        
                        if (file_exists($existingImagePath)) {
                            unlink($existingImagePath);
                        }
                    }
        
                    // Generate a unique name for the image
                    $uniqueName = hexdec(uniqid()) . '.' . $request->file('course_image')->getClientOriginalExtension();
        
                    // Create an instance of the ImageManager with the specified driver
                    $imageManager = new ImageManager(new Driver());
        
                    // Read the uploaded image, resize it, and convert it to JPEG format with 80% quality
                    $processedImage = $imageManager
                        ->read($request->file('course_image'))
                        ->resize(600, 400)
                        ->tojpeg(80);
        
                    // Define the upload path for the processed image
                    $uploadPath = public_path('upload/course_images/' . $uniqueName);
        
                    // Save the processed image to the specified upload path
                    $processedImage->save($uploadPath);
        
                    // Set the course_image field in the data to the generated unique name
                    $course->course_image = $uniqueName;
                }
        
                // Process course video if provided
                if ($request->hasFile('video')) {
                    // Delete existing video if it exists
                    if (!empty($course->video)) {
                        $existingVideoPath = public_path($course->video);
        
                        if (file_exists($existingVideoPath)) {
                            unlink($existingVideoPath);
                        }
                    }
        
                    // Move the video file to the specified upload path
                    $videoName = time() . '.' . $request->file('video')->getClientOriginalExtension();
                    $request->file('video')->move(public_path('upload/course/video/'), $videoName);
        
                    // Set the video field in the data to the generated unique name
                    $course->video = 'upload/course/video/' . $videoName;
        
                    // Calculate video duration
                    $videoPath = public_path($course->video);
                    $duration = $this->getVideoDuration($videoPath);
        
                    // Save the duration to the database
                    $course->duration = $duration;
                }
        
                // Update the course in the database
                $course->update();
        
                // Delete existing course goals
                $course->goals()->delete();
        
                // Insert course goals
                $courseGoals = $request->course_goals;
                if (!empty($courseGoals)) {
                    foreach ($courseGoals as $goal) {
                        $courseGoal = new CourseGoal();
                        $courseGoal->course_id = $course->id;
                        $courseGoal->goal_name = $goal;
                        $courseGoal->save();
                    }
                }
        
                activity()->performedOn($course)->causedBy(auth()->user())->withProperties(['action' => $course])->log('course and course Goal updated ');
        
                // Redirect with success message
                $notification = [
                    'message' => 'Course Updated Successfully',
                    'alert-type' => 'success'
                ];
        
                return redirect()->route('course.view')->with($notification);
            } catch (\Exception $e) {
                // Handle any unexpected errors
        
                // Redirect with error message
                $notification = [
                    'message' => 'An error occurred.',
                    'alert-type' => 'error'
                ];
        
                return redirect()->back()->with($notification);
        
            }
        
        } 
         
        
        public function deleteCourse($id)
        {
            try {
                // Find the existing course by ID
                $course = Course::findOrFail($id);

                // Delete existing course image if it exists
                if (!empty($course->course_image)) {
                    $existingImagePath = public_path('upload/course_images/' . $course->course_image);

                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }

                // Delete existing course video if it exists
                if (!empty($course->video)) {
                    $existingVideoPath = public_path($course->video);

                    if (file_exists($existingVideoPath)) {
                        unlink($existingVideoPath);
                    }
                }

                // Delete existing course goals
                $course->goals()->delete();

                // Delete the course from the database
                $course->delete();

                // Log the activity
                activity()
                    ->performedOn($course)
                    ->causedBy(auth()->user())
                    ->withProperties(['action' => 'delete'])
                    ->log('Course deleted');

                // Redirect with success message
                return redirect()->route('course.view')->with([
                    'message' => 'Course Deleted Successfully',
                    'alert-type' => 'success'
                ]);
            } catch (\Exception $e) {
                // Handle any unexpected errors

                // Redirect with error message
                return redirect()->back()->with([
                    'message' => 'An error occurred while deleting the course. Please try again later.',
                    'alert-type' => 'error'
                ]);
            }
        }

        public function addCourseLecture($id){
            $course = Course::find($id);
            $section = CourseSection::where('course_id', $id)->orderBy('created_at', 'asc')->get();

            return view('instructor.course.section.add_course_lecture',compact('course','section'));
        }

        public function addCourseSection(Request $request){
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'section_title' => [
                    'required',
                    // Unique rule with condition
                    Rule::unique('course_sections')
                        ->where(function ($query) use ($request) {
                            return $query->where('course_id', $request->id)->where('user_id', auth()->id());
                        }),
                ],
                ],
                [
                // Set a success notification
                $notification = [
                    'message' => 'The section title already exists for this course.',
                    'alert-type' => 'error'
                    ]
                ]);
        
            // If validation fails, return back with errors
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput()->with($notification);
            }
            // Insert the new course section into the database
            CourseSection::create([
                'course_id' => $request->id,
                'section_title' => $request->section_title,
                'user_id' => auth()->id() // Associate the section with the authenticated user
            ]);
            
            // Logging the activity
            $data = ['course_id' => $request->id, 'section_title' => $request->section_title];
            activity()->performedOn(new CourseSection($data))->causedBy(auth()->user())->withProperties(['action' => $data])->log('Course Section added');
    
            // Set a success notification
            $notification = array(
                'message' => 'Course Section Added Successfully',
                'alert-type' => 'success'
            );
            // Redirect back with the notification
            return redirect()->back()->with($notification);
        }

        public function saveLecture(Request $request)
        {
            // Validate the request parameters
            $validatedData = $request->validate([
                'lecture_title' => 'required',
                'course_id' => 'required',
                'course_section_id' => 'required',
                'video' => 'required|file|mimetypes:video/mp4',
                'content' => 'required',
            ], [
                // Custom validation messages if needed
            ]);
        
            // Initialize data to be saved
            $data = new CourseLecture();
        
            // Process course video if provided
            $video = $request->file('video');
        
            // Check if a video file is present in the request
            if ($video) {
                $videoName = time() . '.' . $video->getClientOriginalExtension();
        
                // Move the video file to the specified upload path
                $video->move(public_path('upload/course/course_lecture_section_video/'), $videoName);
        
                // Set the video field in the data to the generated unique name
                $data->video = 'upload/course/course_lecture_section_video/' . $videoName;
        
                // Calculate video duration
                $videoPath = public_path($data->video);
                $duration = $this->getVideoDuration($videoPath);
        
                // Save the duration to the database
                $data->duration = $duration;
            }
        
            // Set other fields in the data
            $data->lecture_title = $request->lecture_title;
            $data->course_id = $request->course_id;
            $data->course_section_id = $request->course_section_id;
            $data->content = $request->content;
        
            // Save the data to the database
            $data->save();
        
            // Log the activity
            $logData = [
                'course_id' => $data->course_id,
                'course_section_id' => $data->course_section_id,
                'lecture_title' => $data->lecture_title,
                'url' => $data->video, // Adjusted to use the video field
                'content' => $request->content, // Use the content from the request
            ];
        
            activity()
                ->performedOn(new CourseLecture($logData))
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'Lecture added'])
                ->log('Lecture added');
        
            return response()->json(['success' => 'Lecture Saved Successfully']);
        }
        



        

        public function editLecture($id){
            $clecture = CourseLecture::find($id);
            return view('instructor.course.lecture.edit_course_lecture',compact('clecture'));   
        }

        public function updateCourseLecture(Request $request)
        {
            $lid = $request->id;
        
            $courseLecture = CourseLecture::find($lid);
        
            // Process course video if provided
            if ($request->hasFile('video')) {
                // Delete existing video if it exists
                if (!empty($courseLecture->video)) {
                    $existingVideoPath = public_path($courseLecture->video);
        
                    if (file_exists($existingVideoPath)) {
                        unlink($existingVideoPath);
                    }
                }
        
                // Move the video file to the specified upload path
                $videoName = time() . '.' . $request->file('video')->getClientOriginalExtension();
                $request->file('video')->move(public_path('upload/course/course_lecture_section_video/'), $videoName);
        
                // Set the video field in the data to the generated unique name
                $courseLecture->video = 'upload/course/course_lecture_section_video/' . $videoName;
        
                // Calculate video duration
                $videoPath = public_path($courseLecture->video);
                $duration = $this->getVideoDuration($videoPath);
        
                // Save the duration to the database
                $courseLecture->duration = $duration;
            }
        
            // Set other fields in the data
            $courseLecture->lecture_title = $request->lecture_title;
            $courseLecture->content = $request->content;
        
            // Logging the activity
            $data = [
                'lecture_title' => $request->lecture_title,
                'url' => $request->url,
                'content' => $request->content,
            ];
            activity()->performedOn($courseLecture)->causedBy(auth()->user())->withProperties(['action' => $data])->log('Update Course Lecture');
        
            $courseLecture->save();
        
            $notification = [
                'message' => 'Course Lecture Updated Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
            // return redirect()->route('course.view')->with($notification);
        }
        
        public function deleteSection($id){
            // Find the course section by ID
            $section = CourseSection::findOrFail($id);
        
            // Delete all lectures associated with this section
            $section->lectures()->delete();
        
            // Delete the course section
            $section->delete();
        
            // Log the activity
            activity()
                ->performedOn($section)
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'Course Section Deleted'])
                ->log('Course Section Deleted');
        
            // Redirect back with success notification
            return Redirect::back()->with([
                'message' => 'Course Section Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        

        public function deleteLecture($id)
        {
            // Find the course lecture by ID and delete it
            $lecture = CourseLecture::find($id);
            $lecture->delete();
            
            // Log the activity
            activity()
                ->performedOn($lecture)
                ->causedBy(Auth::user())
                ->withProperties(['action' => 'Course Section Lecture Deleted'])
                ->log('Course Section Lecture Deleted');
                
            // Redirect back with success notification
            return Redirect::back()->with([
                'message' => 'Course Section Lecture Deleted Successfully',
                'alert-type' => 'success'
            ]);
        }
        

        

        

}

