
<div class="rg-container">
	<main>
		<div class="content">
			<div class="grid">
				<div class="winfoo">
					<h1 class="title">Compte</h1>
					<form action="?url=UsuarioController/logout" method="post"
						target=_blank">
						<input type="submit" name="Logout" value="Sortir" class="btn">
					</form>


					<form id="msform" action="?url=UsuarioController/logout"
						method="post" autocomplete="off" enctype="multipart/form-data">
						<!-- fieldsets -->
						<input type="hidden" id="email" name="email"
							value="<?php echo $frmEmail;?>" /> <label id="email"><?php echo $frmEmail;?></label><br>
						<span class="error"> <?php echo (isset($errorsDetectats["baseDades"]))?$errorsDetectats["baseDades"]:"";?> </span><br>
						<span class="error"> <?php echo (isset($errorsDetectats["error"]))?$errorsDetectats["error"]:"";?> </span><br>
						<h4>Les meves dades:</h4>
						<label class="center">Nom:</label>
				<?php   echo $input_nom . "<br>";?>
						<label class="center">Cognoms:</label>
				<?php  echo $input_cognoms . "<br>";?>
						<label>Sexe: </label>
				<?php  echo "<div id='homeDona'>$select_Sexe</div>" . "<br>";?>
					<label class="center">Data de naixement:</label>
				<?php  echo $input_naixement . "<br>";?>

			<label class="center">Pais:</label>
			<?php echo $input_pais . "<br>";?>
					<label class="center">Adreca:</label>
			<?php echo $input_adreca . "<br>";?>
					<label class="center">C.P.:</label>
			<?php echo $input_cp . "<br>";?>
					<label class="center">Poblacio:</label>
			<?php echo $input_poblacio . "<br>";?>
					<label class="center">Provincia:</label>
			<?php echo $input_provincia . "<br>";?>
					<label class="center">Teléfon:</label>
			<?php echo $input_telefon . "<br>";?>
			<?php echo $input_bSend . "<br>";?>

	</form>

					<form id="msform" action="?url=UsuarioController/logout"
						method="post" autocomplete="off" enctype="multipart/form-data">
						<input type="hidden" id="pass0" name="pass0"
							value="<?php echo $frmPass;?>" /> <input type="hidden" id="email"
							name="email" value="<?php echo $frmEmail;?>" />
						<h4>Canvi del password:</h4>
    <?php echo $input_pass . "<br>"; ?>
    <?php echo $input_cpass . "<br><br>";  ?>
    <input type="submit" name="changeContra" value="Guardar" />
					</form>
				</div>

			</div>
		</div>
	</main>
</div>