<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Chercher l'utilisateur par email
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Vérifier le mot de passe
    if ($user && password_verify($password, $user['password'])) {

        // Créer la SESSION
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Créer le COOKIE si "Se souvenir de moi" est coché
        if (isset($_POST['remember'])) {
            setcookie('remember_email', $email, time() + 86400 * 30, "/");
        }

        // Rediriger vers le tableau de bord
        header("Location: dashboard.php");
        exit;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
} else {
    header("Location: login.html");
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
                    <div class="alert alert-danger"><?php echo $erreur; ?></div>
                    <a href="login.html" class="btn btn-primary">Réessayer</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
