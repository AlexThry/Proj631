<?php
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
?>