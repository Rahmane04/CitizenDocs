<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CitizenDocs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-blue-700">🏛️ CitizenDocs</h1>
        </div>
        {{ $slot }}
    </div>
</body>
</html>