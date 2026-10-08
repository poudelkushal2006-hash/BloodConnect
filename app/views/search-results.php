<!-- app/views/search-results.php -->
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - BloodConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex flex-col">
    
    <?php include __DIR__ . '/partials/nav.php'; ?>

    <main class="flex-grow py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Search Results</h1>
                    <p class="text-gray-500">Showing donors for <span class="font-bold text-red-600"><?= htmlspecialchars($_GET['blood_group'] ?? '') ?></span> in <span class="font-bold"><?= htmlspecialchars($_GET['district'] ?? '') ?></span></p>
                </div>
                <a href="/" class="text-sm font-medium text-red-600 hover:text-red-500">&larr; New Search</a>
            </div>

            <?php if (empty($donors)): ?>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">No donors found</h3>
                    <p class="text-gray-500 mt-2">We couldn't find any available donors matching your criteria. Please try a neighboring district.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <?php foreach($donors as $donor): ?>
                        <?php include __DIR__ . '/partials/donor-card.php'; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
