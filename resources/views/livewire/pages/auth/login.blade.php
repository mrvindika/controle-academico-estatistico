<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function Livewire\Volt\{form};

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();
    
    session()->flash('welcome');

    return $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
};


?>


<div class="col-md-5 mx-auto">
    {{-- TITLE --}}
    <x-slot name="title"> {{ __('Sistema | Login') }} </x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-primary">
            <h4 class="page-title text-center text-danger">{{ __('Login') }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit="login">
                <div class="form-group">
                    <label for="email">{{ __('Usuário') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                        </div>
                        <input type="text" id="email" wire:model="form.email"  class="form-control @error('form.email') is-invalid @enderror" placeholder="Email ou Telemovel" aria-label="Email ou Telemovel" autofocus>
                        @error('form.email') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Nova senha') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                        </div>
                        <input type="password" id="password"  wire:model.live.blur="form.password"  class="form-control @error('form.password') is-invalid @enderror" placeholder="Nova senha" aria-label="Nova senha">
                        @error('form.password') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group form-check form-check-success">
                    <label class="form-check-label" for="remember">
                            <input type="checkbox" class="form-check-input" wire:model="form.remember" id="remember" {{ old('form.remember') ? 'checked' : '' }}>
                            {{ __('Lembrar-me') }}<i class="input-helper"></i>
                    </label>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-info btn-lg btn-rounded">
                        <i class="fas fa-sign-in-alt"></i>
                        {{ __('Entrar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>    
