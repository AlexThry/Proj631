<?php

if ( ! class_exists( 'Book' ) ) {

	/**
	 * Book class
	 */
	class Book {
		private $id;
		private $author;
		private $parution_date;
		private $title;
		private $link;

		public function __construct( $id, $author, $parution_date, $title, $link ) {
			$this->id            = $id;
			$this->author        = $author;
			$this->parution_date = $parution_date;
			$this->title         = $title;
			$this->link          = $link;
		}

		public function get_id() {
			return $this->id;
		}

		public function get_author() {
			return $this->author;
		}

		public function get_parution_date() {
			return $this->parution_date;
		}

		public function get_title() {
			return $this->title;
		}

		public function get_link() {
			return $this->link;
		}
	}
}
