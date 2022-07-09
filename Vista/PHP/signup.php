<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['user']) && !empty($_POST['password'])) {
    $sql = "call sp_InsertarLogin(:user, :password, '2020-07-08', 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user', $_POST['user']);
    //$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $_POST['password']);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../VENDOR/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/stylelogin.css">
  </head>
  <body>
    <?php if(!empty($message)): ?>
      <div class="alert alert-warning" role="alert">
        <?= $message ?>
      </div>
    <?php endif; ?>
    
    <section>
    <div class="form-body">
        <!--<div class="row"> -->
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Registrate</h3>
                        <p>Completa los campos.</p>
                        
                        <form action="signup.php" method="POST" class="requires-validation" novalidate>

                            <div class="col-md-12">
                               <input class="form-control" type="text" name="user" placeholder="Username" required>
                            </div>              

                           <div class="col-md-12">
                              <input class="form-control" type="password" name="password" placeholder="Password" required>
                           </div>

                           <div class="col-md-12">
                              <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" required>
                           </div>                     

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary">Registrate!</button>
                                <span style="color: white;">or <a href="login.php">Login</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!--</div> -->
    </div>
    </section>

  </body>
</html>
