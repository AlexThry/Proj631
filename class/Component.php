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
    public static function user_score($user, $book) {
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

}


