<?php

use App\Models\User;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Traits\AppendTrait;
use App\Exports\FailedModelExport;
use App\Exports\ModelTemplateExport;

use function Livewire\Volt\{boot, computed, on, state, uses, usesFileUploads};
uses([WithPagination::class, AppendTrait::class]); usesFileUploads();

state(['importModal' => false, 'file' => null, 'message' => '', 'fields'=> []]);
state(['search'=> ''])->url(except: '');

$users= computed(function(){ 
    $searched= "%{$this->search}%"; 

    return User::query()
        ->where('name','like', $searched)
        ->orWhere('role','like', $searched)
        ->orWhereHas('contact', function ($query) use($searched){
            $query->Where('email','like', $searched)
            ->orWhere('phone','like', $searched);    
    })->latest()->paginate(5); 
});

boot(function(){
    if(session()->has('userCreated'))
        $this->dispatch('swal:alert', 
        message: 'Usuário cadastrado com sucesso.'
    );

    $this->fields= array_keys((new UsersImport())->rules());
});

on(['deleteConfirmed' => function (int $id){
    $user= User::find($id);
    $user->delete();

    $this->dispatch('swal:alert', 
        icon: 'success', 
        title: 'Eliminado!', 
        message: 'Usuário foi eliminado com sucesso.'
    ); 
}]);

$delete= function(mixed $id){
    $user= User::find($id);

    if($user){
        $this->dispatch('swal:confirm-delete', 
            id: $id, 
            title: 'Eliminar '.$user->fullname.'?',
        );
    }
};

$downloadTemplate= fn()=> Excel::download(new ModelTemplateExport($this->fields), 'modelo_importar_usuarios.xlsx');

$importThis = function (UsersImport $importModel) {
    $imported= $this->importModel($importModel);

    if($imported){
        $this->importMessage('usuário', $imported['failures']);
        return Excel::download(new FailedModelExport($imported['data'], $this->fields), ('usuarios_a_corrigir_' .now()->format('His') .'.xlsx'));
    }
    else $this->importMessage('usuário');
};

?>

{{-- LIST USERS  #TABLE --}}
<div class="col-lg-12 mx-auto">
    
    {{-- TITLE --}}
    <x-slot name="title"> {{ __('Todos Usuários') }} </x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-primary">
            <div class="d-flex justify-content-between align-items-between">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label for="search" class="input-group-text"><i class="fa fa-search"></i></label>
                        </div>
                        <input type="search" id="search"  wire:model.live="search"  placeholder="Procurar..." class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-outline-info btn-rounded" href="{{ route('users.create') }}">
                        <i class="fas fa-plus"></i> {{__('Adicionar')}}
                    </a>
                </div>
                
                {{-- IMPORT COLLECTION OF USER #MODAL --}}
                <x-includes.import-modal description="Importar Usuários" />
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
                            <td>{{$user->contact->email}}</td>
                            <td class="text-center">{{$user->role}}</td>
                            <td class="text-center">
                                <i class="fa fa-circle text-{{$user->online? 'success': 'danger'}}"></i>
                            </td>
                            <td class="btn-group d-flex justify-content-center">
                                <a class="btn btn-outline-info  btn-sm" href="{{ route('users.show', $user->id) }}"  title="Detalhes"><i class="fas fa-eye"></i></a>
                                <button wire:click="delete({{ $user->id }})" class="btn btn-outline-danger btn-sm"  title="Eliminar"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                            <tr><td>{{__('Sem mais informações de momento')}}</td></tr>  
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            {{ $this->users->links() }}
        </div>
    </div>
</div>
