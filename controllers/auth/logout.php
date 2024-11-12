<?php
require __DIR__ . "/../../utils/response-handler/response-handler.php";
echo ResponseHandler::SUCCESS_RESPONSE("Logout successful!", ['isAuthenticated' => false], 200);