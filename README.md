# Wayfarer — Modern Tourism & Travel Management System

[![Laravel Version](https://img.shields.io/badge/Laravel-11%20%7C%2012%20%7C%2013-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%20%7C%208.3%20%7C%208.4-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/Database-MySQL%20%7C%20MariaDB-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Frontend](https://img.shields.io/badge/Frontend-Blade%20%7C%20Bootstrap%20%7C%20jQuery-563D7C?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**Wayfarer** is a full-featured, enterprise-grade Tourism and Holiday Package Management web application built with **Laravel**. Designed for travel agencies, tour operators, and holiday travelers, Wayfarer provides an elegant public portal for exploring destinations and booking expeditions, alongside a powerful, real-time administrative command center.

> 📚 **Complete A-to-Z Technical Documentation Available:**  
> For an exhaustive, deep-dive architectural reference covering all technical layers, system domain, complete asset inventory, request lifecycles, database dictionaries, security models, and deployment guides, please see [project documentation.txt](file:///c:/Projects/Wayfarer/project%20documentation.txt).

---

## 🌟 Key Highlights & Features

### 🌍 Traveler Portal (Public & Authenticated)
- **Curated Package Catalog:** Browse holiday packages categorized by travel style (Family, Couples, Adventure), destinations, pricing, amenities, and high-resolution photo galleries.
- **Dynamic Booking Engine:** Real-time date selection with departure and return validation, custom guest notes, and instant booking confirmations.
- **Traveler Account & Profile Center:**
  - Fast registration and secure authentication with real-time email availability validation.
  - Personalized navigation with initial avatar badges displaying the traveler's initial.
  - Complete profile management and credential updates.
- **Tour Booking History:** Review pending, confirmed, and past reservations with self-service cancellation and audit timestamps.
- **Customer Support & Issue Ticketing:** Raise support tickets against reservations or travel questions and track administrative remarks.
- **Inquiry Management:** Dedicated inquiry submission form for customized holiday packages.

### 🛡️ Administrative Command Center (`/admin/`)
- **Executive KPI Dashboard:** Real-time business intelligence tracking total travelers, active packages, customer inquiries (new vs. read), and booking statuses (confirmed, pending, cancelled).
- **Tour Package Management:** Comprehensive CRUD operations for packages, featuring image uploads, destination tagging, pricing, and feature highlights.
- **Interactive Navigation Submenu:** In-place accordion submenu for **Tour Packages** (`Create` & `Manage`) with active route detection and collapsed sidebar flyout support.
- **Booking Fulfillment & Actions:** Review reservations, verify travel dates, and confirm or cancel bookings with automated audit logs.
- **Responsive Data Grids:** Horizontally scrollable tables with custom scrollbars and contained comment boxes preventing layout shifts.
- **Traveler Directory:** Searchable customer directory with drill-down views into individual traveler booking histories.
- **Support Ticket Resolution:** Review customer issues and submit administrative resolution remarks in dedicated dialogs.
- **Content Management System (CMS):** In-browser management for static informational pages (Terms of Use, Privacy Policy, About Us, Contact Us).

---

## 💻 Tech Stack & Architecture

| Layer | Technologies & Tools |
| :--- | :--- |
| **Framework** | **Laravel 13.x** (PHP 8.4+ compatible) |
| **Architecture** | **MVC (Model-View-Controller)** pattern with modular Controllers, Eloquent Models, Middleware, and Blade Views |
| **Database & ORM** | **MySQL 8.x / MariaDB** with **Laravel Eloquent ORM** relationships and query optimization |
| **Authentication** | Multi-guard authentication architecture (`web` for travelers, `admin` for administrators) |
| **Password Security** | Bcrypt (rounds: 12) & Argon2 hashing with multi-algorithm verification |
| **Frontend Engine** | **Blade Templating Engine** with reusable components (`header`, `footer`, `navbar`, `sidebar`, `signin`, `signup`) |
| **Styling & Assets** | Bootstrap, Font Awesome 4.7 & 6, WOW.js animations, custom CSS Grid layouts |
| **Build & Tooling** | Composer, Artisan CLI, PowerShell automation (`run.ps1`) |

---

## 📂 Project Directory Structure

```plaintext
Wayfarer/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AuthController.php        # Admin login, logout, password recovery
│   │   │   │   ├── BookingController.php     # Booking fulfillment, confirmation, cancellation
│   │   │   │   ├── DashboardController.php   # Real-time metrics & KPI summary cards
│   │   │   │   ├── EnquiryController.php     # Customer inquiry review & status
│   │   │   │   ├── IssueController.php       # Support ticket queue & remarks
│   │   │   │   ├── PackageController.php     # Tour packages CRUD & image processing
│   │   │   │   ├── PageController.php        # CMS static pages management
│   │   │   │   ├── ProfileController.php     # Admin profile & security settings
│   │   │   │   └── UserController.php        # Customer directory & booking audits
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php       # Traveler authentication & session management
│   │   │   │   ├── PasswordController.php    # Traveler password recovery
│   │   │   │   └── RegisterController.php    # Traveler account registration
│   │   │   ├── BookingController.php         # Public booking submission & tour history
│   │   │   ├── EnquiryController.php         # Public travel inquiries
│   │   │   ├── HomeController.php            # Homepage with featured packages
│   │   │   ├── IssueController.php           # Traveler support tickets
│   │   │   ├── PageController.php            # Public CMS page views
│   │   │   ├── ProfileController.php         # Traveler profile & password management
│   │   │   └── TourPackageController.php     # Package catalog & detail views
│   │   └── Middleware/
│   │       ├── AuthenticateAdmin.php         # Admin authentication guard
│   │       └── RedirectIfAdmin.php           # Admin guest redirection
│   └── Models/
│       ├── Admin.php                         # Administrator authenticatable model
│       ├── Booking.php                       # Tour reservation model & relationships
│       ├── Enquiry.php                       # Travel inquiry model
│       ├── Issue.php                         # Support ticket model & relationships
│       ├── Page.php                          # CMS content page model
│       ├── TourPackage.php                   # Tour package catalog model
│       └── User.php                          # Traveler authenticatable model & relationships
├── bootstrap/
│   ├── app.php                               # Application configuration & middleware bindings
│   └── providers.php                         # Service providers registry
├── config/
│   ├── auth.php                              # Multi-guard authentication configuration
│   ├── database.php                          # Database connection settings
│   └── hashing.php                           # Hashing driver & algorithm options
├── database/
│   ├── migrations/                           # Database schema migrations
│   └── tms.sql                               # Database schema & sample seed data
├── public/
│   ├── admin/                                # Admin CSS, JS, fonts, and assets
│   ├── css/                                  # Public stylesheets (style.css, bootstrap.css, animate.css)
│   ├── fonts/                                # Font Awesome & Glyphicon icon fonts
│   ├── images/                               # Hero banners and background assets
│   ├── js/                                   # Public JavaScript libraries
│   ├── pacakgeimages/                        # Holiday package photo gallery storage
│   └── index.php                             # Front controller
├── resources/
│   └── views/
│       ├── admin/                            # Admin Blade templates (dashboard, packages, bookings, etc.)
│       ├── auth/                             # Authentication views (login, register, forgot-password)
│       ├── bookings/                         # Booking management views (history, thankyou)
│       ├── components/                       # Reusable Blade components (header, footer, sidebar, modals)
│       ├── enquiries/                        # Inquiry submission views
│       ├── issues/                           # Customer support ticket views
│       ├── layouts/                          # Master layouts (app.blade.php, admin.blade.php)
│       ├── packages/                         # Tour package catalog & show views
│       ├── pages/                            # Dynamic CMS content views
│       └── profile/                          # User profile & credential views
├── routes/
│   ├── console.php                           # Artisan console commands
│   └── web.php                               # Web route definitions (Public, Auth, Admin)
├── .env                                      # Environment configuration file
├── artisan                                   # Laravel Artisan CLI
├── composer.json                             # Composer dependencies & metadata
├── project documentation.txt                 # Exhaustive A-to-Z technical architecture & specs
└── run.ps1                                   # PowerShell quick-start launcher script
```

---

## 📖 Complete Technical Documentation (A to Z)

An exhaustive, in-depth technical manual is provided in [`project documentation.txt`](file:///c:/Projects/Wayfarer/project%20documentation.txt). It includes:

1. **System Domain & Personas:** Detailed breakdown of traveler vs. administrative operational roles.
2. **Complete Technology Stack Inventory:** Exact versions, PHP extensions, Laravel ecosystem components, and database requirements.
3. **Frontend & Asset Directory:** In-depth breakdown of Bootstrap 3/5 components, jQuery plugins, FontAwesome, and custom styling.
4. **MVC Architecture & Request Lifecycle:** Step-by-step tracing from entry point (`public/index.php`) through HTTP Kernels, middleware pipelines, route dispatchers, controllers, Eloquent models, and Blade view rendering.
5. **Database Schema & Data Dictionary:** Comprehensive column-by-column breakdown of all 7 relational tables, primary/foreign key mappings, and Eloquent relationships.
6. **Module-by-Module Functional Deep Dive:**
   - Traveler Authentication & Single-Character Initial Avatar Badges
   - Tour Package Catalog, Gallery, & Booking Validation Engine
   - Traveler Booking History & Self-Service Cancellation Auditing
   - Customer Support & Ticketing Lifecycle
   - Lead Inquiries & Traveler Engagement
   - Real-Time Executive KPI Dashboard
   - Tour Package CRUD & Interactive Submenu (`Create` / `Manage`)
   - Booking Fulfillment & Responsive Data Grids
   - Traveler Directory & Drill-Down Audits
   - In-Browser Static Content Management (CMS)
7. **Complete Routing & Middleware Directory:** Method, URI, name, controller action, and middleware list for every endpoint.
8. **Security & Hardening:** Multi-guard session separation, CSRF protection, SQL injection prevention, XSS escaping, and multi-tier cryptographic password hashing (Bcrypt & Argon2).
9. **File-by-File Codebase Map:** Comprehensive index of application files and their purposes.
10. **Local Setup & PowerShell Automation:** Step-by-step developer setup and `run.ps1` execution.
11. **System Test Credentials & Quick Reference Guide.**

---

## 🚀 Quick Start Guide

### Prerequisites
1. **PHP 8.2 or newer** installed and available in your `PATH` (with `pdo_mysql`, `mbstring`, `openssl`, `curl` extensions enabled).
2. **Composer** installed globally.
3. **MySQL Server 5.7+ or MariaDB 10.4+** (running on `127.0.0.1:3306`).

---

### Installation & Setup

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-username/Wayfarer.git
   cd Wayfarer
   ```

2. **Install Composer Dependencies:**
   ```bash
   composer install
   ```

3. **Configure Environment:**
   Copy `.env.example` to `.env` (if not already present):
   ```bash
   cp .env.example .env
   ```
   Set your local database credentials in `.env`:
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tms
   DB_USERNAME=root
   DB_PASSWORD=your_mysql_password
   ```

4. **Initialize Database:**
   Create the database in MySQL:
   ```sql
   CREATE DATABASE tms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
   Import the schema and initial seed data:
   ```bash
   mysql -u root -p tms < database/tms.sql
   ```

5. **Generate Application Encryption Key:**
   ```bash
   php artisan key:generate
   ```

6. **Start the Development Server:**
   Using the included PowerShell script (Windows):
   ```powershell
   .\run.ps1
   ```
   Or using the standard Artisan CLI:
   ```bash
   php artisan serve --host=127.0.0.1 --port=8000
   ```

7. **Access the Portals:**
   - **Public Website:** [http://127.0.0.1:8000](http://127.0.0.1:8000)
   - **Admin Portal:** [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)

---

## 🔑 Default Test Credentials

Pre-configured sample accounts are available for testing:

| Role | Username / Email | Password | Portal URL |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin` *(or `test@gmail.com`)* | `pass@123` | [Admin Login](/admin/login) |
| **Traveler** | `test@gmail.com` | `Test@123` | [Traveler Sign In](/login) |

---

## 🗄️ Database Schema & Eloquent Mapping

The database (`tms`) architecture comprises 7 relational entities mapped to Eloquent models:

| Table Name | Eloquent Model | Primary Key | Description |
| :--- | :--- | :--- | :--- |
| **`admin`** | `App\Models\Admin` | `id` | Administrator credentials, contact info, and role permissions |
| **`tblusers`** | `App\Models\User` | `id` | Registered travelers (FullName, MobileNumber, EmailId, Password) |
| **`tbltourpackages`** | `App\Models\TourPackage` | `PackageId` | Holiday packages (Name, Type, Location, Price, Details, Image) |
| **`tblbooking`** | `App\Models\Booking` | `BookingId` | Package reservations, guest dates, approval status, and audit timestamps |
| **`tblenquiry`** | `App\Models\Enquiry` | `id` | Customer trip inquiries with read/unread statuses |
| **`tblissues`** | `App\Models\Issue` | `id` | Customer support tickets and administrative remarks |
| **`tblpages`** | `App\Models\Page` | `id` | Dynamic CMS pages (`aboutus`, `contact`, `terms`, `privacy`) |

---

## 🛣️ Route Architecture

### Public & Traveler Routes
- `GET  /` &rarr; Homepage featuring hero banner & highlighted tour packages
- `GET  /packages` &rarr; Tour package catalog with destination filters
- `GET  /packages/{id}` &rarr; Tour package details & date booking form
- `POST /packages/{id}/book` &rarr; Booking reservation submission
- `GET  /thank-you` &rarr; Reservation confirmation receipt
- `GET  /tour-history` &rarr; Authenticated traveler booking history
- `POST /tour-history/{id}/cancel` &rarr; Self-service reservation cancellation
- `GET  /enquiry` &rarr; Custom holiday package inquiry form
- `GET  /issues` &rarr; Support ticket management & creation
- `GET  /profile` &rarr; Traveler account & contact preferences
- `GET  /page/{type}` &rarr; Static CMS pages (aboutus, contact, privacy, terms)
- `GET  /login` &rarr; Traveler sign-in page
- `POST /login` &rarr; Authenticate traveler
- `GET/POST /logout` &rarr; Terminate traveler session
- `GET  /register` &rarr; Traveler account registration

### Admin Portal Routes (`/admin/`)
- `GET  /admin/login` &rarr; Administrator authentication page
- `POST /admin/login` &rarr; Process administrator login
- `GET/POST /admin/logout` &rarr; Terminate administrator session
- `GET  /admin/dashboard` &rarr; Real-time KPI statistics dashboard
- `GET  /admin/packages` &rarr; Tour packages directory
- `GET  /admin/packages/create` &rarr; Create new tour package
- `GET  /admin/bookings` &rarr; Traveler reservations fulfillment
- `POST /admin/bookings/{id}/confirm` &rarr; Confirm traveler reservation
- `POST /admin/bookings/{id}/cancel` &rarr; Cancel traveler reservation
- `GET  /admin/users` &rarr; Registered travelers directory
- `GET  /admin/enquiries` &rarr; Manage customer inquiries
- `GET  /admin/issues` &rarr; Review and resolve support tickets
- `GET  /admin/pages` &rarr; Update CMS pages content

---

## 🔒 Security & Best Practices

- **CSRF Protection:** All state-changing POST requests are protected by Laravel's CSRF token verification (`@csrf`).
- **SQL Injection Prevention:** All database operations utilize Eloquent ORM and PDO prepared statements with strict parameter binding.
- **Multi-Guard Separation:** Independent session isolation between travelers (`web`) and administrators (`admin`) prevents privilege escalation.
- **Input Sanitization & Validation:** Comprehensive server-side validation rules enforce data integrity across all forms.
- **XSS Prevention:** Blade templates automatically escape output (`{{ ... }}`) to prevent cross-site scripting attacks.
