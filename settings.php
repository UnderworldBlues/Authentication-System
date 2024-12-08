<?php
define('BASE_URL', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" . "://" . $_SERVER['HTTP_HOST']);
// db credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'php_auth');
// using smtp2go.com for sending recovery email
define('MAIL_API_KEY', 'api-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');