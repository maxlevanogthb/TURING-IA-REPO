<?php

  session_start();

  //if (isset($_SESSION['user_id'])) {
    //header('Location: /php-login');
  //}
  require 'database.php';

  if (!empty($_POST['user']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT idLogin, nombreLogin, claveLogin FROM Login WHERE nombreLogin = :id');
    $records->bindParam(':id', $_POST['user']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';
    
    if (count($results) > 0 && ($_POST['password'] === $results['claveLogin'])) {
      
      $_SESSION['user_id'] = $results['nombreLogin'];
      header("Location: CRUDProyectos/proyectoInicio.php");
    } else {
      //echo $results['claveLogin'];
      //echo $_POST['password'];
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/style.css">
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
                        <h3>Inicia Sesion</h3>
                        <p>Completa los campos.</p>
                        <form action="login.php" method="POST" class="requires-validation" novalidate>

                            <div class="col-md-12">
                               <input class="form-control" type="text" name="user" placeholder="Username" required>
                               <div class="invalid-feedback">Username field cannot be blank!</div>
                            </div>              

                           <div class="col-md-12">
                              <input class="form-control" type="password" name="password" placeholder="Password" required>
                               <div class="invalid-feedback">Password field cannot be blank!</div>
                           </div>                  

                            <div class="form-button mt-4">
                                <button id="submit" type="submit" class="btn btn-primary">Ingresa</button>
                                <span class="_kc_span" style="color: white;">or <a href="signup.php">SignUp</a></span>
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
