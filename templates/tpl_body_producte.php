<!-- <script src="js/producte.js"></script> -->
<?php
$pid = $_GET["p"];
$sql = "SELECT * FROM producte WHERE id = $pid";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=botiga;charset=utf8','jordi', 'thos');
    $sth = $dbh->prepare($sql);
    $sth->execute($data);
    $result = $sth->fetch();
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
  $res = $result;

  print_r($res);

  $nom = $res['nom'];
  $descripcio = $res['descripcio'];
  $img = $res['imatge'];
  $preu = $res['preu'];
  $pes = $res['pes'];
  echo $img;

?>
<div id="single-product">
    <div id="productimg">
        <img class="prodimg" src="productes/<?php echo $img;?>">
    </div>
    <div id="productinfo">
        <h1><?php echo $nom;?></h1>
        <p><?php echo $preu;?></p>
        <button>Afegir al carretó</button>
    </div>

</div>

