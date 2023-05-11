<?php

const DB_USER_NAME = 'root';
const DB_PASSWORD  = '';

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

			$conn = new mysqli( 'localhost', DB_USER_NAME, DB_PASSWORD );

			if ( ! $conn ) {
				echo 'Erreur de connexion à la bdd';
			}

			$conn->query( 'USE Proj631' );
			$conn->query( 'SET NAMES utf8' );
		}

		/**
		 * Get reviews by book.
		 *
		 * @param int $id_book Book id.
		 * @return array
		 */
		private static function get_reviews_by_book( $id_book ): array {
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
				$reviews[]               = $review;
			}
			return $reviews;
		}

		/**
		 * Get a single book.
		 *
		 * @param int $book_id Book id.
		 * @return array
		 */
		public static function get_single_book( $book_id ): array {
			global $conn;

			$sql   = 'SELECT * FROM book WHERE id = ' . $book_id . ';';
			$res   = mysqli_query( $conn, $sql );
			$books = array();
			foreach ( $res as $line ) {
				$book                  = array();
				$book['id']            = $line['id'];
				$book['title']         = $line['title'];
				$book['author']        = $line['author'];
				$book['description']   = $line['description'];
				$book['image_url']     = $line['image_url'];
				$book['parution_date'] = $line['parution_date'];
				$books[]               = $book;
			}

			if ( count( $books ) !== 1 ) {
				throw new Exception( 'Le livre n\'est pas ou plusieurs fois présent.' );
			}

			$book = $books[0];

			$sql    = 'SELECT label FROM has_genre hg INNER JOIN genre g ON hg.id_genre = g.id WHERE id_book = ' . $book_id . ';';
			$res    = mysqli_query( $conn, $sql );
			$genres = array();

			foreach ( $res as $line ) {
				$genres[] = $line['label'];
			}

			if ( count( $genres ) == 0 ) {
				throw new Exception( 'Le livre n\'a pas de genre précisé.' );
			}

			$book['genres'] = $genres;

			$reviews      = self::get_reviews_by_book( $book_id );
			$reviews_size = sizeof( $reviews );

			if ( $reviews_size > 0 ) {
				$book['score']      = $reviews[0]['score'];
				$book['nb_reviews'] = $reviews_size;
			} else {
				$book['score']      = 'Aucune note';
				$book['nb_reviews'] = 'Aucun ';
			}

			return $book;
		}

		public static function get_books(): array {
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
				$book['image_url']     = $line['image_url'];
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
		 * Filter books according to the $search parameter.
		 *
		 * @param array  $books Books to filter.
		 * @param string $search Search string.
		 * @return array
		 */
		private static function search_books( $books, $search ): array {
			return array_filter(
				$books,
				function ( $book ) use ( $search ) {
					return strpos( strtolower( $book['title'] ), strtolower( $search ) ) !== false
						|| strpos( strtolower( $book['author'] ), strtolower( $search ) ) !== false
						|| strpos( strtolower( $book['description'] ), strtolower( $search ) ) !== false;
				}
			);
		}

		/**
		 * Query books in the db according to the given parameters.
		 *
		 * @param array $args Arguemnts are :
		 *                - genre : string (a specific genre) (default: null)
		 *                - start : int (default: 0)
		 *                - limit : int (default: null)
		 *                - sort : string (default: 'parution_date'). Possible values are 'title', 'author', 'parution_date', 'genre', 'score'.
		 *                - order : string (default: 'ASC'). Possible values are 'ASC' and 'DESC'.
		 *              All parameters are optionnal.
		 * @return array $books Books matching the query.
		 */
		public static function get_sorted_books( $args ): array {
			global $conn;

			$genre  = isset( $args['genre'] ) && ! empty( $args['genre'] ) ? $args['genre'] : null;
			$start  = isset( $args['start'] ) ? $args['start'] : 0;
			$limit  = isset( $args['limit'] ) ? $args['limit'] : null;
			$sort   = isset( $args['sort'] ) ? $args['sort'] : 'parution_date, score';
			$order  = isset( $args['order'] ) && 'DESC' === $args['order'] ? $args['order'] : 'ASC';
			$search = isset( $args['search'] ) ? $args['search'] : null;

			$sql = 'SELECT book.*, avg(score) "score" FROM book LEFT JOIN review ON review.id_book = book.id';

			if ( isset( $genre ) ) {
				$sql .= " WHERE id in (SELECT id_book FROM has_genre WHERE id_genre in (SELECT id FROM genre WHERE label = '" . $genre . "'))";
			}

			$sql .= ' GROUP BY book.id ';
			$sql .= ' ORDER BY ' . $sort . ' ' . $order . ( isset( $limit ) ? ' LIMIT ' . $limit . ' OFFSET ' . $start : '' ) . ';';

			$res = mysqli_query( $conn, $sql );

			$books = array();
			foreach ( $res as $line ) {
				$book                  = array();
				$book['id']            = $line['id'];
				$book['title']         = $line['title'];
				$book['author']        = $line['author'];
				$book['description']   = $line['description'];
				$book['image_url']     = $line['image_url'];
				$book['parution_date'] = $line['parution_date'];
				$book['score']         = $line['score'];
				$books[ $line['id'] ]  = $book;
			}

			return isset( $search ) ? self::search_books( $books, $search ) : $books;
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

		public static function get_users(): array {
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
		 * ReturnIs the list of books a user wants to read and has already read
		 *
		 * @param int $user_id The user's id.
		 * @return array
		 */
		public static function get_user_books( $user_id ): array {
			global $conn;

			$sql = 'SELECT b.id, b.title, b.author, b.parution_date, b.image_url, COALESCE(r.score, 0) AS score
					FROM book b
					JOIN has_read hr ON hr.id_user = 2 AND hr.id_book = b.id
					LEFT JOIN review r ON r.id_book = b.id;';

			$res   = $conn->query( $sql );
			$books = array();
			foreach ( $res as $line ) {
				$book                  = array();
				$book['id']            = $line['id'];
				$book['author']        = $line['author'];
				$book['parution_date'] = $line['parution_date'];
				$book['title']         = $line['title'];
				$book['image_url']     = $line['image_url'];
				$book['score']         = $line['score'];
				$books[]               = $book;
			}
			return $books;
		}

		/**
		 * Returns the list of books a user wants to read
		 *
		 * @param int $user_id The user's id.
		 * @return array
		 */
		public static function get_user_wishlist( $user_id ): array {
			global $conn;

			$sql = 'SELECT b.id, b.title, b.author, b.parution_date, b.image_url, COALESCE(r.score, 0) AS score
					FROM book b
					JOIN wants_to_read wr ON wr.id_user = 2 AND wr.id_book = b.id
					LEFT JOIN review r ON r.id_book = b.id;';

			$res   = $conn->query( $sql );
			$books = array();
			foreach ( $res as $line ) {
				$book                  = array();
				$book['id']            = $line['id'];
				$book['author']        = $line['author'];
				$book['parution_date'] = $line['parution_date'];
				$book['title']         = $line['title'];
				$book['image_url']     = $line['image_url'];
				$book['score']         = $line['score'];
				$books[]               = $book;
			}
			return $books;
		}

		public static function get_review( $user_id, $book_id ) {
			global $conn;

			$sql = "SELECT * FROM review
                WHERE id_user = $user_id
                AND id_book = $book_id";

			$res     = $conn->query( $sql );
			$reviews = array();
			foreach ( $res as $line ) {
				$review                  = array();
				$review['id_user']       = $user_id;
				$review['id_book']       = $book_id;
				$review['content']       = $line['content'];
				$review['score']         = $line['score'];
				$review['parution_date'] = $line['parution_date'];
				$reviews[]               = $review;
			}

			return ( $reviews === null ) ? null : $reviews;
		}

		/**
		 * Get user by id.
		 *
		 * @param int $user_id The user's id.
		 * @return array|null The user's data.
		 */
		public static function get_user_by_id( $user_id ) {
			global $conn;
			$sql   = "SELECT * FROM user WHERE id='" . $user_id . "'";
			$res   = $conn->query( $sql );
			$users = array();
			foreach ( $res as $line ) {
				$users[] = array(
					'id'            => $line['id'],
					'user_name'     => $line['user_name'],
					'first_name'    => $line['first_name'],
					'last_name'     => $line['last_name'],
					'email'         => $line['email'],
					'profile_url'   => $line['profile_url'],
					'password'      => $line['password'],
					'creation_date' => $line['creation_date'],
				);
			}

			if ( count( $users ) > 2 ) {
				throw new Exception( 'Several users found' );
			}

			return isset( $users ) ? $users[0] : null;
		}

		/**
		 * Update user's informations.
		 *
		 * @param int   $user_id
		 * @param array $args
		 * @return void
		 */
		public static function update_user( $user_id, $args ): void {
			global $conn;

			$user_keys  = array( 'user_name', 'password', 'profile_url', 'first_name', 'last_name', 'email' );
			$sql_values = array();

			foreach ( $user_keys as $user_key ) {
				if ( isset( $args[ $user_key ] ) ) {
					array_push( $sql_values, $user_key . " = '" . $args[ $user_key ] . "'" );
				}
			}

			$sql_set_line = join( ', ', $sql_values );

			$sql = 'UPDATE user SET ' . $sql_set_line . ' WHERE id=' . $user_id . ';';
			$conn->query( $sql );
		}

		public static function get_circles() {
			global $conn;

			// $sql = "SELECT * FROM circle WHERE id IN (SELECT circle_id FROM user_in_circle WHERE user_id = $user_id);";
			$sql = 'SELECT *
			FROM circle
			JOIN user ON circle.admin_id = user.id;';

			$res     = $conn->query( $sql );
			$circles = array();
			foreach ( $res as $line ) {
				$circle                     = array();
				$circle['id']               = $line['id'];
				$circle['admin_user_name']  = $line['user_name'];
				$circle['admin_first_name'] = $line['first_name'];
				$circle['admin_last_name']  = $line['last_name'];
				$circle['title']            = $line['title'];
				$circle['description']      = $line['description'];
				$circle['image_url']        = $line['image_url'];
				$circle['admin_id']         = $line['admin_id'];
				$circles[]                  = $circle;
			}

			return ( $circles === null ) ? null : $circles;
		}

		public static function get_user_circles( $user_id ) {
			global $conn;

			// $sql = "SELECT * FROM circle WHERE id IN (SELECT circle_id FROM user_in_circle WHERE user_id = $user_id);";
			$sql = "SELECT *
			FROM circle
			JOIN user ON circle.admin_id = user.id
			WHERE circle.id IN (
				SELECT circle_id
				FROM user_in_circle
				WHERE user_id = $user_id
			);";

			$res     = $conn->query( $sql );
			$circles = array();
			foreach ( $res as $line ) {
				$circle                     = array();
				$circle['admin_user_name']  = $line['user_name'];
				$circle['admin_first_name'] = $line['first_name'];
				$circle['admin_last_name']  = $line['last_name'];
				$circle['title']            = $line['title'];
				$circle['description']      = $line['description'];
				$circle['image_url']        = $line['image_url'];
				$circle['admin_id']         = $line['admin_id'];
				$circles[ $line['id'] ]     = $circle;
			}

			return ( $circles === null ) ? null : $circles;
		}

		public static function create_circle( $title, $description, $admin_id, $image_url = null ) {
			global $conn;
			if ( $image_url ) {
				$image_url = "'$image_url'";
			} else {
				$image_url = 'NULL';
			}

			$sql = "SELECT * FROM circle WHERE title = '$title';";
			if (mysqli_query($conn, $sql)->num_rows > 0) {
				throw new Exception("Le nom de cercle est déjà utilisé.");
			}
			$sql = "INSERT INTO circle (title, description, image_url, admin_id) VALUES ('$title', '$description', $image_url, $admin_id)";
			$conn->query( $sql );
		}


	}
}

Database::setup();
