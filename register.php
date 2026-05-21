<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO Users (name, email, password) VALUES (?, ?, ?)");

    if ($stmt->execute([$name, $email, $password])) {
        $message = "Inscription réussie !";
        $type = "success";
        $lien = "login.html";
        $texte_lien = "Se connecter";
    } else {
        $message = "Erreur lors de l'inscription.";
        $type = "danger";
        $lien = "register.html";
        $texte_lien = "Réessayer";
    }
} else {
    header("Location: register.html");
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
                    <a href="<?php echo $lien; ?>" class="btn btn-primary"><?php echo $texte_lien; ?></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
