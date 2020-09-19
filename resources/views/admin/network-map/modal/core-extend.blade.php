<input type="hidden" value="{{$fiber['id']}}" name="id">
<div class="form-group row" id="ShowCoreupdate">
    @foreach($fiber['fiber_cores'] as $core)
    <label for="example-color-input" class="col-2 col-md-2 text-right col-form-label">Core {{$core['core_no']}}</label><div class="col-8 col-md-2"><input name="core_no[{{$core['core_no']}}]" class="form-control" type="color" value="{{$core['core_color']}}" id="example-color-input"></div><div class="col-2 col-md-2"><button>Extend</button></div>   
    @endforeach                      
</div>