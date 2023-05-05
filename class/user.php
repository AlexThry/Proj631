<?php

require_once("book.php");

class User {
    private $name;
    private $password;

    public function __construct($id, $name, $password) {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }

    public function getname() {
        return ucfirst($this->name);
    }

    public function getPassword() {
        return $this->password;
    }

    public function getid() {
        return $this->id;
    }

    /**
     * Returns a the list of books the user want to read
     * and has already read
     * @return array(Book)
     */
    public function books(): array {
        global $conn;

        // TODO : Deleguate to controller
        $user_id = $this->id;
        $query = "SELECT * FROM book
            JOIN has_read hr ON hr.id_user = $user_id
            UNION
            SELECT * FROM book
            JOIN wants_to_read wtr ON wtr.id_user = $user_id";

        // TODO : check for query errors + XSS attack
        $result = $conn->query($query);
        $books = array();
        while($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }
        return $books;
    }

    // public function setname($name) {
    //     $this->name = $name;
    // }

    // public function setPassword($password) {
    //     $this->password = $password;
    // }

    // public function setid($id) {
    //     $this->id = $id;
    // }
}
