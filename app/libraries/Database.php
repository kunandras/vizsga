<?php

class Database
{
    private static string $dbhost = 'localhost';
    private static string $dbname = 'forum';
    private static string $dbuser = 'root';
    private static string $dbpass = '';
    private static PDO $db_singleton;

    /**
     * @return PDO
     * @throws PDOException
     */
    public static function getInstance(): PDO
    {
        if (empty(self::$db_singleton)) {
            try {
                self::$db_singleton = new PDO('mysql:host=' . self::$dbhost . ';dbname=' . self::$dbname . ';charset=utf8', self::$dbuser, self::$dbpass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                throw new PDOException('Sikertelen adatbázis csatlakozás: ' . $e->getMessage());
            }
        }
        return self::$db_singleton;
    }
}