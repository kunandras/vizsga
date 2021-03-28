<?php

class Database
{
    private static string $dbhost = 'localhost';
    private static string $dbname = 'forum';
    private static string $dbuser = 'root';
    private static string $dbpass = '';
    private static $dsn;
    
    /**
     * @throws PDOException
     */
    public static function getInstance()
    {
        self::$dsn = 'mysql:host=' . self::$dbhost . ';dbname=' . self::$dbname . ';charset=utf8';
        try {
            self::$dsn = new PDO(self::$dsn, self::$dbuser, self::$dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $e) {
            throw new PDOException('Sikertelen adatbázis csatlakozás: ' . $e->getMessage());
        }
        return self::$dsn;
    }
}