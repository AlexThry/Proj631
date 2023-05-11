<?php

if ( ! class_exists( 'Component' ) ) {

	/**
	 * Class that manages component creation
	 */
	final class Component {

		/**
		 * Displays the score that a user gave to a book.
		 * If theres no score, displays a message
		 *
		 * @param int $score
		 * @return void
		 */
		public static function display_user_score( $score ): void {
			$has_no_score = $score == null;
			$score        = ( ! $has_no_score ? round( $score, 1 ) : 0 );
			for ( $i = 0; $i < floor( $score ); $i++ ) {
				?>
				<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
				<?php
			}
			for ( $i = 0; $i < 5 - floor( $score ); $i++ ) {
				?>
				<svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
				<?php
			}
			$score_msg = $has_no_score ? "<span class='no-note'>Aucune note</span>" : $score . ' sur 5';
			?>
			 <p class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400"><?php echo $score_msg; ?></p>
			<?php
		}

		/**
		 * Display a single book.
		 *
		 * @param Book $book The book to display.
		 * @return void
		 */
		public static function display_single_book( $title, $image_url, $author, $id, $score ) : void {
			?>
			<div class="book-card cursor-pointer hover:scale-90 transition ease duration-300 relative">
				<a href="book.php?id=<?php echo htmlentities( $id ); ?>">
					<img class="h-auto max-w-full rounded-lg" src="<?php echo addslashes( $image_url ); ?>" alt="<?php echo addslashes( $title ); ?>">
					<h3 class="mt-2 text-xl font-semibold text-gray-800 dark:text-gray-200"><?php echo ( $title ); ?></h3>
					<span class="mt-1 text-gray-600 dark:text-gray-400"><?php echo addslashes( $author ); ?></span>

					<div class="flex items-center">
						<?php self::display_user_score( $score ); ?>
					</div>
				</a>

				<div class="single-book-buttons height-full">
					<div class="single-book-buttons">
						<?php $has_read = Database::user_has_read(get_user()['id'], $id); ?>
						<?php $wants_to_read = Database::user_wants_to_read(get_user()['id'], $id); ?>

						<?php if ( $has_read ) : ?>
							<a class="disabled text-white bg-green-700 font-medium rounded-full text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-green-600">
								<svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
								Lu
							</a>
						<?php endif; ?>
						<!-- class="disabled hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:hover:bg-green-700 dark:focus:ring-green-800 text-white bg-green-700 font-medium rounded-full text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-green-600" -->
						<!-- class="disabled text-white bg-blue-700 font-medium rounded-full text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600" -->
						<?php if ( $wants_to_read && !$has_read ) : ?>
							<a class="disabled text-white bg-green-700 font-medium rounded-full text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-green-600">
								<svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
								</svg>
								En cours
							</a>
							<a href="<?php echo "change-my-books?book_id=$id&previous-url=$_SERVER[REQUEST_URI]" ?>" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
								<svg fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
								Terminé
							</a>
						<?php endif; ?>

						<?php if ( !$wants_to_read && !$has_read ) : ?>
							<a href="<?php echo "change-wishlist?book_id=$id&previous-url=$_SERVER[REQUEST_URI]" ?>" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
								<svg fill="none" stroke="currentColor" class="w-5 h-5 mr-2 -ml-1" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
								</svg>
								Ajouter
							</a>
						<?php endif; ?>
					</div>
				</div>
				<!-- sldfsdlfj -->

			</div>
			<?php
		}

		/**
		 * Displays a grid of books with there respective cover, title
		 * and the note the current user gave it.
		 * If theres no book, displays a message and a like to get more books.
		 *
		 * @param array $books Array of Books.
		 * @return void
		 */
		public static function display_books( $books ): void {
			if ( $books ) :
				?>
				<div class="grid grid-cols-2 2xl:grid-cols-8 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 gap-4">
					<?php
					foreach ( $books as $book ) :
						self::display_single_book( $book['title'], $book['image_url'], $book['author'], $book['id'], $book['score'] );
					endforeach;
					?>
				 </div>
			<?php else : ?>
				<div class="pb-4 mb-8 border-b border-gray-200 dark:border-gray-800">
					<h2 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white" id="content">Aucun livre !</h2>
					<p class="mb-4 text-lg text-gray-600 dark:text-gray-400">
						Vous voulez découvrir de nouvelles oeuvres ? C'est par ici ->
						<a href='<?php echo get_home_url() ?>' class="dark:text-white">découvrir +</a>
					</p>
				</div>
			<?php endif;
		}
	}
}
