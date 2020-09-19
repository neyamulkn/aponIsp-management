
<!-- add Modal -->
<div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">

          <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Fiber</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{route('fiber.store')}}"  method="POST">
                        {{csrf_field()}}
                        <div class="form-body">
                            <!--/row-->
                          
                                    <div class="form-group row">
                                        <label for="fiber_name" class="col-3 required text-right col-form-label">Fiber Name</label>
                                        <div class="col-8">
                                            <input name="fiber_name" required="" class="form-control" type="text" placeholder="Enter fiber name" id="fiber_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fiber_code" class="col-3 text-right col-form-label">Fiber Code</label>
                                        <div class="col-8">
                                            <input name="fiber_code" class="form-control" type="text" placeholder="example: 1250" id="fiber_code">
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label for="fiber_core" class="col-3 required text-right col-form-label">Fiber Core</label>
                                        <div class="col-8">
                                            <select onchange="ShowCore(this.value)" required name="fiber_core" class="custom-select col-12" id="fiber_core">
                                                <option selected="">Choose...</option>
                                                @for($i = 2; $i <= 32; $i+=2)
                                                <option value="{{$i}}"> {{ '1 / '.$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="ShowCore">
                                        
                                    </div>
                                
                                    <div class="form-group row">
                                        <label for="fiber_core" class="col-3 text-right col-form-label">Notes</label>
                                        <div class="col-8">
                                            <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{old('notes')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="fiber_status" class="col-3 text-right col-form-label">Status</label>
                                        <div class="col-8">
                                            <div  class="status-btn" >
                                            <div class="custom-control custom-switch">
                                                <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="fiber_status">
                                                <label  class="custom-control-label" for="catstatus">Publish/UnPublish</label>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal-footer">
                                        <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>