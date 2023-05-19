<?php
$user 				  = get_user();
$user_id              = get_user()['id'];
$save_label           = null;

if ( ! $user_id ) {
	die();
} ?>






<?php


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

<div class="pb-4 border-b border-gray-200 dark:border-gray-700">
	<h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white dark:text-white" id="content">Mes Cercles</h1>
	<!-- <p class="mb-4 text-lg text-gray-600 dark:text-gray-400">Visualisez vos cercles ou créez-en un nouveau.</p> -->
</div>
<div id="accordion-open" data-accordion="open">
<?php 
$circles = Database::get_circles();
echo '<ul role="list" class="divide-y divide-gray-100">';
$i = 1;
$admin_circles = array();
foreach ($circles as $circle) {

	if (Database::user_is_circle_admin($user_id, $circle['id'])){
		array_push($admin_circles, $circle);
	} 
}
echo '	<h1 class="pt-4 pb-4 inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white dark:text-white" id="content">Modifier mes cercles</h1>
';

foreach ($admin_circles as $circle) :
	?> 

		<?php if ($i == 1) : ?>
		
		<h2 id="accordion-open-heading-<?php echo $i ?>">
			
			<button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 dark:text-gray-400" data-accordion-target="#accordion-open-body-<?php echo $i ?>" aria-expanded="false" aria-controls="accordion-open-body-<?php echo $i ?>">
			<?php echo $circle['title']; ?>
			<svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
			</button>
		</h2>
		<div id="accordion-open-body-<?php echo $i ?>" class="hidden" aria-labelledby="accordion-open-heading-<?php echo $i ?>">
			<?php Component::form_modify_circle($circle['id']); ?>
		</div>
		<?php elseif($i != sizeof($admin_circles)): ?>

		<h2 id="accordion-open-heading-<?php echo $i ?>">
			<button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-open-body-<?php echo $i ?>" aria-expanded="false" aria-controls="accordion-open-body-<?php echo $i ?>">
			<?php echo $circle['title']; ?>
			<svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
			</button>
		</h2>
		<div id="accordion-open-body-<?php echo $i ?>" class="hidden" aria-labelledby="accordion-open-heading-<?php echo $i ?>">
			<?php Component::form_modify_circle($circle['id']); ?>
		</div>

		<?php else: ?>
			<h2 id="accordion-open-heading-<?php echo $i ?>">
				<button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-open-body-<?php echo $i ?>" aria-expanded="false" aria-controls="accordion-open-body-<?php echo $i ?>">
				<?php echo $circle['title']; ?>
				<svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
				</button>
			</h2>
			<div id="accordion-open-body-<?php echo $i ?>" class="hidden" aria-labelledby="accordion-open-heading-<?php echo $i ?>">
			<?php Component::form_modify_circle($circle['id']); ?>
			</div>


		<?php endif; ?>

		
		
	<?php 
	$i++;
	?>
<?php endforeach; ?>
</div>
<ul role="list" class="divide-y divide-gray-100">
	<?php 
	$user_circles = Database::get_all_user_cirlces( $user_id ); 
	$circles = array();
	foreach ($user_circles as $user_circle) {
		if ($user_circle['admin_id'] != $user_id) {
			array_push($circles, $user_circle);
		}
	}
	?>
	<?php 
	if (sizeof($circles) != 0) {
		echo '<h1 class="pt-4 pb-4 inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white dark:text-white" id="content">Les cercles auxquels je suis abonné </h1>';
	}
	?>


	<?php foreach ( $circles as $circle ) : ?>
		<?php
		$user_id = get_user() ? get_user()['id'] : null;
		$circle_admin = Database::get_user($circle['admin_id']);
		$is_subscribed = $user_id ? Database::user_is_subscribed($user_id, $circle['id']) : false;
		$subscription_url = "change-circle-subscription.php?circle-id=".$circle['id']."&previous-url=$_SERVER[REQUEST_URI]";
		?>
		<li class="flex justify-between gap-x-6 py-5">
			<a href="circle.php?id=<?php echo $circle['id']; ?>">
				<div class="flex gap-x-4">
					<img class="object-cover h-12 w-12 flex-none rounded-full bg-gray-50 dark:bg-gray-600" src="<?php echo key_exists( 'image_url', $circle ) ? $circle['image_url'] : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'; ?>" alt="">
					<div class="min-w-0 flex-auto">
						<p class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100"><?php echo $circle['title']; ?></p>
						<p class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-400"><?php echo $circle['description']; ?></p>
					<p class="mt-1 text-xs leading-5 text-gray-500">Admin: <?php echo $circle_admin['first_name'] . ' ' . $circle_admin['last_name'] . ' (' . $circle_admin['user_name'] . ')'; ?></p>
					</div>
				</div>
			</a>

			<div class="sm:flex sm:flex-col sm:items-end">
				<?php if ( $is_subscribed ) : ?>
					<a href="<?php echo $subscription_url ?>"  class="text-white bg-blue-700 inline-flex flex-align hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
						<svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2 -ml-1"© viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
						</svg>
						Abonné
					</a>
				<?php else : ?>
					<a href="<?php echo $subscription_url ?>"  class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">S'abonner</a>
				<?php endif; ?>
			</div>
		</li>
	<?php endforeach; ?>
</ul>


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
<div>


</div>
<h1 class="pt-4 inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white dark:text-white" id="content">Créer un cercle</h1>

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
