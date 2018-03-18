<?php

require_once 'Config/connection.php';

/**
 * Abstract Class Model
 *
 * @author Joseph Selven
 */
abstract class Model
{
    private static $db;

    /**
     * return pdo instance
     *
     * @return PDO
     */
    protected static function getDB()
    {
        static $db = null;

        if (self::$db === null) {
            $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
            $user = DB_USER;
            $password = DB_PASSWORD;

            self::$db = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }

        return self::$db;
    }
}
