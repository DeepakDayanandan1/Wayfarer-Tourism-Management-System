# Wayfarer — Modern Tourism & Travel Management System

[![PHP Version](https://img.shields.io/badge/PHP-8.2%20%7C%208.3%20%7C%208.4-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/Database-MySQL%20%7C%20MariaDB-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Frontend](https://img.shields.io/badge/Frontend-Bootstrap%20%7C%20jQuery%20%7C%20CSS3-563D7C?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Architecture](https://img.shields.io/badge/Architecture-Server--Rendered%20PDO-green)](https://www.php.net/manual/en/book.pdo.php)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

**Wayfarer** is a robust, full-featured, server-rendered Tourism and Holiday Package Management web application. Built with modern PHP (PDO with parameterized queries) and MySQL, it provides an intuitive public portal for travelers to discover packages and book holidays, alongside a high-density, real-time administrative command center.

> 📖 **Looking for a complete technical deep-dive?** See [PROJECT_DOCUMENTATION.md](file:///c:/Projects/Wayfarer/PROJECT_DOCUMENTATION.md) for the exhaustive A-to-Z architecture, library inventory, database model, and workflows.

---

## 🌟 Key Highlights & Features

### 🌍 Traveler Portal (Public)
- **Holiday Package Catalog:** Browse curated tour packages with categorized types (Family, Couple, Group), locations, prices, rich descriptions, and photo galleries.
- **Dynamic Booking Engine:** Real-time date selection with departure and return validation, guest comments, and instant booking submission.
- **Account & Identity Center:**
  - Fast traveler registration with AJAX live email availability checking.
  - Secure sign-in, profile management, and password reset flows.
- **Tour Booking History:** View past, confirmed, and pending bookings; travelers can cancel upcoming trips with audit-logged timestamps.
- **Customer Support & Issue Ticketing:** Raise support tickets against bookings or general concerns and track administrative resolutions.
- **General Inquiries:** Dedicated contact and package inquiry submissions.

### 🛡️ Administrative Command Center (`/admin/`)
- **Executive KPI Dashboard:** Real-time metrics tracking total users, packages, enquiries (new vs. read), and bookings (confirmed, pending, cancelled).
- **Tour Package Management:** Full CRUD operations for packages with image uploads, location targeting, pricing in USD, and feature lists.
- **Booking Fulfillment & Actions:** Review traveler bookings, verify schedules, and confirm or cancel with automated status tracking.
- **Customer Management:** Searchable directory of registered users with drill-down views into individual travel histories.
- **Issue Ticket Resolution:** Review raised tickets and submit administrative remarks in dedicated dialogs.
- **Content Management System (CMS):** In-browser WYSIWYG editor powered by NicEdit to update static informational pages (Terms of Service, Privacy Policy, About Us, Contact Us).

---

## 💻 Tech Stack & Architecture

| Layer | Technologies & Tools |
| :--- | :--- |
| **Backend Runtime** | PHP 8.2+ (CLI built-in web server or Apache/Nginx) |
| **Database Access** | MySQL 5.7+ / MariaDB 10.4+ via **PHP Data Objects (PDO)** with parameterized queries |
| **Authentication** | Secure PHP native sessions (`$_SESSION`) with role-based access control |
| **Public Frontend** | HTML5, CSS3, Bootstrap, Font Awesome icons, jQuery, WOW.js animations |
| **Admin Frontend** | Responsive dashboard theme, BasicTable (responsive grid tables), NiceScroll, NicEdit WYSIWYG |
| **Automation** | Windows PowerShell automation scripts (`start-database.ps1`, `setup-database.ps1`, `run.ps1`) |

---

## 📂 Project Directory Structure

```plaintext
Wayfarer/
├── admin/                     # Administrative command center
│   ├── css/                   # Admin styles & BasicTable responsive layout
│   ├── fonts/                 # Font Awesome & Glyphicon icon fonts
│   ├── images/                # Admin branding & UI icons
│   ├── includes/              # Shared admin header, sidebar navigation, footer, config
│   ├── js/                    # Bootstrap JS, jQuery, NiceScroll, BasicTable
│   ├── pacakgeimages/         # Uploaded tour package photos (referenced by DB)
│   ├── create-package.php     # Package creation form with file upload
│   ├── dashboard.php          # Real-time metrics & KPI summary cards
│   ├── manage-bookings.php    # Booking approval, cancellation & audit
│   ├── manage-enquires.php    # Customer inquiry review
│   ├── manage-packages.php    # Package catalog management
│   ├── manage-pages.php       # Static content CMS (Terms, Privacy, About)
│   ├── manage-users.php       # User directory & profile audits
│   ├── manageissues.php       # Support ticket queue
│   ├── updateissue.php        # Ticket remark dialog
│   └── index.php              # Modern administrative login portal
├── css/                       # Public CSS (Bootstrap, WOW animations, custom styles)
├── database/
│   └── tms.sql                # Complete schema DDL & initial seed records
├── fonts/                     # Public webfonts
├── images/                    # Hero banners and background assets
├── includes/                  # Public shared components (header, footer, modals)
│   ├── config.php             # Unified database PDO connector
│   ├── signin.php             # Traveler login modal
│   ├── signup.php             # Traveler registration modal
│   └── write-us.php           # Support ticket submission modal
├── js/                        # Public JS (jQuery, Bootstrap, WOW.js)
├── change-password.php        # Traveler password update
├── check_availability.php     # AJAX live email verification endpoint
├── enquiry.php                # Public general enquiry page
├── forgot-password.php        # Traveler password recovery
├── index.php                  # Public landing page with featured packages
├── issuetickets.php           # Traveler support ticket history & status
├── logout.php                 # Traveler session termination
├── package-details.php        # Package overview and booking submission form
├── package-list.php           # Full tour package browsing catalog
├── page.php                   # CMS page renderer (About, Terms, Privacy)
├── profile.php                # Traveler profile management
├── run.ps1                    # PowerShell script to start PHP development server
├── setup-database.ps1         # PowerShell script to provision database & credentials
├── start-database.ps1         # PowerShell script to run isolated loopback MySQL instance
├── thankyou.php               # Booking confirmation receipt
├── tour-history.php           # Traveler booking history & self-service cancellation
├── PROJECT_DOCUMENTATION.md   # Exhaustive A-to-Z technical architecture guide
└── README.md                  # Project overview & quick start
```

---

## 🚀 Quick Start Guide (Windows)

### Prerequisites
1. **PHP 8.2 or newer** installed and available in your `PATH` (with `pdo_mysql` extension enabled).
2. **MySQL Server 5.7+ or MariaDB 10.4+** (XAMPP's MySQL or standalone MySQL).

---

### Method A: Automated One-Click Setup (Recommended)

1. **Start the Database Instance:**
   Open a PowerShell terminal at the project root:
   ```powershell
   .\start-database.ps1
   ```
   *This starts an isolated MySQL instance on port `3307` without modifying your default service.*

2. **Initialize Schema & Create Database Account:**
   Open a second PowerShell terminal at the project root:
   ```powershell
   .\setup-database.ps1
   ```
   *Press Enter to accept defaults (`root`, `127.0.0.1`, port `3307`). The script imports `database/tms.sql`, generates a dedicated application account with a secure password, and creates the local `config.local.php` file.*

3. **Launch the Web Application:**
   From the repository root:
   ```powershell
   .\run.ps1
   ```
   Open your browser to:
   - **Public Website:** [http://127.0.0.1:8000](http://127.0.0.1:8000)
   - **Admin Command Center:** [http://127.0.0.1:8000/admin/](http://127.0.0.1:8000/admin/)

---

### Method B: Manual Configuration (XAMPP / Standard MySQL)

1. Start Apache and MySQL from your XAMPP Control Panel (or start your local MySQL service on port `3306`).
2. Open **phpMyAdmin** or your MySQL CLI and create a database:
   ```sql
   CREATE DATABASE tms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Import `database/tms.sql` into the newly created `tms` database.
4. Create a `config.local.php` file in the project root (or set environment variables):
   ```php
   <?php
   return [
       'host' => '127.0.0.1',
       'port' => 3306,
       'name' => 'tms',
       'user' => 'root',
       'pass' => '',
   ];
   ```
5. Start the development server:
   ```bash
   php -S 127.0.0.1:8000
   ```

---

## 🔑 Default Test Credentials

The database dump includes pre-configured sample credentials for testing:

| Role | Username / Email | Password | Portal URL |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin` | `Test@123` *(or `pass@123`)* | `/admin/` |
| **Customer (Traveler)** | `test@gmail.com` | `Test@123` | `/index.php` (Sign In modal) |

> ⚠️ *Note: These are sample application accounts stored in the application database, separate from your MySQL root user. For production deployments, change these passwords immediately.*

---

## 🗄️ Database Schema Summary

The core data store (`tms`) contains 7 primary relational tables:

| Table Name | Primary Key | Description |
| :--- | :--- | :--- |
| **`admin`** | `id` | Administrator account credentials and mobile contact |
| **`tblusers`** | `id` | Registered travelers (Full Name, Mobile Number, Email, Password) |
| **`tbltourpackages`**| `PackageId` | Tour packages (Name, Type, Location, Price, Features, Details, Image) |
| **`tblbooking`** | `BookingId` | Package reservations, guest dates, status (Pending, Confirmed, Cancelled), cancellation audit |
| **`tblenquiry`** | `id` | Public traveler inquiries with read/unread status |
| **`tblissues`** | `id` | Traveler support tickets, issue description, and administrator remarks |
| **`tblpages`** | `id` | CMS-editable pages (`terms`, `privacy`, `aboutus`, `contact`) |

---

## 🔒 Security & Best Practices

- **Parameterized Queries:** All database operations utilize PDO prepared statements with explicit parameter binding (`bindParam` / `execute`) to safeguard against SQL injection.
- **Environment Separation:** Database credentials are kept out of source control using `config.local.php` (ignored in `.gitignore`) and can be dynamically overridden via `TMS_DB_*` environment variables.
- **Session Authentication:** Role-based session separation protects admin operations (`$_SESSION['alogin']`) and customer operations (`$_SESSION['login']`).
- **Production Checklist:** When deploying to production:
  1. Upgrade legacy MD5 password hashes to `password_hash()` and `password_verify()` with Argon2id or Bcrypt.
  2. Implement CSRF tokens for all POST submissions.
  3. Serve over HTTPS with HTTP-only, secure session cookie flags.
  4. Restrict file uploads in `admin/create-package.php` to validated MIME types (`image/jpeg`, `image/png`, `image/webp`).

---

## 📄 License & Attribution

This project is open-source under the [MIT License](LICENSE). Contributions, issues, and feature requests are welcome!
