<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{

    public function state()
    {
        $data['countries'] = Country::all();
        $data['states'] = State::orderBy('id', 'desc')->get();
        return view('admin.location.state')->with($data);
    }

    public function state_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
        ]);

        $data = new State();
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->country_id = $request->country_id;
        $data->status = ($request->status) ? 1 : 0;
        $store = $data->save();
        if($store){
            Toastr::success('State created successfully.');
        }else{
            Toastr::error('State connot created.');
        }
        return back();

    }

    public function state_edit($id)
    {
        $data['countries'] = Country::all();
        $data['data'] = State::find($id);
        echo view('admin.location.edit.state')->with($data);
    }

    public function state_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
        ]);

        $data = State::find($request->id);
        $data->name = $request->name;
        $data->country_id = $request->country_id;
        $data->status = ($request->status) ? 1 : 0;
        $store = $data->save();
        if($store){
            Toastr::success('State update successfully.');
        }else{
            Toastr::error('State connot update.');
        }
        return back();
    }

    public function state_delete($id)
    {
        $delete = State::where('id', $id)->delete();
        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Item deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Item cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function city()
    {
        $data['states'] = State::orderBy('name', 'asc')->get();
        $data['cities'] = City::orderBy('id', 'desc')->get();
        return view('admin.location.city')->with($data);
    }

    public function city_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'state_id' => 'required',
        ]);

        $data = new City();
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->state_id = $request->state_id;
        $data->status = ($request->status) ? 1 : 0;
        $store = $data->save();
        if($store){
            Toastr::success('City created successfully.');
        }else{
            Toastr::error('City connot created.');
        }
        return back();

    }

    public function city_edit($id)
    {
        $data['states'] = State::all();
        $data['data'] = City::find($id);
        echo view('admin.location.edit.city')->with($data);
    }

    public function city_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'state_id' => 'required',
        ]);

        $data = City::find($request->id);
        $data->name = $request->name;
        $data->state_id = $request->state_id;
        $data->status = ($request->status) ? 1 : 0;
        $store = $data->save();
        if($store){
            Toastr::success('city update successfully.');
        }else{
            Toastr::error('city connot update.');
        }
        return back();
    }

    public function city_delete($id)
    {
        $delete = City::where('id', $id)->delete();
        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Item deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Item cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function area()
    {
        $data['cities'] = City::all();
        $data['areas'] = Area::orderBy('id', 'desc')->get();
        return view('admin.location.area')->with($data);
    }

    public function area_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city_id' => 'required',
        ]);

        $data = new Area();
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->city_id = $request->city_id;
        $data->status = ($request->status) ? 1 : 0;
        $store = $data->save();
        if($store){
            Toastr::success('Area created successfully.');
        }else{
            Toastr::error('Area connot created.');
        }
        return back();

    }

    public function area_edit($id)
    {
        $data['cities'] = City::all();
        $data['data'] = Area::find($id);
        echo view('admin.location.edit.area')->with($data);
    }

    public function area_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city_id' => 'required',
        ]);

        $data = Area::find($request->id);
        $data->name = $request->name;
        $data->city_id = $request->city_id;
        $data->status = ($request->status) ? 1 : 0;
        $store = $data->save();
        if($store){
            Toastr::success('Area update successfully.');
        }else{
            Toastr::error('Area connot update.');
        }
        return back();
    }

    public function area_delete($id)
    {
        $delete = Area::where('id', $id)->delete();
        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Item deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Item cannot deleted.'
            ];
        }
        return response()->json($output);
    }
}
