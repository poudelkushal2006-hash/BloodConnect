<?php
// app/controllers/DonorController.php

require_once __DIR__ . '/../models/Donor.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../core/Database.php';

class DonorController {
    
    public function create() {
        require_once __DIR__ . '/../views/donor-register.php';
    }

    public function store() {
        // Spam protection: Honeypot
        if (!empty($_POST['website'])) {
            $dummyToken = bin2hex(random_bytes(32));
            $host = $_SERVER['HTTP_HOST'];
            $manageUrl = "http://{$host}/donor/manage?token=" . $dummyToken;
            require_once __DIR__ . '/../views/donor-success.php';
            return;
        }

        // Spam protection: Session-based rate limit
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $today = date('Y-m-d');
        if (!isset($_SESSION['registration_attempts'])) {
            $_SESSION['registration_attempts'] = [];
        }
        
        $attempts = $_SESSION['registration_attempts'][$today] ?? 0;
        if ($attempts >= 3) {
            $errors = ['general' => "You have reached the maximum number of registrations (3) for today."];
            require_once __DIR__ . '/../views/donor-register.php';
            return;
        }

        $validator = new Validator();
        
        $data = [
            'full_name' => $_POST['full_name'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'password' => $_POST['password'] ?? '',
            'blood_group' => $_POST['blood_group'] ?? '',
            'gender' => $_POST['gender'] ?? '',
            'age' => $_POST['age'] ?? '',
            'province' => $_POST['province'] ?? '',
            'district' => $_POST['district'] ?? '',
            'municipality' => $_POST['municipality'] ?? '',
            'last_donation_date' => $_POST['last_donation_date'] ?? null,
            'consent_given' => isset($_POST['consent_given']) ? true : false,
        ];

        // Validation
        $validator->validateRequired($data['full_name'], 'full_name');
        $validator->validatePhone($data['phone']);
        $validator->validateRequired($data['password'], 'password');
        if (strlen($data['password']) < 6) {
            $validator->addError('password', 'Password must be at least 6 characters.');
        }
        $validator->validateEnum($data['blood_group'], ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'], 'blood_group');
        $validator->validateEnum($data['gender'], ['male', 'female', 'other'], 'gender');
        $validator->validateAge($data['age']);
        $validator->validateRequired($data['province'], 'province');
        $validator->validateRequired($data['district'], 'district');
        $validator->validateConsent($data['consent_given']);

        if ($validator->hasErrors()) {
            $errors = $validator->getErrors();
            require_once __DIR__ . '/../views/donor-register.php';
            return;
        }

        try {
            $donorModel = new Donor();
            $donorId = $donorModel->create($data);
            
            // Auto login after registration
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['donor_id'] = $donorId;
            $_SESSION['donor_name'] = $data['full_name'];

        } catch (\PDOException $e) {
            // 23000 is MySQL's Integrity Constraint Violation (Unique Phone)
            if ($e->getCode() == 23000) {
                $errors['phone'] = "This phone number is already registered.";
                require_once __DIR__ . '/../views/donor-register.php';
                return;
            } else {
                throw $e;
            }
        }
        
        // Increment rate limit counter
        $_SESSION['registration_attempts'][$today] = $attempts + 1;
        
        require_once __DIR__ . '/../views/donor-success.php';
    }

    public function manage() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['donor_id'])) {
            header("Location: /donor/login");
            exit;
        }
        
        $donorModel = new Donor();
        $donor = $donorModel->findById($_SESSION['donor_id']);
        if (!$donor) {
            echo "Donor profile not found.";
            return;
        }

        require_once __DIR__ . '/../views/donor-manage.php';
    }

    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['donor_id'])) {
            header("Location: /donor/login");
            exit;
        }

        require_once __DIR__ . '/../core/Validator.php';
        $validator = new Validator();
        
        $data = [
            'is_available' => (isset($_POST['is_available']) && $_POST['is_available'] == '1') ? 1 : 0,
            'last_donation_date' => !empty($_POST['last_donation_date']) ? $_POST['last_donation_date'] : null,
            'full_name' => $_POST['full_name'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'blood_group' => $_POST['blood_group'] ?? '',
            'gender' => $_POST['gender'] ?? '',
            'age' => $_POST['age'] ?? '',
            'province' => $_POST['province'] ?? '',
            'district' => $_POST['district'] ?? '',
            'municipality' => $_POST['municipality'] ?? ''
        ];

        // Validation for new fields
        $validator->validateRequired($data['full_name'], 'full_name');
        $validator->validatePhone($data['phone']);
        $validator->validateEnum($data['blood_group'], ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'], 'blood_group');
        $validator->validateEnum($data['gender'], ['male', 'female', 'other'], 'gender');
        $validator->validateAge($data['age']);
        $validator->validateRequired($data['province'], 'province');
        $validator->validateRequired($data['district'], 'district');

        $donorModel = new Donor();

        if ($validator->hasErrors()) {
            $donor = $donorModel->findById($_SESSION['donor_id']);
            $errors = $validator->getErrors();
            require_once __DIR__ . '/../views/donor-manage.php';
            return;
        }

        try {
            $donorModel->updateSelfService($_SESSION['donor_id'], $data);
            $_SESSION['donor_name'] = $data['full_name']; // Update session name just in case it changed
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $errors['phone'] = "This phone number is already registered.";
                $donor = $donorModel->findById($_SESSION['donor_id']);
                require_once __DIR__ . '/../views/donor-manage.php';
                return;
            }
        }

        header("Location: /donor/profile?success=1");
        exit;
    }

    public function phone() {
        header('Content-Type: application/json');
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            echo json_encode(['success' => false]);
            return;
        }

        $donorModel = new Donor();
        try {
            $phone = $donorModel->getPhone($id);
            if ($phone) {
                echo json_encode(['success' => true, 'phone' => $phone]);
            } else {
                echo json_encode(['success' => false]);
            }
        } catch (\PDOException $e) {
            echo json_encode(['success' => false]);
        }
    }
}
