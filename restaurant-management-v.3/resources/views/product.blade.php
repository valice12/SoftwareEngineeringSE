<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Products - THE PEEPS</title>
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

    <header class="flex justify-between items-center mb-6 p-4">
    <!-- Search Form -->
    <form action="/product" method="GET" class="w-1/3 min-w-[300px]">
      <div class="relative">
        <input
          type="text"
          name="search"
          placeholder="Search here..."
          value="{{ $searchQuery ?? '' }}"
          class="px-4 py-2 border border-gray-300 rounded-lg w-full pr-10 focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
        <button type="submit" class="absolute right-3 top-2.5 text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
      </div>
      @if($selectedCategory)
        <input type="hidden" name="category" value="{{ $selectedCategory }}">
      @endif
    </form>

    <!-- Notification and Profile -->
    <div class="flex items-center space-x-6">
      <!-- Menu Creation -->
      <a href="{{ route('product.create') }}"
        class="flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        <span>Add Menu</span>
      </a>
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
            <img src="2b0401bf88244fac037c2b1627b3118c.jpg" alt="User" class="w-10 h-10 rounded-full object-cover border-2 border-green-500">
            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-500 ring-2 ring-white"></span>
          </div>
        </div>
      </div>
    </header>

    @if(session('success'))
    <div class="mb-4 p-4 bg-red-100 text-white-700 rounded-lg">
      {{ session('success') }}
    </div>
    @endif

    <!-- Category Filter -->
    <div class="mb-4">
  <h3 class="font-semibold mb-2">Category</h3>
  <div class="flex space-x-4" id="category">
    <a href="/product"
       class="px-4 py-2 rounded-full {{ !$selectedCategory ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800' }}">
       All
    </a>
    <a href="/product?category=Main+Course"
       class="px-4 py-2 rounded-full {{ ($selectedCategory === 'Main Course') ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800' }}">
       Main Course
    </a>
    <a href="/product?category=Pastry"
       class="px-4 py-2 rounded-full {{ ($selectedCategory === 'Pastry') ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800' }}">
       Pastry
    </a>
    <a href="/product?category=Dessert"
       class="px-4 py-2 rounded-full {{ ($selectedCategory === 'Dessert') ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800' }}">
       Dessert
    </a>
    <a href="/product?category=Drinks"
       class="px-4 py-2 rounded-full {{ ($selectedCategory === 'Drinks') ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800' }}">
       Drinks
    </a>
  </div>
</div>


    <h3 class="font-semibold mb-4 mt-6">
      {{ $selectedCategory ? $selectedCategory . ' Menu' : 'All Menu' }}
    </h3>
    <div class="grid grid-cols-5 gap-4">
      @foreach($products as $product)
        <a href="{{ route('product.detail', $product->menuID) }}" class="block bg-white p-2 rounded-lg shadow-md text-center hover:shadow-lg transition">
            <div class="bg-gray-200 h-28 mb-2 rounded-lg">
                <img src="{{ asset($product->imageUrl) }}" alt="{{ $product->menuName }}" class="h-full w-full object-cover object-center">
            </div>
            <p class="text-sm font-medium">{{ $product->menuName }}</p>
            <p class="text-sm text-gray-600">Rp{{ number_format($product->menuPrice) }}</p>
            <p class="text-xs text-gray-400">{{ $product->menuID }}</p>
            <div class="text-right text-gray-400 text-xl">⋯</div>
        </a>
      @endforeach
    </div>

  </main>
</div>
</body>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const buttons = document.querySelectorAll('.category-btn');

      buttons.forEach(button => {
        button.addEventListener('click', function() {
          // Reset all buttons
          buttons.forEach(btn => {
            btn.classList.remove('bg-green-500', 'text-white');
            btn.classList.add('bg-green-100', 'text-green-800');
          });

          // Set active button
          this.classList.remove('bg-green-100', 'text-green-800');
          this.classList.add('bg-green-500', 'text-white');

          console.log('Button clicked:', this.textContent); // Debugging
        });
      });
    });

    lucide.createIcons();

      // Simple search functionality
      document.querySelector('input[placeholder="Search staff..."]').addEventListener('input', function(e) {
          const searchTerm = e.target.value.toLowerCase();
          document.querySelectorAll('tbody tr').forEach(row => {
              const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
              const role = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
              const email = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

              if (name.includes(searchTerm) || role.includes(searchTerm) || email.includes(searchTerm)) {
                  row.style.display = '';
              } else {
                  row.style.display = 'none';
              }
          });
      });
  </script>
</html>
