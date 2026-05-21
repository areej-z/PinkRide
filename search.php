<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Réserver un trajet
if (isset($_POST['book_trip_id'])) {
    $trip_id = $_POST['book_trip_id'];
    $pdo->prepare("INSERT INTO Bookings (user_id, trip_id) VALUES (?, ?)")->execute([$_SESSION['user_id'], $trip_id]);
    $pdo->prepare("UPDATE Trips SET seats = seats - 1 WHERE id = ?")->execute([$trip_id]);
}

// Rechercher des trajets
$trips = [];
if (isset($_POST['search'])) {
    $stmt = $pdo->prepare("SELECT * FROM Trips WHERE departure LIKE ? AND destination LIKE ? AND seats > 0");
    $stmt->execute(["%" . $_POST['departure'] . "%", "%" . $_POST['destination'] . "%"]);
    $trips = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats - PinkRide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">
                <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;">
                    <circle cx="16" cy="16" r="14" stroke="url(#pinkGradient)" stroke-width="2.5" stroke-dasharray="4 2"/>
                    <circle cx="11" cy="16" r="4" fill="url(#pinkGradient)"/>
                    <circle cx="21" cy="16" r="4" fill="url(#pinkGradient)"/>
                    <path d="M11 16H21" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
                    <defs>
                        <linearGradient id="pinkGradient" x1="0" y1="0" x2="32" y2="32" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#f472b6"/>
                            <stop offset="1" stop-color="#db2777"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span style="background: linear-gradient(135deg, #f472b6 0%, #db2777 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">PinkRide</span>
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Tableau de bord</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Déconnexion</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 anime-fade">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 p-4">
                    <h3 class="fw-bold text-center mb-4">Résultats de recherche</h3>

                    <?php if (isset($_POST['book_trip_id'])): ?>
                        <div class="alert alert-success text-center">Réservation confirmée !</div>
                    <?php endif; ?>

                    <?php if (empty($trips)): ?>
                        <div class="alert alert-warning text-center">Aucun trajet trouvé.</div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($trips as $trip): ?>
                                <div class="col-md-6 mb-3 anime-card">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary fw-bold"><?php echo htmlspecialchars($trip['departure']); ?> → <?php echo htmlspecialchars($trip['destination']); ?></h5>
                                            <p class="mb-1">📅 <?php echo htmlspecialchars($trip['date']); ?></p>
                                            <p class="mb-1">💰 <?php echo htmlspecialchars($trip['price']); ?> TND</p>
                                            <p class="mb-3">💺 <span class="badge bg-success"><?php echo htmlspecialchars($trip['seats']); ?> places</span></p>
                                            <form action="search.php" method="POST">
                                                <input type="hidden" name="book_trip_id" value="<?php echo $trip['id']; ?>">
                                                <button type="submit" class="btn btn-primary w-100">Réserver</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="text-center mt-3">
                        <a href="search.html" class="btn btn-outline-secondary">Nouvelle recherche</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script>
    anime({targets: '.anime-fade', translateY: [40, 0], opacity: [0, 1], duration: 800, easing: 'easeOutExpo'});
    anime({targets: '.anime-card', scale: [0.9, 1], opacity: [0, 1], delay: anime.stagger(150)});
    </script>
</body>
</html>
