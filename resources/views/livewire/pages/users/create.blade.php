<?php

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

use function Livewire\Volt\{form};
form(UserForm::class);


$register = function () {
    $validated= $this->form->validateOnlyFields(['name', 'role','email', 'phone', 'password', 'password_confirmation']);

    $user = User::create($validated);

    event(new Registered($user));

    session()->flash('userCreated');

    return $this->redirect(route('users.index', absolute: false), navigate: false); 
};

?>

{{-- CREATE USER #FORM --}}
<div class="col-md-6 mx-auto">
    {{-- TITLE --}}
    <x-slot name="title"> {{ __('Novo Usuário') }} </x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-primary">
            <h4 class="page-title text-center text-danger">{{ __('Cadastrar Usuário') }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit="register">
                {{-- Loader --}}
                <x-includes.loader target="register"/>
                <div class="form-group">
                    <label for="name">{{ __('Nome') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text"><i class="fas fa-user"></i></label>
                        </div>
                        <input type="text" id="name"  wire:model.live.blur="form.name"  class="form-control @error('form.name') is-invalid @enderror" placeholder="Nome">
                        @error('form.name') <label class="invalid-feedback" role="alert">{{ $message }}</label> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="role">{{ __('Previlégio') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text"><i class="fas fa-user-cog"></i></label>
                        </div>
                        <select id="role"  wire:model.live.blur="form.role" class="form-control @error('form.role') is-invalid @enderror" autocomplete="off">
                            <option value="Selecione">-- {{__('Selecione')}} --</option>
                            <option value="Operador">Operador</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                        @error('form.role') <label class="invalid-feedback" role="alert">{{ $message }}</label> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text"><i class="fas fa-user-lock"></i></label>
                        </div>
                        <input type="text" id="email" wire:model.live.blur="form.email"  class="form-control @error('form.email') is-invalid @enderror" placeholder="Email ou Telemovel" autofocus>
                        @error('form.email') <label class="invalid-feedback" role="alert">{{ $message }}</label> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">{{ __('Telemovel') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text"><i class="fas fa-phone"></i></label>
                        </div>
                        <input type="text" id="phone"  wire:model.live.blur="form.phone"  class="form-control @error('form.phone') is-invalid @enderror" placeholder="Telemovel">
                        @error('form.phone') <label class="invalid-feedback" role="alert">{{ $message }}</label> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Senha') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text"><i class="fa fa-eye-slash"></i></label>
                        </div>
                        <input type="password" id="password"  wire:model.live.blur="form.password"  class="form-control @error('form.password') is-invalid @enderror" placeholder="Senha">
                        @error('form.password') <label class="invalid-feedback" role="alert">{{ $message }}</label> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirmar senha') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text"><i class="fa fa-eye-slash"></i></label>
                        </div>
                        <input type="password" id="password_confirmation" wire:model.live.blur="form.password_confirmation" class="form-control @error('form.password_confirmation') is-invalid @enderror" placeholder="Senha de confirmação">
                        @error('form.password_confirmation') <label class="invalid-feedback" role="alert">{{ $message }}</label> @enderror
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
