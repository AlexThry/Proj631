<?php

$user_id              = get_user()['id'];
$save_label           = null;

if ( ! $user_id ) {
	die();
}

if ( ! empty( $_POST ) && $user_id !== false ) {

	if (
		! empty( $_POST['circle_name'] )
	) {
		$circle_label = 'Veuillez entrer un nom de cercle.';
	}

	if (
		key_exists( 'circle_name', $_POST ) &&
		isset( $_POST['circle_name'] ) &&
		! empty( $_POST['circle_name'] ) &&
		key_exists( 'description', $_POST ) &&
		isset( $_POST['description'] ) &&
		! empty( $_POST['description'] )
	) {
		if ( key_exists( 'circle_url', $_POST ) && isset( $_POST['circle_url'] ) && ! empty( $_POST['circle_url'] ) ) {
			$circle_name = $_POST['circle_name'];
			$submitted_args = remove_falsy_values(
				array(
					'circle_name'    => isset( $_POST['circle_name'] ) ? addslashes( $_POST['circle_name'] ) : null,
					'description'    => isset( $_POST['description'] ) ? addslashes( $_POST['description'] ) : null,
					'circle_url'  	 => isset( $_POST['circle_url'] ) ? addslashes( $_POST['circle_url'] ) : null,
					'admin_id'       => $user_id,
				)
			);
			try {
				Database::create_circle(
					$submitted_args['circle_name'],
					$submitted_args['description'],
					$submitted_args['admin_id'],
					$submitted_args['circle_url']
				);
			}
			catch (Exception $e) {
				$save_label = array(
					'type'  => 'error',
					'label' => 'Une erreur est survenue : ' . $e->getMessage(),
				);
			}

		} else {
			$circle_name = $_POST['circle_name'];
			$submitted_args = remove_falsy_values(
				array(
					'circle_name'    => isset( $_POST['circle_name'] ) ? addslashes( $_POST['circle_name'] ) : null,
					'description'    => isset( $_POST['description'] ) ? addslashes( $_POST['description'] ) : null,
					'admin_id'       => $user_id,
				)
			);
			try {
				Database::create_circle(
					$submitted_args['circle_name'],
					$submitted_args['description'],
					$submitted_args['admin_id'],
				);
			} catch (Exception $e) {
				$save_label = array(
					'type'  => 'error',
					'label' => 'Une erreur est survenue : ' . $e->getMessage(),
				);
			}
		}
	}
}


?>

<div class="pb-4 mb-8 border-b border-gray-200 dark:border-gray-700">
	<h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white dark:text-white" id="content">Mes Cercles</h1>
	<p class="mb-4 text-lg text-gray-600 dark:text-gray-400">Visualisez vos cercles ou créez-en un nouveau.</p>
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
<form method="POST" action="account.php?tab=user_circles">
	<div class="space-y-12">
		<div class="border-b border-gray-900/10 dark:border-gray-700 pb-12">
			<h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Cercles</h2>
			<p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-300">Ces informations seront partagées publiquement. Soyez donc
				prudent avec ce que vous souhaitez partager.</p>

			<?php

			if ( $save_label !== null ) {
				?>
				<hr class="my-6 border-gray-200 dark:border-gray-700" />
				<?php
				if ( $save_label['type'] === 'success' ) {
					AlertManager::display_success( $save_label['label'] );
				} else {
					AlertManager::display_warning( $save_label['label'] );
				}
			}

			?>

			<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
				<div class="sm:col-span-4">
					<label for="circle_name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Nom
						du cercle</label>
					<div class="mt-2">
						<div
							class="flex rounded-md focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
							<input type="text" name="circle_name" id="circle_name" autocomplete="circle_name"
								class="pl-3 text-gray-500 sm:text-sm block flex-1 rounded bg-gray-50 border-gray-300 py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
								placeholder="Nom du Cercle">
						</div>
					</div>
				</div>

				<div class="col-span-full">
					<label for="about" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Description</label>
						<div class="mt-2">
							<textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required></textarea>
						</div>
					<p class="mt-3 text-sm leading-6 text-gray-600">Donnez une description de ce que vous voulez voir dans ce cercle.</p>
				</div>

				<div class="col-span-full">
					<label for="photo" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Photo</label>
					<div class="mt-2 flex items-center gap-x-3">
						<img class="w-16 h-16 rounded-full" src="<?php echo ! empty( $circle_url ) ? $circle_url : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'; ?>" alt="Photo de profil" />

						<div class="flex-1">
							<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="circle_url">Ajouter une image</label>
							<input
							name="circle_url"
							type="text" id="circle_url" autocomplete="off"
							class="block w-full rounded-md bg-gray-50 border-gray-300 py-1.5 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
							<p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
						</div>

					</div>
				</div>


			</div>
		</div>

		<div class="border-b border-gray-900/10 dark:border-gray-700 pb-12">



	<div class="mt-6 flex items-center justify-end gap-x-6">
		<button type="submit"
			class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Créer</button>
	</div>
</form>
