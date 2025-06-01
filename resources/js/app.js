import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import Swal from "sweetalert2";
window.Swal = Swal;
// Evento que escucha el 'swal:toast' y muestra el toast
window.addEventListener('swal:toast', event => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        background: 'white',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        },
        customClass: {
            popup: 'swal2-toast-sm',
            icon: 'swal2-icon-sm',
            title: 'swal2-title-sm',
            htmlContainer: 'swal2-html-sm'
        }
    });

    // Convertir los atributos de la notificación
    let config = Array.isArray(event.detail) ? event.detail[0] : event.detail;
    config = convertAttributes(config);

    // Mostrar el toast con la configuración
    Toast.fire(config);
});

// Función para convertir los atributos del color y la configuración
function convertAttributes(attributes) {
    switch (attributes.background) {
        case 'danger':
        case 'error':
            attributes.background = 'rgb(254, 226, 226)';
            break;
        case 'warning':
            attributes.background = 'rgb(255, 237, 213)';
            break;
        case 'primary':
        case 'info':
            attributes.background = 'rgb(207, 250, 254)';
            break;
        case 'success':
            attributes.background = 'rgb(220, 252, 231)';
            break;
    }

    if (attributes.text) {
        attributes.html = attributes.text;
        delete attributes.text;
    }
    return attributes;
}
