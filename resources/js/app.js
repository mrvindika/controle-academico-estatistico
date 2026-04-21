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

// Global Listener from SweetAlert2/Animate for Confirmation
window.addEventListener('swal:alert', event => {
    var btColor= (event.detail.icon && event.detail.icon == 'error')? '#fc2d41': 
            (event.detail.icon && event.detail.icon == 'info')? '#0B94F7': '#28a745';
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
        confirmButtonColor: btColor,
        confirmButtonText: 'Ok'
    });
});

// Global Listener from SweetAlert2/Animate for deletion
window.addEventListener('swal:confirm-delete', event => {
    Swal.fire({
        title: event.detail.title || 'Tens certeza?',
        text: event.detail.message || "Esta ação não pode ser revertida!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#fc2d41', 
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sim, Eliminar',
        cancelButtonText: 'Cancelar',
        showClass: { popup: 'animate__animated animate__fadeInDown animate__faster' },
        hideClass: { popup: 'animate__animated animate__fadeOutUp animate__faster' },
        didOpen: ()=> {
            const iconElement = document.querySelector('.swal2-icon');
            if(iconElement) 
                iconElement.classList.add('animate__animated', 'animate__bounceInDown');
        },
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch('deleteConfirmed', { id: event.detail.id });
        }
    });
});

