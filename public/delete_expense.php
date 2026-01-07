<?php
  session_start();
  require_once __DIR__ . '/../src/bootstrap.php';
  require __DIR__.'/../src/helpers/flash.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnDeleteExpense'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM expenses WHERE id = :id");
    $stmt->execute([
      ":id" => $id
    ]);
    setFlash('success', 'Expense has been deleted!');
    header("Location: expense.php");
    exit;
  }

?>