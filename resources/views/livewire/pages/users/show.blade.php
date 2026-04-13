<?php

use App\Livewire\Forms\UserForm;
use App\Models\User;

use function Livewire\Volt\{form, state};

form(UserForm::class);

state([
    'user'=> fn(User $user)=> ['user'=>$user], 
    'profileModal' => false,
    'resetModal'=> false, 
    'isDirty'=> false,
]);

$editProfile= (function(){
    $this->resetErrorBag();
    $this->form->setUser($this->user);
});

$editPassword= (function(){
    $this->resetErrorBag();
});

$updateProfile= (function(){
    dd($this->form->validateOnlyFields(['name', 'role','email', 'phone']));
});

$updatePassword=  (function(){
   dd($this->form->validateOnlyFields(['current_password', 'password', 'password_confirmation']));
});


?>


{{-- SHOW USER #DIV --}}
<div class="col-md-7 mx-auto">

    {{-- TITLE --}}
    <x-slot name="title">{{ __('Perfil de Usuário') }}</x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-primary">
            <h4 class="page-title text-center text-danger">{{ $user->name }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card py-3">
                        <div class="row">
                            <div class="col-sm-12 d-grid">
                                <div class="d-flex justify-content-center">
                                    <img class="profile-picture" src="{{ asset('images/avatar.png') }}" alt="Avatar">
                                </div>
                                <p class="text-center text-muted">
                                    <i class="fa fa-user-lock"></i>
                                    {{ $user->role }}
                                    <i class="fa fa-circle text-{{$user->online? 'success': 'danger'}}"></i>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-form-label text-primary text-center">
                                <i class="fa fa-at"></i>
                                {{ $user->email }} 

                                @if($user->phone)
                                    <span class="text-muted"> <i class="fa fa-shield" aria-hidden="true"></i> </span>
                                    <i class="fa fa-phone"></i> +244 
                                    {{ $user->phone }}  
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-3 col-sm-12 d-flex justify-content-around">
                                {{-- EDIT PROFILE #MODAL --}}
                                <div x-data="{ open: @entangle('profileModal') }">
                                    <button @click="open = true;$wire.editProfile()" class="btn btn-outline-warning btn-sm btn-rounded">
                                        {{ __('Editar Perfil') }}
                                    </button>
                                    <div class="modal fade shadow" :class="{ 'show d-block': open }" x-show="open" style="background: rgba(0,0,0,0.5)">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form wire:submit="updateProfile">
                                                    {{-- Loader --}}
                                                    <x-includes.loader target="updateProfile"/>

                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title page-title text-danger">{{ __('Editar Perfil') }}</h5>
                                                        <button type="button" class="btn btn-sm bg-danger" @click="open = false;">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body mt-2">
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
                                                            <label for="role">{{ __('Previlégio') }}</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                                                                </div>
                                                                <select id="role"  wire:model.live.blur="form.role" class="form-control @error('form.role') is-invalid @enderror" autocomplete="off">
                                                                    <option value="">-- {{__('Selecione')}} --</option>
                                                                    <option value="Operador">Operador</option>
                                                                    <option value="Administrador">Administrador</option>
                                                                </select>
                                                                @error('form.role') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">{{ __('Email') }}</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                                </div>
                                                                <input type="email" id="email"  wire:model.live.blur="form.email"  class="form-control @error('form.email') is-invalid @enderror" placeholder="Email" aria-label="Email">
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
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-rounded btn-cancel" @click="open = false;">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                                {{__('Fechar')}}
                                                        </button>
                                                        <button type="submit" class="btn btn-success btn-rounded btn-confirm">
                                                            <span class="spinner-border spinner-border-sm">
                                                                <i class="fa fa-save" aria-hidden="true"></i>
                                                            </span>
                                                            <span>{{__('Atualizar')}} </span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- RESET PASSWORD #MODAL --}}
                                <div x-data="{ open: @entangle('resetModal') }">
                                    <button type="button" @click="open = true;$wire.editPassword()" class="btn btn-outline-danger btn-sm btn-rounded">
                                        {{ __('Redefinir Senha') }}
                                    </button>
                                    <div class="modal fade shadow" :class="{ 'show d-block': open }" x-show="open" style="background: rgba(0,0,0,0.5)">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form wire:submit="updatePassword">
                                                    {{-- Loader --}}
                                                    <x-includes.loader target="updatePassword"/>

                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title page-title text-danger">{{ __('Redefinir Senha') }}</h5>
                                                        <button type="button" class="btn btn-sm bg-danger" @click="open = false;">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body mt-2">
                                                        @if($user->id === Auth::user()->id)
                                                            <div class="form-group">
                                                                <label for="current_password">{{ __('Senha actual') }}</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                                                                    </div>
                                                                    <x-includes.faker/>
                                                                    <input type="password" id="current_password" autocomplete="off"  wire:model.live.blur="form.current_password"  class="form-control @error('form.current_password') is-invalid @enderror" placeholder="Senha actual" aria-label="Senha actual" autofocus>
                                                                    @error("form.current_password") <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                        @endif
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
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-rounded" @click="open = false">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                            {{__('Fechar')}}
                                                        </button>
                                                        <button type="submit" class="btn btn-success  btn-rounded">
                                                            <i class="fa fa-save" aria-hidden="true"></i>
                                                            {{__('Atualizar')}}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center text-primary">
                                {{ __('Detalhes de Sessão') }}
                            </h5>
                        
                            @if($user->last_session)
                                <div class="row">
                                    <div class="col-sm-4 col-form-label text-right">{{ __('Última Sessão') }}:</div>
                                    <div class="col-sm-8 col-form-label text-dark">
                                        <i class="fa fa-clock"></i> 
                                        {{ $user->last_session->activity }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-form-label text-right">{{ __('Dispositivo') }}:</div>
                                    <div class="col-sm-8 col-form-label text-dark">
                                        <i class="{{$user->last_session->device_icon}}"></i> 
                                        {{ $user->last_session->device }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-form-label text-right">{{ __('Plataforma') }}:</div>
                                    <div class="col-sm-8 col-form-label text-dark">
                                        <i class="{{$user->last_session->platform_icon}}"></i> 
                                        {{ $user->last_session->platform }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-form-label text-right">{{ __('Navegador') }}:</div>
                                    <div class="col-sm-8 col-form-label text-dark">
                                        <i class="{{$user->last_session->browser_icon}}"></i> 
                                        {{ $user->last_session->browser }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-form-label text-right">{{ __('IP') }}:</div>
                                    <div class="col-sm-8 col-form-label text-dark">
                                        <i class="fa fa-location-arrow"></i> 
                                        {{ $user->last_session->ip_address }}
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-sm-12 col-form-label text-center text-muted">{{ __('Nehuma sessão registada!') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
