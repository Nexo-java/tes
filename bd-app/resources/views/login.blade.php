<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form method="POST" action="/login" class="bg-white p-8 rounded shadow-md w-96">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <div class="mb-4">
              <label for="uname" class="block text-gray-700">Username</label>
              <input type="text" name="uname" id="uname" class="w-full px-3 py-2 border rounded" required autofocus>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded" required>
        </div>
        @if($errors->any())
            <div class="mb-4 text-red-500 text-sm">
                {{ $errors->first() }}
            </div>
        @endif
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Login</button>
    </form>
</body>
</html>
