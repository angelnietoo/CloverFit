<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=cloverfit', 'root', 'toor', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE TABLE IF NOT EXISTS `users` LIKE `user`");
    $count = $pdo->exec("INSERT INTO `users` SELECT * FROM `user`");
    echo "Inserted rows into users: " . ($count === false ? 0 : $count) . PHP_EOL;
} catch (Exception $e) {
    echo 'ERR: ' . $e->getMessage() . PHP_EOL;
}
