<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
      .status-active { background-color: #D1FAE5; color: #065F46; }
      .status-inactive { background-color: #FEE2E2; color: #B91C1C; }
      .status-off { background-color: #FEF3C7; color: #92400E; }
  </style>
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
              <a href="product" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg bg-green-700">
                  <i data-lucide="utensils" class="w-5 h-5"></i>
                  <span>Products</span>
              </a>
              <a href="history" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg hover:bg-green-700 transition">
                  <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                  <span>Order History</span>
              </a>
              <a href="staff" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg hover:bg-green-700 transition">
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
      <header class="flex justify-between items-center mb-6 p-4">
        <div>
          <h2 class="text-lg font-semibold">Product Details</h2>
          <p class="text-sm text-gray-500">{{ $today }}</p>
        </div>

      <!-- Notification and Profile -->
      <div class="flex items-center space-x-6">
      <!-- Notification Icon -->
        <button class="relative p-2 text-gray-600 hover:text-gray-900 rounded-full hover:bg-gray-100 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
          <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
        </button>

        <!-- Profile -->
          <div class="flex items-center space-x-3">
            <div class="relative">
              <img src="{{ asset('2b0401bf88244fac037c2b1627b3118c.jpg') }}" alt="User" class="w-10 h-10 rounded-full object-cover border-2 border-green-500">
              <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-500 ring-2 ring-white"></span>
            </div>
          </div>
        </div>
    </header>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <div class="flex items-center">
                <i data-lucide="check-circle" class="w-6 h-6 mr-2"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <div class="flex items-center">
                <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

      <!-- Product Detail Section -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex flex-col md:flex-row gap-6">
          <!-- Product Image -->
          <div class="w-full md:w-1/3 bg-gray-200 rounded-lg h-64 flex items-center justify-center">
            <img src="{{ asset('storage/'. $product->menuImage) }}" alt="{{$product->menuName}}" class="h-full w-full object-cover object-center">
          </div>

          <!-- Product Info -->
          <div class="w-full md:w-2/3">
            <div class="flex justify-between items-start">
              <h1 class="text-2xl font-bold text-gray-800">{{ $product->menuName }}</h1>
              <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $product->menuType }}
              </span>
            </div>

            <p class="text-3xl font-bold text-gray-900 mt-2">Rp{{ number_format($product->menuPrice) }}</p>
            <p class="text-gray-500 mt-1">Product ID: {{ $product->menuID }}</p>

            <div class="mt-6">
              <h2 class="text-lg font-semibold text-gray-800">Description</h2>
              <p class="text-gray-600 mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="mt-8 flex space-x-4">
              <a href="{{ route('product.edit', $product->menuID) }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Edit
              </a>

              <!-- Tombol Hapus dengan Konfirmasi -->
              <form action="{{ route('product.destroy', $product->menuID) }}" method="POST" class="inline">
                <button type="button" onclick="openDeleteModal('{{ $product->menuID }}', '{{ $product->menuName }}')"
                  class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                  Delete
              </button>
              </form>

              <a href="{{ route('product.index', ['category' => request('category') ?? '']) }}"
                class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50 transition">
                Back to Menu
              </a>
            </div>
          </div>
        </div>

        <!-- Additional Info Section -->
        <div class="mt-8 pt-6 border-t border-gray-200">
          <h2 class="text-lg font-semibold text-gray-800">Additional Information</h2>
          <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
              <p class="text-gray-500">Category</p>
              <p class="font-medium">{{ $product->menuType }}</p>
            </div>
            <div>
              <p class="text-gray-500">Availability</p>
              <p class="font-medium text-green-600">In Stock</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Delete Modal (tempatkan sebelum </body>) -->
  <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
      <h3 class="text-lg font-bold mb-4">Confirm Delete</h3>
      <p class="mb-4">Are you sure you want to delete <span id="productName" class="font-semibold"></span>?</p>
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="flex justify-end space-x-3">
          <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
            Cancel
          </button>
          <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
            Delete
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>

    lucide.createIcons();

    function openDeleteModal(id, name) {
      document.getElementById('productName').textContent = name;
      document.getElementById('deleteForm').action = `/product/${id}`;
      document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
      document.getElementById('deleteModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById('deleteModal');
      if (event.target === modal) {
        closeDeleteModal();
      }
    }
  </script>
</body>
</html>
