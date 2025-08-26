<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unauthorized Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-10 max-w-md text-center">
        <h1 class="text-6xl font-bold text-red-500 mb-4">403</h1>
        <h2 class="text-2xl font-semibold mb-2">Unauthorized Access</h2>
        <p class="text-gray-600 mb-6">
            Sorry, you don’t have permission to access this page.
        </p>
        <a href="{{ url('/') }}"
           class="inline-block px-6 py-3 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 transition">
            Go Back Home
        </a>
    </div>
</body>
</html>
