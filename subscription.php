<?php

require_once 'includes/header.php';

?>

<section class="connection-container">
<div class="connection">
	<form action="./subscription.php" method="post">

		<h2>Inscription</h2>

		<?php
		if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) && isset( $_POST['confirm-password'] ) ) {
			compute_subscription( $_POST['username'], $_POST['password'], $_POST['confirm-password'] );
		}
		?>

		<div class="field">
			<label for="username">Nom d'utilisateur</label>
			<input type="text" name="username" id="username-input-creation" placeholder="Nom d'utilisateur" <?php display_input_value("username") ?>>
		</div>

		<div class="field">
			<label for="password">Mot de passe</label>
			<input type="password" name="password" id="password-input-creation" placeholder="Mot de passe">
		</div>

		<div class="field">
			<label for="confirm-password">Confirmation de mot de passe</label>
			<input type="password" name="confirm-password" id="confirm-password-input-creation" placeholder="Mot de passe">
		</div>

		<input type="submit" name="submit" id="submit-input-creation" value="S'incrire">

		<small>Vous avez déjà un compte ? <a href="./connection.php">Connectez-vous</a></small>
	</form>

</div>
</section>

<?php require_once 'includes/footer.php'; ?>
