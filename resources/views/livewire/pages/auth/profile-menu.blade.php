<?php

use App\Livewire\Actions\Logout;
use App\Traits\AppendTrait;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\{boot, uses};

uses(AppendTrait::class);

boot(function(){
    if(session()->has('welcome'))
    {
        $this->dispatch('swal:alert', 
            icon: 'info',
            title: 'Parabéns!',
            message: 'Seja bem-vindo caro '. Auth::user()->role,
        );
    }
});

$logout= (function(Logout $logout){
    $logout();

    return $this->redirect('login', navigate: false);
});

?>

<ul class="navbar-nav navbar-nav-right">
    <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" id="profileDropdown">
            <img src="{{ asset('images/avatar.png') }}" alt="Avatar"/>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">
                <i class="fas fa-user-lock text-primary"></i>
                {{ __('Perfil') }}
            </a>
        <div class="dropdown-divider"></div>
            <a wire:click="logout" class="dropdown-item btn">
                <i class="fas fa-sign-out-alt text-primary"></i>
                {{ __('Terminar') }}
            </a>
        </div>
    </li>
</ul>
