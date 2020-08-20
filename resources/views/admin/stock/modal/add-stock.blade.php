<div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add stock</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body form-row">
            <div class="card-body">
                <form action="{{route('stock.store')}}" method="POST" class="floating-labels">
                    {{csrf_field()}}
                    <div class="form-body">
                        <!--/row-->
                        <div class="row justify-content-md-center">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required" for="name">Stock Item</label>
                                    <input  name="name" id="name" value="{{old('name')}}" required="" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="required" for="supplier_id">Shop Name</label>
                                    <select required name="shop_id" id="supplier_id" class="form-control custom-select">
                                        <option value="">Select Shop</option>
                                        @foreach($shops as $shop)
                                            <option value="{{$shop->id}}">{{$shop->name}}</option>
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
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="required" for="category">Category Name</label>
                                    <select  required name="category_id" id="category" class="form-control custom-select">
                                        <option value="">Select Category</option>
                                        @foreach($get_category as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="invoice">Invoice No</label>
                                    <input  name="invoice" id="invoice" value="{{old('invoice')}}" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product_code">Product Code</label>
                                    <input  name="product_code" id="product_code" value="{{old('product_code')}}" type="text" class="form-control">
                                </div>
                            </div>
                        
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Serial">Serial</label>
                                    <input  name="serial" id="Serial" value="{{old('serial')}}" type="text" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Model">Model</label>
                                    <input  name="model" id="Model" value="{{old('model')}}" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mac">Mac</label>
                                    <input  name="mac" id="mac" value="{{old('mac')}}" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="port">Port</label>
                                    <input  name="port" id="port" value="{{old('port')}}" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required" for="qty">Quantity</label>
                                    <input  name="qty" id="qty" value="{{old('qty')}}" type="number" min="0" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required" for="price">Price</label>
                                    <input required name="price" id="price" value="{{old('price')}}" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="warranty">Warranty</label>
                                    <input  name="warranty" id="warranty" value="{{old('warranty')}}" type="text" class="form-control">
                                </div>
                            </div>

                            
                           <!--  <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment">Payment</label>
                                    <input name="payment" id="payment" value="{{old('payment')}}" type="number" class="form-control">
                                </div>
                            </div> -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required" for="stock_date">Stock Date</label>
                                    <input name="stock_date" id="stock_date" value="{{old('stock_date') ? old('stock_date') : Carbon\Carbon::parse(now())->format('Y-m-d')}}" required="" type="date" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row justify-content-md-center">
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label style="background: #fff;top:-10px;z-index: 1" for="notes">Notes</label>
                                    <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{old('notes')}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="modal-footer">
                                    <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Add Stock</button>
                                    <button type="reset" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


