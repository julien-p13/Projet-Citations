<?php

require 'config.php';
session_start();

$stmt = $connexion->query("SELECT texte, auteur FROM citations");
$citations = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $serveur='mysql-r13.alwaysdata.net';
            $db='r13_projet_bdd';
            $utilisateur='r13';
            $mot_passe='Rudy2016_';
            $charset='utf8mb4';

           $dsn = "mysql:host=$serveur; dbname=$db;charset=$charset"; 

      try {
   $pdo = new PDO($dsn, $utilisateur, $mot_passe);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   echo "Erreur : " . $e->getMessage();
}      
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Projet SQL</title>
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

<div class="contenu">
    <?php if (count($citations) > 0): ?>
        <?php foreach ($citations as $i => $citation): ?>
            <div class="citation <?= $i === 0 ? 'active' : '' ?>">
                <p class="texte">« <?= htmlspecialchars($citation['texte']) ?> »</p>
                <?php if (!empty($citation['auteur'])): ?>
                    <p class="auteur">par <?= htmlspecialchars($citation['auteur']) ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune citation enregistrée pour le moment.</p>
    <?php endif; ?>
</div>

<script>
// === Changement automatique du fond d’écran ===
const images = document.querySelectorAll('.background-carousel img');
let indexImg = 0;
setInterval(() => {
    images[indexImg].classList.remove('active');
    indexImg = (indexImg + 1) % images.length;
    images[indexImg].classList.add('active');
}, 5000);

// === Défilement automatique des citations ===
const citations = document.querySelectorAll('.citation');
let indexCitation = 0;

setInterval(() => {
    citations[indexCitation].classList.remove('active');
    indexCitation = (indexCitation + 1) % citations.length;
    citations[indexCitation].classList.add('active');
}, 15000); // 15 secondes
</script>

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