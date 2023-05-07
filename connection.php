<?php

require_once 'includes/header.php';

?>

<div class="bg-white dark:bg-gray-800 flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
	<h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 dark:text-white">Connexion</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
	<form class="space-y-6" action="./connection.php" method="POST">
		<?php
		if ( isset( $_POST['connection-username'] ) && isset( $_POST['connection-password'] ) ) {
			compute_connection( $_POST['connection-username'], $_POST['connection-password'] );
		}
		?>

	  <div>
		<label for="connection-username" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Nom d'utilisateur</label>
		<div class="mt-2">
		  <input  <?php display_input_value( 'username' ); ?>  type="text" name="connection-username" id="connection-username-input-creation" placeholder="Nom d'utilisateur" required autocomplete="off" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
		</div>
	  </div>

	  <div>
		<div class="flex items-center justify-between">
		  <label for="connection-password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Mot de passe</label>
		  <div class="text-sm">
			<a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-primary-500">Mot de passe oublié?</a>
		  </div>
		</div>
		<div class="mt-2">
		  <input type="password" name="connection-password" id="connection-password-input-creation" placeholder="Mot de passe" autocomplete="current-connection-password" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
		</div>
	  </div>

	  <div>
		<button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Se connecter</button>
	  </div>
	</form>

	<p class="mt-10 text-center text-sm text-gray-500">
		Vous n'avez pas encore de compte ?
	  <a href="./subscription.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500 dark:text-primary-500">Inscrivez-vous</a>
	</p>
  </div>
</div>

<?php require_once 'includes/footer.php'; ?>
