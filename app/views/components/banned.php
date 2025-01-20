<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Banned</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <!-- Warning Icon -->
            <div class="mx-auto w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <!-- Main Content -->
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Account Banned</h1>
            <p class="text-gray-600 mb-6">Your account has been suspended for violating our community guidelines. This decision has been carefully reviewed by our moderation team.</p>

            <!-- Details Box -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                <h2 class="text-lg font-semibold text-gray-900 mb-3">Ban Details:</h2>
                <ul class="space-y-2 text-gray-600">
                    <li>
                        <span class="font-medium">Duration:</span>
                        <span class="ml-2">Permanent</span>
                    </li>
                    <li>
                        <span class="font-medium">Reason:</span>
                        <span class="ml-2">Multiple violations of community guidelines</span>
                    </li>
                </ul>
            </div>

            <!-- Actions -->
            <div class="space-y-4">
                <button class="w-full bg-red-600 text-white py-3 px-4 rounded-lg hover:bg-red-700 transition-colors">
                    Contact Support
                </button>
            </div>
        </div>
    </div>
</body>
</html>