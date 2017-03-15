
<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
<body>
    @include('layouts.partials.nav')
    <div class="container">
        @include('layouts.partials.flash')
        @include('layouts.partials.header')
        <div class="row">
            @yield('content')
            @include('layouts.partials.sidebar')
        </div><!-- /.row -->
    </div><!-- /.container -->
    @include('layouts.partials.footer')
    <!-- scripts -->
    @include('layouts.partials.scripts')
</body>
</html>
