<html>

<head>
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
        .transparent-red{
            border: 2px solid rgb(255, 0, 0);
            background: rgba(217, 78, 67, 0.5)
        }
    </style>
    @stack('styles')
    @livewireStyles()
</head>

<body>
    @php
        $current_route = Illuminate\Support\Facades\Request::segment(1);
    @endphp
    @auth
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">LMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ $current_route == 'dashboard' ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard </a>
                    </li>
                    <li class="nav-item {{ $current_route == 'customers' ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('customers') }}">Customer </a>
                    </li>
                    <li class="nav-item {{ $current_route == 'orders' ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('orders') }}">Orders</a>
                    </li>
                    <li class="nav-item {{ $current_route == 'receipt' ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('receipt') }}">Receipt</a>
                    </li>
                    {{-- <li class="nav-item {{ $current_route == 'stock' ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('stocks') }}">Stock</a>
                    </li> --}}

                </ul>
                <form class="form-inline my-2 my-lg-0">

                        <a class="btn btn-outline-danger my-2 my-sm-0" href="{{ route('logout') }}">Logout</a>

                </form>
            </div>
        </nav>

        <div class="container m-4">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="header">
                            <div class="col-12">
                                <span class="pull-left">
                                    <nav class="nav nav-pills nav-fill">
                                        {{-- <a class="nav-link" href="#">Dashboard</a> --}}



                                    </nav>
                                </span>

                            </div>

                        </div>
                    </div>
                </div>


            </div>


        </div>
    @endauth
    {{ $slot }}



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

    @stack('scripts')
    @livewireScripts()
</body>


</html>
