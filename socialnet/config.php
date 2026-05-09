<?php
// config.php – shared database configuration
// Adjust host/user/pass to match your environment

define('DB_HOST', 'localhost');
define('DB_NAME', 'socialnet');
define('DB_USER', 'root');       // change as needed
define('DB_PASS', '');           // change as needed
define('DB_CHARSET', 'utf8mb4');

function db_connect(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    }
    return $pdo;
}
