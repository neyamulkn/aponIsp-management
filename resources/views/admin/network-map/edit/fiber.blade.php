<input type="hidden" value="{{$fiber->id}}" name="id">

<div class="form-group row">
    <label for="fiber_name" class="col-3 required text-right col-form-label">Fiber Name</label>
    <div class="col-8">
        <input name="fiber_name" required="" value="{{$fiber->fiber_name}}" class="form-control" type="text" placeholder="Enter fiber name" id="fiber_name">
    </div>
</div>
<div class="form-group row">
    <label for="fiber_code" class="col-3 text-right col-form-label">Fiber Code</label>
    <div class="col-8">
        <input name="fiber_code" value="{{$fiber->fiber_code}}" class="form-control" type="text" placeholder="example: 1250" id="fiber_code">
    </div>
</div>

 <div class="form-group row">
    <label for="fiber_core" class="col-3 required text-right col-form-label">Fiber Core</label>
    <div class="col-8">
        <input name="fiber_core" disabled value="1/{{$fiber->fiber_core}}" class="form-control" type="text" id="fiber_core">
    </div>
</div>

<div class="form-group row" id="ShowCoreupdate">
    @foreach($fiber->fiber_cores as $core)
    <label for="example-color-input" class="col-3 col-md-3 text-right col-form-label">Core {{$core->core_no}}</label><div class="col-8 col-md-2"><input name="core_no[{{$core->id}}]" class="form-control" type="color" value="{{$core->core_color}}" id="example-color-input"></div>    
    @endforeach                      
</div>

<div class="form-group row">
    <label for="fiber_core" class="col-3 text-right col-form-label">Notes</label>
    <div class="col-8">
        <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{$fiber->notes}}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="fiber_status_edit" class="col-3 text-right col-form-label">Status</label>
    <div class="col-8">
        <div  class="status-btn" >
        <div class="custom-control custom-switch">
            <input name="status" type="checkbox" class="custom-control-input" {{ ($fiber->status == 1) ? 'checked' : '' }} id="fiber_status_edit">
            <label  class="custom-control-label" for="fiber_status_edit">Publish/UnPublish</label>
        </div>
    </div>
    </div>
</div>
