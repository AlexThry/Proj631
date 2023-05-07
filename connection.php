<?php

require_once 'includes/header.php';

?>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
	<h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Connexion</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
	<form class="space-y-6" action="./connection.php" method="POST">
		<?php
		if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
			compute_connection( $_POST['username'], $_POST['password'] );
		}
		?>

	  <div>
		<label for="username" class="block text-sm font-medium leading-6 text-gray-900">Nom d'utilisateur</label>
		<div class="mt-2">
		  <input type="text" name="username" id="username-input-creation" placeholder="Nom d'utilisateur" required autocomplete="false" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
		</div>
	  </div>

	  <div>
		<div class="flex items-center justify-between">
		  <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
		  <div class="text-sm">
			<a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Mot de passe oublié?</a>
		  </div>
		</div>
		<div class="mt-2">
		  <input <?php display_input_value( 'username' ); ?> type="password" name="password" id="password-input-creation" placeholder="Mot de passe" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
		</div>
	  </div>

	  <div>
		<button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
	  </div>
	</form>

	<p class="mt-10 text-center text-sm text-gray-500">
		Vous n'avez pas encore de compte ?
	  <a href="./subscription.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Inscrivez-vous</a>
	</p>
  </div>
</div>

<?php require_once 'includes/footer.php'; ?>
