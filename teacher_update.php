<?php
require 'db.php';
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
  $id = $_POST['id'];
  $sql = 'UPDATE teacher SET name=:name, email=:email, department=:department, designation=:designation WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email, ':department' => $department, ':designation' => $designation, ':id' => $id])) {
    header("Location: teacher_edit_final.php");
  }
}
 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update Teacher</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form action= "teacher_edit_final.php?id=<?= $person->id ?>"  method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input value="<?= $person->name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
        </div>
          <div class="form-group">
          <label for="department">Department</label>
          <input value="<?= $person->department; ?>" type="text" name="department" id="department" class="form-control">
        </div>
          <div class="form-group">
          <label for="designation">Designation</label>
          <input value="<?= $person->designation; ?>" type="text" name="designation" id="designation" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" value="<?= $person->id ?>" class="btn btn-info">Update Teacher</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>