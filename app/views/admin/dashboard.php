<!-- app/views/admin/dashboard.php -->
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BloodConnect</title>
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
                    <span class="text-sm text-gray-500 mr-4"><?= htmlspecialchars($_SESSION['admin_email']) ?></span>
                    <a href="/admin/logout" class="text-sm font-medium text-gray-600 hover:text-gray-900 border border-gray-300 px-3 py-1.5 rounded-md">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">Dashboard</h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <?php if(isset($_GET['success'])): ?>
                    <div class="mt-8 rounded-md bg-green-50 p-4 border border-green-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    <?php 
                                        if ($_GET['success'] == 'updated') echo 'Donor information updated successfully.';
                                        elseif ($_GET['success'] == 'deleted') echo 'Donor deleted successfully.';
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mt-8">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                        
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Donors</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900"><?= number_format($donorCount) ?></dd>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Verified Donors</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900"><?= number_format($verifiedDonorCount) ?></dd>
                            </div>
                        </div>
                        
                        <div class="bg-white overflow-hidden shadow rounded-lg border-b-4 border-green-500">
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Currently Available</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900"><?= number_format($availableDonorCount) ?></dd>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Recent Donors Table -->
                <div class="mt-8">
                    <h2 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Registrations</h2>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blood Group</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">District</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered</th>
                                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <?php foreach($recentDonors as $donor): ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($donor['full_name']) ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            <?= htmlspecialchars($donor['blood_group']) ?>
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($donor['district']) ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($donor['phone']) ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M j, Y', strtotime($donor['created_at'])) ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="/admin/donor/edit?id=<?= $donor['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                        <form action="/admin/donor/delete" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this donor?');">
                                                            <input type="hidden" name="id" value="<?= $donor['id'] ?>">
                                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php if(empty($recentDonors)): ?>
                                                <tr><td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No donors found.</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>
