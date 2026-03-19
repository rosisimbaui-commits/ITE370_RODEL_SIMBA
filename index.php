<?php
require 'auth.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];

        if ($action === 'register') {
            $result = register($_POST['username'], $_POST['email'], $_POST['password']);
            echo $result ? "Registration successful!" : "Registration failed!";
        }

        if ($action === 'login') {
            $result = login($_POST['email'], $_POST['password']);
            echo $result ? "Login successful!" : "Login failed!";
        }
    }
} catch (Exception $e) {
    // Centralized Error Handling
    echo "Error: " . $e->getMessage();
}
