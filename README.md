# TraceX

**TraceX** is a lightweight **web-based personal finance tracker** built with **native PHP**.  
It helps users manage **expenses, categories, budgets, payment methods, and savings goals** in one simple and efficient application.

This project is designed for **learning, portfolio showcase, and personal financial tracking**.

---

## ✨ Core Features

### 🧾 Expense Management
- Record daily expenses with **amount, category, payment method, and notes**
- Organize spending using **categories**
- Track **paid / unpaid** expense status
- View **complete expense history** with filtering by date or category

### 📊 Budget Tracking
- Create **monthly or category-based budgets**
- Compare **actual spending vs. planned budget**
- Quickly detect **overspending**

### 💰 Savings Goals
- Create **personal savings targets**
- Store **target amount, start date, and deadline**
- Record **deposit and withdrawal transactions**
- Automatically calculate **current saved amount**
- Mark savings as **active, completed, or cancelled**

---

## 🏗 Database Coverage

The system currently manages:

- **Users** (authentication & roles)
- **Categories** (expense grouping)
- **Expenses** (transactions)
- **Budgets** (monthly/category limits)
- **Payment Methods** (cash, bank, etc.)
- **Savings** (financial goals)
- **Saving Transactions** (deposit / withdraw history)

---

## 🛠 Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | Native PHP |
| Frontend | HTML, Tailwind CSS, JavaScript |
| Database | MySQL |
| Server | Apache / XAMPP |

---

## 📋 Prerequisites

Make sure you have installed:

- **PHP 7.4 or higher**
- **MySQL 5.7 or higher**
- **Apache / Nginx** or **XAMPP / WAMP**
- **Composer** *(optional)*

---
## Installation Guide

Follow these steps to run the project locally.

### 1. Clone the project

```bash
git clone <https://github.com/aungkyawthetx/my-spend.git>
cd my-spend
```

### 2. Configure database connection

Open `config/db.php` and update your local DB credentials:

```php
$DB_HOST = "localhost";
$DB_NAME = "yourdbname";
$DB_USER = "root";
$DB_PASS = "your_password";
```

### 3. Create tables and seed defaults

Run:

```bash
php database/setup.php
```

Useful options:

```bash
php database/setup.php --fresh
php database/setup.php --fresh --kill-connections
php database/setup.php --no-seed
```

### 4. Run the application

Start PHP development server:

```bash
npm run dev
```

Then open:

```text
http://localhost:8000
```

### 5. (Optional) Watch Tailwind CSS changes

Use this in another terminal while developing UI:

```bash
npm run watch
```

---

## Quick Troubleshooting

- If DB connection fails, re-check `config/db.php` values.
- If styles do not update, run `npm run watch`.
- If tables are missing or outdated, run `php database/setup.php --fresh`.
