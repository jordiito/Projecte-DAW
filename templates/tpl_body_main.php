<?php
if (isset($_GET['categoria']) && !isset($_GET['ordre'])) {
	$cate = $_GET['categoria'];
	$sql = "SELECT * FROM producte WHERE categoria = '$cate'";
} elseif (isset($_GET['ordre']) && !isset($_GET['categoria'])){
	$ordre = $_GET['ordre'];
	$sql = "SELECT * FROM producte ORDER BY $ordre";
	echo $_GET['ordre'];
} elseif (isset($_GET['ordre']) && isset($_GET['categoria'])){
	$cate = $_GET['categoria'];
	$ordre = $_GET['ordre'];
	$sql = "SELECT * FROM producte WHERE categoria = '$cate' ORDER BY $ordre";
} else {
	$sql = "SELECT * FROM producte";
}
try {
	$dbh = new PDO('mysql:host=localhost;dbname=botiga;charset=utf8', 'jordi', 'thos');
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$dbh=null;
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
print_r($_SESSION);
?>

<div class="container">
	<aside class="fl">

		<div id="categories" class="mostra">
			<h2>Filtres</h2>
			<form action="index.php" method="get">
				<h3>Categoria</h3>
				<input type="radio" id="ord" name="categoria" value="Sobretaula">
				<label for="ord">Sobretaula</label><br>
				<input type="radio" id="port" name="categoria" value="Portàtils">
				<label for="port">Portatils</label><br>
				<input type="radio" id="ratolins" name="categoria" value="Ratolins">
				<label for="ratolins">Ratolins</label><br>
				<input type="radio" id="teclats" name="categoria" value="Teclats">
				<label for="teclats">Teclats</label><br>
				<input type="radio" id="altaveus" name="categoria" value="Altaveus">
				<label for="altaveus">Altaveus</label><br>
				<input type="radio" id="auriculars" name="categoria" value="Auriculars">
				<label for="auriculars">Auriculars</label><br>
				<h3>Ordre</h3>
				<input type="radio" id="prb" name="ordre" value="preu desc">
				<label for="prb">Preu alt a baix</label><br>
				<input type="radio" id="pra" name="ordre" value="preu asc">
				<label for="pra">Preu baix a alt</label><br>
				<input type="radio" id="alfasc" name="ordre" value="marca asc, model asc">
				<label for="alfasc">Alfabètic (asc)</label><br>
				<input type="radio" id="alfdesc" name="ordre" value="marca desc, model desc">
				<label for="alfdesc">Alfabètic (desc)</label><br>
				<input type="submit">
			</form>
			<!-- <ul>
				<li>Ordinadors</li>
				<li>Portatils</li>
				<li>Ratolins</li>
				<li>Teclats</li>
				<li>Altaveus</li>
				<li>Auriculars</li>
			</ul> -->
		</div>
	</aside>
	<main>
		<div id="productes">
			<?php
			foreach ($result as $p) {
				echo "
				<div class='producte'>
					<a href='index.php?url=ProducteController/show&amp;p=$p[id]'><p>$p[marca] $p[model]</p>
					<img src='productes/$p[imatge]'/></a>
					<p>$p[preu]€ (IVA Inclòs)</p>
					<form action='?url=CarretoController/add' method='post'>
					<input type='hidden' name='img' value='$p[imatge]'/>
					<input type='hidden' name='nom' value='$p[marca] $p[model]'/>
					<input type='hidden' name='preu' value='$p[preu]'/>
					<button type='submit' name='add_to_cart' value='$p[id]'>Afegir al carretó</button>
					</form>
				</div>";
			} ?>

		</div>
	</main>
</div>
<!-- <script type="text/javascript" src="js/productes.js"></script> -->