<?php
namespace DAO;

class DB {
    public function __construct() {
    }

    public static function Init() {
        $ini = parse_ini_file(__DIR__ . "/../config.ini");
        $conn = new \PDO('mysql:host='.$ini["servername"].';dbname='. $ini["databasename"], $ini["username"], $ini["password"]);
        return $conn;
    }

    public static function PrintRes($query) {
        print_r(json_encode($query->fetchAll(\PDO::FETCH_ASSOC)));
    }
}