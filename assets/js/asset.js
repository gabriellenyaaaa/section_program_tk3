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

    var canvas = document.getElementById("styleChart");
    if (canvas && typeof Chart !== "undefined") {
        var context = canvas.getContext("2d");
        var gradient = context.createLinearGradient(0, 0, 0, 320);
        gradient.addColorStop(0, "#368bc0");
        gradient.addColorStop(1, "#9bd8f5");

        new Chart(context, {
            type: "bar",
            data: {
                labels: ["Langit & cahaya", "Hujan", "Perjalanan", "Kenangan", "Hubungan"],
                datasets: [{
                    label: "Elemen visual",
                    data: [95, 82, 88, 90, 85],
                    backgroundColor: gradient,
                    borderRadius: 4,
                    borderSkipped: false,
                    barPercentage: 0.58,
                    categoryPercentage: 0.75
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: "#102b49",
                        callbacks: {
                            label: function (item) {
                                return item.parsed.y + "%";
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 20,
                            callback: function (value) {
                                return value + "%";
                            },
                            color: "#a5b4c3"
                        },
                        grid: {
                            color: "rgba(165, 180, 195, 0.18)"
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        ticks: {
                            color: "#a5b4c3",
                            maxRotation: 15,
                            minRotation: 0
                        },
                        grid: {
                            display: false
                        },
                        border: {
                            color: "#40556b"
                        }
                    }
                }
            }
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
