<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6 style="float: left;" class="pull-left"><strong>All Orders</strong></h6>
                        <button type="button" class="btn btn-primary pull-right" style="float: right;" data-toggle="modal"
                            data-target="#addOrderModal"> ADD Order</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <table class="table table-borderd">
                            <thead>
                                <th>Order Id</th>
                                <th>Customer</th>
                                <th>title</th>
                                <th>Month</th>
                                <th>Total Amount</th>
                                <th>Per Month Amount</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $value)
                                    <tr>
                                        <td>#{{ $value->id }}</td>
                                        <td>{{ $value->customer->name }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->total_month }}</td>
                                        <td>{{ $value->total_amount }}</td>
                                        <td>{{ $value->per_month_amount }}</td>
                                        <td>
                                            <button class="btn btn-danger" wire:click='deleteConfirmation({{ $value->id }})'>Delete</button>
                                            <button class="btn btn-warning" wire:click='orderWithDetail({{ $value->id }})'>View</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade " id="addOrderModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-3">Customer</label>
                            <div class="col-9">
                                <select class="form-control" wire:model='customer_id'>
                                    <option value="">Select Customer</option>
                                    @foreach ($customer as $cust)
                                        <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Category Type</label>
                            <div class="col-9">
                                <input type="text" class="form-control" readonly wire:model='category_type'>
                                @error('category_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Title</label>
                            <div class="col-9">
                                <input type="text" class="form-control" wire:model='title'>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Total Month</label>
                            <div class="col-9">
                                <input type="number" class="form-control" wire:model='total_month'>
                                @error('total_month')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Total Amount</label>
                            <div class="col-9">
                                <input type="text" class="form-control" wire:model='total_amount'>
                                @error('total_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Per Month Amount</label>
                            <div class="col-9">
                                <input type="text" class="form-control" wire:model="per_month_amount">
                                @error('per_month_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Loan Payment Date</label>
                            <div class="col-9">
                                <input type="date" class="form-control" wire:model='loan_payment_date'>
                                @error('loan_payment_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Note</label>
                            <div class="col-9">
                                <textarea class="form-control" wire:model='note'></textarea>
                                @error('note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade " id="deleteOrderModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">

                        <p>Are you sure you want to delete this order?</p>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" wire:click='deleteOrder'>Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade " id="viewOrderModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Show Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">

                        <h4>Customer</h4>
                        @isset($view_order_detail)


                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>MobileNo</th>
                                <th>Pan</th>
                                <th>Aadhar</th>
                            </tr>
                            <tr>
                                <td>{{ $view_order_detail->customer->name }}</td>
                                <td>{{ $view_order_detail->customer->mobile_number }}</td>
                                <td>{{ $view_order_detail->customer->pan }}</td>
                                <td>{{ $view_order_detail->customer->aadhar }}</td>
                            </tr>
                        </table>

                        <h4>Order</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Order ID</th>
                                <th>Total Month</th>
                                <th>Total Amount</th>
                                <th>Per Month Amount</th>

                            </tr>
                            <tr>
                                <td>{{ $view_order_detail->id }}</td>
                                <td>{{ $view_order_detail->total_month }}</td>
                                <td>{{ $view_order_detail->total_amount }}</td>
                                <td>{{ $view_order_detail->per_month_amount }}</td>
                            </tr>
                        </table>
                        <h4>Loan Amount</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Expected Date</th>
                                <th>Amount</th>
                                <th>Is Paid?</th>
                            </tr>
                            @foreach ($view_order_detail->order_details as $key => $order_detail)
                            <tr>
                                <td>{{ $order_detail->expected_dt }}</td>
                                <td>{{ $order_detail->amount }}</td>
                                <td>{{ $order_detail->is_paid == 0 ? 'No' : 'Yes' }}</td>

                            </tr>
                            @endforeach

                        </table>
                        @endisset

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // window.addEventListener('close-modal')
        // {
        //     $('#addCustomerModal').modal('hide');
        // }

        window.addEventListener('close-modal', event => {
            $('#addOrderModal').modal('hide');
            $('#deleteOrderModal').modal('hide');
        });

        window.addEventListener('close-delete-model', event => {
            $('#deleteOrderModal').modal('hide');
        });

        window.addEventListener('close-edit-modal', event => {
            $('#editCustomerModal').modal('hide');
        });

        window.addEventListener('show-order-delete-model', event => {
            $('#deleteOrderModal').modal('show');
        });

        window.addEventListener('show-order-detail', event => {
            $('#viewOrderModal').modal('show');
        });
    </script>
@endpush
