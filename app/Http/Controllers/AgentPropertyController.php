<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Mail\NewPropertyNotification;
use App\Models\City;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\PropertyNearbyPlace;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Mail;


class AgentPropertyController extends Controller
{
    public function properties()
    {
        $data = array();
        $data['title'] = 'Agent Properties';
        $data['properties'] = AppHelper::agentProperties(Sentinel::getUser()->id);
        return view('agent.properties.index', $data);
    }

    public function rentProperties()
    {
        $data = array();
        $data['title'] = 'Agent Rental Properties';
        $data['properties'] = AppHelper::agentRentProperties(Sentinel::getUser()->id);
        return view('agent.properties.rent_properties', $data);
    }

    public function saleProperties()
    {
        $data = array();
        $data['title'] = 'Agent Sale Properties';
        $data['properties'] = AppHelper::agentSaleProperties(Sentinel::getUser()->id);
        return view('agent.properties.sale_properties', $data);
    }


    public function propertyCreate()
    {
        $data = array();
        $data['ptypes'] = PropertyType::get();
        $data['ftypes'] = PropertyFeature::get();
        $data['title'] = 'Create Property';
        $data['states'] = AppHelper::states();
        $data['cities'] =  AppHelper::cities();
        return view('agent.properties.create', $data);
    }


    public function uploadImages(Request $request)
    {
        try {
            if ($request->hasFile('property_images')) {
                $fileDetails = [];
                foreach ($request->file('property_images') as $file) {
                    if ($file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = rand(0, 9999) . time() . '.' . $extension;
                        $file->move(public_path('property_images'), $filename);
                        $relativePath = 'property_images/' . $filename;
                        $fileDetails[] = [
                            'file_path' => $relativePath,
                            'file_name' => $filename
                        ];
                    } else {
                        return response()->json(['error' => 'One or more files are not valid'], 400);
                    }
                }
                return response()->json(['file_details' => $fileDetails]);
            }
            return response()->json(['error' => 'No files uploaded'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred during file upload: ' . $e->getMessage()], 500);
        }
    }


    public function propertyStore(Request $request)
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
            'price' => 'required',
            'address' => 'required|max:255',
            'city_id' => 'required|max:255',
            'state_id' => 'required|max:255',
            'zip_code' => 'required|string|max:10',
            'building_age' => 'required|integer',
            'is_featured' => 'required|boolean',
            'property_features' => 'array',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'property_images' => 'required|array',
            'nearby_place_name.*' => 'required|string|max:255',
            'nearby_place_type.*' => 'required|string|max:255',
            'nearby_place_distance.*' => 'required|numeric|min:0',
        ]);

        $property = new Property();
        $property->agent_id = Sentinel::getUser()->id;
        if(Sentinel::getUser()->agency_id) {
            $property->agency_id = Sentinel::getUser()->agency_id;
        }
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
        $property->country_id = AppHelper::state($request->state_id)->country_id;
        $property->city_id = $request->city_id;
        $property->state_id = $request->state_id;
        $property->zip_code = $request->zip_code;
        $property->building_age = $request->building_age;
        $property->is_featured = $request->is_featured;
        $property_features = $request->property_features;
        $property->property_features = $property_features;
        $property->short_description = $request->short_description;
        $property->long_description = $request->long_description;
        if($request->get('rental_duration')) {
            $property->rental_duration = $request->rental_duration;
        }
        //owner details
        $property->owner_name = Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name;
        $property->owner_email = Sentinel::getUser()->email;
        $property->owner_phone = Sentinel::getUser()->phone;
        $property->save();

        //send email notification to admin
//        $agent = User::find(Sentinel::getUser()->id);
//        $adminEmail = AppHelper::adminEmail();
//        Mail::to($adminEmail)->send(new NewPropertyNotification($property, $agent));

        foreach ($request->property_images as $imageData) {
            $fileDetails = json_decode($imageData, true);
            if (isset($fileDetails['file_details'])) {
                foreach ($fileDetails['file_details'] as $detail) {
                    $existingImage = PropertyImage::where('image_path', $detail['file_path'])
                        ->where('property_id', $property->id)->first();
                    if (!$existingImage) {
                        $image = new PropertyImage();
                        $image->image_path = $detail['file_path'];
                        $image->image = $detail['file_name'];
                        $image->property_id = $property->id;
                        $image->save();
                    }
                }
            }
        }

        if ($request->has('nearby_place_name')) {
            foreach ($request->nearby_place_name as $index => $name) {
                if (!empty($name)) {
                    PropertyNearbyPlace::create([
                        'property_id' => $property->id,
                        'name' => $name,
                        'type' => $request->nearby_place_type[$index] ?? '',
                        'distance' => $request->nearby_place_distance[$index] ?? 0,
                    ]);
                }
            }
        }

