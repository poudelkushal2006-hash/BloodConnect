<?php
// app/controllers/DonorAuthController.php

require_once __DIR__ . '/../core/Database.php';

class DonorAuthController {
    
    public function showLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['donor_id'])) {
            header("Location: /donor/profile");
            exit;
        }

        require_once __DIR__ . '/../views/donor-login.php';
    }

    public function authenticate() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        $error = '';

        if (empty($phone) || empty($password)) {
            $error = "Please fill in all fields.";
            require_once __DIR__ . '/../views/donor-login.php';
            return;
        }

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id, full_name, password_hash FROM donors WHERE phone = :phone LIMIT 1");
        $stmt->execute(['phone' => $phone]);
        $donor = $stmt->fetch();

        if ($donor && password_verify($password, $donor['password_hash'])) {
            // Success
            $_SESSION['donor_id'] = $donor['id'];
            $_SESSION['donor_name'] = $donor['full_name'];
            header("Location: /donor/profile");
            exit;
        } else {
            $error = "Invalid phone number or password.";
            require_once __DIR__ . '/../views/donor-login.php';
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['donor_id']);
        unset($_SESSION['donor_name']);
        header("Location: /");
        exit;
    }
}
