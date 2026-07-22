# Invento Track

> A multi-tenant SaaS inventory management system built with Laravel 13, Filament v5, Livewire, and Tailwind CSS.

![Laravel](https://img.shields.io/badge/Laravel-13-red?style=flat-square&logo=laravel)
![Filament](https://img.shields.io/badge/Filament-v5-orange?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-8.3-blue?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue?style=flat-square&logo=mysql)
![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)

---

## What is Invento Track?

Invento Track is a multi-tenant SaaS platform that allows businesses (supermarkets, hospitals, pharmacies, warehouses, retail shops) to manage their inventory from a single, clean dashboard.

Each company that signs up gets their own **isolated workspace** — they can only see and manage their own products, stock, orders, and invoices. No data leaks between companies.

The platform owner manages everything (plans, tenants, billing) from a separate **Filament super admin panel**.

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 13 |
| Admin Panel | Filament v5.6 |
| Frontend | Blade + Livewire + Alpine.js |
| Styling | Tailwind CSS |
| Database | MySQL 8 |
| Language | PHP 8.3 |
| Auth | Custom multi-tenant auth |

---

## Architecture

### Multi-Tenancy
- **Single database** with `tenant_id` scoping on every table
- UUID primary keys on all 20 tables (prevents ID enumeration attacks)
- Every controller method has `abort(403)` security checks to prevent cross-tenant data access
- Two separate panels: `/admin` (platform owner) and `/dashboard` (tenant companies)

### Stock Tracking (Dual-Table Pattern)
- `stock_levels` — stores the **current quantity** per product per location (fast reads)
- `stock_movements` — stores the **full audit trail** of every stock IN, OUT, and adjustment
- Every stock change runs inside a `DB::transaction()` to guarantee data consistency

### Subscription Plans
- Plans table drives feature gating (`max_users`, `max_products`, `max_locations`, `has_api_access`)
- Every new company gets a **14-day free trial** automatically on registration
- Plan limits enforced at the controller level

---

## Database Design (20 Tables)

```
SaaS & Billing      → plans, subscriptions
Tenants & Users     → tenants, users
Product Catalogue   → categories, units, products
Inventory & Stock   → locations, stock_levels, stock_movements
Procurement         → suppliers, purchase_orders, po_items
Sales & Invoicing   → customers, tax_rates, sales_orders, sale_items, invoices, payments
Alerts              → alerts
```

---

## Features

### Super Admin Panel (`/admin`) — Filament v5
- [x] Manage subscription plans (Starter, Growth, Enterprise)
- [x] View and manage all tenant companies
- [x] Manage users across tenants
- [x] Full CRUD for all 20 models
- [x] Role-based access — only `super_admin` role can access this panel

### Tenant Dashboard (`/dashboard`) — Blade + Livewire
- [x] Company registration (creates Tenant + User + 14-day trial automatically)
- [x] Login / Logout
- [x] Product catalogue management (create, edit, delete, search, filter by category)
- [x] Category management
- [x] Unit of measurement management
- [x] Warehouse/location management
- [x] Stock level tracking (current quantities per product per location)
- [x] Stock movements (IN / OUT / Adjustment with full audit trail)
- [x] Low stock alerts on the stock levels page
- [x] Company settings (name, currency, timezone)
- [x] Trial countdown banner
- [ ] Suppliers & Purchase Orders *(in progress)*
- [ ] Sales Orders & Invoicing *(in progress)*
- [ ] Stripe billing integration *(planned)*
- [ ] Landing page *(planned)*

---

## Local Setup

### Requirements
- PHP 8.2+
- Composer
- MySQL 8+
- Node.js & NPM

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/Lesley-debug/invento-track-web.git
cd invento-track-web

# 2. Install PHP dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Configure your database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invento_track
DB_USERNAME=root
DB_PASSWORD=your_password

# 6. Run migrations
php artisan migrate

# 7. Create a super admin user
php artisan make:filament-user

# 8. Set the user role to super_admin
php artisan tinker
\App\Models\User::where('email', 'your@email.com')->update(['role' => 'super_admin']);
exit

# 9. Start the development server
php artisan serve
```

### Access Points

| URL | Description |
|-----|-------------|
| `http://localhost:8000/` | Landing page (coming soon) |
| `http://localhost:8000/register` | Company registration |
| `http://localhost:8000/login` | Tenant login |
| `http://localhost:8000/dashboard` | Tenant dashboard |
| `http://localhost:8000/admin` | Super admin panel (Filament) |

---

## Project Structure

```
app/
├── Filament/Resources/     # Filament admin resources (20 models)
├── Http/Controllers/
│   ├── Auth/               # RegisterController, LoginController
│   ├── CategoryController.php
│   ├── LocationController.php
│   ├── ProductController.php
│   ├── SettingsController.php
│   ├── StockController.php
│   └── UnitController.php
├── Models/                 # 20 Eloquent models with UUID + relationships
database/
├── migrations/             # 20 migrations in dependency order
resources/views/
├── auth/                   # login.blade.php, register.blade.php
├── layouts/app.blade.php   # Main tenant dashboard layout with sidebar
├── dashboard.blade.php     # Tenant home page
├── products/               # index, create, edit
├── categories/             # index, create
├── units/                  # index, create
├── locations/              # index, create
├── stock/                  # index, add, movements
└── settings.blade.php      # Company settings page
```

---

## Security

- All tenant routes protected by `auth` middleware
- Super admin panel protected by `FilamentUser` interface + `canAccessPanel()` method
- Every controller checks `tenant_id` ownership before read/write operations
- UUID primary keys prevent sequential ID enumeration
- Passwords hashed using Laravel's `bcrypt` via `Hash::make()`
- CSRF protection on all forms
- SQL injection prevented via Eloquent parameterized queries

---

## Roadmap

- [ ] Suppliers & Purchase Orders
- [ ] Sales Orders & Invoicing
- [ ] PDF invoice generation
- [ ] Low stock email alerts
- [ ] Stripe subscription billing
- [ ] CSV product import/export
- [ ] API access for Enterprise plan tenants
- [ ] Mobile-responsive dashboard improvements
- [ ] Landing page

---

## Author

**Lesley Tabi**
- GitHub: [@Lesley-debug](https://github.com/Lesley-debug)
- Email: esanglesley@gmail.com
- Based in Bamenda, Cameroon

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
