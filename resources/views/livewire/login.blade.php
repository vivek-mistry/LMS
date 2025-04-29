<section class="container">
    {{-- @include('admin.alert.failed-validate') --}}
    <div class="container-fluid mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <div class="card" wire:ignore.self>
                    <div class="card-header">
                        <h3 class="card-title"> ShopLedger Login </h3>

                    </div>
                    <form wire:submit.prevent='checkAuthenticate'>
                        <div class="card-body p-5">

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email*</label>
                                        <input type="text" wire:model='email' class="form-control">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password*</label>
                                        <input type="password" wire:model='password' class="form-control">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @if (env('APP_ENV') == "local")
                            
                        
                                <div class="col-12 mt-4">
                                    <table class="table table-bordered ">
                                        <tr>
                                            <th>Email</th>
                                            <td>admin@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <th>Password</th>
                                            <td>12345678</td>
                                        </tr>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>


                        
                        <div class="card-footer">
                            @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                            @endif
                            <button type="submit" class="btn btn-primary"> Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>