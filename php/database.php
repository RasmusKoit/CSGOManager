<?php
/**
 * Created by PhpStorm.
 * User: arti
 * Date: 3/6/18
 * Time: 4:16 PM
 */

class DB {

    private static $host = 'localhost';
    private static $dbname = 'servers';
    private static $charset = 'utf8mb4';
    private static $username = 'www-data';
    private static $password = 'salakala';

    static function connect() {
        $dsn = 'mysql:host=' . static::$host . ';dbname=' . static::$dbname . ';charset=' . static::$charset. ';';
        try {
            $db = new PDO($dsn, static::$username, static::$password);
        } catch (PDOException $e) {
            echo "Could not connect to MySQL";
            var_dump($e->getMessage());
        }


        return $db;
    }

    static function run($sql="", $args=[]) {
        $pdo =self::connect();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}