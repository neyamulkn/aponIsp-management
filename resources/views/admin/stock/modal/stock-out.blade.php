<div class="modal fade" id="stockOut" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form action="{{route('stock.out')}}" class="floating-labels" method="post">
              {{ csrf_field() }}

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Stock out</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body form-row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="required" for="stockOutType">Wherever used</label>
                        <select required name="type" id="stockOutType" class="form-control custom-select">
                            <option value="">Select one</option>
                            <option value="user">User</option>
                            <option value="box">Box</option>
                            <option value="tg">TG</option>
                            <option value="return">Return</option>
                            <option value="warranty">Warranty</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12"><div class="row" id="stockOutByField"></div></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="stockOutqty">Quantity</label>
                        <input  name="qty" id="stockOutqty" value="{{old('qty')}}" type="number" min="0" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="stockout_date">Stock Out Date</label>
                        <input  type="date" name="stock_date" id="stockout_date" value="{{old('stock_date') ? old('stock_date') : Carbon\Carbon::parse(now())->format('Y-m-d')}}" required="" type="date" class="form-control">
                    </div>
                </div>

               <div class="col-md-12">
                    <div class="form-group">
                        <label style="background: #fff;top:-10px;z-index: 1" for="notes">Notes</label>
                        <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{old('notes')}}</textarea>
                    </div>
                </div>
                            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="stock_id" name="stock_id"  value="" class="btn btn-sm btn-success">Stock out</button>
            </div>
          </div>
        </form>
    </div>
</div>