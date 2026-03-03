<!doctype html>
<html lang="en">
@include('partials.head')

<body class="vertical  dark rtl ">
    <div class="wrapper">
        @include('partials.navbar')
        @include('partials.sidebar')

        <main role="main" class="main-content">
            @yield('content')
        </main> <!-- main -->
    </div> <!-- .wrapper -->
    @include('partials.scripts')
    @yield('scripts')
</body>

</html>
