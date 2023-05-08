<?php

const DB_USERNAME = 'root';
const DB_PASSWORD = '';

if ( ! class_exists( 'Database' ) ) {
	/**
	 * Database class
	 */
	final class Database {

		public static function setup() {
			self::connect_db();
		}

		public static function connect_db() {
			global $conn;
			$conn = new mysqli( 'localhost', DB_USERNAME, DB_PASSWORD );

			if ( ! $conn ) {
				echo 'Erreur de connexion à la bdd';
			}

			$conn->query( 'USE Proj631' );
			$conn->query( 'SET NAMES utf8' );

		}

		/**
		 * Get a single book.
		 *
		 * @param int $book_id Book id.
		 * @return array
		 */
		public static function get_single_book( $book_id ):array {
			global $conn;

			$sql  = 'SELECT * FROM book WHERE id = ' . $book_id . ';';
			$res  = mysqli_query( $conn, $sql );
			$books = array();
			foreach ( $res as $line ) {
				$book                  = array();
				$book['id']            = $line['id'];
				$book['title']         = $line['title'];
				$book['author']        = $line['author'];
				$book['description']   = $line['description'];
				$book['link']          = $line['link'];
				$book['parution_date'] = $line['parution_date'];
				$books[]               = $book;
			}


			if ( count( $books ) !== 1 ) {
				throw new Exception( 'Le livre n\'est pas ou plusieurs fois présent.' );
			}

			return $books[0];

		}
		public static function get_books():array {
			global $conn;
			$sql   = 'SELECT * FROM book;';
			$res   = mysqli_query( $conn, $sql );
			$books = array();
			foreach ( $res as $line ) {
				$book                  = array();
				$book['id']            = $line['id'];
				$book['title']         = $line['title'];
				$book['author']        = $line['author'];
				$book['description']   = $line['description'];
				$book['link']          = $line['link'];
				$book['parution_date'] = $line['parution_date'];
				$books[ $line['id'] ]  = $book;
			}
			return $books;

		}

		/**
		 * Get all genres
		 *
		 * @return array $genres All genres
		 */
		public static function get_all_genre(): array {
			global $conn;

			$sql    = 'SELECT * FROM genre;';
			$result = mysqli_query( $conn, $sql );
			$genres = array();

			foreach ( $result as $line ) {
				$genres[] = $line['label'];
			}

			return $genres;
		}

		/**
		 * Get all books by genre
		 *
		 * @param array $genre Genre.
		 * @return array $books Books.
		 */
		public static function get_books_by_genre( $genre, ):array {
			global $conn;
			$sql   = "SELECT * FROM book WHERE id in (SELECT id_book FROM has_genre WHERE id_genre in (SELECT id FROM genre WHERE label = '" . $genre . "'));";
			$res   = mysqli_query( $conn, $sql );
			$books = array();
			foreach ( $res as $line ) {
				$book                  = array();
				$book['id']            = $line['id'];
				$book['title']         = $line['title'];
				$book['author']        = $line['author'];
				$book['description']   = $line['description'];
				$book['link']          = $line['link'];
				$book['parution_date'] = $line['parution_date'];
				$books[ $line['id'] ]  = $book;
			}
			return $books;
		}

		/**
		 * Query books in the db according to the given parameters.
		 *
		 * @param array $args Arguemnts are :
		 *                - genre : string (a specific genre) (default: null)
		 *                - start : int (default: 0)
		 *                - limit : int (default: null)
		 *                - sort : string (default: 'parution_date'). Possible values are 'title', 'author', 'parution_date', 'genre'.
		 *                - order : string (default: 'ASC'). Possible values are 'ASC' and 'DESC'.
		 *              All parameters are optionnal.
		 * @return array $books Books matching the query.
		 */
		public static function get_sorted_books( $args ): array {
			global $conn;

			$genre = isset( $args['genre'] ) && ! empty( $args['genre'] ) ? $args['genre'] : null;
			$start = isset( $args['start'] ) ? $args['start'] : 0;
			$limit = isset( $args['limit'] ) ? $args['limit'] : null;
			$sort  = isset( $args['sort'] ) ? $args['sort'] : 'parution_date';
			$order = isset( $args['order'] ) && 'DESC' === $args['order'] ? $args['order'] : 'ASC';

			$sql = 'SELECT * FROM book';

			if ( isset( $genre ) ) {
				$sql .= " WHERE id in (SELECT id_book FROM has_genre WHERE id_genre in (SELECT id FROM genre WHERE label = '" . $genre . "'))";
			}

			$sql .= ' ORDER BY ' . $sort . ' ' . $order . ( isset( $limit ) ? ' LIMIT ' . $limit . ' OFFSET ' . $start : '' ) . ';';

			$res = mysqli_query( $conn, $sql );

			$books = array();
			foreach ( $res as $line ) {
				$book                  = array();
				$book['id']            = $line['id'];
				$book['title']         = $line['title'];
				$book['author']        = $line['author'];
				$book['description']   = $line['description'];
				$book['link']          = $line['link'];
				$book['parution_date'] = $line['parution_date'];
				$books[ $line['id'] ]  = $book;
			}

			return $books;
		}

		/**
		 * Get the number of books matching the query.
		 *
		 * @param array $args See get_sorted_books() for the list of arguments.
		 * @return integer Number of books matching the query.
		 */
		public static function get_sorted_books_length( $args ): int {
			return count( self::get_sorted_books( $args ) );
		}

		public static function get_reviews_by_book( $id_book ):array {
			global $conn;
			$sql     = "SELECT * FROM review WHERE id_book = $id_book";
			$res     = mysqli_query( $conn, $sql );
			$reviews = array();

			foreach ( $res as $line ) {
				$review                  = array();
				$review['id_user']       = $line['id_user'];
				$review['content']       = $line['content'];
				$review['score']         = $line['score'];
				$review['parution_date'] = $line['parution_date'];
				$reviews[ $line['id'] ]  = $review;
			}

			return $reviews;
		}

		public static function get_users():array {
			global $conn;
			$sql   = 'SELECT * FROM user';
			$res   = $conn->query( $sql );
			$users = array();
			foreach ( $res as $line ) {
				$user                  = array();
				$user['user_name']     = $line['user_name'];
				$user['password']      = $line['password'];
				$user['creation_date'] = $line['creation_date'];
				$users[ $line['id'] ]  = $user;
			}
			return $users;
		}

		/**
		 * Returns the list of books a user wants to read and has already read
		 *
		 * @param int $user_id The user's id.
		 * @return array(Book)
		 */
		public static function get_user_books( $user_id ): array {
			$query = "SELECT b.id, title, author, parution_date, link FROM book b
                JOIN has_read hr ON hr.id_user = $user_id
                UNION
                SELECT b.id, title, author, parution_date, link FROM book b
                JOIN wants_to_read wtr ON wtr.id_user = $user_id";

			// TODO : check for query errors + XSS attack
			global $conn;
			$books = array();
			foreach ( $conn->query( $query ) as $line ) {
				$books[] = new Book( (int) $line['id'], $line['author'], $line['parution_date'], $line['title'], $line['link'] );
			}
			return $books;
		}

		/**
		 * Returns the list of books a user wants to read
		 *
		 * @param int $user_id The user's id.
		 * @return array(Book)
		 */
		public static function get_user_wishlist( $user_id ): array {
			$query = "SELECT b.id, title, author, parution_date, link FROM book b
                JOIN wants_to_read wtr ON wtr.id_user = $user_id";

			// TODO : check for query errors + XSS attack
			global $conn;
			$books = array();
			foreach ( $conn->query( $query ) as $line ) {
				$books[] = new Book( (int) $line['id'], $line['author'], $line['parution_date'], $line['title'], $line['link'] );
			}
			return $books;
		}

		public static function get_review( $user_id, $book_id ) {
			$query = "SELECT * FROM review
                WHERE id_user = $user_id
                AND id_book = $book_id";

			// TODO : check for query errors + XSS attack
			global $conn;
			$res = mysqli_fetch_assoc( $conn->query( $query ) );
			return ( $res === null ) ? null : new Review( $user_id, $book_id, $res['content'], (int) $res['score'], $res['parution_date'] );
		}
	}

}

Database::setup();
