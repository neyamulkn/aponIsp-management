<input type="hidden" value="{{$get_cores->id}}" name="id">

<div class="table-responsive">
   <table id="config-table" class="table display table-bordered table-striped">
        <thead>
            <tr>
                <th>Core Name</th>
                <th>Core Color</th>
                <th>Status</th>
                <th>Extend Core</th>
                <th>#</th>
            </tr>
        </thead> 
        <tbody>

        @foreach($get_cores->cores as $core)                                      
        <tr>
            <td>Core {{$core->core_no}}</td>
            <td> <span style="width: 70%;height: 22px;display: block; background:{{$core->core_color}}" class="core_no"><input name="core_no[{{$core->id}}]" class="form-control" type="hidden" value="{{$core->core_color}}"></span></td>
          
            <td>{!!($core->core_status == 1) ? "<span class='label label-info'>Active</span>" : '<span class="label label-danger">DeActive</span>'!!} 
            </td>
            <td>
                @if($core->extend_core){{$core->extend_core->spliter_name}}@endif
            </td>
            <td>
                <button type="button" class="btn btn-info btn-sm" onclick="getSpliter({{$get_cores->id}}, {{$core->id}})"><i class="fa fa-plus"> </i> Add</button>
            </td>
        </tr>
        @endforeach                               
        </tbody>
    </table>
</div>