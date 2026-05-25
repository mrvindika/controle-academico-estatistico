<?php

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{form};
form(UserForm::class);

$register = function () {

    $validatedUser= $this->form->validateOnlyFields(['name','password', 'password_confirmation']);
    $validatedContact= $this->form->validateOnlyFields(['email', 'phone']);
    
    $user = User::create($validatedUser);
    $user->contact()->create($validatedContact);

    event(new Registered($user));

    session()->flash('welcome');
    
    Auth::login($user);

    return $this->redirect(route('dashboard', absolute: false), navigate: false);  


    dd($validatedContact= $this->form->validateOnlyFields(['email', 'phone']));
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
                        <input type="text" id="name"  wire:model.live.blur="form.name"  class="form-control @error('form.name') is-invalid @enderror" placeholder="Nome" aria-label="Nome" autofocus>
                        @error('form.name') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('Telemovel') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" id="phone"  wire:model.live.blur="form.phone"  class="form-control @error('form.phone') is-invalid @enderror" placeholder="Telemovel">
                        @error('form.phone') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                        </div>
                        <input type="email" id="email" wire:model.live.blur="form.email"  class="form-control @error('form.email') is-invalid @enderror" placeholder="Email">
                        @error('form.email') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Senha') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                        </div>
                        <input type="password" id="password"  wire:model.live.blur="form.password"  class="form-control @error('form.password') is-invalid @enderror" placeholder="Senha">
                        @error('form.password') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirmar senha') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                        </div>
                        <input type="password" id="password_confirmation" wire:model.live.blur="form.password_confirmation" class="form-control @error('form.password_confirmation') is-invalid @enderror" placeholder="Senha de confirmação">
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
