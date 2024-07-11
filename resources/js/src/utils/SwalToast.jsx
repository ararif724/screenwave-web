import Swal from "sweetalert2";

export const Toast = Swal.mixin({
    toast: true,
    position: "top-right",
    customClass: {
        popup: "colored-toast",
    },
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    background: "#fff",
    showCloseButton: true,
});

export const SuccessToast = (text = "I will close in 2 seconds.") =>
    Toast.fire({ text, icon: "success" });

export const ErrorToast = (
    title = "Auto close alert!",
    text = "I will close in 2 seconds."
) =>
    Toast.fire({
        title,
        text,
        color: "#ce150f",
    });
