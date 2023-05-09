<?php

$user = get_user();

if ( ! empty( $_POST ) && $user !== false ) {
	$submitted_args = remove_falsy_values(
		array(
			'profile_url' => $_POST['profile_url'],
			'first_name'  => $_POST['first_name'],
			'last_name'   => $_POST['last_name'],
			'email'       => $_POST['email'],
			'password'    => $_POST['password'],
		)
	);

	Database::update_user(
		$user->get_id(),
		$submitted_args
	);
	refresh_user();
	$user = get_user();
}


?>

<div class="pb-4 mb-8 border-b border-gray-200 dark:border-gray-700"> 
	<h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white dark:text-white" id="content">Mes données</h1>
	<p class="mb-4 text-lg text-gray-600 dark:text-gray-400">Ajoutez, modifiez ou supprimez vos données.</p>
</div>

<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
	// ...
	plugins: [
	  // ...
	  require('@tailwindcss/forms'),
	],
  }
  ```
-->
<form method="POST" action="account.php">
	<div class="space-y-12">
		<div class="border-b border-gray-900/10 dark:border-gray-700 pb-12">
			<h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Profil</h2>
			<p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-300">Ces informations seront partagées publiquement. Soyez donc
				prudent avec ce que vous souhaitez partager.</p>

			<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
				<div class="sm:col-span-4">
					<label for="username" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Nom
						d'utilisateur</label>
					<div class="mt-2">
						<div
							class="flex rounded-md focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
							<input type="text" name="user_name" id="username" autocomplete="username" disabled
								value="<?php echo $user->get_username(); ?>"
								class="pl-3 text-gray-500 sm:text-sm block flex-1 rounded bg-gray-50 border-gray-300 py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
								placeholder="janesmith">
						</div>
					</div>
				</div>

				<div class="col-span-full">
					<label for="photo" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Photo</label>
					<div class="mt-2 flex items-center gap-x-3">
						<svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd"
								d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
								clip-rule="evenodd" />
						</svg>

						<div class="flex-1">
							<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Changer d'image</label>
							<input name="profile_url" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
							<p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
						</div>
			
					</div>
				</div>
	  

			</div>
		</div>

		<div class="border-b border-gray-900/10 dark:border-gray-700 pb-12">
			<h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Informations personnelles</h2>
			<p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-300">Utilisez une adresse avec laquelle vous pouvez recevoir des
				emails.</p>

			<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
				<div class="sm:col-span-3">
					<label for="first-name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Prénom</label>
					<div class="mt-2">
						<input type="text" name="first_name" id="first-name" autocomplete="given-name"
							  value="<?php echo $user->get_firstname(); ?>"
							class="block w-full rounded-md bg-gray-50 border-gray-300 py-1.5 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
					</div>
				</div>

				<div class="sm:col-span-3">
					<label for="last-name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Nom</label>
					<div class="mt-2">
						<input type="text" name="last_name" id="last-name" autocomplete="family-name"
							value="<?php echo $user->get_lastname(); ?>"
							class="block w-full rounded-md py-1.5 bg-gray-50 border-gray-300 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
					</div>
				</div>

				<div class="sm:col-span-4">
					<label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Email</label>
					<div class="mt-2">
						<input id="email" name="email" type="email" autocomplete="email"
						value="<?php echo $user->get_email(); ?>"
							class="block w-full rounded-md py-1.5 bg-gray-50 border-gray-300 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
					</div>
				</div>

			</div>
		</div>

		<div class="border-b border-gray-900/10 dark:border-gray-700 pb-12">
			<h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Changer de mot de passe</h2>


			<div class="sm:col-span-4 mt-10 ">
				<label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Nouveau mot de passe</label>
				<div class="mt-2">
					<input id="password" name="new_password" type="password" autocomplete="off"
						class="block w-full rounded-md py-1.5 bg-gray-50 border-gray-300 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
				</div>
			</div>

			<div class="sm:col-span-4 mt-4">
				<label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Confirmation</label>
				<div class="mt-2">
					<input id="new_confirm_password" name="password" type="password" autocomplete="off"
						class="block w-full rounded-md py-1.5 bg-gray-50 border-gray-300 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
				</div>
			</div>

		</div>
	</div>


	<div class="mt-6 flex items-center justify-end gap-x-6">
		<a href="account.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Annuler</a>
		<button type="submit"
			class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sauvegarder</button>
	</div>
</form>
