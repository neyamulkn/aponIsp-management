<span class="btn btn-info btn-xs" onclick="getAllCore({{$extend_id}})"><i class="fa fa-angle-left"></i> Back</span>
<div class="form-group row">
   
    <label for="spliter_core" class="col-3 required text-right col-form-label">Spliter Name</label>
    <div class="col-8">
        <input type="hidden" name="extend_core_id" value="{{$extend_core_id}}">
        <select required name="spliter_id" class="custom-select col-12" id="spliter_core">
            <option value="">Select Spliter</option>
            @foreach($spliters as $spliter)
                <option @if($spliter->extend_core_id != null) style="background:#ccc" disabled @endif value="{{$spliter->id}}"> {{ $spliter->spliter_name}}({{$spliter->spliter_core}})</option>
            @endforeach
           </select>
    </div>
</div> 
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-sm btn-success">Extend Now</button>
</div>