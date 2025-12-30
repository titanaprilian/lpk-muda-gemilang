// This runs the code that was inside assets/js/main.js
import "./main.js";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

//  SweetAlert Configuration
import Swal from "sweetalert2";
window.Swal = Swal;

const ToastFactory = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
});

window.Toast = {
    success: (message) =>
        ToastFactory.fire({ icon: "success", title: message }),
    error: (message) => ToastFactory.fire({ icon: "error", title: message }),
    warning: (message) =>
        ToastFactory.fire({ icon: "warning", title: message }),
    info: (message) => ToastFactory.fire({ icon: "info", title: message }),
};
