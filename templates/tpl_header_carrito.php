<!--  <div class="logo">
	<logomenu>
	<ul>
		<li class="logo">Thos i Codina</li>
		<li>M07</li>
		<li>UF1</li>
		<li>2021-2022</li>
	</ul>
	</logomenu>
	<infosmenu>
	<ul>
		<a href='?url=ContactController/show'>
			<li><?php echo $mainContacta;?></li>
		</a>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE ) {
?>
		<a href='?url=UsuarioController/logout'>
			<img src="<?php echo $_SESSION['img'];?>" alt="imatge de l'usuari" width="50" height="50" >
		</a>
<?php 
} else {
?>
		<a href='?url=UsuarioController/login'>
			<li class="btn"><?php echo $mainLog_in;?></li>
		</a>
<?php 
}
?>

	</ul>
	</infosmenu>
</div>
-->

        <div id="carrito">
            <p>(1) Producte al carretó</p>
            <table id="taulacarreto">
                <tbody>
                    <tr id="producteid">
                        <td>
                            <img src="productes/1.jpg" class="imgCarreto" />
                        </td>
                        <td>
                            <span>Ordinador portatil</span>
                        </td>
                        <td>
                            <input name="nom" id="producteid" type="number" min="0" value="0" />
                        </td>
                        <td>
                            <span>999,99€</span>
                        </td>
                    </tr>
                    <tr id="producteid">
                        <td>
                            <img src="productes/1.jpg" class="imgCarreto" />
                        </td>
                        <td>
                            <span>Ordinador portatil</span>
                        </td>
                        <td>
                            <input name="nom" id="producteid" type="number" min="0" value="0" />
                        </td>
                        <td>
                            <span>999,99€</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>