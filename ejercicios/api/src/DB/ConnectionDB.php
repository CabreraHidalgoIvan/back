<?php

namespace App\DB;

use App\Config\ResponseHttp;
use PDO;

require __DIR__. '/dataDB.php';

class ConnectionDB {

    private static $host = '';

    private static $user = '';
    private static $password = '';

    final public static function from($host, $user, $password) {
        self::$host     = $host;
        self::$user     = $user;
        self::$password = $password;
    }

    final public static function getConnection() {
        try {
            $opt = [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC];
            $dns = new PDO(self::$host, self::$user, self::$password, $opt);
            $dns->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            error_log('Conexión exitosa');
            return $dns;
        } catch (\PDOException $e) {
            error_log('Error de conexión: ' . $e->getMessage());
            die(json_encode(ResponseHttp::status500()));
        }
    }

}