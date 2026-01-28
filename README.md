# 🌐 DataCenter Management System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

A comprehensive web application designed for managing resource reservations, tracking incidents, and monitoring logs within a Data Center environment. Built with **Laravel 9** and modernized with **Vite**.

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

## 👥 Core Roles

- **Admin**: Full system control (User management, system logs, full dashboard).
- **Responsable**: Resource management and reservation validation.
- **User**: Catalogue browsing and resource booking.

---

## � Getting Started

### Prerequisites
- PHP >= 8.0
- Composer
- Node.js & NPM
- MySQL

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Homam-Dany/DataCenter_Project.git
   cd DataCenter_Project
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration**
   ```bash
   php artisan migrate
   ```

5. **Run the Application**
   ```bash
   # Terminal 1
   php artisan serve
   
   # Terminal 2
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
- **Member 1**: Layouts & Reservation Core
- **Member 2**: Admin System & Identity
- **Member 3**: Security & Notifications
- **Member 4**: Resources & Content

---
*Created for the DataCenter Management Project - 2026*
