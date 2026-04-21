<?php

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{form};
form(UserForm::class);


$register = function () {
    $validated= $this->form->validateOnlyFields(['name','email', 'phone', 'password', 'password_confirmation']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    return $this->redirect(route('dashboard', absolute: false), navigate: false); 
};

?>

{{-- REGISTER USER  ADMIN #DIV --}}
<div class="col-md-5 mx-auto">
    {{-- TITLE --}}
    <x-slot name="title"> {{ __('Usuário | Administrador') }} </x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-primary">
            <h4 class="page-title text-center text-danger">{{ __('Cadastrar Administrador') }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit="register">
                <div class="form-group">
                    <label for="name">{{ __('Nome') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="name"  wire:model.live.blur="form.name"  class="form-control @error('form.name') is-invalid @enderror" placeholder="Nome" aria-label="Nome">
                        @error('form.name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                        </div>
                        <input type="text" id="email" wire:model.live.blur="form.email"  class="form-control @error('form.email') is-invalid @enderror" placeholder="Email ou Telemovel" aria-label="Email ou Telemovel" autofocus>
                        @error('form.email') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('Telemovel') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" id="phone"  wire:model.live.blur="form.phone"  class="form-control @error('form.phone') is-invalid @enderror" placeholder="Telemovel" aria-label="Telemovel">
                        @error('form.phone') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
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
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirmar nova senha') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                        </div>
                        <input type="password" id="password_confirmation" wire:model.live.blur="form.password_confirmation" class="form-control @error('form.password_confirmation') is-invalid @enderror" placeholder="Confirmar nova senha" aria-label="Confirmar nova senha">
                        @error('form.password_confirmation') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success btn-lg btn-rounded">
                        <i class="fas fa-save"></i>
                        {{ __('Guardar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>    
