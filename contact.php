<?php
require_once __DIR__ . '/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ajax_contact'])) {
    header('Content-Type: application/json');

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name !== '' && $email !== '' && $message !== '') {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'Terima kasih! Pesan kamu berhasil dikirim dan tersimpan.'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal menyimpan pesan ke database.'
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            'status'  => 'error',
            'message' => 'Semua kolom bertanda * wajib diisi.'
        ]);
    }
    exit;
}
?>

<!-- Formulir kontak -->
<section class="contact-section section-padding" id="contact">
    <div class="container">
        <div class="section-heading contact-heading text-center">
            <p class="eyebrow">GET IN TOUCH</p>
            <h2>Let's start a <em>conversation.</em></h2>
            <p class="section-lead">Punya pertanyaan atau ingin berbagi cerita tentang karya Makoto Shinkai?
                Kirim pesan melalui formulir di bawah ini.</p>
        </div>

        <div class="contact-card row">
            <div class="col-lg-5 contact-info">
                <p class="eyebrow light">CONTACT INFORMATION</p>
                <h3>Stories are better when they're shared.</h3>
                <p>Website ini dibuat sebagai portfolio fan-made untuk tujuan edukasi dan apresiasi terhadap
                    karya Makoto Shinkai.</p>
                <div class="contact-detail"><i class="bi bi-envelope"></i><span>Gunakan formulir untuk mengirim
                        pesan</span></div>
                <div class="contact-detail"><i class="bi bi-globe2"></i><span>Makoto Shinkai Fan
                        Portfolio</span></div>
                <div class="contact-social">
                    <span>EXPLORE MORE</span>
                    <a href="https://shinkaiworks.com" target="_blank" rel="noopener noreferrer">OFFICIAL
                        WORKS <i class="bi bi-arrow-up-right"></i></a>
                </div>
            </div>

            <div class="col-lg-7 contact-form-wrap">
                <p class="form-intro">Isi detail di bawah ini untuk menyiapkan pesan. Semua kolom bertanda
                    <span>*</span> wajib diisi.
                </p>
                <form id="contactForm" class="contact-form">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="contactName">Your Name</label>
                            <input class="form-control" id="contactName" name="name" type="text"
                                placeholder="Masukkan nama kamu" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="contactEmail">Email Address</label>
                            <input class="form-control" id="contactEmail" name="email" type="email"
                                placeholder="nama@email.com" required>
                        </div>
                        <div class="col-12 form-group">
                            <label for="contactMessage">Your Message</label>
                            <textarea class="form-control" id="contactMessage" name="message" rows="5"
                                placeholder="Tuliskan pesan kamu di sini..." required></textarea>
                        </div>
                        <div class="col-12 d-flex flex-column flex-sm-row align-items-sm-center">
                            <button class="btn btn-contact-submit" type="submit">SEND MESSAGE <i
                                    class="bi bi-arrow-right"></i></button>
                            <!-- <span class="form-note">Formulir demo · Pesan tidak dikirim otomatis</span> -->
                        </div>
                        <div class="col-12">
                            <p id="formStatus" class="form-status" role="status" aria-live="polite"></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
