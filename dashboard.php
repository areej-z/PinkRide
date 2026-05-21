<?php
require 'config.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - PinkRide</title>
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
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Déconnexion</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 anime-fade">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 p-4 text-center">
                    <h2 class="fw-bold mb-4">Bienvenue, <span class="text-primary"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span></h2>

                    <div class="row mt-3">
                        <div class="col-sm-6 mb-3">
                            <a href="add_trip.html" class="btn btn-outline-primary w-100 p-3 fw-bold">🚗 Ajouter un trajet</a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="search.html" class="btn btn-outline-success w-100 p-3 fw-bold">🔍 Rechercher un trajet</a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="my_trips.php" class="btn btn-outline-info w-100 p-3 fw-bold">📋 Mes trajets</a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="my_bookings.php" class="btn btn-outline-warning w-100 p-3 fw-bold">🎟️ Mes réservations</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script>
    anime({targets: '.anime-fade', translateY: [40, 0], opacity: [0, 1], duration: 800, easing: 'easeOutExpo'});
    anime({targets: '.btn', scale: [0.9, 1], opacity: [0, 1], delay: anime.stagger(100, {start: 300})});
    </script>
</body>
</html>
