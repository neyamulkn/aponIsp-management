
<!-- add Modal -->
<div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">

          <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create TJ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{route('tj.store')}}"  method="POST">
                        {{csrf_field()}}
                        <div class="form-body">
                            <!--/row-->
                          
                                    <div class="form-group row">
                                        <label for="tj_name" class="col-3 required text-right col-form-label">TJ Name</label>
                                        <div class="col-8">
                                            <input name="tj_name" required="" class="form-control" type="text" placeholder="Enter tj name" id="tj_name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tj_ports" class="col-3 required text-right col-form-label">TJ Port</label>
                                        <div class="col-8">
                                            <input name="tj_ports" required="" class="form-control" type="text" placeholder="Enter TJ port" id="tj_ports">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tj_location" class="col-3 text-right col-form-label">TJ Location</label>
                                        <div class="col-8">
                                            <input name="tj_location"  class="form-control" type="text" placeholder="Enter TJ location" id="tj_location">
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label for="tj_core" class="col-3 text-right col-form-label">Notes</label>
                                        <div class="col-8">
                                            <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{old('notes')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tj_status" class="col-3 text-right col-form-label">Status</label>
                                        <div class="col-8">
                                            <div  class="status-btn" >
                                            <div class="custom-control custom-switch">
                                                <input name="status" type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="tj_status">
                                                <label  class="custom-control-label" for="tj_status">Publish/UnPublish</label>
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