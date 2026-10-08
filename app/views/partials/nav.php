<!-- app/views/partials/nav.php -->
<nav class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-white font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-gray-900 tracking-tight">BloodConnect</span>
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                ?>
                
                <?php if (isset($_SESSION['donor_id'])): ?>
                    <span class="text-sm font-medium text-gray-700">Hi, <?= htmlspecialchars(explode(' ', trim($_SESSION['donor_name']))[0]) ?></span>
                    <a href="/donor/profile" class="text-sm font-medium text-gray-600 hover:text-red-600">My Profile</a>
                    <a href="/donor/logout" class="text-sm font-medium text-gray-600 hover:text-red-600 border border-gray-300 px-3 py-1.5 rounded-md">Logout</a>
                <?php else: ?>
                    <a href="/donor/login" class="text-sm font-medium text-gray-600 hover:text-red-600">Donor Login</a>
                    <a href="/register" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Register as Donor
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
