<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Récupérer les trajets de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT * FROM Trips WHERE user_id = ? ORDER BY date DESC");
$stmt->execute([$_SESSION['user_id']]);
$trips = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes trajets - PinkRide</title>
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
            <div class="col-md-10">
                <div class="card shadow border-0 p-4">
                    <h3 class="fw-bold mb-4">📋 Mes trajets proposés</h3>

                    <?php if (empty($trips)): ?>
                        <div class="alert alert-info">Vous n'avez proposé aucun trajet.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Départ</th>
                                        <th>Destination</th>
                                        <th>Date</th>
                                        <th>Prix</th>
                                        <th>Places</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($trips as $trip): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($trip['departure']); ?></td>
                                            <td><?php echo htmlspecialchars($trip['destination']); ?></td>
                                            <td><?php echo htmlspecialchars($trip['date']); ?></td>
                                            <td class="text-success fw-bold"><?php echo htmlspecialchars($trip['price']); ?> TND</td>
                                            <td><span class="badge bg-primary"><?php echo htmlspecialchars($trip['seats']); ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                    <a href="dashboard.php" class="btn btn-outline-secondary mt-3">Retour</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script>
    anime({targets: '.anime-fade', translateY: [40, 0], opacity: [0, 1], duration: 800, easing: 'easeOutExpo'});
    anime({targets: 'tbody tr', translateX: [-30, 0], opacity: [0, 1], delay: anime.stagger(100)});
    </script>
</body>
</html>
