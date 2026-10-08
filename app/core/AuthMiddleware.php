<?php
// app/core/AuthMiddleware.php

class AuthMiddleware {
    public static function checkAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin_id'])) {
            header("Location: /admin/login");
            exit;
        }
    }
}
