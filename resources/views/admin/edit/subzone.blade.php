
<input type="hidden" value="{{$data->id}}" name="id">


<div class="col-md-12">
    <div class="form-group">
        <label for="subzone">subzone</label>
        <input  name="name" id="subzone" value="{{$data->name}}" required="" type="text" class="form-control">
    </div>
</div>
 
<div class="col-md-12">                           
    <div class="form-group">
        <label for="zone">Zone name</label>
        <select name="zone_id" id="zone" class="form-control custom-select">
            @foreach($get_zone as $zone)
                <option value="{{$zone->id}}" {{($zone->id == $data->zone_id) ?  'selected' : ''}}>{{$zone->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="notes">Notes</label>
        <input  name="notes" id="notes" value="{{$data->notes}}"  type="text" class="form-control">
    </div>
</div>

<div class="col-md-12 mb-12">

    <div class="form-group">
        <label class="switch-box">Status</label>
        <div  class="status-btn" >
            <div class="custom-control custom-switch">
                <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                <label class="custom-control-label" for="status-edit">Publish/UnPublish</label>
            </div>
        </div>
    </div>

</div>

