<!-- <script src="js/producte.js"></script> -->
<?php
$pid = $_GET["p"];
$sql = "SELECT * FROM producte WHERE id = $pid";
try {
  $dbh = new PDO('mysql:host=localhost;dbname=botiga;charset=utf8', 'jordi', 'thos');
  $sth = $dbh->prepare($sql);
  $sth->execute();
  $result = $sth->fetch();
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
$res = $result;

//print_r($res);

$nom = $res['marca'] . " " . $res['model'];
$descripcio = $res['descripcio'];
$img = $res['imatge'];
$preu = $res['preu'];
$pes = $res['pes'];
// echo $img;

?>
<div id="single-product">
  <div id="productimg">
    <img class="prodimg" src="productes/<?php echo $img; ?>">
  </div>
  <div id="productinfo">
    <h1><?php echo $nom; ?></h1>
    <h3><?php echo $descripcio; ?></h3>
    <p class="preu"><?php echo $preu; ?>€</p>
    <form action="index.php?url=CarretoController/add" method="post">
      <input type="number" name="quantity" value="1" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
      <input type="hidden" name="product_id" value="<?= $pid ?>">
      <input type="submit" value="Add To Cart">
    </form>
  </div>

</div>