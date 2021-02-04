<?php

define('DB_NAME', 'camagru');
define('DB_USER', 'root');
define('DB_PASS', 'vtm9YdgjH');
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '33066');

$dsn  = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';port=' . DB_PORT;

try {
    $dbh = new PDO($dsn, DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbh->query("DROP TABLE IF EXISTS `notifications`");
    $dbh->query("DROP TABLE IF EXISTS `likes`");
    $dbh->query("DROP TABLE IF EXISTS `comments`");
    $dbh->query("DROP TABLE IF EXISTS `gallery`");
    $dbh->query("DROP TABLE IF EXISTS `users`");


    $query = <<< SQL
        CREATE TABLE `users` (
            `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            `email` VARCHAR(255) NOT NULL UNIQUE,
            `password` CHAR(32),
            `username` VARCHAR(32)
        )
    SQL;

    $queryInsert = <<< SQL
        INSERT INTO
            `camagru`.`users` (
                `email`,
                `password`,
                `username`
            )
        VALUES (
            'pavalachi2000@gmail.com',
            MD5('admin'),
            'admin'
        )
    SQL;

    $dbh->query($query);
    $dbh->query($queryInsert);

    $query = <<< SQL
        CREATE TABLE `gallery` (
            `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            `path` VARCHAR(255) NOT NULL UNIQUE,
            `user_id` INT NOT NULL,
            `created_at` DATE NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
        )
    SQL;

    $dbh->query($query);

    $query = <<< SQL
        CREATE TABLE `notifications` (
            `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            `user_id` INT NOT NULL,
            `image_id` INT NOT NULL,
            `body` TEXT NOT NULL,
            `created_at` DATETIME NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
            FOREIGN KEY (`image_id`) REFERENCES `gallery`(`id`)
        )
    SQL;

    $dbh->query($query);

    $query = <<< SQL
        CREATE TABLE `likes` (
            `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            `user_id` INT NOT NULL,
            `image_id` INT NOT NULL,
            `stranger_id` INT NOT NULL,
            `created_at` DATETIME NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
            FOREIGN KEY (`image_id`) REFERENCES `gallery`(`id`),
            FOREIGN KEY (`stranger_id`) REFERENCES `users`(`id`)
        )
    SQL;

    $dbh->query($query);

    $query = <<< SQL
        CREATE TABLE `comments` (
            `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            `user_id` INT NOT NULL,
            `image_id` INT NOT NULL,
            `body` TEXT NOT NULL,
            `created_at` DATETIME NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
            FOREIGN KEY (`image_id`) REFERENCES `gallery`(`id`)
        )
    SQL;

    $dbh->query($query);

} catch (PDOException $e) {
    echo $e->getMessage() . "\n";
}



