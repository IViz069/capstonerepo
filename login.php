<?php

session_start();

if (isset($_SESSION['user_id'])) {
  header('location:index.php');
}
require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM caps_login WHERE email = '$email' AND password = '$password'";

  $records = $conn->prepare($sql);

  $records->bindParam(':email', $_POST['email']);

  $records->execute();

  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if ( !($results ==null) && $_POST['password'] == $results['password']) {
    $_SESSION['user_id'] = $results['id'];
    header('location:index.php');
  } else {
    $message = 'Crendenciales incorrectas';
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Ingresar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

  <?php if (!empty($message)) : ?>
    <p> <?= $message ?></p>
  <?php endif; ?>

  <h1>Ingresar</h1>
  <span>or <a href="signup.php">Registrarse</a></span>

  <form action="login.php" method="POST">
    <input name="email" type="email" placeholder="Ingrese su correo">
    <input name="password" type="password" placeholder="Ingrese su contraseña">
    <input type="submit" value="Ingresar">
  </form>
</body>

</html>