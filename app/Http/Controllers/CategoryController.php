<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class CategoryController extends Controller
{
    public function categoryView(){
        $allData = Category::latest()->get();

        $colors = [
            "table-primary",
            "table-secondary",
            "table-success",
            "table-danger",
            "table-warning",
            "table-info",
            "table-light",
        ];
        return view(
            "backend.category.index",
            compact("allData", "colors")
        );

        return view('backend.category.index',compact('allData'));
    }

    public function categoryStore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            "category_name" => "required|unique:categories",
            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'category_name.required' => 'Please input category name',
            'image.max' => 'Image size should not exceed 1024 KB',
        ]);
    
        // Initialize data to be saved
        $data = new Category(); 
    
        // Process image if it exists in the request
        if ($request->hasFile('image')) {
            // Generate a unique name for the image
            $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
    
            // Resize and save the image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'))->resize(600, 400)->tojpeg(80);
            $image->save(public_path('upload/category_images/' . $name_gen));
    
            // Set the image field in the data
            $data->image = $name_gen;
        }
    
        // Set other fields in the data
        $data->category_name = $request->category_name;
        $data->category_slug = strtolower(str_replace(' ', '-', $request->category_name));
        $data->created_by = Auth::user()->id;
        $data->created_at = now();
    
        // Save the data to the database
        $data->save();
   
        activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('Category added ');
    
        // Set a success notification and redirect to the category view
        $notification = [
            'message' => 'Category added successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('category.view')->with($notification);
    }

 
    public function categoryUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            "category_name" => "required|unique:categories,category_name," . $id,
            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'category_name.required' => 'Please input category name',
            'image.max' => 'Image size should not exceed 1024 KB',
        ]);

        // Initialize data to be saved
        $data = Category::findOrFail($id);

        // Process image if it exists in the request
        if ($request->hasFile('image')) {
            // Delete old photo if present
            if ($data->image) {
                $oldPhotoPath = public_path('upload/category_images/' . $data->image);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Generate a unique name for the new image
            $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();

            // Resize and save the new image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'))->resize(600, 400)->tojpeg(80);
            $image->save(public_path('upload/category_images/' . $name_gen));

            // Set the image field in the data
            $data->image = $name_gen;
        }

        // Set other fields in the data
        $data->category_name = $request->category_name;
        $data->category_slug = strtolower(str_replace(' ', '-', $request->category_name));
        $data->created_by = Auth::user()->id;
        $data->created_at = now();

        // Update the data in the database
        $data->update();

        activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('Category updated ');

        // Set a success notification and redirect to the category view
        $notification = [
            'message' => 'Category updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('category.view')->with($notification);
    }


    public function categoryDelete($id)
    {
        $category = Category::findOrFail($id);
        $img = $category->image;
    
        // Check if the image exists before attempting to unlink
        if ($img && file_exists(public_path('upload/category_images/' . $img))) {
            unlink('upload/category_images/' . $img);
        }
    
        Category::findOrFail($id)->delete();
    
        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'success',
        ];
    
        activity()->performedOn($category)->causedBy(auth()->user())->withProperties(['action' => $category])->log('Category deleted');
    
        return redirect()->back()->with($notification);
    }
    

}