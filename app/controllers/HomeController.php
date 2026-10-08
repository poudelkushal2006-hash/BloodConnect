<?php
// app/controllers/HomeController.php

require_once __DIR__ . '/../models/Donor.php';

class HomeController {
    public function index() {
        require_once __DIR__ . '/../views/home.php';
    }

    public function search() {
        $bloodGroup = $_GET['blood_group'] ?? '';
        $district = $_GET['district'] ?? '';
        
        $donors = [];
        
        if (!empty($bloodGroup) || !empty($district)) {
            $donorModel = new Donor();
            $donors = $donorModel->search($bloodGroup, $district);
        }

        require_once __DIR__ . '/../views/search-results.php';
    }
}
