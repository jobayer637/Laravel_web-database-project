<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/52414c8bb5.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('css')
</head>
<body class="">
    @include('layouts.frontend.header')
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-8 mx-0 px-0">
                @yield('left-section')
            </div>
            <div class="col-md-4">
                @include('layouts.frontend.right-section')
            </div>
        </div>
    </div>

    <div class="container my-2 text-center py-5 card-card px-0">
        <div class="card shadow-sm rounded-0 m-0">
            <div class="card-header py-5">
                <h5>Copyright Jobaye Hossain &copy; Web Database Project {{ date('Y') }}</h5>
                <span>
                    <a href="https://www.facebook.com/web.jobayer" target="_blank"><i class="fab fa-facebook-square text-primary" style="font-size: 2rem;"></i></a> &nbsp;&nbsp;
                    <a href="https://twitter.com/Jobayer01219676" target="_blank"><i class="fab fa-twitter-square text-primary" style="font-size: 2rem;"></i></a> &nbsp;&nbsp;
                    <a href="https://web.skype.com/8:live:web.jobayer?inviteId=iGQk8oD5iiVj" target="_blank"><i class="fab fa-skype text-primary" style="font-size: 2rem;"></i></a> &nbsp;&nbsp;
                    <a href="https://www.github.com/jobayer637" target="_blank"><i class="fab fa-github-square text-primary" style="font-size: 2rem;"></i></a>
                </span>
            </div>
        </div>
    </div>

        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
</body>
</html>
