<?php

namespace App\Controllers;

use App\Config\ResponseHttp;
use App\Config\Security;
use App\Models\UserModel;

class UserController
{

    private static $validate_rol = '/^[1,2,3]{1,1}$/';
    private static $validate_number = '/^[0-9]+$/';
    private static $validate_text = '/^[a-zA-Z]+$/';

    public function __construct(

        private string $method,
        private string $route,
        private array  $params,
        private        $data,
        private        $headers
    )
    {
    }

    final public function getLogin(string $endPoint)
    {
        if ($this->method === 'get' && $endPoint === $this->route) {

            $email = strtolower($this->params[1]);
            $password = $this->params[2];

            if (empty($email) || empty($password)) {
                echo json_encode(ResponseHttp::status400('Todos los campos son obligatorios'));
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(ResponseHttp::status400('El email no es válido'));
            } else {
                UserModel::setCorreo($email);
                UserModel::setPassword($password);
                echo json_encode(UserModel::login(), JSON_THROW_ON_ERROR);
            }

            exit();
        }
    }

    final public function getAll(string $endPoint)
    {
        if ($this->method === 'get' && $endPoint === $this->route) {
            /*Security::validateTokenJwt($this->headers, Security::secretKey());*/
            echo json_encode(UserModel::getAll(), JSON_THROW_ON_ERROR);
            exit();
        }
    }

    final public function getUser(string $endPoint)
    {
        if ($this->method === 'get' && $endPoint === $this->route) {
            /*Security::validateTokenJwt($this->headers, Security::secretKey());*/
            $dni = $this->params[1];
            if (!isset($dni)) {
                echo json_encode(ResponseHttp::status400('El DNI es obligatorio'), JSON_THROW_ON_ERROR);
            } elseif (!preg_match(self::$validate_number, $dni)) {
                echo json_encode(ResponseHttp::status400('El DNI solo puede contener números'), JSON_THROW_ON_ERROR);
            } else {
                UserModel::setDni($dni);
                echo json_encode(UserModel::getUser(), JSON_THROW_ON_ERROR);
            }
            exit();
        }
    }

    final public function post(string $endPoint)
    {
        if ($this->method === 'post' && $endPoint === $this->route) {
            /*Security::validateTokenJwt($this->headers, Security::secretKey());*/

            if (empty($this->data['nombre']) || empty($this->data['dni']) || empty($this->data['correo']) ||
                empty($this->data['rol'] || empty($this->data['password'] || empty($this->data['confirmPassword'])))) {
                echo ResponseHttp::status400('Todos los campos son obligatorios');
            } elseif (!preg_match(self::$validate_text, $this->data['nombre'])) {
                echo ResponseHttp::status400('El nombre solo puede contener letras');
            } elseif (!preg_match(self::$validate_number, $this->data['dni'])) {
                echo ResponseHttp::status400('El DNI solo puede contener números');
            } elseif (!filter_var($this->data['correo'], FILTER_VALIDATE_EMAIL)) {
                echo ResponseHttp::status400('El email no es válido');
            } elseif (!preg_match(self::$validate_rol, $this->data['rol'])) {
                echo ResponseHttp::status400('El rol no es válido');
            } elseif ($this->data['password'] !== $this->data['confirmPassword']) {
                echo ResponseHttp::status400('Las contraseñas no coinciden');
            } else {
                echo ResponseHttp::status200('Todo bien');
                new UserModel($this->data);
                echo json_encode(UserModel::post(), JSON_THROW_ON_ERROR);
            }

            exit;
        }
    }

    final public function patchPassword(string $endPoint)
    {
        if ($this->method === 'patch' && $endPoint === $this->route) {
            /*Security::validateTokenJwt($this->headers, Security::secretKey());*/

            $jwtUserData = Security::getJwtData();

            if (empty($this->data['oldPassword'] || empty($this->data['newPassword'] || empty($this->data['confirmPassword'])))) {
                echo ResponseHttp::status400('Todos los campos son obligatorios');
            } elseif (!UserModel::validateUserPassword($jwtUserData['IDToken'], $this->data['oldPassword'])) {
                echo ResponseHttp::status400('Las contraseña antigua no coincide');
            } elseif (strlen($this->data['newPassword']) < 8 || strlen($this->data['confirmPassword']) < 8) {
                echo json_encode(ResponseHttp::status400('La contraseña debe tener al menos 8 caracteres'), JSON_THROW_ON_ERROR);
            } elseif ($this->data['newPassword'] !== $this->data['confirmPassword']) {
                echo ResponseHttp::status400('Las contraseñas no coinciden');
            } else {
                UserModel::setIDToken($jwtUserData['IDToken']);
                UserModel::setPassword($this->data['oldPassword']);
                echo json_encode(UserModel::patchPassword(), JSON_THROW_ON_ERROR);
            }

        }

        exit;
    }
}

