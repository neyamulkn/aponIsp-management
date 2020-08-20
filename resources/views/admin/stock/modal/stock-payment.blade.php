 <div class="modal fade" id="stockPayment" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('stock.payment')}}" class="floating-labels" method="post">
                    {{ csrf_field() }}
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Stock Payment</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" >

                        <div class="col-md-12">
                            <div class="form-group">
                                <span id="dueAmount">Due Amount</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="amount">Amount</label>
                                <input required name="amount" id="amount" value="{{old('amount')}}" type="text" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="payment_method">Payment Method</label>
                                <select onchange="PaymentMethod(this.value)" required name="payment_method" id="payment_method" class="form-control custom-select">
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="PaymentMethodField"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="required" for="stock_date">Payment Date</label>
                                <input name="payment_date" id="payment_date" value="{{old('payment_date') ? old('payment_date') : Carbon\Carbon::parse(now())->format('Y-m-d')}}" required="" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label style="background: #fff;top:-10px;z-index: 1" for="notes">Notes</label>
                                <textarea name="notes" class="form-control" placeholder="Enter details" id="notes" rows="1">{{old('notes')}}</textarea>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="paymentBtn" class="btn btn-sm btn-success">Payment Now</button>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>