<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class CustomerPropertyController extends Controller
{
    public function favProperties()
    {
        $data = array();
        $data['title'] = 'Customer Properties';
        $data['properties'] = AppHelper::CustometerAllFavoriteproperties(Sentinel::getUser()->id);
        return view('customer.properties.favourite', $data);
    }



    public function propertyDetail($id)
    {
        $data = array();
        $data['ptype'] = PropertyType::find($id);
        $data['ftypes'] = PropertyFeature::get();
        $data['property'] = Property::find($id);
        $data['pimages'] = PropertyImage::where('property_id', $id)->get();
        $data['title'] = 'Property Details';
        return view('customer.properties.detail', $data);
    }
}
