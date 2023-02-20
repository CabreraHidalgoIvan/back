<?php

namespace App\Config;

use Dotenv\Dotenv;
use Firebase\JWT\JWT;

class Security {

    private static $jwt_data;

    final public static function secretKey() {

        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
        return $_ENV['SECRET_KEY'];

    }

    final public static function createPassword(string $password) {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        return $pass;
    }

    final public static function validatePassword(string $password, string $hash) {
        if(password_verify($password, $hash)) {
            return true;
        } else {
            error_log('La contraseña no coincide con el hash');
            return false;
        }
    }

    final public static function createTokenJwt(string $key, array $data) {
        $payload = array(
            'iat' => time(),
            'exp' => time() + 60,
            'data' => $data
        );

        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }

    final public static function validateTokenJwt(array $token, string $key) {

        if(!isset($token['Authorization'])) {
            die(json_encode(ResponseHttp::status400('Token is required')));
            exit();
        }

        try {
            $jwt = explode(" ", $token['Authorization']);
            $data = JWT::decode($jwt[1], $key, array('HS256'));
            self::$jwt_data = $data;
            return $data;
        } catch (\Exception $e) {
            error_log('Token Invalid');
            die(json_encode(ResponseHttp::status401('Token Invalid')));
        }

    }

    final public static function getJwtData() {

        $jwtDecodedArray = json_decode(json_decode(self::$jwt_data),true);
        return $jwtDecodedArray['data'];
        exit();
    }

}