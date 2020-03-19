<?php
require 'db.php';
$message = '';
$id = $_GET['id'];
$sql = 'DELETE FROM teacher WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) {
  $message = 'Teacher deleted successfully';
}
?>
<?php require 'header.php'; ?>
<div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
    <?php endif; ?>
<?php require 'footer.php'; ?>