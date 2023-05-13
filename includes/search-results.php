<?php

$genre  = isset( $_GET['genre'] ) && ! empty( $_GET['genre'] ) ? htmlentities( $_GET['genre'] ) : null;
$start  = isset( $_GET['start'] ) && ! empty( $_GET['start'] ) ? htmlentities( $_GET['start'] ) : 0;
$limit  = isset( $_GET['limit'] ) && ! empty( $_GET['limit'] ) ? htmlentities( $_GET['limit'] ) : 12;
$sort   = isset( $_GET['sort'] ) && ! empty( $_GET['sort'] ) ? htmlentities( $_GET['sort'] ) : null;
$order  = isset( $_GET['order'] ) && ! empty( $_GET['order'] ) ? htmlentities( $_GET['order'] ) : 'DESC';
$search = isset( $_GET['search'] ) && ! empty( $_GET['search'] ) ? htmlentities( $_GET['search'] ) : null;

/**
 * Display the books grid.
 *
 * @param array $books Books to display.
 * @return void
 */
function display_books_grid( $books ): void {
	if ( ! count( $books ) ) :
		AlertManager::display_info( 'Aucun livre ne correspond à votre recherche.' );
	endif;
	?>
	<div class="grid grid-cols-2 2xl:grid-cols-6 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 gap-4">
		<?php
		$circles = array();
		if(get_user()) $circles = Database::get_user_circles(get_user()['id']);

		foreach ( $books as $book ) {
			Component::display_single_book( $book['title'], $book['image_url'], $book['author'], $book['id'], $book['score'], $circles );
		}

		?>
	</div>
	<?php
}

/**
 * Display the pagination.
 *
 * @param int    $total_books Total number of books matching the query.
 * @param string $genre Genre to filter.
 * @param int    $start Start index.
 * @param int    $limit Number of books per page.
 * @param string $sort Sort by.
 * @param string $order Order can be ASC or DESC.
 * @return void
 */
function display_pagination( $total_books, $genre, $start, $limit, $sort, $order ):void {
	?>
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
				$is_selected = strval( $i * $limit ) === strval( $start );
				$page_url    = get_home_url() . '?' . http_build_query(
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
				<a href="<?php echo $page_url; ?>" <?php echo $is_selected ? 'aria-current="page"' : ''; ?> class="<?php echo $is_selected ? 'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'; ?> border border-gray-300 px-3 py-2 leading-tight"><?php echo htmlentities( strval( $i + 1 ) ); ?></a>
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
}

?>

<section class="relative">
	<div class="<?php empty( $_GET ) ? 'pt-16 sm:pt-24 lg:pt-40 ' : ''; ?>pb-40 sm:pb-20 lg:pb-24">
		<div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8 flex flex-col gap-4 align-center">

			<div class="flex items-center justify-start py-2 md:py-4 flex-wrap">
				<button type="button" data-dropdown-toggle="dropdown-cat" class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800"><?php echo isset( $genre ) ? $genre : 'Toutes catégories'; ?></button>
				<div id="dropdown-cat" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
						<?php
						$all_cat_url = get_home_url() . '?' . http_build_query(
							array(
								'genre' => null,
								'start' => 0,
								'limit' => $limit,
								'sort'  => $sort,
								'order' => $order,
							)
						);
						?>
						<li>
							<a href="<?php echo $all_cat_url; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Toutes catégories</a>
						</li>
						<?php
						$categories = Database::get_all_genre();
						foreach ( $categories as $category ) :
							$categories_url = get_home_url() . '?' . http_build_query(
								array(
									'genre' => $category,
									'start' => 0,
									'limit' => $limit,
									'sort'  => $sort,
									'order' => $order,
								)
							);
							?>

						<li>
							<a href="<?php echo $categories_url; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><?php echo $category; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<?php
				$sort_variants = array(
					'title'         => 'Titre',
					'author'        => 'Auteur',
					'parution_date' => 'Date de Parution',
					'genre'         => 'Genre',
					'score'         => 'Note',
				);
				?>
				<button type="button" data-dropdown-toggle="dropdown-sort" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800"><?php echo isset( $sort ) ? $sort_variants[ $sort ] : 'Trier'; ?></button>
				<div id="dropdown-sort" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
						<?php

						$no_sort_url = get_home_url() . '?' . http_build_query(
							array(
								'genre' => $genre,
								'start' => 0,
								'limit' => $limit,
								'sort'  => null,
								'order' => $order,
							)
						);
						?>
						<li>
							<a href="<?php echo $no_sort_url; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pas de tri</a>
						</li>
						<?php

						foreach ( $sort_variants as $sort_slug => $sort_label ) :
							$sort_variant_url = get_home_url() . '?' . http_build_query(
								array(
									'genre' => $genre,
									'start' => 0,
									'limit' => $limit,
									'sort'  => $sort_slug,
									'order' => $order,
								)
							);
							?>

						<li>
							<a href="<?php echo $sort_variant_url; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><?php echo $sort_label; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<button type="button" data-dropdown-toggle="dropdown-order" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800"><?php echo $order === 'ASC' ? 'Croissant' : 'Décroissant'; ?></button>
				<div id="dropdown-order" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
						<?php
						$orders = array(
							'ASC'  => 'Croissant',
							'DESC' => 'Décroissant',
						);

						foreach ( $orders as $order_slug => $order_label ) :
							$order_url = get_home_url() . '?' . http_build_query(
								array(
									'genre' => $genre,
									'start' => 0,
									'limit' => $limit,
									'sort'  => $sort,
									'order' => $order_slug,
								)
							);
							?>

						<li>
							<a href="<?php echo $order_url; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><?php echo $order_label; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>


				<button type="button" data-dropdown-toggle="dropdown-limit" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800"><?php echo isset( $limit ) ? 'Nombre : ' . strval( $limit ) : 'Pas de limite'; ?></button>
				<div id="dropdown-limit" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
						<?php

						$no_limit_url = get_home_url() . '?' . http_build_query(
							array(
								'genre' => $genre,
								'start' => 0,
								'limit' => null,
								'sort'  => $sort,
								'order' => $order,
							)
						);
						?>

						<?php

						for ( $i = 1; $i < 11; $i++ ) :
							$l         = $i * 6;
							$limit_url = get_home_url() . '?' . http_build_query(
								array(
									'genre' => $genre,
									'start' => 0,
									'limit' => $l,
									'sort'  => $sort,
									'order' => $order,
								)
							);
							?>

						<li>
							<a href="<?php echo $limit_url; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><?php echo strval( $l ); ?></a>
						</li>

						<?php endfor; ?>
					</ul>
				</div>
			</div>


			<?php

			$args = array(
				'genre'  => $genre,
				'start'  => $start,
				'limit'  => $limit,
				'sort'   => $sort,
				'order'  => $order,
				'search' => $search,
			);

			try {
				$args_copy          = $args;
				$args_copy['limit'] = null;
				$total_books        = count(Database::get_sorted_books( $args_copy ));
				$books              = Database::get_sorted_books( $args );

				display_books_grid( $books );
				display_pagination( $total_books, $genre, $start, $limit, $sort, $order );

			} catch ( Exception $e ) {
				AlertManager::display_error( $e->getMessage() );
			}

			?>

		</div>
	</div>
</section>
