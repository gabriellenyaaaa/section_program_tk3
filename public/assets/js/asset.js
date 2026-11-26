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

            formStatus.textContent = "Mengirim pesan...";

            var formData = new FormData(contactForm);
            formData.append("ajax_contact", "1");

            fetch("contact.php", {
                method: "POST",
                body: formData
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                formStatus.textContent = data.message;
                if (data.status === "success") {
                    contactForm.reset();
                }
            })
            .catch(function () {
                formStatus.textContent = "Terjadi kesalahan saat menghubungi server.";
            });
        });
    }
});
