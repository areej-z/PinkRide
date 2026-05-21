<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Annuler une réservation
if (isset($_POST['cancel_booking_id'])) {
    $pdo->prepare("DELETE FROM Bookings WHERE id = ?")->execute([$_POST['cancel_booking_id']]);
    $pdo->prepare("UPDATE Trips SET seats = seats + 1 WHERE id = ?")->execute([$_POST['trip_id']]);
}

// Récupérer les réservations de l'utilisateur
$stmt = $pdo->prepare("SELECT Bookings.id as booking_id, Trips.* FROM Bookings JOIN Trips ON Bookings.trip_id = Trips.id WHERE Bookings.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$bookings = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes réservations - PinkRide</title>
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
                    <h3 class="fw-bold mb-4">🎟️ Mes réservations</h3>

                    <?php if (isset($_POST['cancel_booking_id'])): ?>
                        <div class="alert alert-success">Réservation annulée.</div>
                    <?php endif; ?>

                    <?php if (empty($bookings)): ?>
                        <div class="alert alert-info">Aucune réservation pour le moment.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Départ</th>
                                        <th>Destination</th>
                                        <th>Date</th>
                                        <th>Prix</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookings as $b): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($b['departure']); ?></td>
                                            <td><?php echo htmlspecialchars($b['destination']); ?></td>
                                            <td><?php echo htmlspecialchars($b['date']); ?></td>
                                            <td class="text-success fw-bold"><?php echo htmlspecialchars($b['price']); ?> TND</td>
                                            <td>
                                                <form action="my_bookings.php" method="POST">
                                                    <input type="hidden" name="cancel_booking_id" value="<?php echo $b['booking_id']; ?>">
                                                    <input type="hidden" name="trip_id" value="<?php echo $b['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger">Annuler</button>
                                                </form>
                                            </td>
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
