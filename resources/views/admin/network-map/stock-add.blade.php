@extends('layouts.master')
@section('title', 'Add Stock')

@section('content')

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Add New Stock</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Stock</a></li>
                            <li class="breadcrumb-item active">add</li>
                        </ol>
                        <a href="{{route('stock')}}" class="btn btn-info btn-sm d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Stock List</a>
                        <button data-toggle="modal" data-target="#categoryModal" class="btn btn-success btn-sm d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add Category</button>
                        <button data-toggle="modal" data-target="#brand" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add Brand</button>
                        <button data-toggle="modal" data-target="#shop" class="btn btn-primary btn-sm d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i> Add Shop</button>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="card">

                <div class="card-body">

                     <form action="{{route('stock.store')}}" method="POST" class="floating-labels">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="title_head">
                                Add New Stock
                            </div>
                        <div class="row justify-content-md-center">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required" for="name">Title</label>
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
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

    @include('admin.stock.modal.category-add')
    @include('admin.stock.modal.brand')
    @include('admin.stock.modal.shop')
@endsection

@section('js')

    <script>

      
	        @if(old('zone'))
	            get_subzone("{{old('zone')}}");
	        @endif
	        function get_subzone(id=null){
                if(id != null){
    	            var  url = '{{route("get_subzone", ":id")}}';
    	            url = url.replace(':id',id);
    	            $.ajax({
    	                url:url,
    	                method:"get",
    	                success:function(data){
    	                    if(data){
    	                        $("#subzone").html(data);
    	                         $("#subzone").focus();
    	                    }else{
    	                        $("#subzone").html('<option>Subzone not found</option>');
    	                    }
    	                }
    	            });
                }else{
                     $("#subzone").html('<option>Select first zone</option>');
                }
	        }        
	   
       
    </script>
  

@endsection

