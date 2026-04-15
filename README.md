# RoomMate

A server-side web application built with Laravel for managing shared household responsibilities. Housemates can track chores and split expenses through a role-based interface where admins manage assignments and all members can log and view shared costs.

---

## Table of Contents

- [Project Overview](#project-overview)
- [Tech Stack](#tech-stack)
- [Features](#features)
- [Setup and Installation](#setup-and-installation)
- [User Roles](#user-roles)
- [Application Pages](#application-pages)
- [Validation](#validation)
- [Known Issues and Limitations](#known-issues-and-limitations)

---

## Project Overview

RoomMate solves a common problem in shared housing — keeping track of who is responsible for what chores, and making sure shared expenses like groceries and bills are visible to everyone in the house. The application uses a two-tier role system: admins (typically the lead tenant) have full control over chore assignments, while members can view their assigned tasks, mark them complete, and log new expenses.

---

## Tech Stack

| Layer        | Technology          |
|--------------|---------------------|
| Framework    | Laravel 13          |
| Language     | PHP 8.3             |
| Database     | SQLite              |
| Auth         | Laravel Breeze      |
| Frontend     | Blade, Tailwind CSS |
| Asset Build  | Vite                |
| Testing      | Pest                |

---

## Features

### Chore Management (full CRUD)
- Admins can create, edit, and delete chores
- Admins can assign any chore to any registered user
- Members can mark their assigned chores as complete
- All chores display assigned user, assigning admin, and current status

### Expense Tracking (full CRUD)
- Any authenticated user can log a new expense with a title, amount, and optional description
- Expenses display who added them and when
- Admins and the original creator can edit or delete an expense
- Running total of all expenses shown on the expenses index page

### Dashboard
- Summary statistics: total chores, completed chores, pending chores
- Summary statistics: total number of expenses, total amount spent
- Recent chores list (last 5)
- Recent expenses list (last 5) with creator name and amount

### Authentication and Authorisation
- Register, login, logout via Laravel Breeze
- Guest login available for quick demo access (email: `guest@roommate.local`)
- Role-based access control: admin vs member enforced at the controller level
- Profile management: update name, email, password, or delete account

---

## Setup and Installation

### Requirements

- PHP 8.3 or higher
- Composer
- Node.js 18 or higher and npm

### Steps

**1. Clone the repository**

```bash
git clone https://github.com/your-username/ServerSideRoomateAppCa2.git
cd ServerSideRoomateAppCa2
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Install Node dependencies**

```bash
npm install
```

**4. Set up environment file**

```bash
cp .env.example .env
php artisan key:generate
```

**5. Create the SQLite database and run migrations**

```bash
touch database/database.sqlite
php artisan migrate
```

**6. Start the development servers**

Run both the Laravel server and Vite asset compiler. Open two terminal windows:

```bash
# Terminal 1 - Laravel
php artisan serve

# Terminal 2 - Vite
npm run dev
```

The application will be available at `http://127.0.0.1:8000`.

### Creating an Admin User

Register a new account through the UI, then promote it to admin via Tinker:

```bash
php artisan tinker
```

```php
$user = App\Models\User::where('email', 'your@email.com')->first();
$user->role = 'admin';
$user->save();
```

### Guest Login

A guest account is auto-created on first use at the login page. The guest has the `member` role and can be used to test non-admin functionality without registering.

---

## User Roles

| Action                        | Admin | Member |
|-------------------------------|-------|--------|
| View all chores               | ✅    | Own only |
| Create chores                 | ✅    | ❌     |
| Edit chores                   | ✅    | ❌     |
| Delete chores                 | ✅    | ❌     |
| Mark chore complete           | ✅    | ✅ (own only) |
| View all expenses             | ✅    | ✅     |
| Create expenses               | ✅    | ✅     |
| Edit / delete own expenses    | ✅    | ✅     |
| Edit / delete others' expenses| ✅    | ❌     |

---

## Application Pages

| Route               | Page                  | Auth Required |
|---------------------|-----------------------|---------------|
| `/`                 | Redirects to login    | No            |
| `/login`            | Login                 | No            |
| `/register`         | Register              | No            |
| `/dashboard`        | Dashboard overview    | Yes           |
| `/chores`           | Chores list           | Yes           |
| `/chores/create`    | Create chore          | Yes (admin)   |
| `/chores/{id}/edit` | Edit chore            | Yes (admin)   |
| `/expenses`         | Expenses list         | Yes           |
| `/expenses/create`  | Add expense           | Yes           |
| `/expenses/{id}/edit` | Edit expense        | Yes (owner/admin) |
| `/profile`          | Edit profile          | Yes           |

---

## Validation

All forms apply validation at two levels:

**Client-side (JavaScript)** — runs on form submit before the request is sent. Highlights invalid fields with a red border and displays an inline error message. Prevents unnecessary round trips to the server.

**Server-side (Laravel)** — `$request->validate()` in each controller method. Even if JavaScript is disabled or bypassed, the server enforces the same rules and returns errors to the view via the `$errors` bag.

| Form             | Rules enforced                                              |
|------------------|-------------------------------------------------------------|
| Chore create/edit | Title required, max 255 chars. Assigned user required.     |
| Expense create/edit | Title required, max 255 chars. Amount required, numeric, min €0.01. Description optional, max 1000 chars. |

---

## Known Issues and Limitations

- **No pagination** — the chores and expenses index pages load all records. This will become slow with a large dataset. Pagination via `->paginate()` would be the straightforward fix.
- **No expense categories** — expenses are a flat list. Grouping by category (groceries, bills, etc.) was considered but excluded from scope to keep the initial build focused.
- **SQLite in development only** — the app is configured for SQLite which is fine for development and assessment but would need to be switched to MySQL or PostgreSQL for any production deployment.
- **No email verification** — Laravel Breeze includes email verification support but it is not enabled. The `MAIL_MAILER` is set to `log` so no real emails are sent.
- **Guest account has a fixed password** — the guest login creates a user with a hardcoded password (`guest12345`). This is intentional for demo convenience and would be removed in a production environment.
