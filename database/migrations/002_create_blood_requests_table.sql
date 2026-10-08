CREATE TABLE IF NOT EXISTS blood_requests (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    blood_group ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NOT NULL,
    district VARCHAR(255) NOT NULL,
    hospital_name VARCHAR(255),
    urgency ENUM('critical', 'within_24h', 'planned') NOT NULL,
    contact_phone VARCHAR(15) NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
