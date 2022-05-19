
<div class="rg-container">
	<main>

		<!-- multistep form -->
		<form id="msform" action="?url=UsuarioController/register"
			method="post" autocomplete="off" enctype="multipart/form-data">
			<!-- fieldsets -->

			<h2 class="fs-title">Crea el teu compte d'usuari</h2>
			<span class="error"> <?php echo (isset($errorsDetectats["error"]))?$errorsDetectats["error"]:"";?> </span><br>
				<?php
    echo $input_email . "<br>";
    echo $input_pass . "<br>";
    echo $input_cpass . "<br>";
    ?>

				<?php
    echo $input_nom . "<br>";
    echo $input_cognoms . "<br>";
    echo "<div id='homeDona'>$select_Sexe</div>" . "<br>";
    echo $input_naixement . "<br>";
    ?>

			<?php
echo $input_pais . "<br>";
echo $input_adreca . "<br>";
echo $input_cp . "<br>";
echo $input_poblacio . "<br>";
echo $input_provincia . "<br>";
echo $input_telefon . "<br>";
?>
			<?php
echo $input_bSend . "<br>";
?>

	</form>
		<script src="js/index.js"></script>
	</main>
</div>