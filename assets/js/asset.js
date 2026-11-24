document.addEventListener("DOMContentLoaded", function () {
    var menuButton = document.querySelector(".navbar-toggler");
    var menu = document.getElementById("mainNav");

    if (menuButton && menu) {
        menuButton.addEventListener("click", function () {
            var isOpen = menu.classList.toggle("show");
            menuButton.setAttribute("aria-expanded", isOpen);
        });

        menu.querySelectorAll(".nav-link, .nav-cta").forEach(function (link) {
            link.addEventListener("click", function () {
                menu.classList.remove("show");
                menuButton.setAttribute("aria-expanded", "false");
            });
        });
    }

    var contactForm = document.getElementById("contactForm");
    var formStatus = document.getElementById("formStatus");

    if (contactForm && formStatus) {
        contactForm.addEventListener("submit", function (event) {
            event.preventDefault();

            if (!contactForm.checkValidity()) {
                contactForm.reportValidity();
                return;
            }

            formStatus.textContent = "Formulir tervalidasi. Untuk mengirim pesan, hubungkan formulir ke layanan email atau backend.";
        });
    }
});
