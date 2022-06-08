<?php
include_once "stripe-php/init.php";
include_once "config.php";
\Stripe\Stripe::setApiKey("sk_test_51L88NdJcxF7HsahsTJg6k3eTCwuLXMas7SS5gGldbXy4zpjBGowqWGddNV39PoP0VcGAiB8JZGaf94EOJwA9pWqJ00Yf0QwjW8");
$token = $_POST['stripeToken'];
session_start();
if (isset($_SESSION['loggedin'])) {
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
    
            $sql = "SELECT
                p.imatge,
                concat(p.marca, ' ', p.model) as nom,
                dc.quantitat,
                dc.preu,
                dc.subTotal
                FROM
                comanda AS c
                INNER JOIN detalls_comanda AS dc ON dc.comanda_id = c.id
                INNER JOIN producte AS p ON p.id = dc.producte_id
                WHERE
                c.id = '$lastId'";
    
            $sth = $dbh->prepare($sql);
            $sth->execute();
            //   $result = $sth->fetch(PDO::FETCH_ASSOC);
    
            unset($_SESSION['cart']);
            include 'templates/tpl_head.php';
            include 'templates/tpl_header.php';
    
    ?>
    
            <div id="resumCompra">
                <h1 class="text-center">Comanda completada amb exit!</h1>
                <h2 class="text-center">Resum de la compra</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Imatge</th>
                            <th>Nom</th>
                            <th>Quantitat</th>
                            <th>Preu</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <?php
                    $total = 0;
                    while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                        $total += ($row['quantitat'] * $row['subTotal']);
                    ?>
    
                        <tr>
                            <td><img src="productes/<?php echo $row['imatge'] ?>" /></td>
                            <td><?php echo $row['nom'] ?></td>
                            <td><?php echo $row['quantitat'] ?></td>
                            <td><?php echo $row['preu'] ?> €</td>
                            <td><?php echo $row['subTotal'] ?> €</td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="4" class="text-right">Total:</td>
                        <td><?php echo $total; ?> €</td>
                    </tr>
                </table>
            </div>
    <?php
    
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
} else {
    header("Location: index.php?url=UsuarioController/logIn");
    exit();
}

?>