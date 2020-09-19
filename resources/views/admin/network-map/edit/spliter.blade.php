<input type="hidden" value="{{$spliter->id}}" name="id">

<div class="form-group row">
    <label for="spliter_name" class="col-3 required text-right col-form-label">Spliter Name</label>
    <div class="col-8">
        <input name="spliter_name" required="" value="{{$spliter->spliter_name}}" class="form-control" type="text" placeholder="Enter spliter name" id="spliter_name">
    </div>
</div>


 <div class="form-group row">
    <label for="spliter_core" class="col-3 required text-right col-form-label">Spliter Core</label>
    <div class="col-8">
        <input name="spliter_core" disabled value="1/{{$spliter->spliter_core}}" class="form-control" type="text" id="spliter_core">
    </div>
</div>

<div class="form-group row" id="ShowCoreupdate">
    @foreach($spliter->cores as $core)
    <label for="example-color-input" class="col-3 col-md-3 text-right col-form-label">Core {{$core->core_no}}</label><div class="col-8 col-md-2"><input name="core_no[{{$core->id}}]" class="form-control" type="color" value="{{$core->core_color}}" id="example-color-input"></div>    
    @endforeach                      
</div>

<div class="form-group row">
    <label for="spliter_core" class="col-3 text-right col-form-label">Notes</label>
    <div class="col-8">
        <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="2">{{$spliter->notes}}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="spliter_status_edit" class="col-3 text-right col-form-label">Status</label>
    <div class="col-8">
        <div  class="status-btn" >
        <div class="custom-control custom-switch">
            <input name="status" type="checkbox" class="custom-control-input" {{ ($spliter->status == 1) ? 'checked' : '' }} id="spliter_status_edit">
            <label  class="custom-control-label" for="spliter_status_edit">Publish/UnPublish</label>
        </div>
    </div>
    </div>
</div>
