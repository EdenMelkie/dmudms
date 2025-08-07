
# 🏠 Dormitory Management System

<div align="center">
  <img src="https://via.placeholder.com/800x400?text=Dormitory+Management+System" alt="System Banner" width="100%">
  <br><br>
  
  <p>
    <em>A modern web solution bringing harmony and efficiency to dormitory life</em>
  </p>
  
  <p>
    <a href="#overview">Overview</a> •
    <a href="#features">Features</a> •
    <a href="#technologies">Tech Stack</a> •
    <a href="#installation">Installation</a> •
    <a href="#contribution">Contribution</a> •
    <a href="#license">License</a>
  </p>
  
  <div>
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind">
    <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  </div>
</div>

---

## ✨ <span id="overview">Overview</span>

Welcome to the **Dormitory Management System** — a comprehensive digital solution designed to transform dormitory administration into a seamless, efficient, and transparent process. 

🔹 **For Administrators**: Complete control over room allocation, proctor assignments, and student management  
🔹 **For Students**: Transparent room assignment and dormitory life management  
🔹 **For Staff**: Simplified workflows for daily operations  

Built with modern web technologies, this system combines the robustness of **Laravel** with the elegance of **Tailwind CSS**, delivering both power and beauty.

---

## 🌟 <span id="features">Key Features</span>

### 🛏️ Room Management
- Real-time room status tracking (Available/Occupied/Under Maintenance)
- Floor-wise and block-wise organization
- Capacity management with visual indicators

### 👥 Student Placement
- Intelligent room allocation algorithms
- Special needs accommodation
- Room transfer and swap functionality

### 👮 Proctor System
- Aprove Requests
- Incident reporting
- Communication tools

### 🔍 Powerful Search & Filters
- Instant student lookup
- Room availability filters
- Material Registration and print exit paper

### 🔐 Secure Access Control
- Role-based permissions (Admin, Proctor, Student)
- Activity audit logs

### 📱 Responsive Design
- Fully functional on all devices
- Accessible interface

---

## 🛠️ <span id="technologies">Technology Stack</span>

<table>
  <tr>
    <td align="center" width="96">
      <img src="https://laravel.com/img/logomark.min.svg" width="48" alt="Laravel">
      <br>Laravel
    </td>
    <td align="center" width="96">
      <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" width="48" alt="PHP">
      <br>PHP
    </td>
    <td align="center" width="96">
      <img src="https://tailwindcss.com/_next/static/media/tailwindcss-mark.3c5441fc7a190fb1800d4a5c7f07ba4b1345a9c8.svg" width="48" alt="Tailwind">
      <br>Tailwind
    </td>
    <td align="center" width="96">
      <img src="https://vitejs.dev/logo.svg" width="48" alt="Vite">
      <br>Vite
    </td>
  </tr>
  <tr>
    <td align="center" width="96">
      <img src="https://www.mysql.com/common/logos/logo-mysql-170x115.png" width="48" alt="MySQL">
      <br>MySQL
    </td>
    <td align="center" width="96">
      <img src="https://git-scm.com/images/logos/downloads/Git-Icon-1788C.png" width="48" alt="Git">
      <br>Git
    </td>
    <td align="center" width="96">
      <img src="https://upload.wikimedia.org/wikipedia/commons/d/db/Npm-logo.svg" width="48" alt="npm">
      <br>npm
    </td>
    <td align="center" width="96">
      <img src="https://nodejs.org/static/images/logo.svg" width="48" alt="Node.js">
      <br>Node.js
    </td>
  </tr>
</table>

---

## 🚀 <span id="installation">Getting Started</span>

### Prerequisites

- PHP ≥ 8.1
- Composer 2.x
- Node.js 16+
- MySQL 5.7+ or MariaDB 10.3+

### Installation Guide

```bash
# Clone the repository
git clone https://github.com/EdenMelkie/dmudms.git
cd dormitory-management

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Build assets
npm run build

# Configure environment
cp .env.example .env
php artisan key:generate

# Set up database (edit .env first)
php artisan migrate --seed

# Start development server
php artisan serve

# First-Time Setup
----------------
- Access the system at http://localhost:8000
- Login with default admin credentials (check .env or seeders)
- Configure your institution settings
- Import student data or add manually

# Contribution
------------
 We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create your feature branch:
   git checkout -b feature/AmazingFeature
3. Commit your changes:
   git commit -m 'Add some AmazingFeature'
4. Push to the branch:
   git push origin feature/AmazingFeature
5. Open a Pull Request

# License
--------
This project is licensed under the MIT License - see the LICENSE.md file for details. ውሸት

🌿 Where Technology Meets Community Living
-----------------------------------------
This system represents our commitment to creating better living spaces through technology.
