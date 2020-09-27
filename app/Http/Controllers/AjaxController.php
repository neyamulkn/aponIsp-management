<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Core;
use App\Models\Page;
use App\Models\PredefinedFeature;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Spliter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{

    // get core
    public function get_core(Request $request, $core_id){
        $cores = Core::with('extend_core')->where('parent_id', $core_id)->where('type', 'fiber')->get();
        $output = '';
        $type_name = preg_replace('/[0-9_%]+/', '', $request->type);
        if(count($cores)>0){
            $output = '
	                <div class="form-group">
	                    <label class="required" for="core'.$request->type.'">Select Core </label>
	                    <select required onchange="get_extend_core(this.value, \''.$request->type.'\')"  name="core_'.$type_name.'" style="width:100%" id="'.$request->type.'" class="form-control custom-select">
	                       <option value="">Select Core</option>';
            foreach ($cores as $core) {
                $output .= '<option '. ($core->core_status == 1 && $core->extend_core == null ? "disabled title=\"This core allready used\" " : ''  ). ' style="background:'.$core->core_color.'" value="'.$core->id.'"> Core '.$core->core_no.'</option>';
            }
            $output .= '</select>
	                </div>
	            ';
        }
        echo $output;
    }

    // get brand
    public function get_extend_core(Request $request, $core_id){
        $spliter = Spliter::with('cores')->where('extend_core_id', $core_id)->first();
        $output = '';
        $type_name = preg_replace('/[0-9_%]+/', '', $request->type);
        if($spliter){
            $output = '
	                <div class="form-group">
	                    <label class="required">'.$spliter->spliter_name.'</label>
	                    <input type="hidden" name="extend_spliter_'.$type_name.'" value="'.$spliter->id.'">
	                    <select required name="extend_spliter_core_'.$type_name.'" style="width:100%"  class="form-control custom-select">
	                       <option value="">Select Core</option>.';
            foreach ($spliter->cores as $core) {
                $output .= '<option '. ($core->core_status == 1 && $core->extend_core == null ? "disabled title=\"This core allready used\" " : ''  ). ' style="background:'.$core->core_color.'" value="'.$core->id.'"> Core '.$core->core_no.'</option>';
            }
            $output .= '</select>
	                </div>
	            ';
        }
        echo $output;
    }
    // check unique fielde
    public function checkField(Request $request){

        if($request->field == 'email' && !filter_var($request->value, FILTER_VALIDATE_EMAIL)){
            $output = [
                'status' => false,
                'msg' =>  $request->value ." is invalid email."
            ];
            return response()->json($output);
        }

        $check = DB::table($request->table)->where($request->field, $request->value)->first();
        if($check){
            $output = [
                'status' => false,
                'msg' =>  $request->field ." allready used."
            ];
        }else{
            $output = [
                'status' => true,
                'msg' =>  $request->field ." is available."
            ];
        }

        return response()->json($output);

    }


    // get brand
    public function getBrand($category_id){
    	$brands = Brand::where('category_id', $category_id)->orWhere('category_id', 0)->get();
    	$output = '';
    	if(count($brands)>0){
    		$output = '
	                <div class="form-group">
	                    <label class="required" for="brand">Brand </label>
	                    <select name="brand" style="width:100%" id="brand" class="form-control custom-select">
	                       <option value="">Select Brand</option>.';
	                      		foreach ($brands as $brand) {
	                      			$output .= '<option value="'.$brand->id.'">'.$brand->name.'</option>';
	                      		}
	                    $output .= '</select>
	                </div>
	            ';
    	}
    	echo $output;
    }



    // Status change function
    public function satusActiveDeactive(Request $request){
        $status = DB::table($request->table)->where('id', $request->id)->first();
        if($status){
            if($status->status == 1){
                DB::table($request->table)->where('id', $request->id)->update(['status' => 0]);
            }else{
                DB::table($request->table)->where('id', $request->id)->update(['status' => 1]);
            }
            $output = array( 'status' => true,  'message'  => 'Status update successful.');
        }else{
            $output = array( 'status' => false,  'message'  => 'Status connot update.!');
        }
        return response()->json($output);
    }


}
