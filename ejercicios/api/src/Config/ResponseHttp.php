<?php

namespace App\Config;

class ResponseHttp {

    public static $message = array(
        'status' => '',
        'message' => '',
    );

    final public static function status200($response) {
        http_response_code(200);
        self::$message['status'] = 'OK';
        self::$message['message'] = $response;
        return json_encode(self::$message);
    }

    final public static function status201(string $response = 'CREATED') {
        http_response_code(201);
        self::$message['status'] = 'CREATED';
        self::$message['message'] = $response;
        return json_encode(self::$message);
    }

    final public static function status400(string $response = 'BAD REQUEST') {
        http_response_code(400);
        self::$message['status'] = 'BAD REQUEST';
        self::$message['message'] = $response;
        return json_encode(self::$message);
    }

    final public static function status401(string $response = 'UNAUTHORIZED') {
        http_response_code(401);
        self::$message['status'] = 'UNAUTHORIZED';
        self::$message['message'] = $response;
        return json_encode(self::$message);
    }

    final public static function status403(string $response = 'FORBIDDEN') {
        http_response_code(403);
        self::$message['status'] = 'FORBIDDEN';
        self::$message['message'] = $response;
        return json_encode(self::$message);
    }

    final public static function status404(string $response = 'NOT FOUND') {
        http_response_code(404);
        self::$message['status'] = 'NOT FOUND';
        self::$message['message'] = $response;
        return json_encode(self::$message);
    }

    final public static function status500(string $response = 'INTERNAL SERVER ERROR') {
        http_response_code(500);
        self::$message['status'] = 'INTERNAL SERVER ERROR';
        self::$message['message'] = $response;
        return json_encode(self::$message);
    }

}