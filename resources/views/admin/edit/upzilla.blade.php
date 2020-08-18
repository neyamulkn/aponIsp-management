
<input type="hidden" value="{{$data->id}}" name="id">


<div class="col-md-12">
    <div class="form-group">
        <label for="upzilla">Upzilla</label>
        <input  name="name" id="upzilla" value="{{$data->name}}" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">                           
    <div class="form-group">
        <label for="district">District name</label>
        <select name="district_id" id="district" class="form-control custom-select">
            @foreach($get_district as $district)
                <option value="{{$district->id}}" {{($district->id == $data->district_id) ?  'selected' : ''}}>{{$district->name}}</option>
            @endforeach
        </select>
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

