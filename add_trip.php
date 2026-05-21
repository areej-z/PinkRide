<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO Trips (user_id, departure, destination, date, seats, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['departure'],
        $_POST['destination'],
        $_POST['date'],
        $_POST['seats'],
        $_POST['price']
    ]);

    $message = "Trajet ajouté avec succès !";
    $type = "success";
} else {
    header("Location: add_trip.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Covoit'Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 p-4 text-center">
                    <div class="alert alert-<?php echo $type; ?>"><?php echo $message; ?></div>
                    <a href="dashboard.php" class="btn btn-primary">Retour au tableau de bord</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
