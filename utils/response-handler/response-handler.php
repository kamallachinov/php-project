<?php
class ResponseHandler
{
    public static function SUCCESS_RESPONSE($message, $data = [], $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');

        echo json_encode([
            'message' => $message,
            'data' => $data
        ]);
        exit;
    }

    public static function ERROR_RESPONSE($error, $errorData = [], $code = 400)
    {
        http_response_code($code);
        header('Content-Type: application/json');

        echo json_encode([
            'error' => $error,
            'errorData' => $errorData
        ]);
        exit;
    }
}
