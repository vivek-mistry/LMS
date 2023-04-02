<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6 style="float: left;" class="pull-left"><strong>Dashboard</strong></h6>

                        <p style="float: right;"><strong>NOTE : </strong> Current month and year of payment to be taken. </p>
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
                                    <input type="text"  class="form-control" placeholder="Search" wire:model="searchItem" />
                                </div>
                            </div>

                        </div>
                        <table class="table table-borderd">
                            <thead>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Purchase Item</th>
                                <th>Amount</th>
                                <th>Expected Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $key => $order)
                                    <tr class="{{ $order->expected_dt < $current_date ? 'transparent-red' : null }} ">

                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->order->customer->name }}</td>
                                        <td>{{ $order->order->title }}</td>
                                        <td>{{ $order->amount }}</td>
                                        <td>{{ $order->expected_dt }}</td>
                                        <td>
                                            <button class="btn btn-primary" >Check</button>
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
</div>
