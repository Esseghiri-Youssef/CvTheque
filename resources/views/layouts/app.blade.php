<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

</head>
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrp.min.css')}}">
<body>
    <div id="app">
        @include('partials.menu')
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                @include('partials.flash')
                </div>
            </div>
        </div>
        
        @yield('content')
    </div>

    <!-- Scripts -->
    
    <script src="{{asset('js/vue.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    
        @yield('javascript')
</body>
</html>
