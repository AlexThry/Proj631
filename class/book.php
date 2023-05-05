<?php
class Book {
    private $id;
    private $author;
    private $parution_date;
    private $title;

    public function __construct($id, $author, $parution_date, $title) {
        $this->id = $id;
        $this->author = $author;
        $this->parution_date = $parution_date;
        $this->title = $title;
    }

    public function getid() {
        return $this->id;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getParutionDate() {
        return $this->parution_date;
    }

    public function getTitle() {
        return $this->title;
    }
}
