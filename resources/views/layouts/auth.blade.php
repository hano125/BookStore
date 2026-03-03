<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title') - نظام أرشفة الوثائق</title>
    <link rel="stylesheet" href="{{ asset('Assets') }}/css/simplebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Assets') }}/css/feather.css">
    <!-- App CSS (Dark Mode Only) -->
    <link rel="stylesheet" href="{{ asset('Assets') }}/css/app-dark.css" id="darkTheme">
</head>

<body class="dark rtl">
    @yield('content')

    <script src="{{ asset('Assets') }}/js/jquery.min.js"></script>
    <script src="{{ asset('Assets') }}/js/popper.min.js"></script>
    <script src="{{ asset('Assets') }}/js/moment.min.js"></script>
    <script src="{{ asset('Assets') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('Assets') }}/js/simplebar.min.js"></script>
    <script src="{{ asset('Assets') }}/js/tinycolor-min.js"></script>
    <script src="{{ asset('Assets') }}/js/config.js"></script>
    <script src="{{ asset('Assets') }}/js/apps.js"></script>
    @stack('scripts')
</body>

</html>
