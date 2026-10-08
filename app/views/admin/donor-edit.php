<!-- app/views/admin/donor-edit.php -->
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Donor - BloodConnect Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full">
    
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold text-red-600">BloodConnect Admin</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="/admin/dashboard" class="text-sm font-medium text-gray-600 hover:text-gray-900 mr-4">Dashboard</a>
                    <a href="/admin/logout" class="text-sm font-medium text-gray-600 hover:text-gray-900 border border-gray-300 px-3 py-1.5 rounded-md">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10">
        <header>
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">Edit Donor</h1>
                <a href="/admin/dashboard" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">&larr; Back to Dashboard</a>
            </div>
        </header>
        <main>
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 mt-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <form action="/admin/donor/update" method="POST" class="space-y-6">
                            <input type="hidden" name="id" value="<?= $donor['id'] ?>">

                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <div class="mt-1">
                                        <input type="text" name="full_name" id="full_name" value="<?= htmlspecialchars($donor['full_name']) ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                                    </div>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <div class="mt-1">
                                        <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($donor['phone']) ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                                    </div>
                                </div>

                                <div>
                                    <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                                    <div class="mt-1">
                                        <select id="blood_group" name="blood_group" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border bg-white">
                                            <?php foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg): ?>
                                                <option value="<?= $bg ?>" <?= $donor['blood_group'] == $bg ? 'selected' : '' ?>><?= $bg ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="sm:col-span-2">
                                    <label for="district" class="block text-sm font-medium text-gray-700">District</label>
                                    <div class="mt-1">
                                        <input type="text" name="district" id="district" value="<?= htmlspecialchars($donor['district']) ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                                    </div>
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <div class="mt-1">
                                        <select id="status" name="status" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border bg-white">
                                            <option value="verified" <?= $donor['status'] == 'verified' ? 'selected' : '' ?>>Verified</option>
                                            <option value="pending" <?= $donor['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="suspended" <?= $donor['status'] == 'suspended' ? 'selected' : '' ?>>Suspended</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label for="is_available" class="block text-sm font-medium text-gray-700">Availability</label>
                                    <div class="mt-1">
                                        <select id="is_available" name="is_available" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border bg-white">
                                            <option value="1" <?= $donor['is_available'] == 1 ? 'selected' : '' ?>>Available (1)</option>
                                            <option value="0" <?= $donor['is_available'] == 0 ? 'selected' : '' ?>>Hidden/Unavailable (0)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-5 border-t border-gray-200 flex justify-end">
                                <a href="/admin/dashboard" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </a>
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
