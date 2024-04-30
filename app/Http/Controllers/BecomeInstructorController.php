<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class BecomeInstructorController extends Controller
{

    public function getStates($country)
    {
        // Fetch states based on the selected country
        $countryModel = Country::where('name', $country)->first();

        if ($countryModel) {
            $states = State::where('country_id', $countryModel->id)->pluck('name');
            return response()->json(['states' => $states]);
        } else {
            return response()->json(['error' => 'Country not found']);
        }
    }

    public function getCities($state)
    {
        // Fetch cities based on the selected state
        $stateModel = State::where('name', $state)->first();

        if ($stateModel) {
            $cities = City::where('state_id', $stateModel->id)->pluck('name');
            return response()->json(['cities' => $cities]);
        } else {
            return response()->json(['error' => 'State not found']);
        }
    }

    public function becomeInstructorForm(){
            // Fetch countries from your database
            $countries = Country::pluck('name');

            return view('frontend.pages.instructor_reg', compact('countries'));
    }

    public function becomeInstructorStore(Request $request){
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'birthday_day' => 'required|integer',
            'birthday_month' => 'required|integer',
            'birthday_year' => 'required|integer',
            'country' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'password' => 'required|string|min:4', 
        ]);
   
        // Combine day, month, and year to form a valid date string
        $birthday = sprintf(
            '%04d-%02d-%02d',
            $validatedData['birthday_year'],
            $validatedData['birthday_month'],
            $validatedData['birthday_day']
        );
    
        // Create a new User instance
        $data = new User([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'birthday' => $birthday,
            'country' => $validatedData['country'],
            'state' => $validatedData['state'],
            'city' => $validatedData['city'],
            'gender' => $validatedData['gender'],
            'last_login_ip' => $request->getClientIp(),
            'role' => 'instructor',
        ]);
    
        // Save the user to the database
        $data->save();
        
        activity()->performedOn($data)->causedBy(auth()->user())->withProperties(['action' => $data])->log('profile updated');
    
        $notification = [
            'message' => 'Registration Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect('/login')->with($notification);
    }
    

}
