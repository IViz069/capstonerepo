<?php 

    require 'braintree_php-master/lib/Braintree.php';

    $gateway = new Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => '9r5qj2rbsj8yf8mw',
        'publicKey' => '9qqxznsc4frp8tmh',
        'privateKey' => '9588f39d4a0a15d1791d701012eed4d3'
      ]);

    $clientToken = $gateway->clientToken()->generate(); 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://js.braintreegateway.com/js/braintree-2.31.0.min.js"></script>
    <script>
        braintree.setup('<?php echo $clientToken ?>', 'dropin', { container: 'dropin-container' });
    </script>
    <title>Pagar</title>
</head>

<body>

    <form id="realizarPago" action="pay.php" method="POST">
        <div>
            <h3>Datos de envio</h3>
            <input type="text" placeholder="Direccion">
            <input type="text" placeholder="Piso">
            <input type="text" placeholder="Numero de telefono">
        </div>
        <div>
            <h3>Metodo de pago</h3>
            <select onclick="selct()" id="selll">
                <option value="" selected disabled hidden>Metodo de pago</option>
                <option>Tarjeta</option>
                <option>Contraentrega</option>
                <option>Deposito</option>

            </select>

        </div>
        <div hidden id="dataCard">
            <div id="dropin-container">
            <h3>Datos de tarjeta</h3>
            <input type="text"  id="firstName" name="firstName" placeholder="Nombre">
            <input type="text"  id="lastName" name="lastName" placeholder="Apellido">
        </div>

        <input type="submit" value="Confirmar compra" onclick="return confirm('Estas seguro de confirmar la compra?')">

        </div>
    </form>
    <script>
        var dt = new Date();
        currentYear = dt.getFullYear();

        var selectYear = document.getElementById('expireYY');
        var selectMonth = document.getElementById('expireMM');

        for (var i = 1; i <= 12; i++) {
            var opt = document.createElement('option');
            opt.value = i;
            opt.innerHTML = i;
            selectMonth.appendChild(opt);
        }

        for (var i = currentYear - 5; i <= currentYear + 5; i++) {
            var opt = document.createElement('option');
            opt.value = i;
            opt.innerHTML = i;
            selectYear.appendChild(opt);
        }

        function geek() {
            confirm("Esta seguro de confirmar la compra");
        }

        function selct() {
            if (document.getElementById("selll").value == "Tarjeta") {
                document.getElementById("dataCard").hidden = false;
            } else {
                document.getElementById("dataCard").hidden = true;
            }
        }
    </script>
</body>

</html>