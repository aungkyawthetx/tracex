<?php
require __DIR__ . '/../src/helpers/url.php';
require __DIR__ . '/../src/helpers/flash.php';
require_once __DIR__ . '/../src/helpers/isLoggedIn.php';
require_once __DIR__ . '/../src/bootstrap.php';

$title = "Savings - MySpend";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveSaving'])) {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $targetAmount = $_POST['target_amount'] ?? '';
    $startDate = trim($_POST['start_date'] ?? '');
    $targetDate = trim($_POST['target_date'] ?? '');
    $status = trim($_POST['status'] ?? 'active');

    if ($name === '') {
        $errors['name'] = 'Saving name is required.';
    }
    if (!is_numeric($targetAmount) || (float) $targetAmount <= 0) {
        $errors['target_amount'] = 'Target amount must be greater than zero.';
    }
    if ($startDate !== '' && strtotime($startDate) === false) {
        $errors['start_date'] = 'Invalid start date.';
    }
    if ($targetDate !== '' && strtotime($targetDate) === false) {
        $errors['target_date'] = 'Invalid target date.';
    }
    if ($startDate !== '' && $targetDate !== '' && strtotime($targetDate) < strtotime($startDate)) {
        $errors['target_date'] = 'Target date must be after start date.';
    }

    $allowedStatuses = ['active', 'completed', 'cancelled'];
    if (!in_array($status, $allowedStatuses, true)) {
        $status = 'active';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO savings (user_id, name, description, target_amount, start_date, target_date, status)
            VALUES (:user_id, :name, :description, :target_amount, :start_date, :target_date, :status)
        ");
        $stmt->execute([
            ':user_id' => $_SESSION['user_id'],
            ':name' => $name,
            ':description' => $description !== '' ? $description : null,
            ':target_amount' => (float) $targetAmount,
            ':start_date' => $startDate !== '' ? $startDate : null,
            ':target_date' => $targetDate !== '' ? $targetDate : null,
            ':status' => $status,
        ]);

        setFlash('success', 'Saving has been added!');
        header("Location: saving.php");
        exit;
    }

    setFlash('error', array_values($errors)[0]);
    header("Location: saving.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateSaving'])) {
    $id = isset($_POST['edit_saving_id']) ? (int) $_POST['edit_saving_id'] : 0;
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $targetAmount = $_POST['target_amount'] ?? '';
    $startDate = trim($_POST['start_date'] ?? '');
    $targetDate = trim($_POST['target_date'] ?? '');
    $status = trim($_POST['status'] ?? 'active');

    if ($id <= 0) {
        $errors['id'] = 'Invalid saving ID.';
    }
    if ($name === '') {
        $errors['name'] = 'Saving name is required.';
    }
    if (!is_numeric($targetAmount) || (float) $targetAmount <= 0) {
        $errors['target_amount'] = 'Target amount must be greater than zero.';
    }
    if ($startDate !== '' && strtotime($startDate) === false) {
        $errors['start_date'] = 'Invalid start date.';
    }
    if ($targetDate !== '' && strtotime($targetDate) === false) {
        $errors['target_date'] = 'Invalid target date.';
    }
    if ($startDate !== '' && $targetDate !== '' && strtotime($targetDate) < strtotime($startDate)) {
        $errors['target_date'] = 'Target date must be after start date.';
    }

    $allowedStatuses = ['active', 'completed', 'cancelled'];
    if (!in_array($status, $allowedStatuses, true)) {
        $status = 'active';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("
            UPDATE savings
            SET name = :name,
                description = :description,
                target_amount = :target_amount,
                start_date = :start_date,
                target_date = :target_date,
                status = :status
            WHERE id = :id AND user_id = :user_id
        ");
        $stmt->execute([
            ':id' => $id,
            ':user_id' => $_SESSION['user_id'],
            ':name' => $name,
            ':description' => $description !== '' ? $description : null,
            ':target_amount' => (float) $targetAmount,
            ':start_date' => $startDate !== '' ? $startDate : null,
            ':target_date' => $targetDate !== '' ? $targetDate : null,
            ':status' => $status,
        ]);

        if ($stmt->rowCount() === 0) {
            setFlash('error', 'Saving not found or access denied.');
            header("Location: saving.php");
            exit;
        }

        setFlash('success', 'Saving has been updated!');
        header("Location: saving.php");
        exit;
    }

    setFlash('error', array_values($errors)[0]);
    header("Location: saving.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnDeleteSaving'])) {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    if ($id <= 0) {
        setFlash('error', 'Invalid saving ID.');
        header("Location: saving.php");
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM savings WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        ':id' => $id,
        ':user_id' => $_SESSION['user_id'],
    ]);

    if ($stmt->rowCount() === 0) {
        setFlash('error', 'Saving not found or access denied.');
        header("Location: saving.php");
        exit;
    }

    setFlash('success', 'Saving has been deleted!');
    header("Location: saving.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT
        s.*,
        COALESCE(SUM(CASE WHEN st.type = 'deposit' THEN st.amount ELSE -st.amount END), 0) AS current_amount
    FROM savings s
    LEFT JOIN saving_transactions st ON st.saving_id = s.id
    WHERE s.user_id = :user_id
    GROUP BY s.id
    ORDER BY s.created_at DESC, s.id DESC
");
$stmt->execute([':user_id' => $_SESSION['user_id']]);
$savings = $stmt->fetchAll(PDO::FETCH_ASSOC);

ob_start();
include __DIR__ . '/../views/savings/saving-view.php';
$content = ob_get_clean();
include __DIR__ . '/../views/components/layout.php';

$flash = getFlash();
if ($flash):
?>
<script>
  Swal.fire({
    toast: true,
    position: "top-end",
    icon: "<?= $flash['type'] ?>",
    title: <?= json_encode($flash['message']) ?>,
    showConfirmButton: false,
    timer: 1500,
    width: "500px",
    timerProgressBar: true
  });
</script>
<?php endif; ?>
