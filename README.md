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

### � Infrastructure Management
- **Resource Catalogue**: Browse and manage available server racks and data center resources.
- **Maintenance Mode**: Toggle resources in and out of maintenance to prevent unauthorized bookings.

### � Reservation System
- **Booking Flow**: Streamlined reservation process for users.
- **Approval Workflow**: Admin/Responsable dashboard to approve, reject, or manage reservation requests with reason tracking.
- **History Tracking**: Complete logs of past and current reservations.

### ⚠️ Incident Reporting
- **User Alerts**: Facility for users to report technical issues immediately.
- **Resolution Management**: Management interface to track and mark incidents as resolved.

### 🔔 Smart Notifications
- **Automated Alerts**: Real-time notifications for account activation, reservation updates, and incident status.
- **Expiry Warnings**: Automated system to warn users before their reservations expire.

---

## 👥 User Roles (ACL)

- **Administrateur**: Full control, user management, and detailed system logs.
- **Responsable**: Inventory management, reservation validation, and incident resolution.
- **Utilisateur (Ingénieur)**: Resource booking, personal dashboard, and incident reporting.

---

## � Getting Started

### Prerequisites
- PHP >= 8.0
- Composer & NPM
- MySQL Server

### Installation

1. **Clone the repository**
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

5. **Run the Application**
   ```bash
   # Terminal 1: Laravel Server
   php artisan serve
   
   # Terminal 2: Asset Compiler
   npm run dev
   ```

---

## � Tech Stack

- **Backend**: Laravel 9
- **Frontend**: Blade, CSS3, JavaScript (ES6+)
- **Build Tool**: Vite
- **Database**: MySQL
- **Real-time**: Laravel Notifications

---

## 📄 Documentation
For detailed technical info, refer to the [RAPPORT_TECHNIQUE.md](file:///c:/xampp/htdocs/DataCenter_Project/RAPPORT_TECHNIQUE.md) file in the root directory.

---

## 🤝 The Team
Developed by a team of dedicated developers focused on creating efficient infrastructure management solutions.
- **EL HAJIOUI Houssam   :** Layouts & Reservation Core
- **DANY Homam           :** Admin System & Identity
- **FARSSI Fatima Zahra  :** Security & Notifications
- **EL BOURMAKI Salim    :** Resources & Content

---
*Created for the DataCenter Management Project - 2026*
