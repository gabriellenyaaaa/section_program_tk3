document.addEventListener("DOMContentLoaded", function () {

    // Area notifikasi
    var notificationArea = document.getElementById("notification-area");

    if (!notificationArea) {
        notificationArea = document.createElement("div");
        notificationArea.id = "notification-area";
        notificationArea.setAttribute("aria-live", "polite");
        notificationArea.setAttribute("aria-atomic", "false");
        document.body.appendChild(notificationArea);
    }

    // Fungsi notifikasi
    function showNotification(message, type) {
        var notification = document.createElement("div");
        notification.className =
            "custom-notification " + (type || "success");

        var text = document.createElement("p");
        text.className = "notification-message";
        text.textContent = message;

        var close = document.createElement("button");
        close.className = "notification-close";
        close.type = "button";
        close.setAttribute("aria-label", "Tutup notifikasi");
        close.textContent = "\u00d7";

        notification.appendChild(text);
        notification.appendChild(close);
        notificationArea.appendChild(notification);

        var timeout;

        function dismiss() {
            clearTimeout(timeout);
            notification.classList.add("hide");

            notification.addEventListener("animationend", function () {
                notification.remove();
            }, { once: true });
        }

        close.addEventListener("click", dismiss);

        timeout = setTimeout(dismiss, 4000);
    }


    // Animasi elemen saat masuk ke viewport
    var revealElements = document.querySelectorAll(".reveal");

    if ("IntersectionObserver" in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12
        });

        revealElements.forEach(function (element) {
            observer.observe(element);
        });
    } else {
        revealElements.forEach(function (element) {
            element.classList.add("visible");
        });
    }


    // Tombol detail Services
    document.querySelectorAll(".btn-detail").forEach(function (button) {
        button.addEventListener("click", function () {
            showNotification(
                button.getAttribute("data-detail") ||
                "Informasi layanan belum tersedia.",
                "success"
            );
        });
    });


    // Notifikasi untuk formulir kontak
    var form = document.querySelector("#contact form");

    if (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            showNotification(
                "Formulir berhasil divalidasi. Hubungkan formulir ke backend atau layanan email untuk benar-benar mengirim pesan.",
                "success"
            );
        });
    }

});

document.addEventListener("DOMContentLoaded", function () {
  const canvas = document.getElementById("skillsChart");

  if (!canvas || typeof Chart === "undefined") return;

  const ctx = canvas.getContext("2d");

  // Gradasi cokelat ke abu-abu
  const gradient = ctx.createLinearGradient(0, 0, 0, 320);
  gradient.addColorStop(0, "#3b3028");
  gradient.addColorStop(0.5, "#77685a");
  gradient.addColorStop(1, "#c8b9a7");

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: [
        "Pemrograman",
        "Gambar Elektrik",
        "PLC",
        "CAD",
        "Robotika"
      ],
      datasets: [{
        label: "Tingkat Kemampuan",
        data: [80, 90, 90, 80, 88],
        backgroundColor: gradient,
        borderRadius: 9,
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
          backgroundColor: "#29231f",
          titleColor: "#ffffff",
          bodyColor: "#ffffff",
          callbacks: {
            label: function (context) {
              return context.parsed.y + "%";
            }
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          max: 100,
          ticks: {
            stepSize: 10,
            callback: function (value) {
              return value + "%";
            },
            color: "#766f69"
          },
          grid: {
            color: "#e8e3de"
          },
          border: {
            display: false
          }
        },
        x: {
          ticks: {
            color: "#766f69",
            maxRotation: 15,
            minRotation: 0
          },
          grid: {
            display: false
          },
          border: {
            color: "#d8d1ca"
          }
        }
      }
    }
  });
});
