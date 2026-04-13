/* Bootstrap */
import './bootstrap';

/* Initialize the bootstrap components (Tooltips & Popovers) */
function initBootstrap() {
    /* Tooltips */
    const tooltips = document.querySelectorAll('[data-bs-toggle= "tooltip"]');
    tooltips.forEach(el=> new bootstrap.Tooltip(el));

    /* Popovers */
    const popovers = document.querySelectorAll('[data-bs-toggle= "popover"]');
    popovers.forEach(el=> new bootstrap.Popover(el));
}

/* Livewire/Volt Reactivity */
document.addEventListener('livewire:initialized', ()=> {initBootstrap();});
document.addEventListener('livewire:navigated', ()=> {initBootstrap();/*console.log('Template reloaded successfully!');*/});

// Global Listener from Livewire/Volt components for SweetAlert2/Animate
window.addEventListener('swal:alert', event => {
    Swal.fire({
        title: event.detail.title || 'Sucesso!',
        text: event.detail.message || 'Dados enviados com sucesso.',
        icon: event.detail.icon || 'success',
        showClass: { popup: 'animate__animated animate__fadeInDown animate__faster' },
        hideClass: { popup: 'animate__animated animate__fadeOutUp animate__faster' },
        didOpen: ()=> {
            const iconElement = document.querySelector('.swal2-icon');
            if(iconElement) 
                iconElement.classList.add('animate__animated', 'animate__bounceInDown');
        },
        confirmButtonColor: (event.detail.icon && event.detail.icon == 'error')? '#fc2d41': '#28a745',
        confirmButtonText: 'Ok'
    });
});
