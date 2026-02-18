<?php
require_once __DIR__ . '/../config/db.php';

  class DatabaseMigration {
    private $pdo; // only visible within the class

    public function __construct($pdo) {
      $this->pdo = $pdo;
    }
      
    public function createTables() {
      try {
        // Enable foreign key constraints
        $this->pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
        $this->createUsersTable();
        $this->createCategoriesTable(); 
        $this->createPaymentMethodsTable();
        $this->createExpensesTable();
        $this->createBudgetsTable();
        $this->insertDefaultCategories();
        $this->insertDefaultPaymentMethods();

        echo "Database tables created successfully!\n";
        echo "Your GODDAMN database setup completed!\n";
      } 
      catch (PDOException $e) {
        die("Database migration failed: " . $e->getMessage());
      }
    }
      
    private function createUsersTable() {
      $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        profile_picture VARCHAR(30),
        remember_token VARCHAR(100),
        token_expiry DateTime,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )";
      
      $this->pdo->exec($sql);
      echo "Users table created successfully!\n";
    }
      
    private function createCategoriesTable() {
      $sql = "CREATE TABLE IF NOT EXISTS categories (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        user_id INTEGER NULL,
        name VARCHAR(50) NOT NULL,
        description VARCHAR(100),
        monthly_budget INTEGER NOT NULL,
        color VARCHAR(10) NULL,
        icon VARCHAR(30) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        UNIQUE KEY unique_category_name (name, user_id)
      )";
      
      $this->pdo->exec($sql);
      echo "Categories table created successfully!\n";
    }
      
    private function createExpensesTable() {
      $sql = "CREATE TABLE IF NOT EXISTS expenses (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        user_id INTEGER NOT NULL,
        category_id INTEGER NOT NULL,
        payment_method_id INTEGER NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        description TEXT NOT NULL,
        expense_date DATE NOT NULL,
        status BOOLEAN DEFAULT TRUE,
        note VARCHAR (100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT,
        FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id) ON DELETE RESTRICT,
        INDEX idx_expense_date (expense_date),
        INDEX idx_user_date (user_id, expense_date)
      )";
      
      $this->pdo->exec($sql);
      echo "Expenses table created successfully!\n";
    }

    private function createPaymentMethodsTable() {
      $sql = "CREATE TABLE IF NOT EXISTS payment_methods (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        user_id INTEGER NULL,
        name VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        UNIQUE KEY unique_payment_method (name, user_id)
      )";

      $this->pdo->exec($sql);
      echo "Payment methods table created successfully!\n";
    }
      
    private function createBudgetsTable() {
      $sql = "CREATE TABLE IF NOT EXISTS budgets (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        user_id INTEGER NOT NULL,
        category_id INTEGER NULL,
        amount DECIMAL(10,2) NOT NULL,
        month_year DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
        UNIQUE KEY unique_budget (user_id, category_id, month_year)
      )";
      
      $this->pdo->exec($sql);
      echo "Budgets table created successfully!\n";
    }
      
    private function insertDefaultCategories() {
      $defaultCategories = [
        ['Food & Dining', 'Restaurants, groceries, and food delivery', 50000, '#EF4444', 'shopping-bag'],
        ['Transportation', 'Fuel, public transport, taxi, maintenance', 40000, '#F59E0B', 'truck'],
        ['Entertainment', 'Movies, games, concerts, hobbies', 20000, '#8B5CF6', 'film'],
        ['Utilities', 'Electricity, water, internet, phone bills', 10000, '#06B6D4', 'light-bulb'],
        ['Shopping', 'Clothing, electronics, personal items', 20000, '#EC4899', 'shopping-cart'],
        ['Healthcare', 'Medical, pharmacy, insurance', 40000, '#10B981', 'heart'],
        ['Education', 'Books, courses, tuition fees', 100000, '#6366F1', 'academic-cap'],
        ['Travel', 'Flights, hotels, vacation expenses', 20000, '#F97316', 'globe'],
        ['Bills & Payments', 'Rent, loan payments, subscriptions', 30000, '#84CC16', 'document-text'],
        ['Other', 'Miscellaneous expenses', 20000, '#6B7280', 'dots-circle-horizontal']
      ];
        
      $sql = "INSERT IGNORE INTO categories (name, description, monthly_budget, color, icon) VALUES (?, ?, ?, ?, ?)";
      $stmt = $this->pdo->prepare($sql);
      
      foreach ($defaultCategories as $category) {
        $stmt->execute($category);
      }
      echo "Default categories inserted\n";
    }

    private function insertDefaultPaymentMethods() {
      $defaultPaymentMethods = [
        ['Cash'],
        ['Card'],
        ['Digital Wallet'],
        ['Bank Transfer']
      ];

      $sql = "INSERT IGNORE INTO payment_methods (name) VALUES (?)";
      $stmt = $this->pdo->prepare($sql);

      foreach ($defaultPaymentMethods as $method) {
        $stmt->execute($method);
      }
      echo "Default payment methods inserted\n";
    }
      
    public function dropAllTables() {
      $tables = ['budgets', 'expenses', 'payment_methods', 'categories', 'users'];
      
      // Disable foreign key checks
      $this->pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
      
      foreach ($tables as $table) {
          $this->pdo->exec("DROP TABLE IF EXISTS $table");
          echo "Dropped table: $table\n";
      }
      
      // Re-enable foreign key checks
      $this->pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
      echo "All tables dropped successfully!\n";
    }
  }

  //run migration
  try {
    $dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4";
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $migration = new DatabaseMigration($pdo);
    
    // Check command line arguments
    if (isset($argv[1]) && $argv[1] === '--fresh') {
        echo "Fresh installation requested...\n";
        $migration->dropAllTables();
    }

    $migration->createTables();
  } 
  catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
  }
