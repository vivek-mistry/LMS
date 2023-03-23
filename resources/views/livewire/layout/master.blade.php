<html>

<head>
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    @livewireStyles()
</head>

<body>
    @php
        $current_route = Illuminate\Support\Facades\Request::segment(1);
    @endphp
    @auth


    <div class="container m-4">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="header">
                        <div class="col-12">
                            <span class="pull-left">
                                <nav class="nav nav-pills nav-fill">
                                    {{-- <a class="nav-link" href="#">Dashboard</a> --}}
                                    <a class="nav-link {{ $current_route == 'customers' ? 'active' : null }}" href="{{ route('customers') }}">Customer </a>
                                    <a class="nav-link {{ $current_route == 'orders' ? 'active' : null }}" href="{{ route('orders') }}">Orders</a>
                                    <a class="nav-link" href="#">Logout</a>
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