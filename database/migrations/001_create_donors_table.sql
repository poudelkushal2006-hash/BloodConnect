CREATE TABLE IF NOT EXISTS donors (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL UNIQUE,
    blood_group ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    age INT NOT NULL,
    province VARCHAR(255) NOT NULL,
    district VARCHAR(255) NOT NULL,
    municipality VARCHAR(100),
    last_donation_date DATE NULL,
    is_available BOOLEAN DEFAULT TRUE,
    consent_given BOOLEAN DEFAULT FALSE,
    password_hash VARCHAR(255) NOT NULL,
    update_token VARCHAR(64) NULL,
    status ENUM('pending', 'verified', 'suspended') DEFAULT 'verified',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_blood_group_district ON donors(blood_group, district);
