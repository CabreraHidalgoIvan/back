<?php

namespace App\Models;

use App\Config\ResponseHttp;
use App\Config\Security;
use App\DB\ConnectionDB;
use App\DB\Sql;

class UserModel extends ConnectionDB
{

    private static string $nombre;
    private static string $dni;
    private static string $correo;
    private static int $rol;
    private static string $password;
    private static string $IDToken;


    public function __construct(array $data)
    {
        self::$nombre   = $data['nombre'];
        self::$dni      = $data['dni'];
        self::$correo   = $data['correo'];
        self::$rol      = $data['rol'];
        self::$password = $data['password'];
    }

    final public static function getName(){return self::$nombre;}
    final public static function getDni(){return self::$dni;}
    final public static function getEmail(){return self::$correo;}
    final public static function getRol(){return self::$rol;}
    final public static function getPassword(){return self::$password;}
    final public static function getIDToken() {return self::$IDToken;}

    final public static function setNombre(string $nombre) {self::$nombre = $nombre;}
    final public static function setDni(string $dni) {self::$dni = $dni;}
    final public static function setCorreo(string $correo) {self::$correo = $correo;}
    final public static function setRol(int $rol) {self::$rol = $rol;}
    final public static function setPassword(string $password) {self::$password = $password;}
    final public static function setIDToken(string $IDToken) {self::$IDToken = $IDToken;}


    final public static function validateUserPassword(string $IDToken, string $oldPassword) {

        try {

                $con = self::getConnection();
                $query = $con->prepare("SELECT * FROM usuarios WHERE IDToken = :IDToken");
                $query->execute([
                    ':IDToken' => $IDToken
                ]);

                if ($query->rowCount() === 0) {
                    die(json_encode(ResponseHttp::status400('El IDToken no existe')));
                } else {
                    $res = $query->fetch(\PDO::FETCH_ASSOC);

                    if (Security::validatePassword($oldPassword, $res['password'])) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } catch (\PDOException $e) {
                return ResponseHttp::status500($e->getMessage());
        }
    }

    ////////////////////// LOGIN //////////////////////

    final public static function login() {

        try {

            $con = self::getConnection();
            $query = $con->prepare("SELECT * FROM usuarios WHERE correo = :correo");
            $query->execute([
                ':correo' => self::getEmail()
            ]);

            if ($query->rowCount() === 0) {
                return ResponseHttp::status400('El correo no existe');
            } else {
                foreach ($con as $res) {
                    echo self::getPassword() . '<br>';
                    echo $res['password'] . '<br>';
                    if (Security::validatePassword(self::getPassword(), $res['password'])) {
                        $payload = ['IDToken' => $res['IDToken']];
                        $token = Security::createTokenJwt(Security::secretKey(), $payload);

                        $data = [
                            'name' => $res['nombre'],
                            'rol' => $res['rol'],
                            'token' => $token
                        ];

                        echo json_encode($data);

                        return ResponseHttp::status200($data);
                        exit();
                    } else {
                        return ResponseHttp::status400('Usuario o Contraseña incorrecta');
                    }
                }
            }
        } catch (\PDOException $e) {
            error_log('UserModel::Login: ' . $e->getMessage());
            die(json_encode(ResponseHttp::status500('Puto')));
        }

        return ResponseHttp::status400('Usuario o Contraseña incorrecta');
    }

    ////////////////////// GETALL //////////////////////

    final public static function getAll()
    {
        try {
            $con = self::getConnection();
            $query = $con->query("SELECT * FROM usuarios");
            $rs['data'] = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $rs;
        } catch (\PDOException $e) {
            error_log('UserModel::getAll: ' . $e->getMessage());
            return ResponseHttp::status500('No se pueden obtener los datos');
        }
    }

    ////////////////////// GET USER //////////////////////

    final public static function getUser()
    {
        try {
            $con = self::getConnection();
            $query = $con->prepare("SELECT * FROM usuarios WHERE dni = :dni");
            $query->execute([
                ':dni' => self::getDni()
            ]);

            if ($query->rowCount() === 0) {
                return ResponseHttp::status400('El DNI no existe');
            } else {
                $rs['data'] = $query->fetchAll(\PDO::FETCH_ASSOC);
                return $rs;
            }
        } catch (\PDOException $e) {
            error_log('UserModel::getUser: ' . $e->getMessage());
            return ResponseHttp::status500('No se pueden obtener los datos del usuario');
        }
    }

    ////////////////////// REGISTER //////////////////////

    final public static function post()
    {

        if (Sql::exists('SELECT dni FROM usuarios WHERE dni = :dni', ":dni", self::getDni())) {
            return ResponseHttp::status400('El DNI ya existe');
        } elseif (Sql::exists('SELECT correo FROM usuarios WHERE correo = :correo', ":correo", self::getEmail())) {
            return ResponseHttp::status400('El correo ya existe');
        } else {
            self::setIDToken(hash('sha512', self::getDni().self::getEmail()));

            try {
                $con = self::getConnection();
                $query1 = "INSERT INTO usuarios (nombre, dni, correo, rol, password, IDToken) VALUES (:nombre, :dni, :correo, :rol, :password, :IDToken)";
                $query = $con->prepare($query1);
                $query->execute([
                    ':nombre' => self::getName(),
                    ':dni' => self::getDni(),
                    ':correo' => self::getEmail(),
                    ':rol' => self::getRol(),
                    ':password' => Security::createPassword(self::getPassword()),
                    ':IDToken' => self::getIDToken()
                ]);

                 if ($query->rowCount() === 0) {
                    return ResponseHttp::status400('No se pudo registrar el usuario');
                } else {
                    return ResponseHttp::status200('Usuario registrado correctamente');
                }

            } catch (\Exception $e) {
                error_log('UserModel::post --> ' . $e->getMessage());
                die(json_encode(ResponseHttp::status500()));
            }
        }
    }

    ////////////////////// UPDATE //////////////////////

    final public static function patchPassword() {

        try {
            $con = self::getConnection();
            $query = $con->prepare("UPDATE usuarios SET password = :password WHERE IDToken = :IDToken");
            $query->execute([
                ':password' => Security::createPassword(self::getPassword()),
                ':IDToken' => self::getIDToken()
            ]);

            if ($query->rowCount() === 0) {
                return ResponseHttp::status400('No se pudo actualizar la contraseña');
            } else {
                return ResponseHttp::status200('Contraseña actualizada correctamente');
            }
        } catch (\PDOException $e) {
            error_log('UserModel::patchPassword: ' . $e->getMessage());
            return ResponseHttp::status500('No se pudo actualizar la contraseña');
        }

    }
}