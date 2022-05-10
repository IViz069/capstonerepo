<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `caps_login` (`id`, `email`, `password`) VALUES (NULL, '$email', '$password')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $_POST['password']);

    if ($stmt->execute()) {
      $message = 'Se registro correctamente';
      header('location:login.php');
    } else {
      $message = 'Ocurrio un error creando la cuenta';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrarse</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/style.css">
    
    
  </head>
  <body>
    <script>
      var check = function() {
        if (document.getElementById('password').value ==document.getElementById('confirm_password').value) {
          document.getElementById('butt').disabled=false;
          document.getElementById('butt').style.backgroundColor = 'green';
          document.getElementById('message').innerHTML = '';
        } else {
          document.getElementById('butt').disabled=true;
          document.getElementById('butt').style.backgroundColor = 'red';
          document.getElementById('message').style.color = 'red';
          document.getElementById('message').innerHTML = 'Contraseñas no coinciden';
        }
      }
    </script>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    

    <h1>Registrarse</h1>
    <span>or <a href="login.php">Ingresar</a></span>
      <div class="container">
        <form action="signup.php" method="POST">
        <input class="form-control " name="email" type="email" placeholder="Ingrese su correo" required="required">
        <input minlength="10" id="password" name="password" type="password" placeholder="Ingrese su contraseña" onkeyup='check();'>
        <input minlength="10" id="confirm_password" name="confirm_password" type="password" placeholder="Confirme su contraseña" onkeyup='check();'>
        <input id="butt" type="submit" value="Registrarse" disabled="true" >
        </form>
      </div>


    <p id="message"></p>

  </body>
</html>
