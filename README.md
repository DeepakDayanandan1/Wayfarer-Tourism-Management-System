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
| `setup-database.ps1` | Imports the database and configures a dedicated local app account |
| `start-database.ps1` | Starts a separate, loopback-only MySQL instance without changing the existing MySQL service |
| `run.ps1` | Starts the local PHP development server on Windows |

## Run locally on Windows

### Requirements

1. PHP 8.2 or newer with the `pdo_mysql` extension enabled. XAMPP's PHP can be used, or install PHP and add `php.exe` to `PATH`.
2. MySQL Server and its `mysql.exe` command-line client. XAMPP's MySQL distribution also works.

### Initialize the database

Open a PowerShell terminal at the repository root and start a separate local database:

```powershell
.\start-database.ps1
```

Keep that terminal open. It starts MySQL on `127.0.0.1:3307` using a separate data directory under your Windows user profile and does not change or reset the existing MySQL service.

Open a second PowerShell terminal at the repository root and import the sample database:

```powershell
.\setup-database.ps1
```

Press Enter to use the defaults (`root`, `127.0.0.1`, and port `3307`). The separate local database has no root password initially. The setup script imports `database/tms.sql`, creates a dedicated app-only MySQL account with a random password, and saves that account to the ignored `config.local.php` file. If `tms` already contains tables, setup stops to avoid overwriting existing data.

The existing MySQL service on port `3306` is left untouched. To stop the separate database, press Ctrl+C in its terminal. The PHP app uses the saved local configuration; environment variables `TMS_DB_HOST`, `TMS_DB_PORT`, `TMS_DB_NAME`, `TMS_DB_USER`, and `TMS_DB_PASS` can override it.

### Start the site

From the repository root:

```powershell
.\run.ps1
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000). Use `Ctrl+C` in the server terminal to stop it. The admin area is at [http://127.0.0.1:8000/admin/](http://127.0.0.1:8000/admin/).

If PowerShell blocks a script, invoke it for the current process with `Set-ExecutionPolicy -Scope Process Bypass`, then run `.\start-database.ps1`, `.\setup-database.ps1`, and `.\run.ps1` in that order.

### Sample application accounts

The supplied database dump includes these sample application logins:

- **Admin:** username `admin`, password `Test@123` — sign in at `/admin/`.
- **Customer:** email `test@gmail.com`, password `Test@123` — use the customer sign-in on the home page.

These are website logins, not MySQL credentials. The app can only use them after its database connection succeeds. They are demo credentials from the supplied project; change them before using a non-local deployment.

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
