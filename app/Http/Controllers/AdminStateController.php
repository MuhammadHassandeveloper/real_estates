<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminStateController extends Controller
{
    public function states()
    {
        $data = array();
        $data['title'] = 'States List';
        $data['states'] = State::with('country')->get();
        $data['countries'] = Country::where('status',1)->get();
        return view('admin.states.index', $data);
    }

// Store a new state
    public function stateStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:states,name|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        State::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('admin.states')->with('success', 'State added successfully.');
    }

// Update an existing state
    public function stateUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:states,id',
            'name' => 'required|max:255|unique:states,name,' . $request->id,
            'country_id' => 'required|exists:countries,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $state = State::findOrFail($request->id);
        $state->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('admin.states')->with('success', 'State updated successfully.');
    }

// Delete a state
    public function stateDelete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:states,id',
        ]);

        State::destroy($request->id);
        return redirect()->route('admin.states')->with('success', 'State deleted successfully.');
    }


}
