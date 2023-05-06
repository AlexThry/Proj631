<?php

const DB_USERNAME = 'root';
const DB_PASSWORD = '';

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

        $conn->query("USE Proj631");
        $conn->query("SET NAMES utf8");

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
        $res = $conn->query($sql);
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

    public static function get_user_books($user_id): array {
        $query = "SELECT b.id, title, author, parution_date, link FROM book b
            JOIN has_read hr ON hr.id_user = $user_id
            UNION
            SELECT b.id, title, author, parution_date, link FROM book b
            JOIN wants_to_read wtr ON wtr.id_user = $user_id";

        // TODO : check for query errors + XSS attack
        global $conn;
        $res = $conn->query($query);
        $books = array();
        foreach ($res as $line) {
            $books[] = new Book((int)$line["id"], $line["author"], $line["parution_date"], $line["title"], $line["link"]);
        }
        return $books;
    }

    public static function get_review($user_id, $book_id) {
        $query = "SELECT * FROM review
            WHERE id_user = $user_id
            AND id_book = $book_id";

        // TODO : check for query errors + XSS attack
        global $conn;
        $res = mysqli_fetch_assoc($conn->query($query));
        return ($res === null) ? null : new Review($user_id, $book_id, $res['content'], (int)$res['score'], $res['parution_date']);
    }
}

Database::setup();

?>
