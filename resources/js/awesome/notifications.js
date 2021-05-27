window.swal = require("sweetalert2");

function firemsgSuccess(message) {
    swal.fire({
        title: message,
        icon: "success",
    });
}
window.firemsgSuccess = firemsgSuccess;

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
