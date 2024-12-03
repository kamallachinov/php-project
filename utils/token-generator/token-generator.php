<?php
// Generates a secure 64-character token
function generateToken()
{
    return bin2hex(random_bytes(32));
}
