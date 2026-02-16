<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=cloverfit', 'root', 'toor');
    $res = $pdo->query('SHOW TABLES');
    foreach ($res as $r) {
        echo implode(',', $r) . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'ERR: ' . $e->getMessage() . PHP_EOL;
}
