<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-12">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-lg font-bold">Laravel CRUD App</h1>
        </div>
    </nav>

    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
</body>
</html>
