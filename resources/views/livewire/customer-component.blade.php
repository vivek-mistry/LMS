<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6 style="float: left;" class="pull-left"><strong>All Customers</strong></h6>
                        <button type="button" class="btn btn-primary pull-right" style="float: right;" data-toggle="modal"
                            data-target="#addCustomerModal"> ADD Customer</button>
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
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Mobile Number 2</th>
                                <th>Mobile Number 3</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($customers as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->mobile_number }}</td>
                                        <td>{{ $value->mobile_number2 }}</td>
                                        <td>{{ $value->mobile_number3 }}</td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#editCustomerModal" wire:click="editCustomer({{ $value->id }})">Edit</button>
                                            {{-- <button class="btn btn-danger">Delete</button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $customers->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade " id="addCustomerModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form wire:submit.prevent='storeCustomerData'>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-3">Name*</label>
                            <div class="col-9">
                                <input type="text" class="form-control" name="name" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Mobile Number*</label>
                            <div class="col-9">
                                <input type="text" class="form-control" name="mobile_number"
                                    wire:model="mobile_number">
                                @error('mobile_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Mobile Number 2</label>
                            <div class="col-9">
                                <input type="number" class="form-control " wire:model="mobile_number2">
                                @error('mobile_number2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Mobile Number 3</label>
                            <div class="col-9">
                                <input type="number" class="form-control" name="mobile_number3" wire:model="mobile_number3">
                                @error('mobile_number3')
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

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade " id="editCustomerModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form wire:submit.prevent='editCustomerData'>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-3">Name*</label>
                            <div class="col-9">
                                <input type="text" class="form-control" name="name" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Mobile Number*</label>
                            <div class="col-9">
                                <input type="text" class="form-control" name="mobile_number"
                                    wire:model="mobile_number">
                                @error('mobile_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Mobile Number 2</label>
                            <div class="col-9">
                                <input type="number" class="form-control " wire:model="mobile_number2">
                                @error('mobile_number2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Mobile Number 3</label>
                            <div class="col-9">
                                <input type="number" class="form-control" name="mobile_number3" wire:model="mobile_number3">
                                @error('mobile_number3')
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
</div>

@push('scripts')
    <script>
        // window.addEventListener('close-modal')
        // {
        //     $('#addCustomerModal').modal('hide');
        // }

        window.addEventListener('close-modal', event => {
            $('#addCustomerModal').modal('hide');
        });

        window.addEventListener('close-edit-modal', event => {
            $('#editCustomerModal').modal('hide');
        });
    </script>
@endpush
