# Site Web de Gestion du Patrimoine Personnel

## Présentation

Ce projet est une application web permettant à un utilisateur de gérer son patrimoine personnel, incluant ses **comptes bancaires** et ses **résidences**. Le site distingue deux types d’utilisateurs : **clients** et **administrateurs**, chacun ayant des droits et des fonctionnalités spécifiques.

Ce projet a été développé dans le cadre du module **LO07** en suivant le modèle **MVC (Modèle - Vue - Contrôleur)**.

---

## Fonctionnalités principales

- **Authentification** :
  - Connexion sécurisée (méthode `POST`)
  - Système d'inscription avec enregistrement des données en base
  - Vérification des identifiants avant ouverture de session
  - Réinitialisation automatique des sessions à la déconnexion et au chargement du site

- **Gestion utilisateur** :
  - Rôles séparés : client vs administrateur
  - Contrôleurs distincts pour chaque rôle

- **Gestion du patrimoine** :
  - Ajout, modification, suppression de comptes bancaires et de biens immobiliers
  - Visualisation synthétique des actifs

- **Classement** :
  - Classement des personnes les plus riches basé sur leur patrimoine

- **Persistance des données** :
  - Utilisation de MySQL pour stocker toutes les informations
  - Données conservées entre les sessions

- **Sécurité et intégrité** :
  - Vérification des soldes négatifs
  - Utilisation de sessions pour les utilisateurs connectés

---

## Architecture du projet

L’architecture suit le schéma MVC :

```
/config/             → Configuration globale (connexion BDD)
/controleurs/        → Contrôleurs séparés pour client et administrateur
/modeles/            → Un modèle par table (Personne, Compte, Résidence, etc.)
/vues/               → Interfaces HTML (formulaires, affichages, fragments réutilisables)
index.php            → Point d’entrée du site avec routeur
```

Le **Routeur 1** est utilisé pour diriger les actions vers les bons contrôleurs.

---

## Technologies utilisées

- **Langages** : PHP, HTML, CSS
- **Framework CSS** : Bootstrap
- **Base de données** : MySQL
- **Architecture** : MVC

---

## Auteurs

- **Hong Phuoc DINH**
- **Hippolyte GINESTE**
http://dev-isi.utt.fr/~ginesteh/lo07_tp/projet

> Projet réalisé dans le cadre du module LO07 _ UTT Troyes
