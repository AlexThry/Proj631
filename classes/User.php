<?php

if ( ! class_exists( 'User' ) ) {

	/**
	 * User class
	 */
	class User {
		private $name;
		private $password;

		public function __construct( $id, $name, $password ) {
			$this->id       = $id;
			$this->name     = $name;
			$this->password = $password;
		}

		public function getName() {
			return ucfirst( $this->name );
		}

		public function getPassword() {
			return $this->password;
		}

		public function getId() {
			return $this->id;
		}

		/**
		 * Returns the list of books the user wants to read and has already read
		 *
		 * @return array(Book)
		 */
		public function books(): array {
			return Database::get_user_books( $this->id );
		}

		/**
		 * Returns the list of books the user wants to read
		 *
		 * @return array(Book)
		 */
		public function wishlist(): array {
			return Database::get_user_wishlist( $this->id );
		}

		// public function setname($name) {
		// $this->name = $name;
		// }

		// public function setPassword($password) {
		// $this->password = $password;
		// }

		// public function setid($id) {
		// $this->id = $id;
		// }
	}
}