        AppHelper::storeActivity(
            'New Property Created', // Heading
            'Property created by Agent ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . '.', // Content
            'success', // Color
            Sentinel::getUser()->id, // User ID
            1, // Type
            Sentinel::getUser()->id, // System ID
            'Agent' // Role
        );
        return redirect()->route('agent.properties')->with('success', 'Property added successfully.');
    }

    public function propertyEdit($id)
    {
        $data = array();
        $data['ptypes'] = PropertyType::get();
        $data['property'] = Property::find($id);
        $data['ftypes'] = PropertyFeature::get();
        $data['pimages'] = PropertyImage::where('property_id', $id)->get();
        $data['title'] = 'Update Property';
        $data['states'] = AppHelper::states();
        $data['nearplaces'] = PropertyNearbyPlace::where('property_id', $id)->get();
        $data['cities'] = City::where('state_id', $data['property']->state_id)->get();
        return view('agent.properties.edit', $data);
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
            'price' => 'required|',
            'address' => 'required|string|max:255',
            'city_id' => 'required|',
            'city_id' => 'required|',
            'zip_code' => 'required|string|max:10',
            'building_age' => 'required|integer',
            'is_featured' => 'required|boolean',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
        ]);

        $id = $request->id;
        $property = Property::findOrFail($id);
        $property->agent_id = Sentinel::getUser()->id;
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
        $property->country_id = AppHelper::state($request->state_id)->country_id;
        $property->city_id = $request->city_id;
        $property->state_id = $request->state_id;
        $property->zip_code = $request->zip_code;
        $property->building_age = $request->building_age;
        $property->is_featured = $request->is_featured;
        $property->property_features = $request->property_features;
        $property->short_description = $request->short_description;
        $property->long_description = $request->long_description;
        $property->owner_name = Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name;
        $property->owner_email = Sentinel::getUser()->email;
        $property->owner_phone = Sentinel::getUser()->phone;
        if($request->get('rental_duration')) {
            $property->rental_duration = $request->rental_duration;
        }
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


        // Process nearby places
        $existingNearbyPlaces = $request->input('nearby_place_id', []);
        $existingNearbyPlaces = array_filter($existingNearbyPlaces); // Remove any empty values

        $newNearbyPlaces = [];
        $updatedNearbyPlaces = [];

        if ($request->has('nearby_place_name')) {
            foreach ($request->input('nearby_place_name') as $index => $name) {
                if ($name) {
                    $nearbyPlaceData = [
                        'name' => $name,
                        'type' => $request->input('nearby_place_type')[$index],
                        'distance' => $request->input('nearby_place_distance')[$index],
                        'property_id' => $property->id,
                    ];

                    if (!empty($request->input('nearby_place_id')[$index])) {
                        $updatedNearbyPlaces[$request->input('nearby_place_id')[$index]] = $nearbyPlaceData;
                    } else {
                        // New place, create
                        $newNearbyPlaces[] = $nearbyPlaceData;
                    }
                }
            }
        }

        // Update existing nearby places
        foreach ($updatedNearbyPlaces as $id => $data) {
            PropertyNearbyPlace::where('id', $id)->update($data);
        }
        // Create new nearby places
        PropertyNearbyPlace::insert($newNearbyPlaces);
//        // Delete old nearby places that are no longer in the form
//        PropertyNearbyPlace::where('property_id', $property->id)
//            ->whereNotIn('id', array_keys($updatedNearbyPlaces))
//            ->delete();





        AppHelper::storeActivity(
            'Property Updated', // Heading
            'Property updated by Agent ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . '.', // Content
            'success', // Color
            Sentinel::getUser()->id, // User ID
            1, // Type
            Sentinel::getUser()->id, // System ID
            'Agent' // Role
        );

        return redirect()->route('agent.properties')->with('success', 'Property updated successfully.');
    }



    public function propertyDetail($id)
    {
        $data = array();
        $data['ptype'] = PropertyType::find($id);
        $data['ftypes'] = PropertyFeature::get();
        $data['property'] = Property::find($id);
        $data['pimages'] = PropertyImage::where('property_id', $id)->get();
        $data['title'] = 'Property Details';
        $data['nearplaces'] = PropertyNearbyPlace::where('property_id', $id)->get();
        return view('agent.properties.detail', $data);
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
        return redirect()->route('agent.properties')->with('success', 'Property deleted successfully.');
    }



    public function customerFavouriteProperties() {
        $data = array();
        $data['title'] = 'Customer Favourite Properties';
        $data['properties'] = Property::join('favourite_properties', 'properties.id', '=', 'favourite_properties.property_id')
            ->where('properties.agency_id', Sentinel::getUser()->id)
            ->select('properties.*','favourite_properties.user_id')
            ->get();
        return view('agent.customers.favourite', $data);
    }


    public function customerPurchasedProperties() {

        $data = array();
        $data['title'] = 'Customer Purchased Properties';
        $data['properties'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->where('properties.agency_id', Sentinel::getUser()->id)
            ->select('properties.*','property_purchases.purchased_price','property_purchases.purchased_date',
                'property_purchases.purchased_time','property_purchases.purchased_status','property_purchases.purchased_payment_status','property_purchases.customer_id')
            ->get();

        return view('agent.customers.purchased', $data);

    }

    public function customerRentalProperties() {
        $data = array();
        $data['title'] = 'Rental Properties';
        $data['properties'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->where('properties.agency_id', Sentinel::getUser()->id)
            ->select('properties.*','property_rentals.rental_price','property_rentals.start_date',
                'property_rentals.end_date','property_rentals.rental_status','property_rentals.rental_payment_status','property_rentals.rental_days','property_rentals.rental_price','property_rentals.customer_id')
            ->get();

        return view('agent.customers.rental', $data);

    }

}
