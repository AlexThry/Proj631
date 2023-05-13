<?php

require_once 'includes/header.php';

$circle_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($circle_id === null ) {
	header( 'Location: ' . get_home_url() );
	exit();
}
$circle = Database::get_circle( $circle_id );
$books  = Database::get_circle_books( $circle_id );
$users  = Database::get_circle_users( $circle_id );
?>

<main class="pt-4 pb-8 lg:pt-8 lg:pb-12 bg-white dark:bg-gray-900">
	<div class="flex justify-between px-4 mx-auto max-w-screen-2xl ">
		<article class="mx-auto w-full max-w-5xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
			<section class="bg-white dark:bg-gray-900">
				<div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">

					<div class="mr-auto place-self-center lg:col-span-7">
						<h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white"><?php echo $circle['title']; ?></h1>
						<p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400"><?php echo $circle['description']; ?></p>
						<a href="#books" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
							Voir les livres
							<svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
						</a>
						<a href="#users" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
							Les utilisateurs
						</a>
					</div>

					<div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
						<img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup">
					</div>

				</div>
			</section>

			<section id="books" class="bg-white dark:bg-gray-900">
				<h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Les livres</h2>
				<?php Component::display_books($books); ?>
			</section>

			<section id="users" class="bg-white dark:bg-gray-900">
				<h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Les utilisateurs</h2>
				<?php foreach ( $users as $user ) echo $user['user_name']; ?>
				<!-- afficher les utilisateurs ici -->
			</section>

		</article>
	</div>
</main>

<?php require_once 'includes/footer.php'; ?>
