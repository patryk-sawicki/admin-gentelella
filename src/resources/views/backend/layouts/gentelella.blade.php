<!DOCTYPE html>
<html>
@include('admin::includes.head')
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('admin::includes.sidebar')

            @include('admin::includes.top-nav')

            <div class="right_col" role="main">
                @yield('content')
            </div>

            @include('admin::includes.footer')

        </div>
    </div>
@include('admin::includes.footer-scripts')
</body>
</html>