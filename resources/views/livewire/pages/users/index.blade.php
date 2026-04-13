<?php

use App\Models\User;

use function Livewire\Volt\{computed};

$users= computed(fn()=> User::latest()->get());

?>

{{-- LIST USERS  #TABLE --}}
<div class="col-lg-12 mx-auto">
    
    {{-- TITLE --}}
    <x-slot name="title"> {{ __('Todos Usuários') }} </x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-primary">
            <div class="d-flex justify-content-between align-items-between">
                <button class="btn btn-outline-info btn-rounded" wire:navigate href="">
                    <i class="fas fa-plus"></i> {{__('Adicionar')}}
                </button>
            </div>
            <h4 class="page-title text-center text-danger">{{ __('Lista de Usuários') }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover sortable-table-1">
                    <thead>
                        <tr class="text-center">
                            <th><i class="fas fa-hashtag"></i></th> 
                            <th>{{__('Nome')}}</th> 
                            <th>{{__('Email')}}</th> 
                            <th>{{__('Previlégio')}}</th>
                            <th>{{__('Estado')}}</th>
                            <th class="text-primary"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->users as $user)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="text-center">{{$user->role}}</td>
                            <td class="text-center">
                                <i class="fa fa-circle text-{{$user->online? 'success': 'danger'}}"></i>
                            </td>
                            <td class="btn-group d-flex justify-content-center">
                                <button wire:navigate class="btn btn-outline-info  btn-sm"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                            <tr><td>{{__('Sem mais informações de momento')}}</td></tr>  
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
