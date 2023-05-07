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

		public function get_name() {
			return ucfirst( $this->name );
		}

		public function get_password() {
			return $this->password;
		}

		public function get_id() {
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
	}
}
