<?php
$pid = $_GET["p"];
$sql = "SELECT * FROM producte";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=botiga;charset=utf8', 'jordi', 'thos');
	$sth = $dbh->prepare($sql);
	$sth->execute($data);
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
print_r($result);
?>

<div class="container">
	<aside class="fl">
		<div id="catboto">
			<button id="cat">
				<img id="caticon" src="img/menu.png"></img>
			</button>
		</div>
		<div id="categories" class="mostra">
			<h2>Categories</h2>
			<ul>
				<li>Ordinadors</li>
				<li>Portatils</li>
				<li>Ratolins</li>
				<li>Teclats</li>
				<li>Altaveus</li>
				<li>Auriculars</li>
			</ul>
		</div>
	</aside>
	<main>
		<div id="productes">
			<?php
			foreach ($result as $p) {
				echo "
				<div class='producte'>
					<a href='index.php?url=ProducteController/show&amp;p=$p[id]'>$p[nom]</a>
					<img src='productes/$p[imatge]'/>
					<p>$p[preu]€ (IVA Inclòs)</p>
					<button>Afegir al carretó</button>
				</div>";
			} ?>

		</div>
	</main>
</div>
<!-- <script type="text/javascript" src="js/productes.js"></script> -->