<?php

require_once 'includes/header.php';

?>

<seciton class="connection-container">
<div class="connection">
	<form action="./connection.php" method="post">

		<h2>Connexion</h2>

		<?php
		if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
			compute_connection( $_POST['username'], $_POST['password'] );
		}
		?>

		<div class="field">
			<label for="username">Nom d'utilisateur</label>
			<input type="text" name="username" id="username-input-creation" placeholder="Nom d'utilisateur" <?php input_value("username") ?> >
		</div>

		<div class="field">
			<label for="password">Mot de passe</label>
			<input type="password" name="password" id="password-input-creation" placeholder="Mot de passe">
		</div>

		<input type="submit" name="submit" id="submit-input-creation" value="Inscription">

		<small>Vous n'avez pas encore de compte ? <a href="./subscription.php">Inscrivez-vous</a></small>
	</form>

</div>
</seciton>

<?php require_once 'includes/footer.php'; ?>
