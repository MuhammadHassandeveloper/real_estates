<?php
namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdminCityController extends Controller
{
    // Display the list of cities
    public function index()
    {
        $title = 'City List';
        $cities = City::with('state')->get();
        $states = State::all();
        return view('admin.cities.index', compact('title', 'cities', 'states'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state_id' => 'required|exists:states,id',
            'cities.*.name' => 'required|max:255',
            'cities.*.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $state = State::findOrFail($request->state_id);
        foreach ($request->cities as $city) {
            $imageName = time() . '_' . $city['name'] . '.' . $city['image']->extension();
            $city['image']->move(public_path('city_images'), $imageName);

            City::create([
                'name' => $city['name'],
                'image' => $imageName,
                'state_id' => $request->state_id,
                'country_id' => $state->country_id,
            ]);
        }
        return redirect()->route('admin.cities')->with('success', 'Cities added successfully.');
    }

    // Update an existing city
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:cities,id',
            'name' => 'required|max:255|unique:cities,name,' . $request->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'state_id' => 'required|exists:states,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $city = City::findOrFail($request->id);
        $city->name = $request->name;
        $city->state_id = $request->state_id;

        $state = State::findOrFail($request->state_id);
        $city->country_id = $state->country_id;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('city_images'), $imageName);
            $city->image = $imageName;
        }
        $city->save();
        return redirect()->route('admin.cities')->with('success', 'City updated successfully.');
    }

    // Delete a city
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:cities,id',
        ]);

        City::destroy($request->id);
        return redirect()->route('admin.cities')->with('success', 'City deleted successfully.');
    }

}
