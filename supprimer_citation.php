<?php
require 'config.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$message = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $stmt = $connexion->prepare("DELETE FROM citations WHERE id_citation = ?");
    $stmt->execute([$_GET['id']]);
    $message = "Citation supprimée avec succès.";
}

if (isset($_POST['supprimer_toutes'])) {
    $connexion->exec("DELETE FROM citations");
    $message = "Toutes les citations ont été supprimées.";
}

$stmt = $connexion->query("SELECT id_citation, texte, auteur FROM citations");
$citations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer des citations</title>
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

<div class="container-citations">
    <h2>Gestion des citations</h2>

    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

    <?php if (count($citations) > 0): ?>
        <ul class="liste-citations">
            <?php foreach ($citations as $c): ?>
                <li>
                    <div class="citation-texte">
                        <strong><?= htmlspecialchars($c['texte']); ?></strong><br>
                    <?= htmlspecialchars($c['quelque_chose'] ?? '') ?>
                    </div>
                    <a href="supprimer_citation.php?id=<?= $c['id_citation']; ?>" class="btn-supprimer" onclick="return confirm('Supprimer cette citation ?');">Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <form method="post" onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir TOUT supprimer ?');">
            <input type="submit" name="supprimer_toutes" value="Supprimer toutes les citations" class="btn-tout-supprimer">
        </form>
    <?php else: ?>
        <p style="text-align:center;">Aucune citation enregistrée.</p>
    <?php endif; ?>

    <a href="mon_compte.php" class="btn-retour">⬅ Retour</a>
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
