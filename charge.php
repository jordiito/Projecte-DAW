<?php
include_once "stripe-php/init.php";
include_once "config.php";
\Stripe\Stripe::setApiKey("sk_test_51L88NdJcxF7HsahsTJg6k3eTCwuLXMas7SS5gGldbXy4zpjBGowqWGddNV39PoP0VcGAiB8JZGaf94EOJwA9pWqJ00Yf0QwjW8");
$token = $_POST['stripeToken'];
session_start();
$productoscarrito = $_SESSION['cart'];
$total = 0;
foreach ($productoscarrito as $prod) {
    $total += ($prod['product_price'] * $prod['product_qty']);
}
$totalConvertit = $total * 100;
$charge = \Stripe\Charge::create([
    'amount' => "$totalConvertit",
    'currency' => 'eur',
    'description' => 'Pago a PCBuilds',
    'source' => $token
]);
if ($charge['captured']) {
    try {
        $sql = "INSERT INTO comanda (user_id, pagament_id) VALUES ('$_SESSION[user_id]','$charge[id]');";
        $dbh = new PDO('mysql:host=localhost;dbname=botiga;charset=utf8', 'jordi', 'thos');
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetch();
        $lastId = $dbh->lastInsertId();
        $productoscarrito = $_SESSION['cart'];
        foreach ($productoscarrito as $prod) {
            $subTotal = ($prod['product_price'] * $prod['product_qty']);
            $sql = "INSERT INTO detalls_comanda (producte_id, comanda_id, quantitat, preu, subTotal) VALUES ('$prod[product_id]', '$lastId', '$prod[product_qty]', '$prod[product_price]', '$subTotal');";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $result = $sth->fetch();
        }
        $dbh = null;
        unset($_SESSION['cart']);

        include 'templates/tpl_head.php';
        include 'templates/tpl_header.php';
        function muestraDetalle($idVenta)
        {
        }
        include 'templates/tpl_footer.php';
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>