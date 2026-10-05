<?php
require 'config.php';
session_start();


$message = '';

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = 0;
}

$blocked = false;
if ($_SESSION['login_attempts'] >= 3) {
    $temps_ecoule = time() - $_SESSION['last_attempt_time'];
    if ($temps_ecoule < 60) {
        $blocked = true;
        $message = "Trop de tentatives. Réessayez dans " . (60 - $temps_ecoule) . " secondes.";
    } else {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_attempt_time'] = 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$blocked) {
    $username = trim($_POST['nom']);
    $password = trim($_POST['mot_de_passe']);

    if (empty($username) || empty($password)) {
        $message = "Veuillez remplir tous les champs !";
    } else {
        $stmt = $connexion->prepare("SELECT * FROM utilisateur WHERE nom = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['mot_de_passe'])) {
                $_SESSION['login_attempts'] = 0;
                $_SESSION['last_attempt_time'] = 0;

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['nom'];
                $_SESSION['role'] = $user['role'];

                header("Location: index.php");
                exit;
            } else {
                $_SESSION['login_attempts']++;
                $_SESSION['last_attempt_time'] = time();

                $tentatives_restantes = max(0, 3 - $_SESSION['login_attempts']);
                if ($tentatives_restantes > 0) {
                    $message = "Mot de passe incorrect ! Il vous reste $tentatives_restantes tentative(s).";
                } else {
                    $message = "Trop de tentatives ! Vous êtes bloqué pendant 1 minute.";
                }
            }
        } else {
            $message = "Nom d'utilisateur inexistant !";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="background-carousel">
    <img src="medias/foret.webp" class="active">
    <img src="medias/mer.png">
    <img src="medias/montagne.jpg">
    <img src="medias/neige.jpg">
    <img src="medias/sable.jpg">

</div>

<header>
    <nav>
      <ul class="menu">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="compte.php">Créer un compte</a></li>
        <li><a href="mon_compte.php">Mon compte</a></li>
      </ul>
    </nav>

   
</header>

<div class="menu-connexion">
    <?php if (!empty($message)): ?>
        <p class="error"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION['username']) && !$blocked): ?>
        <form action="connexion.php" method="post">
            <label for="nom">Utilisateur :</label><br>
            <input type="text" id="nom" name="nom" required><br><br>

            <label for="mot_de_passe">Mot de passe :</label><br>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

            <input type="submit" value="Connexion">
        </form>
    <?php elseif ($blocked): ?>
        <p>⏳ Vous êtes temporairement bloqué. Veuillez patienter avant de réessayer.</p>
    <?php else: ?>
        <p>Vous êtes déjà connecté.</p>
    <?php endif; ?>
</div>

</body>

<script>
    const images = document.querySelectorAll('.background-carousel img');
    let index = 0;

    setInterval(() => {
      images[index].classList.remove('active');
      index = (index + 1) % images.length;
      images[index].classList.add('active');
    }, 5000); 
  </script>
  
</html>
