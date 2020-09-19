<input type="hidden" value="{{$tj->id}}" name="id">

<div class="form-group row">
    <label for="tj_name" class="col-3 required text-right col-form-label">TJ Name</label>
    <div class="col-8">
        <input name="tj_name" required="" value="{{$tj->tj_name}}" class="form-control" type="text" placeholder="Enter tj name" id="tj_name">
    </div>
</div>


 <div class="form-group row">
    <label for="tj_ports" class="col-3 required text-right col-form-label">TJ Ports</label>
    <div class="col-8">
        <input name="tj_ports" required="" value="{{$tj->tj_ports}}" class="form-control" type="text" id="tj_ports">
    </div>
</div>

<div class="form-group row">
    <label for="tj_location" class="col-3 text-right col-form-label">TJ Location</label>
    <div class="col-8">
        <input name="tj_location"  value="{{$tj->tj_location}}" class="form-control" type="text" placeholder="Enter TJ location" id="tj_location">
    </div>
</div>


<div class="form-group row">
    <label for="notes" class="col-3 text-right col-form-label">Notes</label>
    <div class="col-8">
        <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{$tj->notes}}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="tj_status_edit" class="col-3 text-right col-form-label">Status</label>
    <div class="col-8">
        <div  class="status-btn" >
        <div class="custom-control custom-switch">
            <input name="status" type="checkbox" class="custom-control-input" {{ ($tj->status == 1) ? 'checked' : '' }} id="tj_status_edit">
            <label  class="custom-control-label" for="tj_status_edit">Publish/UnPublish</label>
        </div>
    </div>
    </div>
</div>
