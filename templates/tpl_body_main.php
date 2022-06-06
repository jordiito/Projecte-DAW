<?php
if (isset($_GET['categoria'])) {
	$cate = $_GET['categoria'];
	$sql = "SELECT * FROM producte WHERE categoria = '$cate'";
	echo $_GET['categoria'];
} else {
	$sql = "SELECT * FROM producte";
}
try {
	$dbh = new PDO('mysql:host=localhost;dbname=botiga;charset=utf8', 'jordi', 'thos');
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}

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
			<form action="index.php" method="get">
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
				<input type="radio" id="pra" name="preu" value="Alt">
				<label for="pra">Preu alt</label><br>
				<input type="radio" id="prb" name="preu" value="Baix">
				<label for="prb">Preu baix</label><br>
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