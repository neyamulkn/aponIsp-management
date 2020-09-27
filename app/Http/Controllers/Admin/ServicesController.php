<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ServicesController extends Controller
{
    use CreateSlug;
    // Services list
    public function index()
    {
        $services = Services::orderBy('id', 'asc')->get();
        return view('admin.services.service')->with(compact('services'));
    }

    // Services store
    public function store(Request $request)
    {
        //if occur any error open modal
        Session::put('submitType', $request->submitType);

        $request->validate([
            'title' => 'required'
        ]);

        $data = new Services();
        $data->title = $request->title;
        $data->subtitle = $request->subtitle;
        $data->font = $request->font;
        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();

        //if feature image set
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_image_name = $this->uniqueImagePath('services', 'image', $image->getClientOriginalName());

            $image_path = public_path('upload/images/services/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(50, 50);
            $image_resize->save($image_path);

            // $image->move(public_path('upload/images/service'), $new_image_name);

            $data->image = $new_image_name;
        }

        $store = $data->save();

        if($store){
            Toastr::success('Service added successfully.');
        }else{

            Toastr::error('Service cannot added.!');
        }

        return back();
    }

    //Edit services
    public function edit($id)
    {
        $data = Services::find($id);
        echo view('admin.services.editform')->with(compact('data'));
    }
    // Update service
    public function update(Request $request)
    {
        //if occur any error open modal
        Session::put('submitType', $request->submitType);

        $request->validate([
            'title' => 'required'
        ]);

        $data = Services::find($request->id);

        $data->title = $request->title;
        $data->subtitle = $request->subtitle;
        $data->font = $request->font;
        $data->status = ($request->status ? 1 : 0);
        $data->updated_by = Auth::id();

        //if feature image set
        if ($request->hasFile('image')) {

            //delete image from folder
            $image_path = public_path('upload/images/services/'. $data->image);
            if(file_exists($image_path) && $data->image){
                unlink($image_path);
            }

            $image = $request->file('image');
            $new_image_name = $this->uniqueImagePath('services', 'image', $image->getClientOriginalName());

            $image_path = public_path('upload/images/services/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(50, 50);
            $image_resize->save($image_path);

            // $image->move(public_path('upload/images/service'), $new_image_name);

            $data->image = $new_image_name;

        }

        $store = $data->save();

        if($store){
            Toastr::success('Service update successfully.');
        }else{

            Toastr::error('Service cannot update.!');
        }

        return back();
    }

    //Delete service
    public function delete($id)
    {
        $services = Services::find($id);

        if($services){
            $image_path = public_path('upload/images/services/'. $services->image);
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $services->delete();
            $output = [
                'status' => true,
                'msg' => 'Service deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Service cannot deleted.'
            ];
        }
        return response()->json($output);
    }
}
