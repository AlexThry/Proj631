<?php

require_once 'includes/header.php';

?>

<seciton class="connection-container">
<div class="connection">
	<form action="./inscription.php" method="post">

		<h2>Inscription</h2>

		<?php
		if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) && isset( $_POST['confirm-password'] ) ) {
			compute_subscription( $_POST['username'], $_POST['password'], $_POST['confirm-password'] );
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

		<div class="field">
			<label for="confirm-password">Confirm</label>
			<input type="password" name="confirm-password" id="confirm-password-input-creation" placeholder="Confirm password">
		</div>
  
		<input type="submit" name="submit" id="submit-input-creation" value="Inscription">

		<small>Vous avez déjà un compte ? <a href="./connection.php">Connectez-vous</a></small>
	</form>
	
</div>
</seciton>

<?php require_once 'includes/footer.php'; ?>
