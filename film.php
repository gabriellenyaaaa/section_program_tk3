<?php
require __DIR__ . '/connect.php';

$sql = "SELECT * FROM films ORDER BY film_number ASC";
$result = $conn->query($sql);
?>

<!-- Filmography: urutan kartu mengikuti data dari tabel database -->
<section class="section-padding films-section" id="films">
    <div class="container">
        <div class="section-heading d-flex flex-column flex-md-row justify-content-between align-items-md-end">
            <div>
                <p class="eyebrow">SELECTED FILMOGRAPHY</p>
                <h2>Stories that<br><em>stay with us.</em></h2>
            </div>
        </div>

        <div class="row film-grid">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="film-card">
                            <div class="film-poster">
                                <img src="<?= htmlspecialchars($row['poster_path']) ?>" 
                                     alt="Poster film <?= htmlspecialchars($row['title']) ?>">
                                <span class="film-number"><?= htmlspecialchars($row['film_number']) ?></span>
                            </div>
                            <div class="film-info">
                                <div class="film-meta">
                                    <span><?= htmlspecialchars($row['release_year']) ?></span>
                                    <span><?= htmlspecialchars($row['genre']) ?></span>
                                </div>
                                <h3><?= htmlspecialchars($row['title']) ?></h3>
                                <p><?= htmlspecialchars($row['description']) ?></p>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No films found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>