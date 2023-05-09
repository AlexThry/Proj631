<?php
/**
 * Contains de subscription page
 */

require_once 'includes/header.php';

?>

<div class="bg-white dark:bg-gray-800 flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
	<h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 dark:text-white">Inscription</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
	<form class="space-y-6" action="subscribe.php" method="POST">
		<?php
		if ( isset( $_GET['subscription_error'] ) ) {
			AlertManager::display_error( html_entity_decode( $_GET['subscription_error'] ) );
		}
		?>

	  <div>
		<label for="subscription-username" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Nom d'utilisateur</label>
		<div class="mt-2">
		  <input <?php display_input_value( 'username' ); ?> type="text" name="subscription-username" id="subscription-username-input-creation" placeholder="Nom d'utilisateur" required autocomplete="off" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
		</div>
	  </div>

	  <div>
		<div class="flex items-center justify-between">
		  <label for="subscription-password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Mot de passe</label>
		</div>
		<div class="mt-2">
		  <input type="password" name="subscription-password" id="subscription-password-input-creation" placeholder="Mot de passe" autocomplete="current-password" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
		</div>
	  </div>

	  <div>
		<div class="flex items-center justify-between">
		  <label for="subscription-confirm-password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Confirmer votre mot de passe</label>
		</div>
		<div class="mt-2">
		  <input type="password" name="subscription-confirm-password" id="subscription-confirm-password-input-creation" placeholder="Mot de passe" autocomplete="current-password" required class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
		</div>
	  </div>

	  <div>
		<button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">S'incrire</button>
	  </div>
	</form>

	<p class="mt-10 text-center text-sm text-gray-500">
		Vous avez déjà un compte ?
	  <a href="./connection.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500 dark:text-primary-500">Connectez-vous</a>
	</p>
  </div>
</div>

<?php require_once 'includes/footer.php'; ?>
