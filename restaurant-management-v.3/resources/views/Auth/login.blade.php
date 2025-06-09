<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>The Peeps Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }

    .left-panel {
      background-color: #00462A;
    }
  </style>
</head>
<body class="bg-gray-50">
  <div class="flex min-h-screen">
    <!-- Left Side -->
    <div class="hidden md:flex md:w-1/2 bg-green-900 items-center justify-center flex-col p-8 relative">
      <!-- Middle Image -->
        <div class="flex-1 flex items-end justify-center mb-8 z-10">
            <img src="{{ asset('images/tp1.png') }}" alt="The Peeps" class="max-w-full h-auto">
        </div>

        <!-- YB Image (smaller and absolute positioned) -->
        <div class="absolute top-[30%] left-[30%] transform -translate-x-1/2 -translate-y-1/2 z-0">
            <img src="{{ asset('images/yb.png') }}" alt="YB" class="w-10 h-auto"> <!-- Reduced from w-32 to w-20 -->
        </div>

        <!-- Bottom Image (aligned to bottom) -->
        <div class="w-full flex justify-center mt-auto"> <!-- mt-auto pushes it to bottom -->
            <img src="{{ asset('images/ppl.png') }}" alt="Illustration" class="max-w-[90%] h-auto">
        </div>
    </div>

    <!-- Right Side -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-white p-6">
      <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="mb-8 text-center">
          <img src="{{ asset('images/tp2.png') }}" alt="The Peeps" class="h-12 mx-auto">
        </div>

        <!-- Form Header -->
        <div class="mb-6 text-center">
          <h2 class="text-2xl font-semibold text-gray-800">Log in to your Account</h2>
          <p class="text-gray-500 mt-2">Hello, Welcome back!</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
          @csrf
          <!-- Email -->
          <div>
            <input name="email" type="email" value="{{ old('email') }}" placeholder="Email"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
            @error('email')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password -->
          <div>
            <input name="password" type="password" placeholder="Password"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
            @error('password')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="text-right">
            <a href="#" class="text-sm text-green-600 hover:text-green-800">Forgot Password?</a>
          </div>

          <button type="submit"
                  class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg transition duration-200">
            Log In
          </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
          </div>
          <div class="relative flex justify-center">
            <span class="bg-white px-2 text-sm text-gray-500">or continue with</span>
          </div>
        </div>

        <!-- Google Login -->
        <button class="w-full flex items-center justify-center gap-2 py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
          <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
          <span>Google</span>
        </button>

        <!-- Sign Up Link -->
        <div class="mt-6 text-center text-sm">
          <span class="text-gray-600">Don't have an account?</span>
          <a href="register" class="ml-1 text-green-600 font-semibold hover:text-green-800">Create an account</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
