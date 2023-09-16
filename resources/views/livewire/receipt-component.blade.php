@push('styles')
    <style>
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
@endpush
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
                                <th>Action</th>
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
                                        <td>
                                            <button class="btn btn-warning"
                                                wire:click='orderWithDetail({{ $order->order_id }})'>Show Receipt</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $order_details->links('pagination::bootstrap-4') }}


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="PrintDiv"></div>

    <div wire:ignore.self class="modal fade " id="viewOrderModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Show Order Receipt</h5>
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
                                    <th>Mobile Number</th>
                                    <th>Mobile Number 2 </th>
                                    <th>Mobile Number 3 </th>
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
                                    <th>Payment Date</th>
                                    <th>Expected Date</th>
                                    <th>Amount</th>
                                    <th>Is Paid?</th>
                                </tr>
                                @foreach ($view_order_detail->order_details as $key => $order_detail)
                                    <tr>
                                        <td>{{ $order_detail->payment_dt }}</td>
                                        <td>{{ $order_detail->expected_dt }}</td>
                                        <td>{{ $order_detail->amount }}</td>
                                        <td>{{ $order_detail->is_paid == 0 ? 'No' : 'Yes' }}</td>

                                    </tr>
                                @endforeach

                            </table>
                        @endisset

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click="printLoanInvoice">Print</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        window.addEventListener('show-order-detail', event => {
            $('#viewOrderModal').modal('show');

        });

        window.addEventListener('print-order', event => {

            var elem = document.getElementById("viewOrderModal")

            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();




        });
    </script>
@endpush
