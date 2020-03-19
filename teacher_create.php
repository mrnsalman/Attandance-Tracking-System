<?php
require 'db.php';
$message = '';
if (isset ($_POST['name'])  && isset($_POST['email']) ) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $department = $_POST['department'];
  $designation = $_POST['designation'];
  $sql = 'INSERT INTO teacher(name, email, department, designation) VALUES(:name, :email, :department, :designation)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email, ':department' => $department, ':designation' => $designation])) {
    $message = 'data inserted successfully';
  }
}
 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a teacher</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
          <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="department">Department</label>
          <input type="text" name="department" id="department" class="form-control">
          </div>
            <div class="form-group">
          <label for="designation">Designation</label>
          <input type="text" name="designation" id="designation" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a teacher</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>