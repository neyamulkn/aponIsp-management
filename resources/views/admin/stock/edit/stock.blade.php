
<input type="hidden" value="{{$data->id}}" name="id">

<div class="row ">

    <div class="col-md-12">
        <div class="form-group">
            <label class="required" for="name">Stock Item</label>
            <input  name="name" id="name" value="{{$data->name}}" required="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="required" for="supplier_id">Shop Name</label>
            <select required name="shop_id" id="supplier_id" class="form-control custom-select">
                <option value="">Select Shop</option>
                @foreach($shops as $shop)
                    <option @if($data->shop_id == $shop->id) selected @endif value="{{$shop->id}}">{{$shop->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="required" for="brand_id">Brand name</label>
            <select required name="brand_id" id="brand_id" class="form-control custom-select">
                <option value="">Select Brand</option>
                @foreach($get_brand as $brand)
                    <option @if($data->brand_id == $brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="required" for="category">Category Name</label>
            <select required name="category_id" id="category" class="form-control custom-select">
                <option value="">Select Category</option>
                @foreach($get_category as $category)
                    <option @if($data->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="invoice">Invoice No</label>
            <input  name="invoice" id="invoice" value="{{$data->invoice}}" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="product_code">Product Code</label>
            <input  name="product_code" id="product_code" value="{{$data->code}}" type="text" class="form-control">
        </div>
    </div>

    
    <div class="col-md-4">
        <div class="form-group">
            <label for="Serial">Serial</label>
            <input  name="serial" id="Serial" value="{{$data->serial}}" type="text" class="form-control">
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
            <label for="Model">Model</label>
            <input  name="model" id="Model" value="{{$data->model}}" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="mac">Mac</label>
            <input  name="mac" id="mac" value="{{$data->mac}}" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="port">Port</label>
            <input  name="port" id="port" value="{{$data->port}}" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="qty">Quantity</label>
            <input required="" name="qty" id="qty" value="{{$data->quantity}}" type="number" class="form-control">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="price">Price</label>
            <input required="" name="price" id="price" value="{{$data->price}}" type="number" class="form-control">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="warranty">Warranty</label>
            <input  name="warranty" id="warranty" value="{{$data->warranty}}" type="text" class="form-control">
        </div>
    </div>



<!--     <div class="col-md-2">
        <div class="form-group">
            <label for="payment">Payment</label>
            <input name="payment" id="payment" value="{{$data->payment}}" type="number" class="form-control">
        </div>
    </div> -->

    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="stock_date">Stock Date</label>
            <input name="stock_date" id="stock_date" value="{{$data->date}}" required="" type="date" class="form-control">
        </div>
    </div>


   <div class="col-md-12">
        <div class="form-group">
            <label style="background: #fff;top:-10px;z-index: 1" for="notes">Notes</label>
            <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{$data->notes}}</textarea>
        </div>
    </div>
</div>


