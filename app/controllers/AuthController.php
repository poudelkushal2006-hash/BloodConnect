<?php
// app/controllers/AuthController.php

require_once __DIR__ . '/../models/Admin.php';

class AuthController {
    
    public function showLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['admin_id'])) {
            header("Location: /admin/dashboard");
            exit;
        }

        require_once __DIR__ . '/../views/admin/login.php';
    }

    public function authenticate() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $error = '';

        if (empty($email) || empty($password)) {
            $error = "Please fill in all fields.";
            require_once __DIR__ . '/../views/admin/login.php';
            return;
        }

        $adminModel = new Admin();
        $admin = $adminModel->findByEmail($email);

        if ($admin && password_verify($password, $admin['password_hash'])) {
            // Success
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $admin['email'];
            header("Location: /admin/dashboard");
            exit;
        } else {
            $error = "Invalid email or password.";
            require_once __DIR__ . '/../views/admin/login.php';
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: /admin/login");
        exit;
    }
}
