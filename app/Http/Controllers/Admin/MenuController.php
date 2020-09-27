<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{

    public function index()
    {
        $data['menus'] = Menu::orderBy('priority', 'desc')->get();
        return view('admin.menu.menu')->with($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'source_id' => 'required',
            'name' => 'required',
        ]);
        $data = new Menu();
        $data->name = $request->name;
        $data->menu_source = $request->menu_type;
        $data->source_id = implode(',', $request->source_id);
        $data->top_header = ($request->top_header ? 1 : null);
        $data->main_header = ($request->main_header ? 1 : null);
        $data->footer = ($request->footer ? 1 : null);
        $data->status = ($request->status ? 1 : 0);

        $store = $data->save();
        if($store){
            if($request->menu_type == 'category'){
               foreach ($request->source_id as $id){
                    $category = Category::find($id);
                    $category->menu_id = $data->id;
                    $category->save();
                }

            }elseif($request->menu_type == 'page'){
                foreach ($request->source_id as $id){
                    $category = Page::find($id);
                    $category->menu_id = $data->id;
                    $category->save();
                }
            }else{
                echo '';
            }
            Toastr::success('Menu Create Successfully.');
        }else{
            Toastr::error('Menu Cannot Create.!');
        }

        return back();
    }


    public function edit(Menu $menu)
    {
        //
    }


    public function update(Request $request, Menu $menu)
    {
        //
    }

    public function delete($id)
    {
        $delete = Menu::where('id', $id)->delete();

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
