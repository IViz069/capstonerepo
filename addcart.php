<?php
    require 'database.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('location:login.php');
    }else{
        $_SESSION['cart'][] = htmlspecialchars($_GET["id"]);
        $_SESSION['cart'][] = $_POST['cant'];

        header('location:cart.php');
    }

?>