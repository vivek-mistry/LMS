<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6 style="float: left;" class="pull-left"><strong>Receipt</strong></h6>


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
                                <th>Purchase Item (Title)</th>
                                <th>Amount</th>
                                <th>Payement Date</th>

                            </thead>
                            <tbody>
                                @foreach ($order_details as $key => $order)
                                    <tr>

                                        <td>{{ $order->order_id }}</td>
                                        <td>
                                            <p><strong>Name : </strong>{{ $order->order->customer->name }}</p>
                                            <p><strong>Mobile No : </strong>{{ $order->order->customer->mobile_number }}</p>
                                        </td>
                                        <td>{{ $order->order->title }}</td>
                                        <td>{{ $order->amount }}</td>
                                        <td>{{ $order->payment_dt }}</td>

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
