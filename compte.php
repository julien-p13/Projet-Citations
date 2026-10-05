<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['nom']);
    $password = trim($_POST['mot_de_passe']);

    if (empty($username) || empty($password)) {
        die("Veuillez remplir tous les champs !");
    }

    $stmt = $connexion->prepare("SELECT * FROM utilisateur WHERE nom = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        $message = "Ce nom d'utilisateur existe déjà"; 
        echo htmlspecialchars($message);
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO utilisateur (nom, mot_de_passe, role)
                    VALUES (:nom, :mot_de_passe, 'utilisateur')";
            $stmt = $connexion->prepare($sql);
            $stmt->execute([
                ":nom" => $username,
                ":mot_de_passe" => $password_hash,
            ]);

            $_SESSION["success"] = "Compte créé avec succès !";
            header("Location: connexion.php");
            exit;
        } catch (PDOException $e) {
            echo "Erreur lors de la création de votre compte : " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page de connexion</title>
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
      </ul>
    </nav>
  </header>

  <div class="menu-connexion">
<form action="compte.php" method="post">
        <label for="nom">Utilisateur :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="mot_de_passe">Mot de passe :</label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <input type="submit" value="Créer le compte">
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


