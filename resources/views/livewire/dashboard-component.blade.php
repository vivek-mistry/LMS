<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6 style="float: left;" class="pull-left"><strong>Dashboard</strong></h6>

                        <p style="float: right;"><strong>NOTE : </strong> Current month and year of payment to be taken.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <div class="row mb-2">
                            <div class="col-8"></div>
                            <div class="col-4 pull-right">
                                <div class="">
                                    <input type="text" class="form-control" placeholder="Search"
                                        wire:model="searchItem" />
                                </div>
                            </div>

                        </div>
                        <table class="table table-borderd">
                            <thead>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Purchase Item (Title)</th>
                                <th>Amount</th>
                                <th>Expected Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $key => $order)
                                    <tr class="{{ $order->expected_dt < $current_date ? 'transparent-red' : null }} ">

                                        <td>{{ $order->order_id }}</td>
                                        <td>
                                            <p><strong>Name : </strong>{{ $order->order->customer->name }}</p>
                                            <p><strong>Mobile No : </strong>{{ $order->order->customer->mobile_number }}
                                            </p>
                                        </td>
                                        <td>{{ $order->order->title }}</td>
                                        <td>{{ $order->amount }}</td>
                                        <td>{{ $order->expected_dt }}</td>
                                        <td>
                                            <button class="btn btn-primary"
                                                wire:click='setOrderDetailId({{ $order->id }})'>Check</button>
                                            {{-- <button class="btn btn-danger">Delete</button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $order_details->links() }}


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade " id="confirmPaymentModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">

                        <p>Is payment is delivered by Customer?</p>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click='confirmPayment'>Yes</button>
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

        window.addEventListener('show-confirm-payment', event => {
            $('#confirmPaymentModal').modal('show');
        });
        window.addEventListener('close-modal', event => {
            $('#confirmPaymentModal').modal('hide');
        });
    </script>
@endpush
