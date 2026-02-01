# i-ALQORI - Project Rebuild Workflow

## Tech Stack

| Component | Technology |
|-----------|------------|
| **Backend** | Laravel 10, PHP 8.1+ |
| **Frontend** | Blade templates, Livewire 3, Filament 3 UI |
| **CSS Framework** | Tailwind CSS 3.4 with Preline plugin |
| **Build Tool** | Vite 4.x |
| **Database** | MySQL (MariaDB compatible) |
| **PDF Generation** | DomPDF |
| **Authentication** | Laravel Sanctum |
| **Roles & Permissions** | Spatie Laravel Permission |
| **Admin Panel** | Filament 3 |

---

## Prerequisites

- PHP 8.1+
- Composer 2.x
- Node.js 18+ and npm/yarn
- MySQL 8.0+ or MariaDB 10+
- Git

---

## Step 1: Clone & Install Dependencies

```bash
# Clone repository
git clone <repository-url> i-alqori
cd i-alqori

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

---

## Step 2: Configure Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

**Required `.env` settings:**
```env
APP_NAME=i-ALQORI
APP_ENV=local
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120

QUEUE_CONNECTION=sync
```

**Optional (payment gateway, Redis, mail):**
```env
# ToyyibPay Payment Gateway
TOYYIBPAY_USER_SECRET_KEY=...
TOYYIBPAY_CATEGORY_CODE=...

# Redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_PASSWORD=null

# Mail
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025

# Currency
MONEY_DEFAULTS_CURRENCY=MYR
MONEY_DEFAULTS_CONVERT=TRUE
```

---

## Step 3: Database Setup

```bash
# Create database in MySQL
mysql -u root -p -e "CREATE DATABASE laravel;"

# Run migrations
php artisan migrate --force

# Optional: seed database
php artisan db:seed
```

---

## Step 4: Build Frontend Assets

```bash
# Development
npm run dev

# Production
npm run build
```

---

## Step 5: Start Development Server

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server
npm run dev
```

---

## Access Points

| Environment | URL |
|-------------|-----|
| **Local App** | `http://localhost:8000` |
| **Admin Panel** | `http://localhost:8000/admin` |

---

## Key Commands

```bash
# Clear all caches
php artisan optimize:clear

# Rebuild caches
php artisan optimize

# Fresh database migration (WARNING: deletes all data)
php artisan migrate:fresh

# Rollback migrations
php artisan migrate:rollback

# Check migration status
php artisan migrate:status

# List all routes
php artisan route:list

# Filament upgrade
php artisan filament:upgrade

# Run tests
php artisan test

# Create new Filament resource
php artisan make:filament-resource ResourceName

# Create new model with migration
php artisan make:model ModelName -m
```

---

## Project Structure

```
i-alqori/
├── app/
│   ├── Console/                  # Artisan commands
│   ├── Exceptions/               # Exception handling
│   ├── Filament/                 # Admin panel
│   │   ├── Auth/                 # Authentication
│   │   ├── Pages/                # Custom pages
│   │   ├── Resources/            # CRUD resources
│   │   └── Widgets/              # Dashboard widgets
│   ├── Http/                     # HTTP layer (Kernel, middleware)
│   ├── Livewire/                 # Livewire components
│   ├── Models/                   # Eloquent models (24 models)
│   ├── Policies/                 # Authorization policies
│   ├── Providers/                # Service providers
│   ├── Tables/                   # Table configurations
│   └── Traits/                   # Custom traits
├── bootstrap/                    # Laravel bootstrap files
├── config/                       # Configuration files (29 config files)
├── database/
│   ├── factories/                # Model factories
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders
├── lang/                         # Localization files
├── public/                       # Web root
├── resources/
│   ├── css/                      # Stylesheets
│   ├── js/                       # JavaScript files
│   └── views/                    # Blade templates
├── routes/                       # Route definitions
├── storage/                      # Storage (logs, cache, etc.)
├── tests/                        # Unit and Feature tests
├── composer.json                 # PHP dependencies
├── package.json                  # Node.js dependencies
├── vite.config.js                # Vite configuration
└── postcss.config.js             # PostCSS configuration
```

---

## Composer Dependencies

| Package | Purpose |
|---------|---------|
| `laravel/framework: ^10.10` | Core framework |
| `filament/filament: ^3.0-stable` | Admin panel |
| `livewire/livewire: ^3.0` | Frontend framework |
| `laravel/sanctum: ^3.2` | Authentication |
| `spatie/laravel-permission: ^5.11` | Roles & permissions |
| `barryvdh/laravel-dompdf: ^2.0` | PDF generation |
| `guzzlehttp/guzzle: ^7.2` | HTTP client |
| `pxlrbt/filament-excel: ^2.3` | Excel exports |
| `stechstudio/filament-impersonate: ^3.5` | User impersonation |
| `hasnayeen/themes: ^3.0` | Theming |
| `shuvroroy/filament-spatie-laravel-health: ^2.0` | Health checks |

---

## NPM Dependencies

| Package | Version | Purpose |
|---------|---------|---------|
| `vite` | ^4.0.0 | Build tool |
| `laravel-vite-plugin` | ^0.8.0 | Laravel integration |
| `tailwindcss` | ^3.4.6 | CSS framework |
| `postcss` | ^8.4.39 | CSS processing |
| `postcss-nesting` | ^12.1.5 | CSS nesting |
| `axios` | ^1.6.0 | HTTP client |
| `@tailwindcss/forms` | ^0.5.7 | Form styling |
| `@tailwindcss/typography` | ^0.5.13 | Typography |
| `preline` | ^1.9.0 | UI components |

---

## Database Models

| Model | Description |
|-------|-------------|
| `User` | System users |
| `Student` | Students |
| `Teacher` | Teachers |
| `Registrar` | Registrars |
| `ClassName` | Class definitions |
| `ClassPackage` | Class packages/pricing |
| `RegisterClass` | Class registrations |
| `AssignClassTeacher` | Teacher-class assignments |
| `FeeRate` | Fee rates |
| `Invoice` | Invoices |
| `HistoryPayment` | Payment history |
| `Debt` | Debts/overdue |
| `Expense` / `ExpenseCategory` | Expenses |
| `Income` / `IncomeCategory` | Income tracking |
| `ReportClass` | Class reports |
| `AuditLog` | Audit trails |

---

## Filament Resources

| Resource | Purpose |
|----------|---------|
| `AssignClassTeacherResource` | Manage teacher-class assignments |
| `ClassNameResource` | Manage class definitions |
| `ClassPackageResource` | Manage class packages |
| `FeeRateResource` | Manage fee rates |
| `ReportClassResource` | Class reports |
| `UserResource` | User management |

---

## Configuration Files

| File | Purpose |
|------|---------|
| `config/dompdf.php` | PDF generation settings |
| `config/media-library.php` | Spatie media library |
| `config/permission.php` | Spatie permissions |
| `config/filament-spatie-roles-permissions.php` | Filament roles plugin |
| `config/money.php` | Currency settings |
| `config/livewire.php` | Livewire configuration |
| `config/themes.php` | Hasnayeen themes plugin |
| `config/toyyibpay.php` | Payment gateway |
| `config/filament.php` | Filament main config |

---

## Deployment Notes

- Current deployment: `https://v4.i-alqori.app`
- Database hosted remotely on shared hosting
- Uses Redis-ready configuration (queue)
- Custom color theme: Amber primary, Rose secondary, Pink warning
