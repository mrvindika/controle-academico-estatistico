<nav class="navbar col-lg-12 col-12 p-0  @auth fixed-top @endauth d-flex flex-row default-layout-navbar">

    {{-- BRAND DESCRIPTION --}}
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand" href="index-2.html"><img src="{{ asset('images/gov-ao.png') }}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index-2.html"><img src="{{ asset('images/min-gov-ao.png') }}" alt="logo"/></a>
    </div>

    {{-- NAV MENU --}}
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        
        @auth
            {{-- LEFT TOGGLE MENU BUTTON --}}
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="fas fa-bars"></span>
            </button>
            
            {{-- USER PROFILE --}}
            <livewire:pages.auth.profile-menu>

            {{-- RIGHT TOGGLE MENU BUTTON --}}
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="fas fa-bars"></span>
            </button>
        @else
            <ul class="navbar-nav navbar-nav-right">
                @if(Route::currentRouteName()=='welcome')
                    @if(App\Models\User::count() == 0)
                        <li class="nav-item btn btn-warning"> 
                            <a class="nav-link"  wire:navigate href="{{ route('register') }}">
                                <i class="fas fa-plus"></i> {{__('Cadastrar')}}
                            </a>
                        </li>
                        @else 
                        <li class="nav-item btn btn-info"> 
                            <a class="nav-link"  wire:navigate href="{{ route('login') }}">
                                <i class="fas fa-door-open"></i> {{ __('Login') }}
                            </a>
                        </li>
                    @endif
                @endif

                @if(Route::currentRouteName()=='login')
                     <li class="nav-item btn btn-info"> 
                        <a class="nav-link"  wire:navigate href="{{ route('welcome') }}">
                            <i class="fas fa-info"></i> {{__('Bem-vindo')}}
                        </a>
                    </li>
                @endif
            </ul>
        @endauth
    </div>
</nav>