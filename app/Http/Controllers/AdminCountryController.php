<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminCountryController extends Controller
{

    // Display the list of countries
    public function countries()
    {
        $data = array();
        $data['title'] = 'Countries List';
        $data['countries'] = Country::all();
        return view('admin.countries.index', $data);
    }

// Store a new country
    public function countryStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:countries,name|max:255',
            'country_code' => 'required|max:255',
            'currency_sign' => 'required|max:255',
            'currency' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Country::create([
            'name' => $request->name,
            'country_code' => $request->country_code,
            'currency_sign' => $request->currency_sign,
            'currency' => $request->currency,
        ]);
        return redirect()->route('admin.countries')->with('success', 'Country added successfully.');
    }

// Update an existing country
    public function countryUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:countries,id',
            'name' => 'required|max:255|unique:countries,name,' . $request->id,
            'country_code' => 'required|max:255',
            'currency_sign' => 'required|max:255',
            'currency' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $country = Country::findOrFail($request->id);
        $country->update([
            'name' => $request->name,
            'country_code' => $request->country_code,
            'currency_sign' => $request->currency_sign,
            'currency' => $request->currency,
        ]);
        return redirect()->route('admin.countries')->with('success', 'Country updated successfully.');
    }

// Delete a country
    public function countryDelete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:countries,id',
        ]);
        Country::destroy($request->id);
        return redirect()->route('admin.countries')->with('success', 'Country deleted successfully.');
    }

    public function changeStatus($id)
    {
        $country = Country::findOrFail($id);

        // Toggle the status
        $newStatus = $country->status == 0 ? 1 : 0;

        $country->update([
            'status' => $newStatus,
        ]);

        return redirect()->route('admin.countries')->with('success', 'Country Status successfully changed.');
    }


}
