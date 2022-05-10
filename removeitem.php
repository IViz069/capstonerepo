<?php
    session_start();

    require 'database.php';


    function removeFromCart($id){
        $temp = [];
        for($i=0;$i<count($_SESSION['cart'])/2;$i++){
            if($_SESSION['cart'][$i*2]==$id){

            }
            else{
                array_push($temp, $_SESSION['cart'][$i*2], $_SESSION['cart'][($i*2)+1]);
            }
        }
        return $temp;
    }

    $_SESSION['cart'] = removeFromCart(htmlspecialchars($_GET["id"]));

    header('location:cart.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>