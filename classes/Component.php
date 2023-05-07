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
		public static function user_score( $user, $book ): void {
			$review = Database::get_review( $user->get_id(), $book->get_id() );
			if ( $review === null ) {
				return;
			}
			echo "<div class='score'>";
			for ( $i = 0; $i < $review->get_score(); $i++ ) {
				echo "<img src='./assets/images/full-hearth.svg' alt='coeur'/>";
			}
			for ( $i = 0; $i < Review::MAX_SCORE - $review->get_score(); $i++ ) {
				echo "<img src='./assets/images/hearth.svg' alt='coeur'/>";
			}
			echo '</div>';
		}

		/**
		 * Displays a grid of books with there respective cover, title
		 * and the note the current user gave it.
		 * If theres no book, displays a message and a like to get more books.
		 *
		 * @param array $books
		 * @return void
		 */
		public static function books_display( $books ): void {
			if ( $books ) {
				echo "<div id='books_container'>";
				foreach ( $books as $book ) {
					?>Ï
					<div class='book'>
					<?php // Couverture du livre ?>
					<img src="<?php echo $book->get_link(); ?>" alt="<?php echo $book->get_title(); ?>">
					<div class='separator_container'>
					<?php // Titre du livre ?>
					<p><?php echo $book->get_title(); ?></p>
					<?php
					// Note du livre.
					self::user_score( get_user(), $book )
					?>
					</div>
					</div>
					<?php
				}
				echo '</div>';
			} else {
				?>
				<div class='no-book-message'>
				<h2>Aucun livre !</h2>
				<p>
				Vous voulez découvrir de nouvelles oeuvres ? C'est par ici ->
				<a href=' . get_home_url() . '>découvrir +</a>
				</p>
				</div>
				<?php
			}
		}
	}
}
