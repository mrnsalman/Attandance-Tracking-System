<?php
require 'db.php';
$message = '';
$id = $_GET['id'];
$sql = 'SELECT * FROM teacher WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['email']) ) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $department = $_POST['department'];
  $designation = $_POST['designation'];
  $sql = 'UPDATE teacher SET name=:name, email=:email, department=:department, designation=:designation WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email, ':department' => $department, ':designation' => $designation, ':id' => $id])) {
    $message = 'data updated successfully';
  }
}
 ?>
<?php require 'header.php'; ?>
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
<?php require 'footer.php'; ?>