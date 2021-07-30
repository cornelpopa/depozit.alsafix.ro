<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Depozit Alsafix</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
</head>
<body class="form-membership">

<!-- begin::preloader-->
{{--<div class="preloader">
    <div class="preloader-icon"></div>
</div>--}}
<!-- end::preloader -->

<div class="form-wrapper">

    <h5>Depozit Alsafix</h5>

    <!-- form -->
    <form method="post" action="{{route('login')}}">
        @csrf
        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group d-flex justify-content-between">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked="" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="remember">Remember me</label>
            </div>
        </div>
        <button class="btn btn-primary btn-block">Log in</button>
        <hr>

    </form>
    <!-- ./ form -->

</div>

<!-- Plugin scripts -->
<script src="{{ url('vendors/bundle.js') }}"></script>

<!-- App scripts -->
<script src="{{ url('assets/js/app.min.js') }}"></script>
</body>
</html>
