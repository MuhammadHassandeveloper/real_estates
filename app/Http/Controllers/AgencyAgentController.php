<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AgencyAgentController extends Controller
{
    public function agents()
    {
        $data = array();
        $data['title'] = 'Agent Properties';
        $data['agents'] = User::where('agency_id', Sentinel::getUser()->id)->get();
        return view('agency.agents.index', $data);
    }

    public function agentCreate()
    {
        $data = array();
        $data['title'] = 'Create Agent';
        return view('agency.agent.create', $data);
    }


    public function agentStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required|numeric|min:11|unique:users,phone',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'bio' => 'required',
            'photo' => 'required|image',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [];
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['phone'] = $request->phone;
        $data['city'] = $request->city;
        $data['state'] = $request->state;
        $data['zip_code'] = $request->zip_code;
        $data['bio'] = $request->bio;
        $password = Hash::make($request->input('password'));
        $user = Sentinel::register(array(
            'email' => $request->email,
            'password' => $password,

        ));

        DB::table('activations')->insert(
            [
                'user_id' => $user->id,
                'code' => Str::random(60),
                'completed' => 1,
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        $data['password'] = Hash::make($request->input('password'));
        User::where('id', $user->id)->update($data);
        $role = Sentinel::findRoleByName('agent');
        if ($role) {
            $role->users()->attach($user);
        } else {
            return back()->with('error', 'Registration not successful');
        }

        AppHelper::storeActivity(
            'New Agent Created', // Heading
            'Agency created by ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . '.', // Content
            'success', // Color
            Sentinel::getUser()->id, // User ID
            1, // Type
            Sentinel::getUser()->id, // System ID
            'Agency' // Role
        );
        return redirect()->route('agency.agents')->with('success', 'Agent added successfully.');
    }


    public function propertyEdit($id)
    {
        $data = array();
        $data['ptypes'] = PropertyType::get();
        $data['property'] = Property::find($id);
        $data['ftypes'] = PropertyFeature::get();
        $data['pimages'] = PropertyImage::where('property_id', $id)->get();
        $data['title'] = 'Create Property';
        return view('agency.properties.edit', $data);
    }

    public function propertyUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'property_type_id' => 'required|integer',
            'property_category' => 'required|string',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'rooms' => 'required|integer',
            'garages' => 'required|integer',
            'size_sqft' => 'required|integer',
            'price' => 'required|integer',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'building_age' => 'required|integer',
            'is_featured' => 'required|boolean',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
        ]);

        $id = $request->id;
        $property = Property::findOrFail($id);
        $property->title = $request->title;
        $property->property_type_id = $request->property_type_id;
        $property->property_category = $request->property_category;
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->rooms = $request->rooms;
        $property->garages = $request->garages;
        $property->size_sqft = $request->size_sqft;
        $property->price = $request->price;
        $property->address = $request->address;
        $property->city = $request->city;
        $property->state = $request->state;
        $property->zip_code = $request->zip_code;
        $property->building_age = $request->building_age;
        $property->is_featured = $request->is_featured;
        $property->property_features = json_encode($request->property_features, true);
        $property->short_description = $request->short_description;
        $property->long_description = $request->long_description;
        $property->owner_name = Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name;
        $property->owner_email = Sentinel::getUser()->email;
        $property->owner_phone = Sentinel::getUser()->phone;
        $property->save();

        $imageDetails = json_decode($request->image_details, true);
        $newImages = [];
        $existingImages = [];
        if ($request->has('property_images')) {
            foreach ($request->property_images as $imageData) {
                $fileDetails = json_decode($imageData, true);
                if (isset($fileDetails['file_details'])) {
                    foreach ($fileDetails['file_details'] as $detail) {
                        $newImages[] = $detail['file_path'];
                    }
                }
            }
        }

        if ($imageDetails) {
            foreach ($imageDetails as $detail) {
                $existingImages[] = $detail['file_details']['file_name'];
            }
        }
        $dbImages = PropertyImage::where('property_id', $property->id)->pluck('image')->toArray();
        $imagesToRemove = array_diff($dbImages, $existingImages);
        foreach ($imagesToRemove as $imageName) {
            PropertyImage::where('image', $imageName)->where('property_id', $property->id)->delete();
        }
        foreach ($newImages as $filePath) {
            $imageName = basename($filePath);
            PropertyImage::updateOrCreate(
                ['property_id' => $property->id, 'image' => $imageName],
                ['image_path' => 'property_images/' . $imageName]
            );
        }
        AppHelper::storeActivity(
            'Property Updated', // Heading
            'Property updated by Agent ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . '.', // Content
            'success', // Color
            Sentinel::getUser()->id, // User ID
            1, // Type
            Sentinel::getUser()->id, // System ID
            'Agent' // Role
        );

        return redirect()->route('agency.properties')->with('success', 'Property updated successfully.');
    }



    public function propertyDetail($id)
    {
        $data = array();
        $data['ptype'] = PropertyType::find($id);
        $data['ftypes'] = PropertyFeature::get();
        $data['property'] = Property::find($id);
        $data['pimages'] = PropertyImage::where('property_id', $id)->get();
        $data['title'] = 'Property Details';
        return view('agency.properties.detail', $data);
    }

    public function propertyDelete(Request $request)
    {
        Property::destroy($request->id);
        PropertyImage::where('property_id', $request->id)->delete();
        AppHelper::storeActivity(
            'Property Deleted', // Heading
            'Property deleted by Agent ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . '.', // Content
            'success', // Color
            Sentinel::getUser()->id, // User ID
            1, // Type
            Sentinel::getUser()->id, // System ID
            'Agent' // Role
        );
        return redirect()->route('agency.properties')->with('success', 'Property deleted successfully.');
    }
}
