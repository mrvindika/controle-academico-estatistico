<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- METADATA --}}
        <meta data-navigate-once>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="{{ config('app.name', 'Colégio Kilamba do Cubal') }}">
        <meta name="keywords" content="Sistema, Web, Gestão, Escolar, Integrada, Cubal, SGEI">
        <meta name="author" content="UKB">
        <meta name="csrf_token" content="{{ csrf_token() }}">

        {{-- TITLE --}}
        <title>{{ $title?? 'Testing Page'}}</title>

        {{-- ICON --}}
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/png">

        {{-- BOOTSTRAP STYLES --}}
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/vendor.bundle.addons.css') }}">
        
        {{-- TEMPLATE & SPECIFICS STYLES --}}
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontAwesome/all.min.css') }}">
        <link rel="prefetch" href="{{ asset('assets/plugins/fontAwesome/webfonts/fa-solid-900.woff') }}" as="font" type="font/woff" crossorigin>
        <link rel="stylesheet" href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/sweetAlert2/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/template/style.css') }}">
        {{ $styles?? null }}

        {{-- VITE STYLES --}}
         @vite(['resources/css/app.css'])

        {{-- LIVEWIRE STYLES --}}
        @livewireStyles
    </head>
    <body id="{{ Auth::user()? 'app-page': 'guest-page' }}">

        {{-- CONTENT PAGE --}}
        <div class="container-scroller">  
                                                                                                                                                                                                                          
            {{-- NAVBAR --}}
            <x-layouts.navbar/>

            {{--CONTAINER --}}
            <div class="container-fluid page-body-wrapper">
                @auth
                    {{-- SIDEBAR --}}
                    <x-layouts.sidebar/>

                    <div class="main-panel">
                        <div class="content-wrapper">
                            <div class="page-header">
                                <h3 class="page-title"> 
                                    {{ $title?? 'Testing Page'}}
                                </h3>
                                
                                {{-- NOTIFICATION ALERT --}}
                                <nav aria-label="breadcrumb">
                                    @if (session('alert'))
                                        <div class="alert alert-fill-{{ session('alert.bg')}}" role="alert">
                                            <i class="fa fa-bell"></i>
                                            {!! session('alert.msg') !!}
                                        </div>
                                    @endif
                                </nav>
                            </div>
                            {{ $slot->isEmpty()? __('No main component'): $slot }}
                        </div>
                    </div>
                @else
                    <div class="content-wrapper">
                        {{ $slot->isEmpty()? __('No main component'): $slot }}
                    </div>
                @endauth
            </div> 
        </div>

        {{-- FOOTER --}}
        <x-layouts.footer/>

        {{-- BOOTSTRAP SCRIPTS --}}
        <script src="{{ asset('assets/bootstrap/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/vendor.bundle.addons.js') }}"></script>

        {{-- TEMPLATE & SPECIFICS SCRIPTS --}}
        <script src="{{ asset('assets/plugins/sweetAlert2/sweetalert2@11.js') }}"></script>
        <script src="{{ asset('assets/template/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('assets/template/misc.js') }}"></script>
        <script src="{{ asset('assets/template/off-canvas.js') }}"></script>
        {{ $scripts?? null }}

        {{-- VITE SCRIPTS --}}
        @vite(['resources/js/app.js'])

        {{-- LIVEWIRE SCRIPTS --}}
        @livewireScripts
    </body>
</html>
