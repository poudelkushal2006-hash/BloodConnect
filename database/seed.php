<?php
// database/seed.php

require_once __DIR__ . '/../app/core/Database.php';

echo "Seeding Database...\n";

try {
    $db = Database::getInstance()->getConnection();

    // Drop and re-create tables if they exist for clean seed
    $db->exec("DROP TABLE IF EXISTS admins");
    $db->exec("DROP TABLE IF EXISTS blood_requests");
    $db->exec("DROP TABLE IF EXISTS donors");

    // Run migrations
    $db->exec(file_get_contents(__DIR__ . '/migrations/001_create_donors_table.sql'));
    $db->exec(file_get_contents(__DIR__ . '/migrations/002_create_blood_requests_table.sql'));
    $db->exec(file_get_contents(__DIR__ . '/migrations/003_create_admins_table.sql'));
    
    echo "Tables created successfully.\n";

    $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    $genders = ['male', 'female'];
    $districts = ['Kathmandu', 'Lalitpur', 'Bhaktapur', 'Kaski', 'Chitwan'];
    $provinces = ['Bagmati', 'Bagmati', 'Bagmati', 'Gandaki', 'Bagmati']; // Rough mapping

    $firstNames = ['Ram', 'Hari', 'Sita', 'Gita', 'Shyam', 'Krishna', 'Bishnu', 'Anil', 'Sunil', 'Kamal', 'Pooja', 'Rina', 'Sujan', 'Nabin', 'Sagar', 'Dipendra', 'Ramesh', 'Suresh', 'Bikash', 'Prakash'];
    $lastNames = ['Thapa', 'Gurung', 'Magar', 'Shrestha', 'Maharjan', 'Tamang', 'Lama', 'Rai', 'Limbu', 'Chaudhary', 'Gautam', 'Karki', 'Khadka', 'Basnet', 'Ghimire', 'Paudel'];

    $stmt = $db->prepare("
        INSERT INTO donors 
        (full_name, phone, blood_group, gender, age, province, district, municipality, last_donation_date, is_available, consent_given, password_hash, status, update_token)
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, 'verified', ?)
    ");

    $defaultPasswordHash = password_hash('password123', PASSWORD_DEFAULT);

    for ($i = 0; $i < 30; $i++) {
        $fname = $firstNames[array_rand($firstNames)];
        $lname = $lastNames[array_rand($lastNames)];
        $fullName = "$fname $lname";
        
        $phone = '98' . mt_rand(10000000, 99999999);
        $bg = $bloodGroups[array_rand($bloodGroups)];
        $gender = $genders[array_rand($genders)];
        $age = mt_rand(18, 55);
        
        $distIdx = array_rand($districts);
        $district = $districts[$distIdx];
        $province = $provinces[$distIdx];
        
        $municipality = $district . ' Metro';
        
        // Some donated recently, some long ago
        $daysAgo = mt_rand(10, 200);
        $lastDonation = date('Y-m-d', strtotime("-$daysAgo days"));
        
        $isAvailable = mt_rand(0, 10) > 2 ? 1 : 0; // 80% available
        $token = bin2hex(random_bytes(32));

        $stmt->execute([
            $fullName,
            $phone,
            $bg,
            $gender,
            $age,
            $province,
            $district,
            $municipality,
            $lastDonation,
            $isAvailable,
            $defaultPasswordHash,
            $token
        ]);
    }

    echo "Seeded 30 donors successfully.\n";

    // Seed default admin
    $adminPassword = password_hash('password123', PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO admins (email, password_hash) VALUES (?, ?)");
    $stmt->execute(['admin@bloodconnect.org', $adminPassword]);
    
    echo "Seeded default admin (admin@bloodconnect.org / password123).\n";

} catch (Exception $e) {
    die("Error during seeding: " . $e->getMessage() . "\n");
}
