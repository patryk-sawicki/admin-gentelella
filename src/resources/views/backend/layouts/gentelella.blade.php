<!DOCTYPE html>
<html>
@include('admin::includes.head')
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('admin::includes.sidebar')

            @include('admin::includes.top-nav')

            <div class="right_col" role="main">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible" role="alert" style="margin-top:55px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:55px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('warning'))
                    <div class="alert alert-warning alert-dismissible" role="alert" style="margin-top:55px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('info'))
                    <div class="alert alert-info alert-dismissible" role="alert" style="margin-top:55px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @yield('content')
            </div>

            @include('admin::includes.footer')

        </div>
    </div>
@include('admin::includes.footer-scripts')
</body>
</html>