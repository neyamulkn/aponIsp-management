<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    use CreateSlug;
    /**
     * Category list Display.
    */
    public function category()
    {
        $get_data = new Category();
        $get_data = $get_data->where('parent_id', '=' , null);
        $get_data = $get_data->orderBy('id', 'desc')->get();

        return view('admin.category.category')->with(compact('get_data'));
    }
    public function getcategory()
    {
        return new CategoryCollection(Category::where('parent_id', '=' , null)->orderBy('id', 'desc')->paginate(2));

    }

    /**
     * Store a new category.
    */
    public function category_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = new Category();
        $data->name = $request->name;
        $data->slug = $this->createSlug('categories', $request->name);
        $data->notes = $request->notes;
        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id);
        if ($request->hasFile('phato')) {
            $image = $request->file('phato');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/images/category/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 200);
            $image_resize->save($image_path);

            $image->move(public_path('upload/images/category'), $new_image_name);

            $data->image = $new_image_name;
        }

        $store = $data->save();
        if($store){
            Toastr::success('Category Create Successfully.');
        }else{
            Toastr::error('Category Cannot Create.!');
        }

        return back();
    }

    //category edit
    public function category_edit($id)
    {
        $data = Category::find($id);
        echo view('admin.category.edit.category')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function category_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = Category::find($request->id);
        $data->name = $request->name;
        $data->notes = $request->notes;
        $data->status = ($request->status ? 1 : 0);
        $data->updated_by = Auth::id();

        if ($request->hasFile('phato')) {

            //delete image from folder
            $image_path = public_path('upload/images/category/'. $data->phato);
            if(file_exists($image_path) && $data->phato){
                unlink($image_path);
                unlink(public_path('upload/images/category/thumb/'. $data->phato));
            }
            $image = $request->file('phato');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/images/category/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 200);
            $image_resize->save($image_path);

            $image->move(public_path('upload/images/category'), $new_image_name);

            $data->image = $new_image_name;
        }

        $update = $data->save();
        if($update){
            Toastr::success('Category update successfully.');
        }else{
            Toastr::error('Category cannot update.!');
        }
        return redirect()->back();
    }

    public function category_delete($id)
    {
        $category = Category::find($id);

        if($category){
            $image_path = public_path('upload/images/category/'. $category->phato);
            if(file_exists($image_path)){
                unlink($image_path);
                unlink(public_path('upload/images/category/thumb/'. $category->phato));
            }
            $category->delete();

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

    /**
     * Category list Display.
     */
    public function subcategory()
    {
        $data['get_category'] = Category::where('parent_id', '=' , null)->orderBy('name', 'asc')->get();

        $data['get_data'] = Category::where('parent_id', '!=' , null)->where('subcategory_id', '=' , null)->orderBy('id', 'desc')->get();
        return view('admin.category.subcategory')->with($data);
    }


    /**
     * Store a new category.
     */
    public function subcategory_store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required',
            'name' => 'required',
        ]);
        $data = new Category();
        $data->parent_id = $request->parent_id;
        $data->name = $request->name;
        $data->slug = $this->createSlug('categories', $request->name);
        $data->notes = $request->notes;
        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id);
        if ($request->hasFile('phato')) {
            $image = $request->file('phato');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/images/category/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 200);
            $image_resize->save($image_path);

            $image->move(public_path('upload/images/category'), $new_image_name);

            $data->image = $new_image_name;
        }

        $store = $data->save();
        if($store){
            Toastr::success('Sub Category Create Successfully.');
        }else{
            Toastr::error('Sub Category Cannot Create.!');
        }
        Session::put('autoSelectId', $request->parent_id);
        return back();
    }



    public function subcategory_edit($id)
    {
        $data['get_category'] = Category::where('parent_id', '=' , null)->orderBy('name', 'asc')->get();
        $data['data'] = Category::find($id);
        echo view('admin.category.edit.subcategory')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function subcategory_update(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $data = Category::find($request->id);
        $data->name = $request->name;
        $data->parent_id = $request->parent_id;
        $data->notes = $request->notes;
        $data->status = ($request->status ? 1 : 0);
        $data->updated_by = Auth::id();

        if ($request->hasFile('phato')) {

            //delete image from folder
            $image_path = public_path('upload/images/category/'. $data->phato);
            if(file_exists($image_path) && $data->phato){
                unlink($image_path);
                unlink(public_path('upload/images/category/thumb/'. $data->phato));
            }

            $image = $request->file('phato');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/images/category/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 200);
            $image_resize->save($image_path);

            $image->move(public_path('upload/images/category'), $new_image_name);

            $data->image = $new_image_name;
        }

        $update = $data->save();
        if($update){
            Toastr::success('Category update successfully.');
        }else{
            Toastr::error('Category cannot update.!');
        }

        return redirect()->back();
    }

    public function subcategory_delete($id)
    {
        $category = Category::find($id);

        if($category){
            $image_path = public_path('upload/images/category/'. $category->phato);
            if(file_exists($image_path)){
                unlink($image_path);
                unlink(public_path('upload/images/category/thumb/'. $category->phato));
            }
            $category->delete();
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

    /**
     *sub child Category list Display.
     */
    public function subchildcategory()
    {
        $data['get_category'] = Category::where('parent_id', '=' , null)->orderBy('name', 'asc')->get();

        $data['get_data'] = Category::where('subcategory_id', '!=' , null)->orderBy('id', 'desc')->get();
        return view('admin.category.sub-childcategory')->with($data);
    }


    /**
     * Store a new category.
     */
    public function subchildcategory_store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required',
            'name' => 'required',
        ]);

        $data = new Category();
        $data->parent_id = $request->parent_id;
        $data->subcategory_id = $request->parent_id;
        $data->name = $request->name;
        $data->slug = $this->createSlug('categories', $request->name);
        $data->notes = $request->notes;
        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : Auth::user()->vendor_id);
        if ($request->hasFile('phato')) {
            $image = $request->file('phato');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/images/category/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 200);
            $image_resize->save($image_path);

            $image->move(public_path('upload/images/category'), $new_image_name);

            $data->image = $new_image_name;
        }

        $store = $data->save();
        if($store){
            Toastr::success('Sub Category Create Successfully.');
        }else{
            Toastr::error('Sub Category Cannot Create.!');
        }
        Session::put('autoSelectId', $request->parent_id);
        return back();
    }

    public function subchildcategory_edit($id)
    {
        $data['get_category'] = Category::where('parent_id', '=' , null)->orderBy('name', 'asc')->get();
        $data['data'] = Category::find($id);
        echo view('admin.category.edit.subchildcategory')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function subchildcategory_update(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $data = Category::find($request->id);
        $data->name = $request->name;
        $data->parent_id = $request->parent_id;
        $data->subcategory_id = $request->parent_id;
        $data->notes = $request->notes;
        $data->status = ($request->status ? 1 : 0);
        $data->updated_by = Auth::id();

        if ($request->hasFile('phato')) {
            //delete image from folder
            $image_path = public_path('upload/images/category/'. $data->phato);
            if(file_exists($image_path) && $data->phato){
                unlink($image_path);
                unlink(public_path('upload/images/category/thumb/'. $data->phato));
            }
            $image = $request->file('phato');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/images/category/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(250, 200);
            $image_resize->save($image_path);

            $image->move(public_path('upload/images/category'), $new_image_name);

            $data->image = $new_image_name;
        }

        $update = $data->save();
        if($update){
            Toastr::success('Category update successfully.');
        }else{
            Toastr::error('Category cannot update.!');
        }
        return redirect()->back();
    }

    public function subchildcategory_delete($id)
    {
        $category = Category::find($id);

        if($category){
            $image_path = public_path('upload/images/category/'. $category->phato);
            if(file_exists($image_path)){
                unlink($image_path);
                unlink(public_path('upload/images/category/thumb/'. $category->phato));
            }
            $category->delete();
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
