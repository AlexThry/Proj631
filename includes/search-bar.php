<?php

$genre  = isset( $_GET['genre'] ) && ! empty( $_GET['genre'] ) ? htmlentities( $_GET['genre'] ) : null;
$start  = isset( $_GET['start'] ) && ! empty( $_GET['start'] ) ? htmlentities( $_GET['start'] ) : 0;
$limit  = isset( $_GET['limit'] ) && ! empty( $_GET['limit'] ) ? htmlentities( $_GET['limit'] ) : 12;
$sort   = isset( $_GET['sort'] ) && ! empty( $_GET['sort'] ) ? htmlentities( $_GET['sort'] ) : null;
$order  = isset( $_GET['order'] ) && ! empty( $_GET['order'] ) ? htmlentities( $_GET['order'] ) : 'DESC';
$search = isset( $_GET['search'] ) && ! empty( $_GET['search'] ) ? htmlentities( $_GET['search'] ) : null;

$random = generate_random_string();

?>

<form class="sm:max-w-lg w-450" action="<?php echo get_home_url(); ?>" method="GET">
	<div class="flex search-cat-dropdown-container">
		<input type="hidden" name="start" value="0">
		<input type="hidden" name="limit" value="<?php echo $limit; ?>">
		<input type="hidden" name="sort" value="<?php echo $sort; ?>">
		<input type="hidden" name="order" value="<?php echo $order; ?>">
		<input type="hidden" class="search-hidden-genre" name="genre" value="<?php echo $genre; ?>">

		<button data-dropdown-toggle="dropdown-cat-search-<?php echo $random; ?>" class="dropdown-search-cat-button flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button"><span class="dropdown-cat-value"><?php echo isset( $genre ) ? $genre : 'Toutes catégories'; ?></span> <svg aria-hidden="true" class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
		<div id="dropdown-cat-search-<?php echo $random; ?>" class="dropdown-cat-search z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
			<ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
				<li data-cat="">
					<button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Toutes catégories</button>
				</li>
				<?php
				$categories = Database::get_all_genre();
				foreach ( $categories as $category ) :
					?>

					<li data-cat="<?php echo $category; ?>">
						<button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><?php echo $category; ?></button>
					</li>
				
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="relative w-full">
			<input value="<?php echo isset( $search ) ? $search : ''; ?>" type="search" id="search-dropdown" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Rechercher un livre...">
			<button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
				<svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
				<span class="sr-only">Chercher</span>
			</button>
		</div>
	</div>
</form>
