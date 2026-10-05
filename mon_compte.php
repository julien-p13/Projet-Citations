<?php
require 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon compte</title>
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
            <li><a href="mon_compte.php">Mon compte</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
</header>

<div class="menu-connexion">
    <h2>Voici les informations de votre compte:</h2>
    <br>
    <p><strong>Nom d'utilisateur :</strong> <?= htmlspecialchars($_SESSION['username']); ?></p>
    <p><strong>Rôle :</strong> <?= htmlspecialchars($_SESSION['role']); ?></p>
    <br>

    <?php if ($_SESSION['role'] === 'utilisateur' || $_SESSION['role'] === 'admin'): ?>
        <a href="ajouter_citation.php" class="btn">Ajouter une citation</a>
    <?php endif; ?>
    <br></br>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="supprimer_citation.php" class="btn">Supprimer une citation</a>
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
