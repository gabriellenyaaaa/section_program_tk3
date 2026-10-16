// document.addEventListener("DOMContentLoaded", function () {

//     // Area notifikasi
//     var notificationArea = document.getElementById("notification-area");

//     if (!notificationArea) {
//         notificationArea = document.createElement("div");
//         notificationArea.id = "notification-area";
//         notificationArea.setAttribute("aria-live", "polite");
//         notificationArea.setAttribute("aria-atomic", "false");
//         document.body.appendChild(notificationArea);
//     }

//     // Fungsi notifikasi
//     function showNotification(message, type) {
//         var notification = document.createElement("div");
//         notification.className =
//             "custom-notification " + (type || "success");

//         var text = document.createElement("p");
//         text.className = "notification-message";
//         text.textContent = message;

//         var close = document.createElement("button");
//         close.className = "notification-close";
//         close.type = "button";
//         close.setAttribute("aria-label", "Tutup notifikasi");
//         close.textContent = "\u00d7";

//         notification.appendChild(text);
//         notification.appendChild(close);
//         notificationArea.appendChild(notification);

//         var timeout;

//         function dismiss() {
//             clearTimeout(timeout);
//             notification.classList.add("hide");

//             notification.addEventListener("animationend", function () {
//                 notification.remove();
//             }, { once: true });
//         }

//         close.addEventListener("click", dismiss);

//         timeout = setTimeout(dismiss, 4000);
//     }


//     // Animasi elemen saat masuk ke viewport
//     var revealElements = document.querySelectorAll(".reveal");

//     if ("IntersectionObserver" in window) {
//         var observer = new IntersectionObserver(function (entries) {
//             entries.forEach(function (entry) {
//                 if (entry.isIntersecting) {
//                     entry.target.classList.add("visible");
//                     observer.unobserve(entry.target);
//                 }
//             });
//         }, {
//             threshold: 0.12
//         });

//         revealElements.forEach(function (element) {
//             observer.observe(element);
//         });
//     } else {
//         revealElements.forEach(function (element) {
//             element.classList.add("visible");
//         });
//     }


//     // Tombol detail Services
//     document.querySelectorAll(".btn-detail").forEach(function (button) {
//         button.addEventListener("click", function () {
//             showNotification(
//                 button.getAttribute("data-detail") ||
//                 "Informasi layanan belum tersedia.",
//                 "success"
//             );
//         });
//     });


//     // Notifikasi untuk formulir kontak
//     var form = document.querySelector("#contact form");

//     if (form) {
//         form.addEventListener("submit", function (event) {
//             event.preventDefault();

//             if (!form.checkValidity()) {
//                 form.reportValidity();
//                 return;
//             }

//             showNotification(
//                 "Formulir berhasil divalidasi. Hubungkan formulir ke backend atau layanan email untuk benar-benar mengirim pesan.",
//                 "success"
//             );
//         });
//     }

// });