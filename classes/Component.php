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
		 * @param User $user
		 * @param Book $book
		 * @return void
		 */
		public static function user_score($score): void {
			$has_no_score = $score == null;
			$score = (!$has_no_score ? round($score, 1) : 0);
			for ( $i = 0; $i < floor($score); $i++ ) {
				?>
				<svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
				<?php
			}
			for ( $i = 0; $i < Review::MAX_SCORE - floor($score); $i++ ) {
				?>
				<svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
				<?php
			}
			$score_msg = ($has_no_score ? "Aucune note" : $score." sur ".REVIEW::MAX_SCORE);
			?> <p class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400"><?php echo $score_msg; ?></p> <?php
		}

		/**
		 * Display a single book.
		 *
		 * @param Book $book The book to display.
		 * @return void
		 */
		public static function display_single_book( $title, $link, $author, $id, $score ) : void {
			?>
			<a href="book.php?id=<?php echo htmlentities( $id ); ?>" class="cursor-pointer hover:scale-90 transition ease duration-300">
				<img class="h-auto max-w-full rounded-lg" src="<?php echo addslashes( $link ); ?>" alt="<?php echo addslashes( $title ); ?>">
				<h3 class="mt-2 text-xl font-semibold text-gray-800 dark:text-gray-200"><?php echo addslashes( $title ); ?></h3>
				<span class="mt-1 text-gray-600 dark:text-gray-400"><?php echo addslashes( $author ); ?></span>

				<div class="flex items-center">
					<?php self::user_score($score); ?>
				</div>

			</a>
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
						self::display_single_book( $book['title'], $book['link'], $book['author'], $book['id'], $book['score'] );
					endforeach;
					?>
				 </div>
			<?php else : ?>
				<div class='no-book-message'>
				<h2>Aucun livre !</h2>
				<p>
					Vous voulez découvrir de nouvelles oeuvres ? C'est par ici ->
					<a href=' . get_home_url() . '>découvrir +</a>
				</p>
			</div>
				<?php
			endif;
		}
	}
}
