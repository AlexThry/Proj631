<?php

require_once 'functions.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Readable</title>
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="page-<?php echo get_url_basename(); ?>">
	<main>
		<div class="page-container">
			<header class="header">
				<div class="header-menu left-part">
					<a href="<?php echo get_home_url(); ?>" class="homepage-link">
						<img src="assets/images/logo.png" alt="Readable">
						<h1>Readable</h1>
					</a>
				</div>

				<?php if(!current_user()): ?>

					<!-- DISCONNECTED USER -->
					<div class="header-menu right-part">
						<div class="btn signup">
							<a href="subscription.php">Inscription</a>
						</div>

						<div class="btn login">
							<a href="connection.php">Connexion</a>
						</div>
					</div>

				<?php else: ?>

					<!-- CONNECTED USER -->
					<div class="header-menu right-part">
						<h1><?php echo current_user()->getname() ?></h1>
						<a href="account.php">
							<img src="assets/images/account.svg" alt="Mon compte">
						</a>
						<a href="logout.php">
							<img src="assets/images/logout.svg" alt="Se déconnecter">
						</a>
					</div>

				<?php endif; ?>
			</header>


