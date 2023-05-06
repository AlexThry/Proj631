<?php

/**
 * Class that manages component creation
 */
final class Component {

    /**
    * Displays the score that a user gave to a book.
    * If theres no score, displays a message
    * @param User $user
    * @param Book $book
    * @return void
    */
    public static function user_score($user, $book): void {
        $review = Database::get_review($user->getId(), $book->getId());
        if($review === null) return;
        echo "<div class='score'>";
        for($i = 0; $i < $review->getScore(); $i++) {
            echo "<img src='./assets/images/full-hearth.svg' alt='coeur'/>";
        }
        for($i = 0; $i < Review::MAX_SCORE - $review->getScore(); $i++) {
            echo "<img src='./assets/images/hearth.svg' alt='coeur'/>";
        }
        echo "</div>";
    }

    /**
    * Displays a grid of books with there respective cover, title
    * and the note the current user gave it.
    * If theres no book, displays a message and a like to get more books.
    * @param array $books
    * @return void
    */
    public static function books_display($books): void {
        if($books) {
            echo "<div id='books_container'>";
            foreach($books as $book) {
                echo "<div class='book'>";
                // Couverture du livre
                echo "<img src=".$book->getLink()." alt=".$book->getTitle().">";
                echo "<div class='separator_container'>";
                // Titre du livre
                echo "<p>".$book->getTitle()."</p>";
                // Note du livre
                Component::user_score(current_user(), $book);
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<div class='no-book-message'>";
            echo "<h2>Aucun livre !</h2>";
            echo "<p>";
            echo "Vous voulez découvrir de nouvels oeuvres ? C'est par ici ->";
            echo "<a href=".get_home_url().">découvrir +</a>";
            echo "</p>";
            echo "</div>";
        }
    }
}


