<!-- add Modal -->
<div class="modal fade" id="categoryModal" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">

          <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Stock Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body form-row">
                <div class="card-body">
                    <form action="{{route('stockCategory.store')}}" enctype="multipart/form-data" method="POST" class="floating-labels">
                        {{csrf_field()}}
                        <div class="form-body">
                            <!--/row-->
                            <div class="row justify-content-md-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Category">Stock Category Name</label>
                                        <input  name="name" id="Category" value="{{old('name')}}" required="" type="text" class="form-control">
                                    </div>
                                </div>
                             
                            </div>
                            

                            <div class="row justify-content-md-center">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="background: #fff;top:-10px;z-index: 1" for="notes">Notes</label>
                                        <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="2">{{old('notes')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-12">
                                    <div class="head-label">
                                        <label class="switch-box">Status</label>
                                        <div  class="status-btn" >
                                            <div class="custom-control custom-switch">
                                                <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="catstatus">
                                                <label  class="custom-control-label" for="catstatus">Publish/UnPublish</label>
                                            </div>
                                        </div>
                                    </div>
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