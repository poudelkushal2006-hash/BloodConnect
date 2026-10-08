<!-- app/views/partials/donor-card.php -->
<?php
// Formatting name for privacy (First name + Last Initial)
$nameParts = explode(' ', $donor['full_name']);
$firstName = $nameParts[0];
$lastInitial = isset($nameParts[1]) ? substr($nameParts[1], 0, 1) . '.' : '';
$displayName = htmlspecialchars($firstName . ' ' . $lastInitial);

// Last active / donation status logic
$lastDonation = $donor['last_donation_date'] ? new DateTime($donor['last_donation_date']) : null;
$statusText = "Available";
$statusColor = "bg-green-100 text-green-800";

if ($lastDonation) {
    $now = new DateTime();
    $diff = $now->diff($lastDonation)->days;
    if ($diff < 56) {
        $statusText = "Donated recently";
        $statusColor = "bg-yellow-100 text-yellow-800";
    }
}
?>
<div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100 hover:shadow-md transition-shadow">
    <div class="px-4 py-5 sm:p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-red-100 text-red-700 font-bold text-lg">
                        <?= htmlspecialchars($donor['blood_group']) ?>
                    </span>
                </div>
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <?= $displayName ?>
                    </h3>
                    <div class="mt-1 flex items-center text-sm text-gray-500 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <?= htmlspecialchars($donor['district']) ?>
                        <?php if(!empty($donor['municipality'])): ?>
                            <span class="text-gray-300">|</span> <?= htmlspecialchars($donor['municipality']) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusColor ?>">
                    <?= $statusText ?>
                </span>
            </div>
        </div>
        <div class="mt-5 sm:mt-6">
            <a href="tel:<?= htmlspecialchars($donor['phone']) ?>" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                </svg>
                <span><?= htmlspecialchars($donor['phone']) ?></span>
            </a>
        </div>
    </div>
</div>
