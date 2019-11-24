<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="photos sharing" />
        <meta name="keywords" content="photos users snaps filters profile like comment sharing" />
        <meta name="author" content="Bogdan Matorkić" />
        <link rel="stylesheet" href="{{ asset('/css/modules/plugins/owl.carousel.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/modules/plugins/owl.theme.default.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/modules/plugins/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/modules/template/skel.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/modules/template/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/modules/template/style-wide.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kalam&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kalam&display=swap" />
        <link rel="shortcut icon" href="{{ asset('/img/main/favicon.ico') }}" />
        <title>@yield('title')</title>
    </head>
    <body>

    <!-- Header -->
    @include('components.header')

    <!-- Main -->
    <div id="main">
        @yield('main')

        @isset($errors)
            @if($errors->any())
                <div id="notice">
                    <div class="notices-wrapper">
                        <div class="notices">
                            <div class="notices-body">
                                @foreach($errors->all() as $error)
                                    <div class="error"><i class="fa fa-exclamation-circle"></i><p>{{ $error }}</p></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset

        @empty(!session('error'))
            <div id="notice">
                <div class="notices-wrapper">
                    <div class="notices">
                        <div class="notices-body">
                            <div class="error"><i class="fa fa-exclamation-triangle"></i><p>{{ session('error') }}</p></div>
                        </div>
                    </div>
                </div>
            </div>
        @endempty

        @empty(!session('success'))
        <div id="notice">
            <div class="notices-wrapper">
                <div class="notices">
                    <div class="notices-body">
                        <div class="success"><i class="fa fa-check-circle"></i><p>{{ session('success') }}</p></div>
                    </div>
                </div>
            </div>
        </div>
        @endempty
    </div>

    <!-- Footer -->
    @include('components.footer')

    <!-- Scripts -->
    <script>
        const baseUrl = "{{ asset('/') }}";
        const token = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('/js/modules/plugins/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('/js/modules/plugins/skel.min.js') }}"></script>
    <script src="{{ asset('/js/modules/plugins/skel-layers.min.js') }}"></script>
    <script src="{{ asset('/js/modules/plugins/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/modules/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
    @yield('redirect')
    </body>
</html>
