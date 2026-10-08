<?php
// app/models/Donor.php

require_once __DIR__ . '/../core/Database.php';

class Donor {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function search($bloodGroup, $district) {
        $sql = "SELECT id, full_name, phone, blood_group, district, municipality, last_donation_date, is_available, update_token
                FROM donors 
                WHERE status = 'verified' 
                AND is_available = 1 
                AND (last_donation_date IS NULL OR last_donation_date <= DATE_SUB(CURDATE(), INTERVAL 56 DAY))";
        $params = [];

        if (!empty($bloodGroup)) {
            $sql .= " AND blood_group = :blood_group";
            $params['blood_group'] = $bloodGroup;
        }

        if (!empty($district)) {
            $sql .= " AND district = :district";
            $params['district'] = $district;
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll();
    }

    public function getPhone($id) {
        $stmt = $this->db->prepare("SELECT phone FROM donors WHERE id = :id AND status = 'verified' AND is_available = 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn();
    }
    
    public function findByToken($token) {
        $stmt = $this->db->prepare("SELECT * FROM donors WHERE update_token = :token");
        $stmt->execute(['token' => $token]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO donors 
                (full_name, phone, blood_group, gender, age, province, district, municipality, last_donation_date, consent_given, password_hash, update_token, status, is_available) 
                VALUES 
                (:full_name, :phone, :blood_group, :gender, :age, :province, :district, :municipality, :last_donation_date, :consent_given, :password_hash, :update_token, :status, 1)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'blood_group' => $data['blood_group'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'province' => $data['province'],
            'district' => $data['district'],
            'municipality' => $data['municipality'] ?? null,
            'last_donation_date' => !empty($data['last_donation_date']) ? $data['last_donation_date'] : null,
            'consent_given' => !empty($data['consent_given']) ? 1 : 0,
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            'update_token' => bin2hex(random_bytes(32)),
            'status' => 'verified' // Auto-verify for MVP. In Phase 2, this could be 'pending'
        ]);

        return $this->db->lastInsertId();
    }
    
    public function updateAvailability($id, $isAvailable, $lastDonationDate = null) {
        $sql = "UPDATE donors SET is_available = :is_available";
        $params = [
            'is_available' => $isAvailable ? 1 : 0,
            'id' => $id
        ];
        
        if (!empty($lastDonationDate)) {
            $sql .= ", last_donation_date = :last_donation_date";
            $params['last_donation_date'] = $lastDonationDate;
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM donors WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function updateAdmin($id, $data) {
        $sql = "UPDATE donors SET 
                full_name = :full_name, 
                phone = :phone, 
                blood_group = :blood_group, 
                district = :district, 
                status = :status,
                is_available = :is_available 
                WHERE id = :id";
                
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'blood_group' => $data['blood_group'],
            'district' => $data['district'],
            'status' => $data['status'],
            'is_available' => !empty($data['is_available']) ? 1 : 0,
            'id' => $id
        ]);
    }

    public function updateSelfService($id, $data) {
        $sql = "UPDATE donors SET 
                full_name = :full_name, 
                phone = :phone, 
                blood_group = :blood_group,
                gender = :gender,
                age = :age,
                province = :province,
                district = :district, 
                municipality = :municipality,
                is_available = :is_available,
                last_donation_date = :last_donation_date
                WHERE id = :id";
                
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'blood_group' => $data['blood_group'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'province' => $data['province'],
            'district' => $data['district'],
            'municipality' => $data['municipality'],
            'is_available' => $data['is_available'] ? 1 : 0,
            'last_donation_date' => !empty($data['last_donation_date']) ? $data['last_donation_date'] : null,
            'id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM donors WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
