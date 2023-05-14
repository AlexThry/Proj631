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
		 * Get all books.
		 *
		 * @return array
		 */
		public static function get_circle( $circle_id ): array {
			global $conn;
			$sql = "SELECT * FROM circle WHERE id=$circle_id LIMIT 1;";
			$res     = mysqli_fetch_assoc($conn->query( $sql ));
			$circle = array(
				'id' => $res['id'],
				'title' => $res['title'],
				'description' => $res['description'],
				'admin_id' => $res['admin_id'],
				'image_url' => $res['image_url'],
			);
			return $circle;
		}

		/**
		 * Get reviews by book.
		 *
		 * @param int $id_book Book id.
		 * @return array
		 */
		public static function get_reviews_by_book( $id_book ): array {
			global $conn;

			$sql     = "SELECT * FROM review JOIN user ON review.id_user = user.id WHERE id_book = $id_book";
			$res     = mysqli_query( $conn, $sql );
			$reviews = array();
			foreach ( $res as $line ) {
				$review                    = array();
				$review['id_user']         = $line['id_user'];
				$review['user_name']       = $line['user_name'];
				$review['user_first_name'] = $line['first_name'];
				$review['user_last_name']  = $line['last_name'];
				$review['profile_url']     = $line['profile_url'];
				$review['content']         = $line['content'];
				$review['score']           = $line['score'];
				$review['parution_date']   = $line['parution_date'];
				$reviews[]                 = $review;
			}
			return $reviews;
		}

		/**
		 * Returns the average score of a book
		 * If there's no score, returns null
		 * @param $id_book The book's id
		 * @return null|float
		 */
		private static function calculate_average_scores_by_book($id_book) {
			global $conn;
			$sql     = "SELECT avg(score) `moyenne` FROM review JOIN user ON review.id_user = user.id WHERE id_book = $id_book";
			$res     = $conn->query($sql);
			$avg_score = mysqli_fetch_assoc($res)['moyenne'];
			return $avg_score;
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

			$reviews        = self::get_reviews_by_book( $book_id );
			$reviews_size   = sizeof( $reviews );
			$book['score']  = self::calculate_average_scores_by_book($book_id);

			if ( $reviews_size > 0 ) {
				$book['nb_reviews'] = $reviews_size;
			} else {
				$book['nb_reviews'] = "Aucun ";
			}

			return $book;
		}

		/**
		 * Get all books.
		 *
		 * @return array
		 */
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
				$books[]               = $book;
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
			$sort   = $sort == 'genre' ? 'genre.label' : $sort;
			$order  = isset( $args['order'] ) && 'DESC' === $args['order'] ? $args['order'] : 'ASC';
			$search = isset( $args['search'] ) ? $args['search'] : null;

			$sql = 'SELECT book.*, avg(score) "score" FROM book LEFT JOIN review ON review.id_book = book.id';
			if($sort == 'genre.label') $sql .= " LEFT JOIN genre ON genre.id = book.id";

			if (isset($genre)) {
				$sql .= " WHERE book.id in (SELECT id_book FROM has_genre WHERE id_genre in (SELECT id FROM genre WHERE label = '" . $genre . "'))";
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
				$books[]               = $book;
			}

			return isset( $search ) ? self::search_books( $books, $search ) : $books;
		}

		/**
		 * Get the best books according to the given parameters.
		 *
		 * @param array $args Arguemnts are :
		 *                - start : int (default: 0)
		 *                - limit : int (default: null)
		 *                - sort : string (default: 'parution_date'). Possible values are 'title', 'author', 'parution_date', 'genre', 'score'.
		 *                - order : string (default: 'ASC'). Possible values are 'ASC' and 'DESC'.
		 *              All parameters are optionnal.
		 * @return array $books Books matching the query.
		 */
		public static function get_book_genre( $genres ) {
			global $conn;

			$book = array();
			foreach ( $genres as $genre ) {
				$sql      = "SELECT * FROM book b INNER JOIN has_genre hg ON b.id = hg.id_book INNER JOIN genre g ON g.id = hg.id_genre WHERE g.label = '$genre'";
				$res      = mysqli_query( $conn, $sql );
				$num_rows = $res->num_rows;
				if ( $num_rows >= 4 && sizeof( $book ) === 0 ) {
					$book = self::get_sorted_books(
						array(
							'genre' => $genre,
							'start' => 0,
							'limit' => 4,
							'sort'  => 'genre',
							'order' => 'ASC',
						)
					);
				} else {
					$book = array_merge(
						$book,
						self::get_sorted_books(
							array(
								'genre' => $genre,
								'start' => 0,
								'limit' => 4 - sizeof( $book ),
								'sort'  => 'genre',
								'order' => 'ASC',
							)
						)
					);
				}
			}

			if ( sizeof( $book ) < 4 ) {
				$sql        = "SELECT label FROM genre WHERE label NOT IN ('" . implode( "','", $genres ) . "')";
				$res        = mysqli_query( $conn, $sql );
				$row        = mysqli_fetch_assoc( $res );
				$otherGenre = $row['label'];
				$book       = array_merge(
					$book,
					self::get_sorted_books(
						array(
							'genre' => $otherGenre,
							'start' => 0,
							'limit' => 4 - sizeof( $book ),
							'sort'  => 'genre',
							'order' => 'ASC',
						)
					)
				);
			}

			return $book;
		}

		/**
		 * Return the list of books matching the search query
		 *
		 * @param array  $books The list of books to search in.
		 * @param string $search The search query.
		 * @return array
		 */
		public static function get_users(): array {
			global $conn;

			$sql   = 'SELECT * FROM user';
			$res   = $conn->query( $sql );
			$users = array();
			foreach ( $res as $line ) {
				$user                  = array();
				$user['id']            = $line['id'];
				$user['user_name']     = $line['user_name'];
				$user['password']      = $line['password'];
				$user['creation_date'] = $line['creation_date'];
				$users[]               = $user;
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

			$sql = "SELECT b.id, b.title, b.author, b.parution_date, b.image_url, r.score AS score
					FROM book b
					JOIN has_read hr ON hr.id_user = $user_id AND hr.id_book = b.id
					LEFT JOIN review r ON r.id_book = b.id;";

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

			$sql = "SELECT b.id, b.title, b.author, b.parution_date, b.image_url, r.score AS score
					FROM book b
					JOIN wants_to_read wr ON wr.id_user = $user_id AND wr.id_book = b.id
					LEFT JOIN review r ON r.id_book = b.id;";

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
		 * Returns whether a user wants to read a book or not
		 * @param int $user_id The user's id.
		 * @param int $book_id The book's id.
		 * @return bool
		 */
		public static function user_wants_to_read( $user_id, $book_id ): bool {
			global $conn;
			$sql = "SELECT id_user FROM wants_to_read WHERE id_user = $user_id AND id_book = $book_id LIMIT 1";
			$result = $conn->query($sql);
			return mysqli_num_rows($result) > 0;
		}

		/**
		 * Returns whether a user is subscribed to a circle or not
		 * @param int $user_id The user's id.
		 * @param int $circle_id The circle's id.
		 * @return bool
		 */
		public static function user_is_subscribed( $user_id, $circle_id ): bool {
			global $conn;
			$sql = "SELECT user_id FROM user_in_circle WHERE user_id = $user_id AND circle_id = $circle_id;";
			$res = $conn->query($sql);
			return mysqli_num_rows($res) > 0;
		}

		/**
		 * Returns whether a user has read a book or not
		 * @param int $user_id The user's id.
		 * @param int $book_id The book's id.
		 * @return bool
		 */
		public static function user_has_read( $user_id, $book_id ): bool {
			global $conn;
			$sql = "SELECT * FROM has_read WHERE id_user = $user_id AND id_book = $book_id LIMIT 1";
			$result = $conn->query($sql);
			return mysqli_num_rows($result) > 0;
		}

		/**
		 * Returns whether a user is the admin of a certain circle
		 * @param int $user_id The user's id.
		 * @param int $book_id The circle's id.
		 * @return bool
		 */
		public static function user_is_circle_admin( $user_id, $circle_id ): bool {
			global $conn;
			$sql = "SELECT id FROM circle WHERE admin_id = $user_id AND id = $circle_id LIMIT 1";
			$result = $conn->query($sql);
			return mysqli_num_rows($result) > 0;

		}
		/**
		 * Returns whether a book is in a circle or not
		 * @param int $user_id The user's id.
		 * @param int $book_id The circle's id.
		 * @return bool
		 */
		public static function book_is_in_circle( $book_id, $circle_id ): bool {
			global $conn;
			$sql = "SELECT book_id FROM book_in_circle WHERE book_id = $book_id AND circle_id = $circle_id LIMIT 1";
			$result = $conn->query($sql);
			return mysqli_num_rows($result) > 0;
		}

		/**
		 * Returns whether a user has read a book or not
		 * @param int $user_id The user's id.
		 * @param int $book_id The book's id.
		 * @return bool
		 */
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
		public static function get_user( $user_id ) {
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

		/**
		 * Get user's circles.
		 *
		 * @param int $user_id The user's id.
		 * @return array|null The user's circles.
		 */
		public static function get_circles() {
			global $conn;
			$sql = 'SELECT * FROM circle';

			$res     = $conn->query( $sql );
			$circles = array();
			foreach ( $res as $line ) {
				$circle                     = array();
				$circle['id']               = $line['id'];
				$circle['title']            = $line['title'];
				$circle['description']      = $line['description'];
				$circle['image_url']        = $line['image_url'];
				$circle['admin_id']         = $line['admin_id'];
				$circles[]                  = $circle;
			}

			return $circles;
		}

		// on doit recup
		// les utilisateurs
		// les livres
		// todo: ajouter un champ date_ajout dans la db pour les livres ajoutés à un cercle
		public static function get_single_circle($circle_id): array {
			// to code here
			return array();
		}
		
		/**
		 * Get all books in a circle.
		 *
		 * @param int $circle_id The circle's id.
		 * @return array|null The books' data.
		 */
		public static function get_user_circles( $user_id ) {
			global $conn;

			// $sql = "SELECT * FROM circle WHERE id IN (SELECT circle_id FROM user_in_circle WHERE user_id = $user_id);";
			$sql = "SELECT c.* FROM user u
				JOIN circle c ON c.admin_id = u.id
				WHERE u.id = $user_id;";

			$res     = $conn->query( $sql );
			$circles = array();
			foreach ( $res as $line ) {
				$circle                     = array();
				$circle['id']               = $line['id'];
				// $circle['admin_user_name']  = $line['user_name'];
				// $circle['admin_first_name'] = $line['first_name'];
				// $circle['admin_last_name']  = $line['last_name'];
				$circle['title']            = $line['title'];
				$circle['description']      = $line['description'];
				$circle['image_url']        = $line['image_url'];
				$circle['admin_id']         = $line['admin_id'];
				$circles[]                  = $circle;
			}

			return ( $circles === null ) ? null : $circles;
		}

		/**
		 * Get all books in a circle.
		 *
		 * @param int $circle_id The circle's id.
		 * @return array|null The books.
		 */
		public static function get_circle_books( $circle_id ) {
			global $conn;

			$sql = "SELECT b.*, r.score AS score
					FROM book_in_circle bic
					JOIN book b ON b.id = bic.book_id
					LEFT JOIN review r ON r.id_book = b.id
					WHERE bic.circle_id = $circle_id;";

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
		 * Get all users in a circle.
		 *
		 * @param int $circle_id
		 * @return array
		 */
		public static function get_circle_users( $circle_id ) {
			global $conn;

			$sql = "SELECT * FROM user_in_circle uic
					JOIN user ON uic.user_id = user.id
					WHERE uic.circle_id = $circle_id";

			$res   = $conn->query( $sql );
			$users = array();
			foreach ( $res as $line ) {
				$user                  = array();
				$user['id']            = $line['id'];
				$user['user_name']     = $line['user_name'];
				$user['password']      = $line['password'];
				$user['creation_date'] = $line['creation_date'];
				$user['profile_url']   = $line['profile_url'];
				$users[]               = $user;
			}
			return $users;
		}

		/**
		 * Get circle by id.
		 *
		 * @param int         $circle_id The circle's id.
		 * @return array|null The circle's data.
		 */
		public static function create_circle( $title, $description, $admin_id, $image_url = null ): void {
			global $conn;
			if ( $image_url ) {
				$image_url = "'$image_url'";
			} else {
				$image_url = 'NULL';
			}

			$sql = "SELECT * FROM circle WHERE title = '$title';";
			if ( mysqli_query( $conn, $sql )->num_rows > 0 ) {
				throw new Exception( 'Le nom de cercle est déjà utilisé.' );
			}
			$sql = "INSERT INTO circle (title, description, image_url, admin_id) VALUES ('$title', '$description', $image_url, $admin_id)";
			$conn->query( $sql );
		}

		/**
		 * Gets the average score of a book by it's id.
		 *
		 * @param int    $book_id The book's id.
		 * @return float The book's average score.
		 */
		public static function get_book_average($book_id): float {
			global $conn;

			$sql = "SELECT AVG(score) as moyenne FROM review JOIN book ON book.id = review.id_book WHERE id_book = $book_id;";
			$res = $conn->query($sql);
			$moyenne = $res->fetch_assoc()['moyenne'];
			return $moyenne;
		}

		/**
		 * Adds a review.
		 *
		 * @param string      $content The review's comment.
		 * @param int         $id_book The rated book id.
		 * @param int         $id_user The user that rated the book.
		 * @param string      $parution_date The date the review was published.
		 * @param int         $score The score that gave the user.
		 */
		public static function add_review($content, $id_book, $id_user, $parution_date, $score) {
			global $conn;

			$sql = "SELECT * FROM review WHERE id_book = $id_book AND id_user = $id_user AND content = '$content';";
			$res = $conn->query($sql);
			if ($res->num_rows > 0) {
				throw new Exception("Vous avez déjà écrit une critique pour ce livre.");
				return;
			}

			$sql = 'INSERT INTO review (content, id_book, id_user, parution_date, score) VALUES ("' . $content . '", ' . $id_book . ', ' . $id_user . ', "' . $parution_date . '", ' . $score . ');';
			$conn->query($sql);
		}
	}
}

Database::setup();
