<?php
session_start();

require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <h1>Carrito</h1>
    <?php
    if (!isset($_SESSION['cart']) || count($_SESSION['cart'])==0) {
        echo "Su carrito esta vacio";
    } else {
        $total=0;
    ?>
        <table>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
            </tr>

            <?php
            for ($i = 0; $i < count($_SESSION['cart']) / 2; $i++) {
                $products = $conn->prepare('SELECT * FROM caps_products WHERE id=' . $_SESSION['cart'][$i * 2]);
                $products->execute();
                $productsResults = $products->fetch(PDO::FETCH_ASSOC);
                $total = $total + $productsResults['precio']*$_SESSION['cart'][($i * 2)+1];
            ?>

                <tr>
                    <td><?php echo $productsResults['nombre']?></td>
                    <td><?php echo $productsResults['precio']?></td>
                    <td><?php echo $_SESSION['cart'][($i * 2)+1]?></td>
                    <td><?php echo $productsResults['precio']*$_SESSION['cart'][($i * 2)+1]?></td>
                    <td><a href="removeitem.php?id=<?php echo $_SESSION['cart'][$i * 2]?>"><button>Eliminar del carro</button></a></td>
                </tr>
        


    <?php
            }
        
            //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
    ?>
        </table>
    <h1>Precio total: <?php echo $total?></h1>
    <a href="comprar.php"><button>Pagar</button></a>
    
<?php
    }
?>


</body>

</html>