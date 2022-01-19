<?php

namespace Framework\Database;


class Database
{
    const DB_HOST     = 'localhost';
    const DB_USER     = 'root';
    const DB_PASSWORD = 'root';
    const DB_NAME     = 'mvc';

    /**
     * @var \mysqli
     */
    private static $connection;

    /**
     * @return \mysqli
     */
    public static function getConnection() : \mysqli
    {
        if (null === self::$connection) {
            self::$connection = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_NAME );
        }

        return self::$connection;
    }

    private function __construct() {}
}