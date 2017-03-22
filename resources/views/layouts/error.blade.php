<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
<body>
    @include('layouts.partials.nav')
    <div class="container">
        <div class="row vertical-center">
            @yield('content')
        </div><!-- /.row -->
    </div><!-- /.container -->
    <!-- scripts -->
</body>
</html>