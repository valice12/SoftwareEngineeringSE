<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit {{ $product->menuName }} - THE PEEPS</title>
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
      <!-- Header (sama dengan product-detail) -->
      <header class="flex justify-between items-center mb-6 p-4">
        <div>
          <h2 class="text-lg font-semibold">Edit</h2>
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

      <!-- Edit Form Section -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Product</h1>
        
        <form action="{{ route('product.update', $product->menuID) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

           <!-- Bagian upload gambar -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Product Image</label>
                
                <!-- Tampilkan gambar saat ini -->
                @if($product->menuImage)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $product->menuImage) }}" 
                            alt="Current Image" 
                            class="w-40 h-40 object-cover rounded-lg mb-2">
                        <button type="button" onclick="confirmDelete()"
                          class="text-red-500 text-sm hover:text-red-700">
                            Delete Image
                        </button>
                    </div>
                @else
                    <div class="mb-3">
                        <img src="{{ asset('images/default-product.png') }}" 
                            alt="Default Image" 
                            class="w-40 h-40 object-cover rounded-lg mb-2">
                    </div>
                @endif
                
                <!-- Input file upload -->
                <input type="file" name="menuImage" id="menuImage" 
                      class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                      accept="image/*">
                
                <!-- Preview gambar baru -->
                <div id="imagePreview" class="mt-3 hidden">
                    <img id="previewImage" class="w-40 h-40 object-cover rounded-lg">
                </div>
            </div>

            <!-- Product Name -->
            <div>
              <label for="menuName" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
              <input type="text" id="menuName" name="menuName" value="{{ $product->menuName }}"
                     class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            
            <!-- Product Price -->
            <div>
              <label for="menuPrice" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
              <input type="number" id="menuPrice" name="menuPrice" value="{{ $product->menuPrice }}"
                     class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            <!-- Menu Calorie -->
            <div>
              <label for="menuCalorie" class="block text-sm font-medium text-gray-700 mb-1">Calorie*</label>
              <input type="number" id="menuCalorie" name="menuCalorie" value="{{ $product->menuCalorie }}"
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                      min="0" step="100">
            </div>
            
            <!-- Product Category -->
            <div>
              <label for="menuType" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
              <select id="menuType" name="menuType" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option value="Main Course" {{ $product->menuType == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                <option value="Pastry" {{ $product->menuType == 'Pastry' ? 'selected' : '' }}>Pastry</option>
                <option value="Dessert" {{ $product->menuType == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                <option value="Drinks" {{ $product->menuType == 'Drinks' ? 'selected' : '' }}>Drinks</option>
              </select>
            </div>
          </div>

          
          <div class="mt-8 flex space-x-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
              Save Changes
            </button>
            <a href="{{ route('product.detail', $product->menuID) }}" class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50 transition">
              Cancel
            </a>
          </div>
        </form>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
        </div>
    </main>
  </div>

    <form id="deleteImageForm" action="{{ route('product.deleteImage', $product->menuID) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
        
        <div class="mt-8 flex space-x-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Save Changes
            </button>
            <a href="{{ route('product.detail', $product->menuID) }}" class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50 transition">
                Cancel
            </a>
        </div>
    </form>
</body>
  <script>

        // Konfirmasi hapus gambar
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this image?')) {
            document.getElementById('deleteImageForm').submit();
        }
    }

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