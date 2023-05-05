<?php

const DB_USERNAME = 'root';
const DB_PASSWORD = 'root';

final class Database {

    public static function setup() {
        self::connect_db();
    }

    public static function connect_db() {
        global $conn;
        $conn  = new mysqli('localhost', DB_USERNAME, DB_PASSWORD);
        
        if ( ! $conn ) {
            echo 'Erreur de connexion à la bdd';
        }

        mysqli_query($conn, "USE Proj631");

    }

    public static function get_books():array {
        global $conn;
        $sql = "SELECT * FROM book;";
        $res = mysqli_query($conn, $sql);
        $books = array();
        foreach ($res as $line) {
            $book = array();
            $book["title"] = $line["title"];
            $book["author"] = $line["author"];
            $book["description"] = $line["description"];
            $book["link"] = $line["link"];
            $book["parution_date"] = $line["parution_date"];
            $books[$line["id"]] = $book;
        }
        return $books;

    }

    public static function get_books_by_genre($genre):array {
        global $conn;
        $sql = "SELECT * FROM book WHERE id in (SELECT id_book FROM has_genre WHERE id_genre in (SELECT id FROM genre WHERE label = '" . $genre . "'));";
        $res = mysqli_query($conn, $sql);
        $books = array();
        foreach ($res as $line) {
            $book = array();
            $book["title"] = $line["title"];
            $book["author"] = $line["author"];
            $book["description"] = $line["description"];
            $book["link"] = $line["link"];
            $book["parution_date"] = $line["parution_date"];
            $books[$line["id"]] = $book;
        }
        return $books;
    }

    public static function get_reviews_by_book($id_book):array {
        global $conn;
        $sql = "SELECT * FROM review WHERE id_book = $id_book";
        $res = mysqli_query($conn, $sql);
        $reviews = array();
        foreach ($res as $line) {
            $review = array();
            $review["id_user"] = $line["id_user"];
            $review["content"] = $line["content"];
            $review["score"] = $line["score"];
            $review["parution_date"] = $line["parution_date"];
            $reviews[$line["id"]] = $review;
        }
        return $reviews;
    }

    public static function get_users():array {
        global $conn;
        $sql = "SELECT * FROM user";
        $res = mysqli_query($conn, $sql);
        $users = array();
        foreach ($res as $line) {
            $user = array();
            $user["user_name"] = $line["user_name"];
            $user["password"] = $line["password"];
            $user["creation_date"] = $line["creation_date"];
            $users[$line["id"]] = $user;
        }
        return $users;
    }
    

}

Database::setup();

?>