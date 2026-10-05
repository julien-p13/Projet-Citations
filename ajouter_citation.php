<?php
require 'config.php';
session_start();

if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], ['utilisateur', 'admin'])) {
    header("Location: index.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $citation = trim($_POST['citation']);
    $auteur = trim($_POST['auteur']);

    if (!empty($citation)) {
        $stmt = $connexion->prepare("INSERT INTO citations (texte, auteur, utilisateur_id) VALUES (?, ?, ?)");
        $stmt->execute([$citation, $auteur, $_SESSION['user_id']]);
        $message = "Citation ajoutée avec succès !";
    } else {
        $message = "Veuillez saisir une citation.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une citation</title>
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
    <?php if (!empty($message)) echo "<p class='success'>$message</p>"; ?>

    <form action="ajouter_citation.php" method="post">
        <label for="citation">Votre citation :</label><br>
        <input type="text" id="citation" name="citation" rows="4" cols="30" required><br><br>

        <label for="auteur">Auteur :</label><br>
        <input type="text" id="auteur" name="auteur" ><br><br>

        <input type="submit" value="Ajouter la citation">
    </form>
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
