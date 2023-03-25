<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Title -->
    <title>Practical - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .input-group {
            margin-top: 5px;
        }

        .error-help-block {
            color: red;
            text-align: left;
            float: left;
        }
    </style>
    @stack('custom-styles')
</head>

<body class="h-100vh">
    <div class="container">
        <div class="row text-end mt-5">
            <div class="col-12">
                <a href="{{ route('auth.login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('auth.register') }}" class="btn btn-primary">Register</a>
            </div>
        </div>
        @if(session()->has('error'))
        <div class="alert alert-danger mt-2">
            {{ session()->get('error') }}
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success mt-2">
            {{ session()->get('success') }}
        </div>
        @endif
        @yield('container')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    @stack('custom-scripts')
</body>

</html>