<?php
class ResponseHandler
{
    public function successResponse($message, $data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');

        return json_encode([
            'message' => $message,
            'data' => $data
        ]);
    }

    public function errorResponse($error, $errorData, $code = 400)
    {
        http_response_code($code);
        header('Content-Type: application/json');

        return json_encode([
            'error' => $error,
            'errorData' => $errorData
        ]);
    }
}
