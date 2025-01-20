<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inactive Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <!-- Sleep/Inactive Icon -->
            <div class="mx-auto w-24 h-24 bg-amber-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </div>

            <!-- Main Content -->
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Account Inactive</h1>
            <p class="text-gray-600 mb-6">This account has been deactivated due to Admin request. Immediate action is
                required to restore access.</p>

            <!-- Details Box -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                <h2 class="text-lg font-semibold text-gray-900 mb-3">Account Details:</h2>
                <ul class="space-y-2 text-gray-600">
                    <li>
                        <span class="font-medium">Status:</span>
                        <span class="ml-2 text-amber-600 font-medium">Deactivated</span>
                    </li>
                    <li>
                        <span class="font-medium">Reason:</span>
                        <span class="ml-2">Admin Request</span>
                    </li>
                </ul>
            </div>

            <!-- Reactivation Box -->
            <div class="bg-amber-50 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Account Recovery Required</h3>
                <p class="text-gray-600 mb-4">Your account needs to be reactivated to restore access. Additional
                    verification may be required.</p>
            </div>

            <!-- Actions -->
            <div class="space-y-4">
                <button
                    class="w-full bg-amber-600 text-white py-3 px-4 rounded-lg hover:bg-amber-700 transition-colors">
                    Contact Support
                </button>
                <div class="flex justify-center space-x-4 text-sm">
                    <a href="#" class="text-gray-600 hover:text-amber-700">
                        Contact Support
                    </a>
                    <span class="text-gray-300">|</span>
                    <a href="#" class="text-gray-600 hover:text-amber-700">
                        Security FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>