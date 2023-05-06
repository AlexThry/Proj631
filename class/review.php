<?php

class Review {
    private $id_book;
    private $id_user;
    private $content;
    private $score;
    private $parution_date;
    const MAX_SCORE = 5;

    public function __construct($id_book, $id_user, $content, $score, $parution_date) {
        $this->id_book = $id_book;
        $this->id_user = $id_user;
        $this->content = $content;
        $this->score = $score;
        $this->parution_date = $parution_date;
    }

    public function getIdBook() {
        return $this->id_book;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getContent() {
        return $this->content;
    }

    public function getScore() {
        return $this->score;
    }

    public function getParutionDate() {
        $date_format = date("d/m/Y H:i:s", strtotime($this->parutionDate));
        return $date_format;
    }
}