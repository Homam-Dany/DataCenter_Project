# 🌐 DC-Manager: Data Center Management System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![CSS Natif](https://img.shields.io/badge/CSS_Natif-Exclusif-blue?style=for-the-badge)
![JS Vanilla](https://img.shields.io/badge/JS_Vanilla-ES6+-yellow?style=for-the-badge)

**DC-Manager** is a high-compliance web solution for resource orchestration within a Data Center. It emphasizes a strict "No-Framework" policy for the frontend, demonstrating mastery of core web standards while providing a premium user experience.

---

## 💎 Project Identity

> [!IMPORTANT]
> This project was developed as a technical challenge with a strict **NO CSS FRAMEWORK** (no Bootstrap, no Tailwind) and **NO JQUERY** policy. Every pixel is styled with native CSS3, and every interaction is powered by Vanilla JS.

---

## ✨ Key Features

### 🏢 Infrastructure Management
- **Resource Catalogue**: Comprehensive inventory of server racks and equipment.
- **Dynamic Availability**: Impact tracking—Resource state updates automatically based on incidents.
- **Maintenance Core**: Admin-controlled maintenance toggles.

### 📅 Advanced Reservation
- **Conflict Detection**: Real-time validation to prevent overlapping bookings.
- **Decision Engine**: Multi-role approval workflow (Approve/Reject) with audit trails.
- **Reservation Lifecycle**: From initial request to automated expiry warnings.

### ⚠️ Incident Management
- **Reporting Pipeline**: Engineers can report hardware/software incidents.
- **Responsable Dashboard**: Centralized view for resolving technical debt.
- **Log System**: Full traceability of administrative actions.

---

## 👥 User Roles (ACL)

- **Administrateur**: Full control, user management, and detailed system logs.
- **Responsable**: Inventory management, reservation validation, and incident resolution.
- **Utilisateur (Ingénieur)**: Resource booking, personal dashboard, and incident reporting.

---

## 🚀 Installation & Setup

### Prerequisites
- PHP >= 8.0
- Composer & NPM
- MySQL Server

### Quick Start

1. **Clone the repo**
   ```bash
   git clone https://github.com/Homam-Dany/DataCenter_Project.git
   cd DataCenter_Project
   ```

2. **Setup Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Initialize Database**
   ```bash
   php artisan migrate
   ```

5. **Launch**
   ```bash
   # Terminal 1: Laravel Server
   php artisan serve
   
   # Terminal 2: Asset Compiler
   npm run dev
   ```

---

## 🤝 The Development Team

Distributed according to technical complexity and project modules:

- **Member 1 (35%)**: Layouts, Incident Management, and Responsable Dashboards.
- **Member 2 (35%)**: Admin Suite, System Logs, and User Identity/Profiles.
- **Member 3 (20%)**: Unified Authentication and Notification Engine.
- **Member 4 (10%)**: "A Propos" documentation and Resource Catalogue.

---

## 📄 Compliance Info
For the full compliance audit, see [RAPPORT_TECHNIQUE.md](file:///c:/xampp/htdocs/DataCenter_Project/RAPPORT_TECHNIQUE.md).

---
*Developed for Data Center Excellence - 2026*
