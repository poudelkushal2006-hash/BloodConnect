<!-- app/views/donor-login.php -->
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Login - BloodConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex flex-col">
    <?php include __DIR__ . '/partials/nav.php'; ?>

    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-xl border border-gray-100">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900">Donor Login</h2>
                <p class="mt-2 text-sm text-gray-600">Access your profile to update details or availability.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="mb-4 rounded-md bg-red-50 p-4 border border-red-200">
                    <p class="text-sm font-medium text-red-800"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="/donor/authenticate" method="POST">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <div class="mt-1">
                        <input id="phone" name="phone" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm bg-gray-50">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm bg-gray-50">
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Sign in
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Not a donor yet? <a href="/register" class="font-medium text-red-600 hover:text-red-500">Register here</a></p>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
