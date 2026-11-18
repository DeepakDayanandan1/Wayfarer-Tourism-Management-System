# Wayfarer — Tourism & Travel Management System

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-8.2%20%7C%208.3%20%7C%208.4-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/Database-MySQL%20%7C%20MariaDB-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**Wayfarer** is a modern, full-featured Tourism and Holiday Package Management web application built with **Laravel**. It provides an elegant public portal for travelers to explore and book tours, alongside a comprehensive administrative command center for travel agencies and operators.

> 📖 **Looking for Deep Technical Details?**  
> An exhaustive A-to-Z technical architecture manual, full database dictionary, request lifecycles, and security specifications can be found in [project documentation.txt](file:///c:/Projects/Wayfarer/project%20documentation.txt).

---

## 🌟 Features

### 🌍 Traveler Portal
- **Tour Packages Catalog:** Browse curated packages with high-resolution galleries, amenities, and pricing.
- **Booking Engine:** Real-time date selection with departure/return validation and instant vouchers.
- **User Dashboard:** Single-letter avatar pill, complete booking history, and self-service cancellations.
- **Inquiries & Support:** Submit custom trip requests and track support tickets with admin remarks.

### 🛡️ Admin Command Center (`/admin/`)
- **Executive Dashboard:** Live business intelligence tracking packages, bookings, inquiries, and users.
- **Package Management:** Full CRUD operations with destination tagging, pricing, and image uploads.
- **Interactive Submenu:** In-place accordion submenu (`Create` & `Manage`) with active route detection.
- **Booking Fulfillment:** Review reservations, verify dates, and confirm or cancel with audit logs.
- **Responsive Data Grids:** Horizontally scrollable tables with bounded comments and full action toolbars.
- **CMS Manager:** Update static informational pages (Terms, Privacy, About, Contact).

---

## 🛠️ Tech Stack

- **Backend:** Laravel 13.x (PHP 8.4 compatible)
- **Database:** MySQL 8.x / MariaDB (InnoDB, Eloquent ORM)
- **Frontend:** Blade Templating, Bootstrap, jQuery, Font Awesome, Animate.css / WOW.js
- **Security:** Multi-guard sessions (`web` & `admin`), CSRF protection, Bcrypt/Argon2 password hashing

---

## 🚀 Quick Start

### Prerequisites
- **PHP 8.2+** (with `pdo_mysql`, `mbstring`, `openssl`, `curl`)
- **Composer**
- **MySQL 5.7+ / MariaDB**

### Setup Instructions

1. **Clone & Install Dependencies:**
   ```bash
   git clone https://github.com/your-username/Wayfarer.git
   cd Wayfarer
   composer install
   ```

2. **Configure Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Set your database credentials in `.env`:
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tms
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. **Import Database:**
   ```bash
   mysql -u root -p tms < database/tms.sql
   ```

4. **Run the Application:**
   ```bash
   # Windows PowerShell launcher:
   .\run.ps1

   # Or standard Artisan CLI:
   php artisan serve --port=8000
   ```

5. **Open in Browser:**
   - **Public Site:** [http://127.0.0.1:8000](http://127.0.0.1:8000)
   - **Admin Portal:** [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)

---

## 🔑 Test Credentials

| Role | Username / Email | Password | Login URL |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin` *(or `test@gmail.com`)* | `pass@123` | [/admin/login](http://127.0.0.1:8000/admin/login) |
| **Traveler** | `test@gmail.com` | `Test@123` | [/login](http://127.0.0.1:8000/login) |

---

## 📚 Complete Technical Specification

For the exhaustive A-to-Z technical architecture, complete database dictionary, asset directory, routing tables, and security specification, please consult:  
👉 **[`project documentation.txt`](file:///c:/Projects/Wayfarer/project%20documentation.txt)**
