<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6 style="float: left;" class="pull-left"><strong>All Stock</strong></h6>
                        <button type="button" class="btn btn-primary pull-right" style="float: right;" data-toggle="modal"
                            data-target="#addStockModal"> ADD Stock</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <table class="table table-borderd">
                            <thead>
                                <th>Title</th>
                                <th>Qunatity</th>
                                <th>Per Qunatity Price</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($stock as $key => $value)
                                    <tr>

                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->quantity }}</td>
                                        <td>{{ $value->per_quantity_price }}</td>
                                        <td>

                                            <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#editStockModal"
                                                wire:click="editStockModel({{ $value->id }})">Edit</button>
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
    <div wire:ignore.self class="modal fade " id="addStockModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form wire:submit.prevent='saveStock'>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-3">Title</label>
                            <div class="col-9">
                                <input type="text" class="form-control"  wire:model="title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Quantity</label>
                            <div class="col-9">
                                <input type="number" class="form-control"
                                    wire:model="quantity">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Per Qunatity Price</label>
                            <div class="col-9">
                                <input type="number" class="form-control " wire:model="per_quantity_price">
                                @error('per_quantity_price')
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

    <div wire:ignore.self class="modal fade " id="editStockModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form wire:submit.prevent='updateStock'>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-3">Title</label>
                            <div class="col-9">
                                <input type="text" class="form-control"  wire:model="title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Quantity</label>
                            <div class="col-9">
                                <input type="number" class="form-control"
                                    wire:model="quantity">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-3">Per Qunatity Price</label>
                            <div class="col-9">
                                <input type="number" class="form-control " wire:model="per_quantity_price">
                                @error('per_quantity_price')
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


        window.addEventListener('close-modal', event => {
            $('#addStockModal').modal('hide');
            $('#editStockModal').modal('hide');
        });


    </script>
@endpush
