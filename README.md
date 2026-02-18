# MySpend

**MySpend** is a lightweight **web-based personal finance tracker** built with **native PHP**.  
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

## ⚙️ Installation Guide

### 1️⃣ Clone the repository
```bash
git clone https://github.com/aungkyawthetx/my-spend.git
cd my-spend
2️⃣ Configure database credentials
Create a .env file or update your configuration file with:

env
DB_HOST=localhost
DB_NAME=yourdbname
DB_USER=root
DB_PASS=your_password
3️⃣ Run database setup / migrations
bash
php migrations/setup.php
4️⃣ Start local development server
bash
php -S localhost:8000
📜 License
This project is not licensed for commercial redistribution.
All rights reserved.

© Aung Kyaw Thet

👨‍💻 Author
Aung Kyaw Thet

GitHub: https://github.com/aungkyawthetx

Email: aungkyawthethimself@gmail.com