<?php
use \DAO\DB as DB;

class Users {

    function __construct() {

    }

    public function All() {
        $db = DB::Init();
        $query = $db->prepare("SELECT * FROM users");
        $query->execute();
        DB::PrintRes($query);
    }

    public function getById($id) {
        $db = DB::Init();
        $query = $db->prepare("SELECT * FROM users WHERE id = ?");
        $query->execute([$id]);
        DB::printres($query);
    }
}