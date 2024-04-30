<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseGoal;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function courseDetails($id, $slug){
        $course = Course::findOrFail($id);
        $goals = CourseGoal::where('course_id',$id)->orderBy('id','DESC')->get();

        $instructorId = $course->user_id; 
        $instructorCourses = Course::where('user_id', $instructorId)->orderBy('id', 'DESC')->get();

        $categories = Category::latest()->get();
        $relatedCourses = Course::where('category_id', $course->category_id)->where('id', '!=', $id)->latest()->limit(3)->get();
        
        return view('frontend.pages.course_details', compact('course', 'goals', 'instructorCourses', 'categories', 'relatedCourses'));
    }


    public function courseCategory($id, $slug) {
        $courses = Course::where('category_id', $id)->where('status', '1')->get();
        $category = Category::where('id', $id)->first();  
        $categories = Category::latest()->get();  
        return view('frontend.pages.category.index', compact('courses', 'category','categories'));
    }
    
    public function courseSubCategory($id, $slug) {
        // Retrieve courses under the specified subcategory with status '1'
        $courses = Course::where('subcategory_id', $id)->where('status', '1')->get();
        
        // Retrieve subcategory information
        $subcategory = Subcategory::findOrFail($id);
    
        // Retrieve all categories, sorted by the latest
        $categories = Category::latest()->get();
    
        // Pass data to the view
        return view('frontend.pages.subcategory.index', compact('courses', 'subcategory', 'categories'));
    }

    // public function instructorDetails($id)
    // {
    //     $instructor = User::findOrFail($id);
    //     $courses = Course::where('user_id', $id)->get();    
    //     return view('frontend.pages.instructor.instructor_details', compact('instructor', 'courses'));
    // }

    public function instructorDetails($id)
    {
        $instructor = User::findOrFail($id);
        $courses = Course::where('user_id', $id)->paginate(6); // Paginate with 6 items per page   
        return view('frontend.pages.instructor.instructor_details', compact('instructor', 'courses'));
    }


    
    
    


}
