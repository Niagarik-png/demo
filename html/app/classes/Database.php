<?php

class Database {
    public static $pdo;

    public static function get(){
        if (self::$pdo == null) {
            self::$pdo = new PDO('mysql:dbname=demo;host=10.0.0.2', 'demo', 'demo');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }
}