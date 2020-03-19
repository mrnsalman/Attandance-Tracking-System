<?php
require 'db.php';
$sql = 'SELECT * FROM teacher';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All teachers</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Name</th>
          <th>Email</th>
            <th>Department</th>
        </tr>
        <?php foreach($people as $person): ?>
          <tr>
            <td><?= $person->myusername; ?></td>
            <td><?= $person->mypassword; ?></td>
            <td><?= $person->sub; ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>