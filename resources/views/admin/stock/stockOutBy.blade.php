

<div class="form-group">
    <span class="required" for="stock_out_by">Select {{$type}}</span>
    <select  required name="stock_out_by" id="stock_out_by" class="form-control custom-select">
        <option value="">Select {{$type}}</option>
        @foreach($stockOutBy as $stockOut)
        <option value="{{$stockOut->id}}">{{$stockOut->name}}</option>
        @endforeach
    </select>
</div>
