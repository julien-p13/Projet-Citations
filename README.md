# Projet SQL

## Description

**Projet SQL** est un site web développé dans le cadre d’un projet scolaire.  
Il permet la gestion de comptes utilisateurs avec différents niveaux de permissions et l’ajout/gestion de citations.  

### Objectifs principaux

- Permettre aux visiteurs de consulter les citations.  
- Permettre aux membres de créer un compte et de se connecter.  
- Permettre aux membres de **ajouter leurs propres citations**.  
- Permettre aux admins de **gérer toutes les citations et utilisateurs**.  
- Sécuriser la connexion avec un **hachage des mots de passe** et une limite de **3 tentatives de connexion**.  
- Déconnexion automatique à la fermeture du navigateur.  

---

## Fonctionnalités

| Fonctionnalité | Description | Rôle concerné |
|----------------|------------|---------------|
| Création de compte | Les visiteurs peuvent créer un compte avec un nom d’utilisateur et un mot de passe | Visiteur |
| Connexion | Connexion sécurisée avec limitation de 3 tentatives | Tous |
| Gestion des citations | Ajouter des citations | Membres |
| Gestion des citations | Ajouter et supprimer des citations | Admins
| Gestion des utilisateurs | Accès complet à toutes les citations et aux utilisateurs | Admin uniquement |
| Consultation | Consulter les citations | Tous (y compris visiteurs non connectés) |
| Déconnexion | Bouton de déconnexion et fermeture automatique de session à la fermeture du navigateur | Tous |

---

## Technologies utilisées

- **Backend :** PHP 8.2  
- **Base de données :** MySQL  
- **Frontend :** HTML, CSS  
- **Sécurité :** Hachage des mots de passe avec `password_hash()` et `password_verify()`  
- **Gestion des sessions :** Limite de connexion, expiration à la fermeture du navigateur  
