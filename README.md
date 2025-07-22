# 🚗 EcoRide – Plateforme de covoiturage

**EcoRide** est une application web PHP native (MVC) de covoiturage écoresponsable. Elle permet à des utilisateurs de proposer ou réserver des trajets, avec un système de rôles, une interface claire, des photos de profil et une base de données relationnelle complète.

---

## 🧰 Technologies utilisées

- **Langage** : PHP 8.3 (natif, sans framework)
- **Base de données** : MariaDB / MySQL
- **Frontend** : HTML5 / CSS3 / Vanilla JS (design responsive mobile-first)
- **Architecture** : MVC personnalisé
- **Sécurité** : CSRF, mots de passe hashés (bcrypt), validations

---

## 🗂️ Structure du projet

```
EcoRide/
├── controllers/       → Logique des pages
├── core/              → Router, Controller, Model de base
├── db/                → Fichier SQL (`ecoride.sql`)
├── helpers/           → Fonctions utilitaires
├── models/            → Accès BDD
├── views/             → Fichiers de vues HTML/PHP
├── public/            → CSS, JS, images
├── index.php          → Routeur frontal
└── .htaccess          → (optionnel) pour les URLs propres
```

---

## 🔐 Authentification & rôles

- **Inscription / Connexion** avec gestion CSRF
- **Mots de passe** hashés avec `password_hash`
- **Rôles** :
    - 1 : Utilisateur
    - 2 : Employé
    - 3 : Administrateur

---

## ✨ Fonctionnalités principales

### Pour les conducteurs :
- Création de trajets (lieux, dates, heures, prix, places)
- Photo de profil (BLOB)
- Lien avec un véhicule (marque, modèle, énergie)

### Pour les passagers :
- Recherche par lieu et date
- Consultation détaillée des trajets
- Infos conducteur + véhicule + notes

---

## 🔍 Recherche de trajets

- Formulaire multi-critères (lieu de ddépart, destination, date)
- Résultats dynamiques filtrés
- Lien vers la fiche détaillée du trajet

---

## 📦 Base de données

- 📁 `db/ecoride.sql` à importer via phpMyAdmin ou ligne de commande :

```bash
mysql -u root -p ecolride < db/ecoride.sql
```

---

## 🚀 Installation locale

1. Cloner le dépôt :
```bash
git clone https://github.com/Alxndr06/EcoRide.git
```

2. Lancer XAMPP / WAMP

3. Copier le projet dans `htdocs/` ou `www/`

4. Importer `ecoride.sql` dans phpMyAdmin

5. Accéder à :
```
http://localhost/EcoRide/
```

---

## ✅ TODO

- [x] Création et recherche de trajets
- [x] Authentification avec rôles
- [x] Affichage responsive en cartes
- [ ] Réservation des places avec crédits
- [ ] Panneaux employés / administrateurs

---

## 👨‍💻 Auteur

**Alexander Aulong**  
Policier de métier – Développeur web en devenir  
GitHub : [Alxndr06](https://github.com/Alxndr06)

---

## 📝 Licence

Projet libre pour usage pédagogique.
