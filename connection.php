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
			<label for="username">Username</label>
			<input type="text" name="username" id="username-input-creation" placeholder="Username">
		</div>

		<div class="field">
			<label for="password">Password</label>
			<input type="password" name="password" id="password-input-creation" placeholder="Password">
		</div>

		<input type="submit" name="submit" id="submit-input-creation" value="Inscription">

		<small>Vous n'avez pas encore de compte ? <a href="./subscription.php">Connectez-vous</a></small>
	</form>
	
</div>
</seciton>

<?php require_once 'includes/footer.php'; ?>
