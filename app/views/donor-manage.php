<!-- app/views/donor-manage.php -->
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Listing - BloodConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex flex-col">
    
    <?php include __DIR__ . '/partials/nav.php'; ?>

    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-xl border border-gray-100">
            
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Manage Your Status</h1>
                <p class="text-gray-500 mt-1">Hello, <?= htmlspecialchars($donor['full_name']) ?></p>
            </div>

            <?php if(isset($_GET['success'])): ?>
                <div class="rounded-md bg-green-50 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">Changes saved successfully.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(!empty($errors)): ?>
                <div class="rounded-md bg-red-50 p-4 mb-6">
                    <ul class="list-disc pl-5 text-sm text-red-700">
                        <?php foreach($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/donor/update" method="POST" class="space-y-6">
                
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <div class="mt-1">
                            <input type="text" name="full_name" id="full_name" value="<?= htmlspecialchars($donor['full_name']) ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <div class="mt-1">
                            <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($donor['phone']) ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                        </div>
                    </div>

                    <div>
                        <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                        <div class="mt-1">
                            <select id="blood_group" name="blood_group" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border bg-white">
                                <?php foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg): ?>
                                    <option value="<?= $bg ?>" <?= $donor['blood_group'] == $bg ? 'selected' : '' ?>><?= $bg ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                        <div class="mt-1">
                            <input type="number" name="age" id="age" value="<?= htmlspecialchars($donor['age']) ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                        </div>
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <div class="mt-1">
                            <select id="gender" name="gender" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border bg-white">
                                <option value="male" <?= $donor['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?= $donor['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                                <option value="other" <?= $donor['gender'] == 'other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                        <div class="mt-1">
                            <input type="text" name="province" id="province" value="<?= htmlspecialchars($donor['province']) ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                        </div>
                    </div>

                    <div>
                        <label for="district" class="block text-sm font-medium text-gray-700">District</label>
                        <div class="mt-1">
                            <input type="text" name="district" id="district" value="<?= htmlspecialchars($donor['district']) ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                        </div>
                    </div>
                    
                    <div class="sm:col-span-2">
                        <label for="municipality" class="block text-sm font-medium text-gray-700">Municipality (Optional)</label>
                        <div class="mt-1">
                            <input type="text" name="municipality" id="municipality" value="<?= htmlspecialchars($donor['municipality']) ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200">
                    <label class="text-base font-medium text-gray-900">Availability</label>
                    <p class="text-sm leading-5 text-gray-500">Toggle if you are currently available to donate blood.</p>
                    <div class="mt-4">
                        <div class="flex items-center">
                            <input id="available_yes" name="is_available" type="radio" value="1" <?= $donor['is_available'] ? 'checked' : '' ?> class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300">
                            <label for="available_yes" class="ml-3 block text-sm font-medium text-gray-700">Yes, I am available</label>
                        </div>
                        <div class="flex items-center mt-3">
                            <input id="available_no" name="is_available" type="radio" value="0" <?= !$donor['is_available'] ? 'checked' : '' ?> class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300">
                            <label for="available_no" class="ml-3 block text-sm font-medium text-gray-700">No, hide my profile</label>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <label for="last_donation_date" class="block text-sm font-medium text-gray-700">Update Last Donation Date</label>
                    <p class="text-xs text-gray-500 mt-1 mb-2">If you recently donated, update this date. We'll automatically hide you for 56 days to ensure you recover.</p>
                    <div class="mt-1">
                        <input type="date" name="last_donation_date" id="last_donation_date" value="<?= htmlspecialchars($donor['last_donation_date'] ?? '') ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                    </div>
                </div>

                <div class="pt-5">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
