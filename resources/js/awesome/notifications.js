window.swal = require("sweetalert2");

function firemsgSuccess(message) {
    swal.fire({
        title: message,
        icon: "success",
    });
}
window.firemsgSuccess = firemsgSuccess;

function fireMessageAndRedirect(message,url) {
    swal.fire({
        position: 'top-end',
        icon: 'success',
        title: message,
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        /* Despues de completar el mensaje */
        console.log('Despues del mensaje');
        window.location.href = url;
    });
}
window.fireMessageAndRedirect = fireMessageAndRedirect;

const Toast = swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", swal.stopTimer);
        toast.addEventListener("mouseleave", swal.resumeTimer);
    },
});
window.Toast = Toast;

function fireModal(message, text, image) {
    swal.fire({
        title: '<h2 class="text-eat-pink-500">' + message + "</h2>",
        text: text,
        imageUrl: image,
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Custom image",
    });
}
window.fireModal = fireModal;

function confirmAction(toemit, key) {
    swal.fire({
        title: "¡Confirma!",
        text: "¿Deseas eliminar el elemento?",
        position: "top-end",
        padding: ".7rem",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Sí",
        cancelButtonText: "No",
        customClass: {
            header: "text-base items-start pl-2 text-left font-semibold text-eat-olive-700",
            content: "text-xs pl-2 text-eat-olive-300",
            confirmButton:
                "btn w-1/3 bg-eat-olive-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-eat-olive-700 active:bg-eat-olive-900 focus:outline-none focus:border-eat-olive-900 focus:ring ring-eat-olive-300 disabled:opacity-25 transition ease-in-out duration-150 px-4 py-3 mr-4",
            cancelButton:
                "btn w-1/3 bg-eat-fuccia-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-eat-fuccia-700 active:bg-eat-fuccia-900 focus:outline-none focus:border-eat-fuccia-900 focus:ring ring-eat-fuccia-300 disabled:opacity-25 transition ease-in-out duration-150 px-4 py-3",
        },
    }).then((result) => {
        if (result.isConfirmed) {
            console.log(toemit);
            console.log(key);
            Livewire.emit(toemit, key);
        }
    });
}
window.confirmAction = confirmAction;

function StayOrLeave(message, text, url) {
    swal.fire({
        title: message,
        text: text,
        position: "top-end",
        padding: ".7rem",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Agregar otro",
        cancelButtonText: "Menú anterior",
        customClass: {
            header: "text-base items-start pl-2 text-left font-semibold text-eat-olive-700",
            content: "text-xs pl-2 text-eat-olive-300",
            confirmButton:
                "btn w-1/3 bg-eat-olive-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-eat-olive-700 active:bg-eat-olive-900 focus:outline-none focus:border-eat-olive-900 focus:ring ring-eat-olive-300 disabled:opacity-25 transition ease-in-out duration-150 px-4 py-3 mr-4",
            cancelButton:
                "btn w-1/4 bg-eat-fuccia-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-eat-fuccia-700 active:bg-eat-fuccia-900 focus:outline-none focus:border-eat-fuccia-900 focus:ring ring-eat-fuccia-300 disabled:opacity-25 transition ease-in-out duration-150 px-4 py-3",
        },
    }).then((result) => {
        if (result.isDismissed) {
            console.log('Despues del mensaje');
            window.location.href = url;
        }
    });
}
window.StayOrLeave = StayOrLeave;
