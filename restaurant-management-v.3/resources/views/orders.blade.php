<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .status-active { background-color: #D1FAE5; color: #065F46; }
        .status-inactive { background-color: #FEE2E2; color: #B91C1C; }
        .status-off { background-color: #FEF3C7; color: #92400E; }
    </style>
    <title>Order History - THE PEEPS</title>
</head>
<body class="bg-gray-50" style="font-family: 'Poppins', sans-serif">
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
              <a href="history" class="flex items-center space-x-2 text-white font-medium text-base p-2 rounded-lg bg-green-700 transition">
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

    <main class="flex-1 p-6 ml-64">
        <header class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-semibold">Order History</h2>
                <p class="text-sm text-gray-500">{{ $today }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <img src="2b0401bf88244fac037c2b1627b3118c.jpg" alt="User" class="w-10 h-10 rounded-full object-cover border-2 border-green-500">
                        <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-500 ring-2 ring-white"></span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Alert Messages -->
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

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Table Header -->
            <div class="grid grid-cols-12 bg-gray-100 p-4 font-medium text-gray-700 uppercase text-sm">
                <div class="col-span-1">Order ID</div>
                <div class="col-span-2">Customer</div>
                <div class="col-span-2">Payment</div>
                <div class="col-span-2">Type</div>
                <div class="col-span-2">Status</div>
                <div class="col-span-2">Total</div>
                <div class="col-span-1">Actions</div>
            </div>


            @foreach ($orders as $order)
            <div class="grid grid-cols-12 p-4 border-b border-gray-200 hover:bg-gray-50 transition items-center">
                <!-- Order ID -->
                <div class="col-span-1 font-mono text-gray-600">
                    #{{ $order->id }}
                </div>
                
                <!-- Customer Name -->
                <div class="col-span-2 font-medium">
                    {{ $order->name }}
                </div>
                
                <!-- Payment Method -->
                <div class="col-span-2 flex items-center">
                    @if($order->payment == 'Cash')
                        <i data-lucide="dollar-sign" class="w-5 h-5 mr-2 text-green-600"></i>
                    @else
                        <i data-lucide="credit-card" class="w-5 h-5 mr-2 text-blue-600"></i>
                    @endif
                    {{ $order->payment }}
                </div>
                
                <!-- Order Type -->
                <div class="col-span-2">
                    <span class="px-3 py-1 rounded-full text-sm 
                        {{ $order->type == 'Dine In' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ $order->type }}
                    </span>
                </div>
                
                <!-- Status -->
                <div class="col-span-2">
                    @if ($order->status == 'On Kitchen')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
                            On Kitchen
                        </span>
                    @elseif ($order->status == 'Delivered')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <i data-lucide="truck" class="w-4 h-4 mr-1"></i>
                            Delivered
                        </span>
                    @elseif ($order->status == 'Completed')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                            Completed
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <i data-lucide="help-circle" class="w-4 h-4 mr-1"></i>
                            {{ $order->status }}
                        </span>
                    @endif
                </div>
                
                <!-- Total -->
                <div class="col-span-2 font-bold text-gray-900">
                    Rp{{ number_format($order->total, 0, ',', '.') }}
                </div>
                
                <!-- Actions -->
                <div class="col-span-1 flex space-x-2">
                    <!-- View Button -->
                    <a href="{{ route('history.show', $order->id) }}" class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </a>
                    
                    <!-- Delete Form -->
                    <form action="{{ route('history.destroy', $order->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                onclick="confirmDelete('{{ $order->id }}', 'Order #{{ $order->id }}')" 
                                class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                        <h3 class="text-lg font-bold mb-4">Confirm Delete</h3>
                        <p class="mb-4">Are you sure you want to delete <span id="itemName" class="font-semibold"></span>?</p>
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="flex justify-end space-x-3">
                                <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach    
        </div>
    </main>
    <script>
        function confirmDelete(id, name) {
            document.getElementById('itemName').textContent = name;
            document.getElementById('deleteForm').action = `/history/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
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
</body>
</html>