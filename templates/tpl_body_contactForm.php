<div class="rg-container">
	<main>
		<div class="winfooo">
			<h1 class="title"><?php echo (isset($contacteForm))?$contacteForm:"";?></h1>
			<p class="description"><?php echo (isset($missatgeOK))?$missatgeOK:"";?></p>

			<form action="?url=ContactFormController/show" method="post"
				target=_blank">
				<label for="nom">Nom: </label><br> <input id="nom" type="text"
					name="nom" placeholder="Nom"
					value="<?php echo (isset($frmNom))?$frmNom:""; ?>"> <br> <span
					class="error"><?php echo (isset($errors["nom"]))?$errors["nom"]:"";?></span>
				<br> <label for="email">Email: </label><br> <input id="email"
					type="text" name="email" placeholder="Email"
					value="<?php echo (isset($frmMail))?$frmMail:""; ?>"><br> <span
					class="error"><?php echo (isset($errors["mail"]))?$errors["mail"]:"";?></span>
				<br> <label for="missatge">Missatges: </label><br>
				<textarea id="missatge" name="missatge" placeholder="Missages" cols='43' rows='10'><?php echo (isset($frmMsg))?$frmMsg:""; ?></textarea>
				<span class="error"><?php echo (isset($errors["missatge"]))?$errors["missatge"]:"";?></span>
				<br> <input type="submit" name="boto" value="Enviar" class="btn">
			</form>


		</div>

	</main>
</div>