<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/vendor/autoload.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/db/db-connection.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/utils/response-handler/response-handler.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php-prj/utils/token-generator/token-generator.php";

$mail = new PHPMailer(true);
$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . "/php-prj");
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];

    $stmt = $conn->prepare('SELECT * FROM `auth-data` WHERE `email` = ?');
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $token = generateToken();
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $expires = time() + 3600;

        $stmt = $conn->prepare('UPDATE `auth-data` SET reset_token = ?, reset_token_expiry = ? WHERE email = ?');
        $stmt->bind_param("sis", $hashedToken, $expires, $email);
        $stmt->execute();

        $resetLink = "http://localhost/php-prj/views/auth/reset-password.view.php?token=$hashedToken";

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
            $mail->Port = $_ENV['SMTP_PORT'];

            $mail->setFrom('info@sample.com', 'Sample Website');
            $mail->addAddress($email);

            $templatePath = $_SERVER['DOCUMENT_ROOT'] . "/php-prj/views/reset-mail-template/reset-mail-template.php";
            $template = file_get_contents($templatePath);

            $emailBody = str_replace('{{RESET_LINK}}', $resetLink, $template);

            // Use the processed template as the email body
            $mail->isHTML(true);
            $mail->Subject = 'Website - Reset Password';
            $mail->Body = $emailBody;

            $mail->send();
            ResponseHandler::SUCCESS_RESPONSE('Password reset link has been sent to your email.', [], 200);
        } catch (Exception $e) {
            ResponseHandler::ERROR_RESPONSE("Message could not be sent. Mailer Error: {$mail->ErrorInfo}", [], 500);
        }
    } else {
        ResponseHandler::ERROR_RESPONSE("No account found with that email address.", [], 404);
    }
} else {
    ResponseHandler::ERROR_RESPONSE("Something went wrong...", [], 404);
}
