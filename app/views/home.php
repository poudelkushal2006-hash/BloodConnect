<!-- app/views/home.php -->
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodConnect Nepal</title>
    <!-- Using Tailwind Play CDN for immediate preview -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex flex-col">
    
    <?php include __DIR__ . '/partials/nav.php'; ?>

    <main class="flex-grow">
        <!-- Hero Section -->
        <div class="bg-white">
            <div class="max-w-4xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                    Find blood donors <span class="text-red-600">instantly.</span>
                </h1>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    A lightweight emergency donor registry for Nepal. No login required. Every second counts.
                </p>
            </div>
        </div>

        <!-- Search Form Section -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
            <div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
                <form action="/search" method="GET" class="space-y-4 sm:space-y-0 sm:flex sm:gap-4">
                    <div class="flex-1">
                        <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                        <select id="blood_group" name="blood_group" required class="mt-1 block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md bg-gray-50 border">
                            <option value="">Select Group...</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="district" class="block text-sm font-medium text-gray-700">District</label>
                        <select id="district" name="district" required class="mt-1 block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md bg-gray-50 border">
                            <option value="">Select District...</option>
                            <option value="Kathmandu">Kathmandu</option>
                            <option value="Lalitpur">Lalitpur</option>
                            <option value="Bhaktapur">Bhaktapur</option>
                            <option value="Kaski">Kaski</option>
                            <option value="Chitwan">Chitwan</option>
                        </select>
                    </div>
                    <div class="flex items-end mt-4 sm:mt-0">
                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
