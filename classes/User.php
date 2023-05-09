<?php

if ( ! class_exists( 'User' ) ) {

	/**
	 * User class
	 */
	class User {
		private $username;
		private $firstname;
		private $lastname;
		private $email;
		private $password;

		/**
		 * Constructor
		 *
		 * @param string $id     User ID.
		 * @param string $username User username.
		 * @param string $firstname User firstname.
		 * @param string $lastname User lastname.
		 * @param string $password User password.
		 */
		public function __construct( $id, $username, $firstname, $lastname, $password ) {
			$this->id        = $id;
			$this->username  = $username;
			$this->firstname = $firstname;
			$this->lastname  = $lastname;
			$this->password  = $password;
		}

		/**
		 * Returns the user's username
		 *
		 * @return string
		 */
		public function get_username() {
			return ucfirst( $this->username );
		}

		/**
		 * Returns the user's firstname
		 *
		 * @return string
		 */
		public function get_firstname() {
			return ucfirst( $this->firstname );
		}

		/**
		 * Returns the user's lastname
		 *
		 * @return string
		 */
		public function get_lastname() {
			return ucfirst( $this->lastname );
		}

		/**
		 * Returns the user's email
		 *
		 * @return string
		 */
		public function get_email() {
			return $this->email;
		}

		/**
		 * Returns the user's password
		 *
		 * @return string
		 */
		public function get_password() {
			return $this->password;
		}

		/**
		 * Returns the user's ID
		 *
		 * @return string
		 */
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
