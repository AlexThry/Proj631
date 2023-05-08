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
								<img src="https://m.media-amazon.com/images/I/51tYQFOBhOL._SL320_.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/416yHF9RshL._SL500_.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
						</div>
						<div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/510af+-z7EL._SL320_.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/51mJKRFr+NL._SL500_.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/51QsNB4GAaL._SL320_.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							</div>
							<div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/61+yngAg+uL._SL500_.jpg" alt="" class="h-full w-full object-cover object-center">
							</div>
							<div class="h-64 w-44 overflow-hidden rounded-lg">
								<img src="https://m.media-amazon.com/images/I/51dlPduJAXL._SL500_.jpg" alt="" class="h-full w-full object-cover object-center">
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

	<section class="relative">
		<div class="<?php empty( $_GET ) ? 'pt-16 sm:pt-24 lg:pt-40 ' : ''; ?>pb-40 sm:pb-20 lg:pb-24">
			<div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8 flex flex-col gap-4 align-center">

				<div class="flex items-center justify-start py-2 md:py-4 flex-wrap">
					<button type="button" class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">All categories</button>
					<button type="button" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Shoes</button>
					<button type="button" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Bags</button>
					<button type="button" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Electronics</button>
					<button type="button" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Gaming</button>
				</div>


				<?php

				$genre = isset( $_GET['genre'] ) && ! empty( $_GET['genre'] ) ? htmlentities( $_GET['genre'] ) : null;
				$start = isset( $_GET['start'] ) && ! empty( $_GET['start'] ) ? htmlentities( $_GET['start'] ) : 0;
				$limit = isset( $_GET['limit'] ) && ! empty( $_GET['limit'] ) ? htmlentities( $_GET['limit'] ) : 12;
				$sort  = isset( $_GET['sort'] ) && ! empty( $_GET['sort'] ) ? htmlentities( $_GET['sort'] ) : 'parution_date';
				$order = isset( $_GET['order'] ) && ! empty( $_GET['order'] ) ? htmlentities( $_GET['order'] ) : 'DESC';

				$args = array(
					'genre' => $genre,
					'start' => $start,
					'limit' => $limit,
					'sort'  => $sort,
					'order' => $order,
				);

				try {
					$args_copy          = $args;
					$args_copy['limit'] = null;
					$total_books        = Database::get_sorted_books_length( $args_copy );
					$books              = Database::get_sorted_books( $args );

					?>
					<div class="grid grid-cols-2 2xl:grid-cols-6 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 gap-4">
						<?php

						foreach ( $books as $book ) {
							Component::display_single_book( $book['title'], $book['link'], $book['author'] );
						}

						?>
					</div>

					<nav class="flex justify-center py-4 md:py-8" aria-label="Page navigation example">
						<ul class="inline-flex items-center -space-x-px">
							<li>
							<?php

							$previous_url = get_home_url() . '?' . http_build_query(
								array(
									'genre' => $genre,
									'start' => 0,
									'limit' => $limit,
									'sort'  => $sort,
									'order' => $order,
								)
							);

							?>
							<a href="<?php echo $previous_url; ?>" class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
								<span class="sr-only">Previous</span>
								<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
							</a>
							</li>
							<?php

							$nb_pages = ceil( $total_books / $limit );

							for ( $i = 0; $i < $nb_pages; $i++ ) :

								$page_url = get_home_url() . '?' . http_build_query(
									array(
										'genre' => $genre,
										'start' => $i * $limit,
										'limit' => $limit,
										'sort'  => $sort,
										'order' => $order,
									)
								);
								?>

								<li>
									<a href="<?php echo $page_url; ?>" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?php echo htmlentities( strval( $i + 1 ) ); ?></a>
								</li>

							<?php endfor; ?>
							<li>
							<?php

							$next_url = get_home_url() . '?' . http_build_query(
								array(
									'genre' => $genre,
									'start' => ( $nb_pages - 1 ) * $limit,
									'limit' => $limit,
									'sort'  => $sort,
									'order' => $order,
								)
							);

							?>
							<a href="<?php echo $next_url; ?>" class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
								<span class="sr-only">Next</span>
								<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
							</a>
							</li>
						</ul>
					</nav>
								<?php

				} catch ( Exception $e ) {
					AlertManager::display_error( $e->getMessage() );
				}

				?>

			</div>
		</div>
	</section>



	<?php
	// $genres = Database::get_all_genre();

	// foreach ( $genres as $genre ) {
		// $books = Database::get_books_by_genre( $genre );
	?>

		<!-- <section class="relative bg-white dark:bg-gray-800 library">
			<div class="sm:pb-40 sm:pt-24 lg:pb-0 shelf">
				<div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
					<h2 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Dans le thème <?php echo $genre; ?></h2>
				</div>
				<div class="carousel">
					<button type="button" class="btn-nav move-left">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
					<!-- </button>
					<div class="container-indicators">
						<div class="indicator active" data-index=0></div>
						<div class="indicator" data-index=1></div>
						<div class="indicator" data-index=2></div>
					</div>

					<div class="books"> -->
						<?php
						// for ( $i = 0; $i < 10; $i++ ) {
						// echo '<div class="book" id="book' . strval( $i ) . '">
						// <img
						// src="https://images.unsplash.com/photo-1585951237318-9ea5e175b891?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
						// alt="" srcset="">
						// <div class="description">
						// <div class="book-buttons-container">
						// <div class="book-buttons">8</i></div>
						// <a class="book-buttons page-button" href="./single-book.php?id=1">
						// <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
						// </a>
						// </div>
						// <div class="description-text-container">
						// <span class="description-rating">Auteur</span>
						// <br><br>
						// <span class="book-theme">Explosive</span>
						// <span>&middot;</span>
						// <span class="book-theme">Exciting</span>
						// <span>&middot;</span>
						// <span class="book-theme">Family</span>
						// </div>
						// </div>
						// </div>';
						// }
						?>

					<!-- </div> -->

					<!-- <button type="button" class="btn-nav move-right"> -->
						<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc.<path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg> -->
					<!-- </button> -->
				<!-- </div> -->
			<!-- </div> -->
		<!-- </section> -->

		<?php
		// }
		?>

	<div class="bg-gray-100 dark:bg-gray-900 py-12 sm:py-16 mb-16">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			<h2 class="text-center text-lg font-semibold leading-8 text-gray-900 dark:text-white">Les équipes les plus innovantes du monde lui font confiance</h2>
			<div class="mx-auto mt-10 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">
				<img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:bg-white dark:rounded" src="https://tailwindui.com/img/logos/158x48/transistor-logo-gray-900.svg" alt="Transistor" width="158" height="48">
				<img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:bg-white dark:rounded" src="https://tailwindui.com/img/logos/158x48/reform-logo-gray-900.svg" alt="Reform" width="158" height="48">
				<img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1 dark:bg-white dark:rounded" src="https://tailwindui.com/img/logos/158x48/tuple-logo-gray-900.svg" alt="Tuple" width="158" height="48">
				<img class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 dark:bg-white dark:rounded lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/savvycal-logo-gray-900.svg" alt="SavvyCal" width="158" height="48">
				<img class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1 dark:bg-white dark:rounded" src="https://tailwindui.com/img/logos/158x48/statamic-logo-gray-900.svg" alt="Statamic" width="158" height="48">
			</div>
		</div>
	</div>

</div>

<?php
require_once 'includes/footer.php';
