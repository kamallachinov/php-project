<?php

class Validator
{
    /**
     * Validates a string with optional minimum and maximum length.
     *
     * @param string $value The string to validate.
     * @param int $min The minimum length (default is 1).
     * @param int $max The maximum length (default is INF).
     * @return bool True if valid, false otherwise.
     */
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * Validates an email address.
     *
     * @param string $value The email to validate.
     * @return bool True if valid, false otherwise.
     */
    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validates a password against a defined pattern.
     *
     * The password must:
     * - Be at least 8 characters long
     * - Contain at least one uppercase letter
     * - Contain at least one lowercase letter
     * - Contain at least one digit
     * - Contain at least one special character (@, $, !, %, *, ?, &)
     *
     * @param string $value The password to validate.
     * @return bool True if valid, false otherwise.
     */
    public static function password($value)
    {
        $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        return preg_match($password_pattern, $value);
    }
}