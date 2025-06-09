<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Staff - THE PEEPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50" style="font-family: 'Poppins', sans-serif">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-green-600 p-4 border-r h-screen flex flex-col fixed top-0 left-0 overflow-y-auto">
      <div>
          <div class="text-white text-2xl font-bold mb-8 text-center">
              BITEZ
          </div>
          <nav class="space-y-2">
              <a href="dashboard" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg hover:bg-green-700 transition">
                  <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                  <span>Dashboard</span>
              </a>
              <a href="product" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg hover:bg-green-700">
                  <i data-lucide="utensils" class="w-5 h-5"></i>
                  <span>Products</span>
              </a>
              <a href="history" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg hover:bg-green-700 transition">
                  <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                  <span>Order History</span>
              </a>
              <a href="staff" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg bg-green-700 transition">
                  <i data-lucide="users" class="w-5 h-5"></i>
                  <span>Staff</span>
              </a>
          </nav>
      </div>

      <div class="mt-auto mb-4 space-y-2">
          <a href="#" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg hover:bg-green-700 transition">
              <i data-lucide="settings" class="w-5 h-5"></i>
              <span>Settings</span>
          </a>
          <form method="POST" action="{{ route('logout') }}" class="w-full">
              @csrf
              <button type="submit" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg hover:bg-green-700 w-full">
                  <i data-lucide="log-out" class="w-5 h-5"></i>
                  <span>Logout</span>
              </button>
          </form>
      </div>
  </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 ml-64">
        <!-- Header -->
        <header class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-semibold">Add New Staff</h2>
                <p class="text-sm text-gray-500">{{ date('l, d F Y') }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <img src="{{ asset('2b0401bf88244fac037c2b1627b3118c.jpg')}}"
                            class="w-10 h-10 rounded-full object-cover border-2 border-green-500"
                            onerror="this.src='{{ asset('images/default-avatar.jpg') }}'">
                        <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-500 ring-2 ring-white"></span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('staff.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Staff Name -->
                        <div>
                            <label for="staffName" class="block text-sm font-medium text-gray-700">Full Name <b style="color: red">*</b></label>
                            <input type="text" name="staffName" id="staffName" value="{{ old('staffName') }}" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="staffEmail" class="block text-sm font-medium text-gray-700">Email <b style="color: red">*</b></label>
                            <input type="email" name="staffEmail" id="staffEmail" value="{{ old('staffEmail') }}" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        <!-- Position -->
                            <div>
                                <label for="staffPositionID" class="block text-sm font-medium text-gray-700">Position <b style="color: red">*</b></label>
                                <select name="staffPositionID" id="staffPositionID" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    <option value="">Select Position</option>
                                    @foreach($positions as $position)
                                         <option value="{{ $position->staffPositionID }}" @selected(old('staffPositionID') == $position->staffPositionID)>
                                            {{ $position->staffPosition }} ({{ $position->staffPositionID }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>

                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password <b style="color: red">*</b></label>
                                <input type="password" name="password" id="password" required
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password <b style="color: red">*</b></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                       @error('password')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                            </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label for="staffAddress" class="block text-sm font-medium text-gray-700">Address <b style="color: red">*</b></label>
                            <textarea name="staffAddress" id="staffAddress" rows="3"
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('staffAddress') }}</textarea>
                        </div>
                    </div>


                    <!-- Hidden fields -->
                    <input type="hidden" name="staffPhone" value="">
                    <input type="hidden" name="joinDate" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="isActive" value="1">

                    <!-- Form Footer -->
                    <div class="mt-8 pt-5 border-t border-gray-200">
                        <div class="flex justify-end">
                            <a href="{{ route('staff.index') }}"
                               class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Add Staff
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
<script>
    lucide.createIcons();
</script>
</body>
</html>
