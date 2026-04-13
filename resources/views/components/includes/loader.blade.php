@props(['target' => null])

<div wire:loading.delay {{ $target? "wire:target=$target" : '' }} class="loader-overlay  d-grid align-content-center">
    <div class="loader-content">
        <div class="circle-loader small"></div>
        <h5 class="mt-3 text-white">{{ $slot->isEmpty()? __('A processar, aguarde'): $slot }}...</h5>
    </div>
</div>
