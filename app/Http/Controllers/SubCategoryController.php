<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    public function subCategoryView(){
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get(); 
        
        $colors = [
            "table-primary",
            "table-secondary",
            "table-success",
            "table-danger",
            "table-warning",
            "table-info",
            "table-light",
        ];        
        return view('backend.subcategory.index',compact('categories','subcategories','colors'));
    }



    public function subCategorystore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            "category_id" => "required",
            "subcategory_name" => [
                "required",
                Rule::unique('subcategories')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                }),
            ],
        ], [
            'category_id.required' => 'Please input category name',
            'subcategory_name.required' => 'Please input sub category name',
            'subcategory_name.unique' => 'Sub category name must be unique for the selected category',
        ]);
    
        // Initialize data to be saved
        $data = new Subcategory(); 
    
        // Set other fields in the data
        $data->category_id  = $request->category_id;
        $data->subcategory_name = $request->subcategory_name;
        $data->subcategory_slug = strtolower(str_replace(' ', '-', $request->subcategory_name));
        $data->created_by = Auth::user()->id;
        $data->created_at = now();
    
        // Save the data to the database
        $data->save();
    
        activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('Sub Category added ');
    
        // Set a success notification and redirect to the category view
        $notification = [
            'message' => 'Sub Category added successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('subcategory.view')->with($notification);
    }
    
    public function subCategoryUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            "category_id" => "required",
            "subcategory_name" => [
                "required",
                Rule::unique('subcategories')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                }),
            ],
        ], [
            'category_id.required' => 'Please input category name',
            'subcategory_name.required' => 'Please input sub category name',
            'subcategory_name.unique' => 'Sub category name must be unique for the selected category',
        ]);
    
        // Find the Subcategory by ID
        $data = Subcategory::findOrFail($id);
    
        // Set other fields in the data
        $data->category_id  = $request->category_id;
        $data->subcategory_name = $request->subcategory_name;
        $data->subcategory_slug = strtolower(str_replace(' ', '-', $request->subcategory_name));
        $data->updated_by = Auth::user()->id;
        $data->updated_at = now();
    
        // Save the data to the database
        $data->save();
    
        activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('Sub Category updated ');
    
        // Set a success notification and redirect to the category view
        $notification = [
            'message' => 'Sub Category updated successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('subcategory.view')->with($notification);
    }
    

    
}
