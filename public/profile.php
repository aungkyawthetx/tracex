<?php
  include __DIR__ . '/../src/helpers/url.php';
  require_once __DIR__ . '/../src/helpers/isLoggedIn.php';
  require_once __DIR__ . '/../src/bootstrap.php';
  $title = "Account";

  $updateErrors = [];
  // get login user
  $user_id = $_SESSION['user_id'] ?? null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateProfile'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($name === '') {
      $updateErrors['name'] = 'Name is required.';
    }

    if ($email === '') {
      $updateErrors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $updateErrors['email'] = 'Invalid email format.';
    } else {
      $emailCheckStmt = $pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1");
      $emailCheckStmt->execute([
        ':email' => $email,
        ':id' => $user_id
      ]);
      if ($emailCheckStmt->fetchColumn()) {
        $updateErrors['email'] = 'Email is already in use.';
      }
    }

    if (empty($updateErrors)) {
      $updateStmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
      $updateStmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':id' => $user_id
      ]);

      $_SESSION['user_name'] = $name;
      $_SESSION['user_email'] = $email;
      header("Location: profile.php");
      exit;
    }
  }

  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
  $stmt->execute([':user_id' => $user_id]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $editMode = isset($_GET['edit']);

  ob_start();
?>

<div class="flex-1">
  <?php include __DIR__ . '/../views/profile/heading.php'; ?>
  <div class="max-w-6xl mx-auto space-y-6">
    <?php 
      include __DIR__ . '/../views/profile/profile-card.php';
      include __DIR__ . '/../views/profile/account-settings.php';
      include __DIR__ . '/../views/profile/statistics.php';
    ?>
  </div>
</div>

<?php
  $content = ob_get_clean();
  include __DIR__ . '/../views/components/layout.php';
?>
