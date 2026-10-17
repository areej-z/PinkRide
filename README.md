# PinkRide - Plateforme de Covoiturage en Ligne

PinkRide est une application web de covoiturage conçue pour mettre en relation des conducteurs proposant des trajets avec des passagers recherchant un moyen de transport économique, convivial et écologique.

---

## Fonctionnalités Principales

### Pour les Conducteurs
* Publication de trajets : Saisie du point de départ, de la destination, de la date, de l'heure et du prix par place.
* Gestion des réservations : Acceptation ou refus des demandes effectuées par les passagers.
* Gestion du véhicule : Renseignement des informations sur le véhicule et le nombre de places disponibles.

### Pour les Passagers
* Recherche avancée : Filtrage des trajets disponibles par ville de départ, destination et date.
* Réservation en ligne : Réservation de places avec confirmation du trajet.
* Évaluations et avis : Consultation des retours d'expérience laissés par d'autres utilisateurs.

### Fonctionnalités Générales
* Authentification : Inscription et connexion sécurisées pour conducteurs et passagers.
* Gestion de profil : Modification des informations personnelles et historique des déplacements.
* Notifications : Suivi en temps réel du statut des réservations.

---

## Technologies Utilisées

* Front-End : HTML5, CSS3, JavaScript, Bootstrap
* Back-End : PHP / MySQL
* Base de données : MySQL
* Gestion de version : Git et GitHub

---

## Installation et Configuration Locale

1. Cloner le dépôt :
   git clone https://github.com/votre-nom-utilisateur/pinkride.git

2. Configurer le serveur local (XAMPP / WAMP) :
   * Placer le dossier du projet dans le répertoire web (htdocs ou www).
   * Démarrer les services Apache et MySQL.

3. Importer la base de données :
   * Accéder à phpMyAdmin.
   * Créer une base de données nommée pinkride_db.
   * Importer le fichier database.sql fourni à la racine du projet.

4. Lancer l'application :
   * Ouvrir le navigateur et accéder à http://localhost/pinkride.
