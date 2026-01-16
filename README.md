<div align="center">

# 🏢 Data Center Resource Management System
### Application Web de Réservation et de Gestion des Ressources Informatiques

![Laravel](https://img.shields.io/badge/Laravel-Framework-red)
![PHP](https://img.shields.io/badge/PHP-8.x-blue)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
![Status](https://img.shields.io/badge/Project-Academic-success)

</div>

---

## 📖 Présentation Générale

Cette application Web a pour objectif la **gestion centralisée, la réservation et le suivi des ressources informatiques d’un Data Center**.  
Elle permet une exploitation **efficace, sécurisée et transparente** des ressources à travers une plateforme multi-utilisateurs avec **rôles et permissions différenciés**.

Le projet est développé avec le **framework Laravel**, en respectant les **bonnes pratiques du génie logiciel**, notamment l’architecture **MVC**, la sécurité applicative et la traçabilité des actions.

---

## 🎯 Objectifs du Projet

- Concevoir une **base de données relationnelle normalisée**
- Implémenter un **système de réservation intelligent**
- Gérer les **rôles et permissions utilisateurs**
- Développer une interface **ergonomique et responsive**
- Mettre en place un **système de notifications et de statistiques**
- Assurer la **sécurité et la journalisation** des actions critiques

---


## 👥 Profils Utilisateurs

### 👤 Invité
- Consultation des ressources disponibles
- Accès aux règles d’utilisation
- Demande d’ouverture de compte

### 👨‍💻 Utilisateur interne (Ingénieur / Enseignant / Doctorant)
- Espace personnel sécurisé
- Recherche et filtrage des ressources
- Demande de réservation avec justification
- Suivi des statuts :
  - ⏳ En attente
  - ✅ Approuvée
  - ❌ Refusée
  - 🔄 Active
  - ✔ Terminée
- Historique des réservations
- Réception de notifications
- Signalement d’incidents techniques

### 🛠 Responsable Technique
- Gestion des ressources supervisées
- Validation ou refus des demandes
- Planification des maintenances
- Modération des échanges liés aux ressources

### 👑 Administrateur du Data Center
- Gestion des utilisateurs, rôles et permissions
- Gestion du catalogue des ressources
- Supervision globale du Data Center
- Activation / désactivation des ressources
- Consultation des statistiques globales

---

## ⚙️ Fonctionnalités Principales

### 🔧 Gestion des Ressources
- Catégories :
  - Serveurs physiques
  - Machines virtuelles
  - Stockage
  - Équipements réseau
- Fiches techniques détaillées :
  - CPU, RAM
  - Capacité et type de stockage
  - Bande passante
  - Système d’exploitation
  - État et disponibilité
  - Historique d’utilisation

### 📅 Système de Réservation
- Vérification automatique des disponibilités
- Détection des conflits de réservation
- Gestion complète du cycle de vie des demandes
- Notifications internes automatiques

### 📊 Statistiques et Tableaux de Bord
- Taux d’occupation des ressources
- Analyse d’utilisation
- Traçabilité des actions

### 🔐 Sécurité
- Authentification Laravel
- Middleware de protection
- Gestion fine des rôles et permissions
- Journalisation des actions sensibles

---

## 🛠️ Technologies Utilisées

| Domaine | Technologies |
|-------|-------------|
| Back-end | Laravel / PHP |
| Base de données | MySQL |
| Front-end | HTML, CSS personnalisé, JavaScript natif |
| Sécurité | Auth Laravel, Middleware |

> ⚠️ Sans jQuery, Bootstrap, Tailwind ou frameworks CSS externes.

---


## 📌 Statut du Projet

📘 Projet académique universitaire
Conçu pour démontrer la maîtrise du développement Web moderne, de la gestion des ressources et des architectures applicatives.

✍️ Auteurs

- DANY HOMAM / EL Hajioui Houssam / El Bourmaki Salim / Farssi Fatima Zahra
- Étudiants en Ingenieurie De Developpement D'Applications Informatiques
- Projet académique – Gestion des Ressources d’un Data Center

🏁 Conclusion

Cette application constitue une solution complète et évolutive pour la gestion des ressources d’un Data Center, intégrant les principes fondamentaux du génie logiciel, de la sécurité et de la conception orientée objet.