<?php
// app/models/BloodRequest.php

require_once __DIR__ . '/../core/Database.php';

class BloodRequest {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO blood_requests 
                (blood_group, district, hospital_name, urgency, contact_phone, notes) 
                VALUES 
                (:blood_group, :district, :hospital_name, :urgency, :contact_phone, :notes)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'blood_group' => $data['blood_group'],
            'district' => $data['district'],
            'hospital_name' => $data['hospital_name'] ?? null,
            'urgency' => $data['urgency'],
            'contact_phone' => $data['contact_phone'],
            'notes' => $data['notes'] ?? null,
        ]);

        return $this->db->lastInsertId();
    }
}
