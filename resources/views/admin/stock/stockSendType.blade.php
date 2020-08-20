
@if($get_data->used_status == "good")
<div class="col-md-12">
    <div class="form-group">
        <p>Product condition {{$get_data->used_status}} </p>
        <input  type="checkbox" name="return_stock" id="return_stock"> <label for="return_stock">Return Back In Stock</label>
    </div>
</div>
@endif
<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="type">Item Status</label>
        <select required name="type" id="type" class="form-control custom-select">
            <option value="">Select Status</option>
			<option @if($get_data->used_status == "good") disabled selected @endif value="good">Good</option>
			<option @if($get_data->used_status == "normal") disabled selected @endif value="normal">Normal</option>
			<option @if($get_data->used_status == "warranty") disabled selected @endif value="warranty">Warranty</option>
			<option @if($get_data->used_status == "recyle") disabled selected @endif value="recyle">Recyle</option>
			<option @if($get_data->used_status == "pending") disabled selected @endif value="pending">Pending</option>
        </select>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="StockSend_date">Stock Send Date</label>
        <input  type="date" name="repair_date" id="StockSend_date" value="{{ $get_data->repair_date ? $get_data->repair_date : Carbon\Carbon::parse(now())->format('Y-m-d')}}" required=""  class="form-control">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label style="background: #fff;top:-10px;z-index: 1" for="notes">Notes</label>
        <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{$get_data->notes}}</textarea>
    </div>
</div>