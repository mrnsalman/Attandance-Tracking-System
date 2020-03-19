<!doctype html>
<html lang="en">
  <head>
    <title>Attandence Tracker</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="test.css">
  </head>
    <body>
    <?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <?php $message = $error ?>
      <div class="alert alert-warning alert-dismissable fade show">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          <?php echo $message; ?>
        </div>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
        </body>
</html>