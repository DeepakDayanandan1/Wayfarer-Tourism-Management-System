# Tourism Management System

A server-rendered tourism booking website for browsing tour packages, submitting enquiries, booking trips, and managing customers and packages through an admin area.

## Technology and architecture

- **Backend:** PHP pages with server-side form handling and PHP sessions.
- **Database:** MySQL or MariaDB, accessed through PHP PDO and parameterized queries.
- **Frontend:** HTML, CSS, Bootstrap, Font Awesome, jQuery, and small browser-side JavaScript helpers.
- **Runtime:** PHP's built-in development web server; no Node.js, npm, or frontend build step is required.

The browser requests a PHP page, which includes shared navigation/layout and database configuration as needed. PHP reads or updates the `tms` database through PDO, renders HTML, and returns it to the browser. User and admin areas use PHP sessions for authentication.

## Main features

- Browse and search tour packages and view package details.
- Register, sign in, manage a profile, and change or reset a password.
- Submit enquiries and book packages; view and cancel bookings in tour history.
- Raise support tickets and view admin responses.
- Admin sign-in and dashboards for packages, bookings, users, enquiries, tickets, and informational pages.

## Repository layout

| Path | Purpose |
| --- | --- |
| `index.php`, `package-list.php`, `package-details.php` | Public landing page and package browsing/booking |
| `includes/` | Shared public layout and sign-in, sign-up, enquiry, and support forms |
| `admin/` | Admin pages, reports, and package/booking/user management |
| `css/`, `js/`, `fonts/`, `images/` | Frontend styles, scripts, fonts, and images |
| `database/tms.sql` | Database schema and sample records |
| `run.ps1` | Starts the local PHP development server on Windows |

## Run locally on Windows

### Requirements

1. PHP 8.2 or newer with the `pdo_mysql` extension enabled. XAMPP's PHP can be used, or install PHP and add `php.exe` to `PATH`.
2. A running MySQL or MariaDB server.
3. The MySQL command-line client (`mysql.exe`) to create and initialize the database.

### Initialize the database

Create a fresh database and import the included SQL dump from the repository root:

```powershell
mysql -u root -p -e "CREATE DATABASE tms CHARACTER SET utf8mb4;"
cmd /c 'mysql -u root -p tms < database\tms.sql'
```

Enter the database password when prompted. If the database or tables already exist, back them up before importing; the dump creates tables and includes sample records.

The default connection is `127.0.0.1:3306`, database `tms`, user `root`, and an empty password (the common local XAMPP setup). Override these defaults in the PowerShell session before starting the site if your database uses different credentials:

```powershell
$env:TMS_DB_HOST = "127.0.0.1"
$env:TMS_DB_PORT = "3306"
$env:TMS_DB_NAME = "tms"
$env:TMS_DB_USER = "root"
$env:TMS_DB_PASS = "your-database-password"
```

### Start the site

From the repository root:

```powershell
.\run.ps1
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000). Use `Ctrl+C` in the server terminal to stop it. The admin area is at [http://127.0.0.1:8000/admin/](http://127.0.0.1:8000/admin/).

If PowerShell blocks the script, invoke it for the current process with `Set-ExecutionPolicy -Scope Process Bypass`, then run `.\run.ps1` again.

## Database model

The SQL dump defines these main tables:

- `tbltourpackages`: package descriptions, locations, features, prices, and images.
- `tblbooking`: customer bookings, dates, status, and cancellation details.
- `tblusers`: customer accounts and contact details.
- `admin`: administrator account.
- `tblenquiry`: public enquiries and their status.
- `tblissues`: customer support tickets and admin remarks.
- `tblpages`: editable informational pages such as terms and contact details.

## Configuration and development notes

Database settings are read from `TMS_DB_HOST`, `TMS_DB_PORT`, `TMS_DB_NAME`, `TMS_DB_USER`, and `TMS_DB_PASS`. Both public and admin database configuration files use the same settings. The PHP built-in server is for local development; use a properly configured production web server and review authentication, password storage, and other security controls before exposing this legacy application publicly.

To check PHP syntax for an individual file, run `php -l path\to\file.php`.
