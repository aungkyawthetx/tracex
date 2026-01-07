<?php
  session_start();
  require_once __DIR__ . '/../src/bootstrap.php';
  require __DIR__.'/../src/helpers/flash.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateExpense'])) {
    $id = $_POST['edit_expense_id'] ?? null;
    if (!$id) {
      die('Invalid expense ID');
    }
    $date = $_POST['expense_date'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $payment_method = $_POST['payment_method'];
    $note = $_POST['note'];
    $status = isset($_POST['paid']) ? 1 : 0;

    $stmt = $pdo->prepare("
      UPDATE expenses 
        SET expense_date = :expense_date,
          amount = :amount,
          description = :description,
          category_id = :category_id,
          payment_method = :payment_method,
          note = :note,
          status = :status
        WHERE id = :id
    ");
    $stmt->execute([
      ':expense_date' => $date,
      ':amount' => $amount,
      ':description' => $description,
      ':category_id' => $category_id,
      ':payment_method' => $payment_method,
      ':note' => $note,
      ':status' => $status,
      ':id' => $id
    ]);
    setFlash('success', 'Expense has been updated!');
    header("Location: expenses.php");
    exit;
  }

?>