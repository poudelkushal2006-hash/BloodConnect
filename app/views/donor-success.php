<!-- app/views/donor-success.php -->
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - BloodConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex flex-col">
    
    <?php include __DIR__ . '/partials/nav.php'; ?>

    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-xl border border-gray-100 text-center">
            
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                <svg class="h-10 w-10 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Thank You!</h2>
            <p class="mt-2 text-md text-gray-600">
                You have successfully registered as a donor. Your willingness to help could save a life.
            </p>

            <div class="mt-8 border-t border-gray-200 pt-6 text-left">
                <div class="mt-6 text-center">
                <p class="text-gray-600 mb-6">You are now logged in. You can edit your profile or update your availability at any time by clicking "My Profile".</p>
                
                <a href="/donor/profile" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Go to My Profile
                </a>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
