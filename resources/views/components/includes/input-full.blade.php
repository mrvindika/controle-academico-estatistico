@props([
    'type' => $type?? 'text',
    'name' => $name,
    'id' => $label?? $name,
    'label' => $label?? $name,
    ])

<div class="form-group">
    <label for="{{$id}}">{{ __($label) }}</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
        </div>
        <x-includes.faker/>
        <input 
            type="{{$type}}" 
            id="{{$id}}"
            class="form-control @error("{$name}") is-invalid @enderror"
            wire:model.live.blur="{{ $name }}"   
            placeholder="{{ $label }}" autofocus>
            @error("{$name}") 
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span> 
            @enderror
    </div>
</div>