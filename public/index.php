<?php
  include __DIR__ . '/../src/helpers/url.php';
  require_once __DIR__ . '/../src/helpers/isLoggedIn.php';
  require_once __DIR__ . '/../src/bootstrap.php';
  $title = "Home - MySpend";

  // last month total expenses
  $sql = "
    SELECT COALESCE(SUM(amount), 0) AS total
    FROM expenses
    WHERE expense_date >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m-01')
      AND expense_date <  DATE_FORMAT(CURRENT_DATE, '%Y-%m-01')
      AND user_id = :user_id
  ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':user_id' => $_SESSION['user_id']]);
  $lastMonthTotal = (float) $stmt->fetchColumn();

  // current month total expenses
  $stmt = $pdo->prepare("
    SELECT COALESCE(SUM(amount), 0) AS total_expenses
    FROM expenses
    WHERE MONTH(expense_date) = MONTH(CURRENT_DATE())
    AND YEAR(expense_date) = YEAR(CURRENT_DATE())
    AND user_id = :user_id
  ");
  $stmt->execute(['user_id' => $_SESSION['user_id']]);
  $totalExpenses = (float) $stmt->fetchColumn();
  $isUp = $totalExpenses >= $lastMonthTotal;
  $percent = $lastMonthTotal > 0 ? (($totalExpenses - $lastMonthTotal) / $lastMonthTotal) * 100 : ($totalExpenses > 0 ? 100 : 0);

  if (tableHasColumn($pdo, 'categories', 'user_id')) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories WHERE user_id IS NULL OR user_id = :user_id");
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
  } else {
    $stmt = $pdo->query("SELECT COUNT(*) FROM categories");
  }
  $categoriesCount = $stmt->fetchColumn();

  ob_start();
  include __DIR__ . '/../views/home/welcome-text-and-cards.php';
  include __DIR__ . '/../views/home/charts.php';
  include __DIR__ . '/../views/home/transactions-and-progress.php';

  $content = ob_get_clean();
  include __DIR__ . '/../views/components/layout.php';

?>
