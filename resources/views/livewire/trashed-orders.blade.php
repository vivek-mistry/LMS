<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6 style="float: left;" class="pull-left"><strong>Recover Orders</strong></h6>

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

                                            <button class="btn btn-warning" wire:click="openConfirm({{ $value->id }})"
                                                >Recover</button>
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $orders->links('pagination::bootstrap-4') }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade " id="recoverOrderModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recover Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">

                        <p>Are you sure you want to recover this order?</p>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click='recoverOrder'>Yes</button>
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

        window.addEventListener('show-model', event => {
            $('#recoverOrderModal').modal('show');

        });
        window.addEventListener('close-model', event => {
            $('#recoverOrderModal').modal('hide');

        });


    </script>
@endpush
