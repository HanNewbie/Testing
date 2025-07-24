<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BLUD</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative h-full flex items-center justify-center overflow-hidden">

  <img src="{{ asset('assets/img/teratai.jpg') }}"
       alt="Background"
       class="absolute inset-0 w-full h-full object-cover z-0"/>

  <div class="relative z-10 w-full max-w-md bg-white bg-opacity-50 backdrop-blur-md rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login Admin BLUD</h2>

    @if ($errors->has('login'))
      <div class="mb-4 text-red-600 text-sm">
        {{ $errors->first('login') }}
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
      @csrf

      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" required
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" required
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
      </div>

      <button type="submit"
        class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
        Login
      </button>
    </form>
  </div>

</body>
</html>
