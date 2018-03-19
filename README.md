# I@D-tchat

Auteur : [Joseph Selven](https://github.com/Darksel)

## Description

* le but est de créer un tchat, construit sur un modele MVC object maison, sans framework

## Pré-requis
* une connexion internet (pour les CDN)
* PHP5
* MySQL
* Apache/Ngnix (testé sur Apache)

## Installation
* Aller sur votre serveur et cloné le projet, faite en sorte que le index.php se trouve a la racine du dossier www/ 
* Récupérer le fichier config/i@d_tchat.sql et éxecuter le pour créer la base de donnée **i@d_tchat**
* Dans le fichier Config/connection.php informée toutes les données pour permettre la connexion à votre base de donnée

## Fonctionnalité demandé et si implémenté
* Une architecture basée sur le modèle MVC objet => **OK**
* Une page d’authentification => **OK**
* Génération automatique de comptes => **NON-OK**
* Possibilité de dialoguer avec les autres membres => **OK**
* Listing des messages archivés => **OK**
* Listing des connectés (si vous avez le temps) => **NON-OK**
* Un affichage ‘temps réel’ (si vous avez le temps) => **OK**
* Un sql pour l’installation de la BDD => **OK**
