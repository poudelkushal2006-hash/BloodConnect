<!-- app/views/donor-register.php -->
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as Donor - BloodConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full flex flex-col">
    
    <?php include __DIR__ . '/partials/nav.php'; ?>

    <main class="flex-grow py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <h1 class="text-3xl font-extrabold text-gray-900">Register as a Blood Donor</h1>
                <p class="mt-2 text-gray-500 text-lg">Your registration could save a life in an emergency. It takes less than a minute.</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg border border-gray-100 overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <form action="/register" method="POST" class="space-y-6">
                        
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div style="display:none;">
                <label for="website">Website</label>
                <input type="text" name="website" id="website" value="">
            </div>

            <!-- Full Name -->
                            <div class="sm:col-span-2">
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <div class="mt-1">
                                    <input type="text" name="full_name" id="full_name" required value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                </div>
                                <?php if(isset($errors['full_name'])): ?>
                                    <p class="mt-2 text-sm text-red-600"><?= $errors['full_name'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                                <div class="mt-1">
                                    <input type="tel" name="phone" id="phone" placeholder="98XXXXXXXX" required value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                </div>
                                <?php if(isset($errors['phone'])): ?>
                                    <p class="mt-2 text-sm text-red-600"><?= $errors['phone'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <div class="mt-1">
                                    <input type="password" name="password" id="password" required class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                </div>
                                <?php if(isset($errors['password'])): ?>
                                    <p class="mt-2 text-sm text-red-600"><?= $errors['password'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Age -->
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                                <div class="mt-1">
                                    <input type="number" name="age" id="age" min="18" max="65" required value="<?= htmlspecialchars($_POST['age'] ?? '') ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                </div>
                                <?php if(isset($errors['age'])): ?>
                                    <p class="mt-2 text-sm text-red-600"><?= $errors['age'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Blood Group -->
                            <div>
                                <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                                <div class="mt-1">
                                    <select id="blood_group" name="blood_group" required class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                        <option value="">Select Group...</option>
                                        <?php 
                                        $bgs = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                                        $selectedBg = $_POST['blood_group'] ?? '';
                                        foreach($bgs as $bg) {
                                            $sel = ($selectedBg == $bg) ? 'selected' : '';
                                            echo "<option value=\"$bg\" $sel>$bg</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php if(isset($errors['blood_group'])): ?>
                                    <p class="mt-2 text-sm text-red-600"><?= $errors['blood_group'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <div class="mt-1">
                                    <select id="gender" name="gender" required class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                        <option value="">Select Gender...</option>
                                        <option value="male" <?= (($_POST['gender'] ?? '') == 'male') ? 'selected' : '' ?>>Male</option>
                                        <option value="female" <?= (($_POST['gender'] ?? '') == 'female') ? 'selected' : '' ?>>Female</option>
                                        <option value="other" <?= (($_POST['gender'] ?? '') == 'other') ? 'selected' : '' ?>>Other</option>
                                    </select>
                                </div>
                                <?php if(isset($errors['gender'])): ?>
                                    <p class="mt-2 text-sm text-red-600"><?= $errors['gender'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Province -->
                            <div>
                                <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                                <div class="mt-1">
                                    <select id="province" name="province" required class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                        <option value="">Select Province...</option>
                                        <?php 
                                        $provs = ['Koshi', 'Madhesh', 'Bagmati', 'Gandaki', 'Lumbini', 'Karnali', 'Sudurpashchim'];
                                        $selectedProv = $_POST['province'] ?? '';
                                        foreach($provs as $prov) {
                                            $sel = ($selectedProv == $prov) ? 'selected' : '';
                                            echo "<option value=\"$prov\" $sel>$prov</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php if(isset($errors['province'])): ?>
                                    <p class="mt-2 text-sm text-red-600"><?= $errors['province'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- District -->
                            <div>
                                <label for="district" class="block text-sm font-medium text-gray-700">District</label>
                                <div class="mt-1">
                                    <select id="district" name="district" required class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                        <option value="">Select District...</option>
                                        <option value="Kathmandu" <?= (($_POST['district'] ?? '') == 'Kathmandu') ? 'selected' : '' ?>>Kathmandu</option>
                                        <option value="Lalitpur" <?= (($_POST['district'] ?? '') == 'Lalitpur') ? 'selected' : '' ?>>Lalitpur</option>
                                        <option value="Bhaktapur" <?= (($_POST['district'] ?? '') == 'Bhaktapur') ? 'selected' : '' ?>>Bhaktapur</option>
                                        <option value="Kaski" <?= (($_POST['district'] ?? '') == 'Kaski') ? 'selected' : '' ?>>Kaski</option>
                                        <option value="Chitwan" <?= (($_POST['district'] ?? '') == 'Chitwan') ? 'selected' : '' ?>>Chitwan</option>
                                    </select>
                                </div>
                                <?php if(isset($errors['district'])): ?>
                                    <p class="mt-2 text-sm text-red-600"><?= $errors['district'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Municipality (Optional) -->
                            <div class="sm:col-span-2">
                                <label for="municipality" class="block text-sm font-medium text-gray-700">Municipality / Area <span class="text-gray-400 font-normal">(Optional)</span></label>
                                <div class="mt-1">
                                    <input type="text" name="municipality" id="municipality" value="<?= htmlspecialchars($_POST['municipality'] ?? '') ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                </div>
                            </div>

                            <!-- Last Donation Date -->
                            <div class="sm:col-span-2">
                                <label for="last_donation_date" class="block text-sm font-medium text-gray-700">Last Donation Date <span class="text-gray-400 font-normal">(Optional, if applicable)</span></label>
                                <div class="mt-1">
                                    <input type="date" name="last_donation_date" id="last_donation_date" value="<?= htmlspecialchars($_POST['last_donation_date'] ?? '') ?>" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border bg-gray-50">
                                </div>
                            </div>
                        </div>

                        <!-- Consent -->
                        <div class="mt-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="consent_given" name="consent_given" type="checkbox" required class="focus:ring-red-500 h-5 w-5 text-red-600 border-gray-300 rounded" <?= isset($_POST['consent_given']) ? 'checked' : '' ?>>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="consent_given" class="font-medium text-gray-700">I consent to make my contact number visible to people searching for blood donors during emergencies.</label>
                                </div>
                            </div>
                            <?php if(isset($errors['consent_given'])): ?>
                                <p class="mt-2 text-sm text-red-600"><?= $errors['consent_given'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end">
                                <a href="/" class="bg-white py-3 px-6 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Cancel
                                </a>
                                <button type="submit" class="ml-3 inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
