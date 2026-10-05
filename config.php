<?php
ini_set('session.cookie_lifetime', 0);
ini_set('session.gc_maxlifetime', 0);

            $serveur='mysql-r13.alwaysdata.net';
            $db='r13_projet_bdd';
            $utilisateur='r13';
            $mot_passe='Rudy2016_';
            $charset='utf8mb4';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

           $dsn = "mysql:host=$serveur; dbname=$db;charset=$charset"; 

      try {
    $connexion = new PDO($dsn, $utilisateur, $mot_passe, $options);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}     
?>