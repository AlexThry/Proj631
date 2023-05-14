<?php require_once 'includes/header.php'; ?>

<div class="content">

	<?php if ( empty( $_GET ) ) : ?>
	<section class="relative bg-white dark:bg-gray-800">
		<div class="pb-80 pt-16 sm:pb-40 sm:pt-24 lg:pb-48 lg:pt-40">
			<div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
			<div class="sm:max-w-lg">
				<h1 class="font text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl">Des milliers d'avis sur vos livres préférés</h1>
				<p class="mt-4 text-xl text-gray-500 dark:text-gray-300">Découvrez de nouveaux horizons littéraires en partageant votre avis sur vos livres préférés dès maintenant sur notre site !</p>
			</div>
			<div>
				<div class="mt-10">
					<!-- Decorative image grid -->
					<div aria-hidden="true" class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
						<div class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
						<div class="flex items-center space-x-6 lg:space-x-8">
							<div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
							<div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
								<img src="https://m.media-amazon.com/images/I/916DM68L6cS.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/91QAA9JXFJL.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
						</div>
						<div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://static.fnac-static.com/multimedia/Images/FR/NR/76/ac/e1/14789750/1507-1/tsp20230401085400/Force-de-vie.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/71xXrddBk7L.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/41ozBdkhBrL._SX316_BO1,204,203,200_.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							</div>
							<div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/41ozBdkhBrL._SX316_BO1,204,203,200_.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://products-images.di-static.com/image/george-r-r-martin-le-trone-de-fer-a-game-of-thrones-book-1/9780006479888-475x500-1.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							</div>
						</div>
						</div>
					</div>

					<!-- <a href="#" class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-center font-medium text-white hover:bg-indigo-700">Shop Collection</a> -->

					<?php require 'includes/search-bar.php'; ?>

				</div>
			</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php require_once 'includes/search-results.php'; ?>


</div>

<?php
require_once 'includes/footer.php';
