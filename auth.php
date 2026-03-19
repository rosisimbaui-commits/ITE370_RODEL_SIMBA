<?php
require 'db.php';
$config = require 'config.php';
require 'validate.php';

function register($username, $email, $password) {
    global $pdo, $config;
    
    $username = sanitize($username);
    $email = sanitize($email);
    
    if (!validate_email($email)) {
        return "Invalid email address!";
    }

    $hashedPassword = password_hash($password . $config['salt'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$username, $email, $hashedPassword]);
}

function login($email, $password) {
    global $pdo, $config;
    $email = sanitize($email);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password . $config['salt'], $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}
