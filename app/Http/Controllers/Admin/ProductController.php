<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\ProductFeature_detail;
use App\Models\ProductFeatureDetail;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use App\Models\State;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class ProductController extends Controller
{
    use CreateSlug;
    // get product lists function
    public function index()
    {
        $products = Product::with(['get_category', 'get_subcategory'])->orderBy('id', 'desc')->paginate(15);
        return view('admin.product.product-lists')->with(compact('products'));
    }

    // Add new product
    public function create()
    {
        $data['regions'] = State::orderBy('name', 'asc')->get();
        $data['categories'] = Category::where('parent_id', '=', null)->where('status', 1)->get();
        return view('admin.product.product')->with($data);
    }

    //store new product
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'feature_image' => 'mimes:jpeg,jpg,png,gif'
        ]);
        // Insert product
        $data = new Product();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : Auth::guard('vendor')->id());
        $data->title = $request->title;
        $data->slug = $this->createSlug('products', $request->title);
//        $data->sku = $request->sku;
        $data->summery = $request->summery;
        $data->description = $request->description;
        $data->category_id = $request->category;
        $data->subcategory_id = $request->subcategory;
        $data->childcategory_id = $request->childcategory;
        $data->brand_id = ($request->brand ? $request->brand : null);
        $data->purchase_price = $request->purchase_price;
        $data->selling_price = $request->selling_price;
        $data->discount = $request->discount;
        $data->stock = ($request->stock) ? $request->stock : 0;
        $data->total_stock = ($request->stock) ? $request->stock : 0;
        $data->manufacture_date = $request->manufacture_date;
        $data->expired_date = $request->expired_date;
        $data->video = ($request->product_video) ? 1 : null;
        $data->weight = $request->weight;
        $data->length = $request->length;
        $data->width = $request->width;
        $data->height = $request->height;
        $data->shipping_method = ($request->shipping_method) ? $request->shipping_method : null;
        $data->order_price_above = ($request->order_price_above) ? $request->order_price_above : null;
        $data->free_shipping = ($request->free_shipping) ? 1 : null;
        $data->shipping_cost = ($request->shipping_cost) ? $request->shipping_cost : null;
        $data->ship_region_id = ($request->ship_region_id) ? $request->ship_region_id : null;
        $data->other_region_cost = ($request->other_region_cost) ? $request->other_region_cost : null;
        $data->shipping_time = ($request->shipping_time) ? $request->shipping_time : null;
        $data->meta_title = $request->meta_title;
        $data->meta_keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;
        $data->meta_description = $request->meta_description;
        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();
        //if feature image set
        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $new_image_name = $this->uniqueImagePath('products', 'feature_image', $image->getClientOriginalName());

            $image_path = public_path('upload/images/product/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);

            $image_path = public_path('upload/images/product/zoom/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(700, 700);
            $image_resize->save($image_path);

            $image->move(public_path('upload/images/product'), $new_image_name);

            $data->feature_image = $new_image_name;
        }

        $store = $data->save();

        if($store){
            //insert attribute
            if($request->attribute){
                foreach ($request->attribute as $attribute_id){
                    //insert product feature in feature table
                    $feature = new ProductFeature();
                    $feature->product_id = $data->id;
                    $feature->attribute_id = $attribute_id;
                    $feature->save();

                    for ($i=0; $i< count($request->attributeValue[$attribute_id]); $i++){
                        //check weather attribute value set
                        if(array_key_exists($i, $request->attributeValue[$attribute_id])) {
                            //insert feature details in ProductFeatureDetail table
                            $feature_details = new ProductFeatureDetail();
                            $feature_details->product_id = $data->id;
                            $feature_details->feature_id = $feature->id;
                            $feature_details->attributeValue_id = $request->attributeValue[$attribute_id][$i];
                            $feature_details->quantity = (isset($request->qty[$attribute_id]) && array_key_exists($i, $request->qty[$attribute_id]) ? $request->qty[$attribute_id][$i] : 0);
                            $feature_details->price = (isset($request->price[$attribute_id]) && array_key_exists($i, $request->price[$attribute_id]) ? $request->price[$attribute_id][$i] : 0);
                            $feature_details->color = (isset($request->color[$attribute_id]) && array_key_exists($i, $request->color[$attribute_id]) ? $request->color[$attribute_id][$i] : null);

                            //if attribute variant image set
                            if (isset($request->image[$attribute_id]) && array_key_exists($i, $request->image[$attribute_id])) {
                                $image = $request->image[$attribute_id][$i];
                                $new_variantimage_name = $this->uniqueImagePath('product_features', 'image', $image->getClientOriginalName());

                                $image_path = public_path('upload/images/product/varriant-product/thumb/' . $new_variantimage_name);
                                $image_resize = Image::make($image);
                                $image_resize->resize(250, 200);
                                $image_resize->save($image_path);

                                $image->move(public_path('upload/images/product/varriant-product'), $new_variantimage_name);
                                $feature_details->image = $new_variantimage_name;
                            }
                            $feature_details->save();
                        }
                    }

                }
            }
            //insert Feature data
            if($request->FeatureName){
                try {
                    for($x = 0; $x < count($request->FeatureName); $x++){
                        $extraFeature = new ProductFeature();
                        $extraFeature->product_id = $data->id;
                        $extraFeature->name = $request->FeatureName[$x];
                        $extraFeature->value = $request->FeatureValue[$x];
                        $extraFeature->save();
                        echo $request->FeatureName[$x];
                    }
                }catch (Exception $exception){

                }
            }
            // gallery Image upload
            if ($request->hasFile('gallery_image')) {
                $gallery_image = $request->file('gallery_image');
                foreach ($gallery_image as $image) {
                    $new_image_name = $this->uniqueImagePath('product_images', 'image_path', $image->getClientOriginalName());

                    $image_path = public_path('upload/images/product/gallery/thumb/' . $new_image_name);
                    $image_resize = Image::make($image);
                    $image_resize->resize(200, 200);
                    $image_resize->save($image_path);

                    $image->move(public_path('upload/images/product/gallery'), $new_image_name);

                    ProductImage::create( [
                        'product_id' => $data->id,
                        'image_path' => $new_image_name
                    ]);
                }
            }
            //video upload
            if(isset($request->product_video)){
                ProductVideo::create(['type' => $request->video_type, 'link' => $request->video_link]);
            }
            Toastr::success('Product Create Successfully.');
        }else{
            Toastr::error('Product Cannot Create.!');
        }
        dd($request->all());
        return back();
    }

    public function show(Product $product)
    {
        //
    }

    //edit product
    public function edit(Product $product)
    {
        //
    }

    //update product
    public function update(Request $request, Product $product)
    {
        //
    }

    // delete prouct
    public function delete($id)
    {
        $delete = Product::where('id', $id)->delete();

        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Product deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Product cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function highlight(){
        echo view('admin.product.hightlight');
    }
}
