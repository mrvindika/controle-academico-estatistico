@props(['description' => $description])

<div x-data="{ open: @entangle('importModal') }">
    <button @click="open = true" class="btn btn-outline-warning btn-sm btn-rounded">
        {{ __('Importar') }}
    </button>
    <div class="modal fade shadow" :class="{ 'show d-block': open }" x-show="open" style="background: rgba(0,0,0,0.5)">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="importThis">
                    {{-- Loader --}}
                    <x-includes.loader target="importThis"/>

                    <div class="modal-header bg-primary">
                        <h5 class="modal-title page-title text-danger">{{ __($description) }}</h5>
                        <button type="button" class="btn btn-sm bg-danger" @click="open = false;">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body mt-2">
                        <div class="form-group">
                            <button type="button" wire:click="downloadTemplate" class="btn btn-outline-info btn-rounded">
                                <i class="fa fa-download"></i> {{__('Baixar Modelo')}} 
                            </button>
                        </div>
                        <div class="form-group">
                            <label for="file">{{ __('Carregar ficheiro') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label for="file" class="input-group-text text-success"><i class="fa fa-file-excel"></i></label>
                                </div>
                                <input type="file" id="file"  wire:model="file" accept=".xlsx"  class="form-control" placeholder="Nome">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded btn-cancel" @click="open = false;">
                                <i class="fa fa-times"></i>
                                {{__('Fechar')}}
                        </button>
                        <button type="submit" class="btn btn-success btn-rounded btn-confirm">
                            <label class="spinner-border spinner-border-sm">
                                <i class="fa fa-upload"></i>
                            </label>
                            <label>{{__('Importar')}} </label>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>