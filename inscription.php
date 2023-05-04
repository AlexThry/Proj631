<?php require_once("includes/header.php"); ?>

<div class="connection">
	<form action="./creation_compte.php" method="post">
		<input type="text" name="username" id="username-input-creation" placeholder="Username">
		<input type="text" name="password" id="password-input-creation" placeholder="Password">
		<input type="text" name="confirm-password" id="confirm-password-input-creation" placeholder="Confirm password">
		<input type="submit" name="submit" id="submit-input-creation" value="Créer mon compte">
	</form>
	
	<?php 
		error_reporting(E_ALL); 
		ini_set("display_errors", 1);
		$conn = new mysqli('localhost', 'root', '');
		if (!$conn) {
			echo "Erreur de connexion : " . mysqli_connect_error();
		}
		mysqli_query($conn, "USE Proj631");
		$username = $_POST["username"];
		$date = date("Y-m-d");
		if ($_POST["password"] == $_POST["confirm-password"]) {
			$password = $_POST["password"];
		} else {
			echo "<span id='password-error'>Les mots de passe ne correspondent pas.</span>";
		}
		if ($password) {
			
			$sql = "INSERT INTO user (user_name, password, creation_date) VALUES ('" . $username . "','" . $password . "','" . $date . "')";
			if (mysqli_query($conn, $sql)) {
				echo "<span id='user-added'>Vous avez créé votre compte.</span>";
			} else {
				echo "<span id='error-adding-user'>Erreur lors de l'inscription.</span>";
			}
		}
		?>
	</div>

<?php require_once("includes/footer.php"); ?>