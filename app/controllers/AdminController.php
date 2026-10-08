<?php
// app/controllers/AdminController.php

require_once __DIR__ . '/../core/AuthMiddleware.php';
require_once __DIR__ . '/../core/Database.php';

class AdminController {
    
    public function dashboard() {
        AuthMiddleware::checkAdmin();
        
        $db = Database::getInstance()->getConnection();
        
        // Fetch basic metrics
        $donorCount = $db->query("SELECT COUNT(*) FROM donors")->fetchColumn();
        $verifiedDonorCount = $db->query("SELECT COUNT(*) FROM donors WHERE status = 'verified'")->fetchColumn();
        $availableDonorCount = $db->query("SELECT COUNT(*) FROM donors WHERE status = 'verified' AND is_available = 1")->fetchColumn();
        
        // Recent donors
        $stmt = $db->query("SELECT id, full_name, blood_group, district, phone, created_at FROM donors ORDER BY created_at DESC LIMIT 10");
        $recentDonors = $stmt->fetchAll();

        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    public function editDonor() {
        AuthMiddleware::checkAdmin();
        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /admin/dashboard");
            exit;
        }

        require_once __DIR__ . '/../models/Donor.php';
        $donorModel = new Donor();
        $donor = $donorModel->findById($id);

        if (!$donor) {
            echo "Donor not found.";
            return;
        }

        require_once __DIR__ . '/../views/admin/donor-edit.php';
    }

    public function updateDonor() {
        AuthMiddleware::checkAdmin();
        
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header("Location: /admin/dashboard");
            exit;
        }

        require_once __DIR__ . '/../models/Donor.php';
        $donorModel = new Donor();
        
        $data = [
            'full_name' => $_POST['full_name'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'blood_group' => $_POST['blood_group'] ?? '',
            'district' => $_POST['district'] ?? '',
            'status' => $_POST['status'] ?? 'verified',
            'is_available' => $_POST['is_available'] ?? 0
        ];

        $donorModel->updateAdmin($id, $data);

        header("Location: /admin/dashboard?success=updated");
        exit;
    }

    public function deleteDonor() {
        AuthMiddleware::checkAdmin();
        
        $id = $_POST['id'] ?? null;
        if ($id) {
            require_once __DIR__ . '/../models/Donor.php';
            $donorModel = new Donor();
            $donorModel->delete($id);
        }

        header("Location: /admin/dashboard?success=deleted");
        exit;
    }
}
