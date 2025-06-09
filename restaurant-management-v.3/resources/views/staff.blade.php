<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management - THE PEEPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h2 class="text-lg font-semibold">Staff Pages</h2>
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

        <!-- Page Title and Add Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Staff Management</h2>
            <a href="{{ route('staff.create') }}" class="flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                <i data-lucide="user-plus" class="w-5 h-5"></i>
                <span>Add Staff</span>
            </a>
        </div>

        <!-- Staff Table -->
      <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attendance</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($staffs as $staff)
              <tr class="hover:bg-gray-50 transition">
                <!-- Profile Picture (Dummy) -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full object-cover"
                         src="2b0401bf88244fac037c2b1627b3118c.jpg"
                         alt="{{ $staff->staffName }}">
                  </div>
                </td>

                <!-- Staff ID -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">{{ $staff->staffID }}</div>
                </td>

                <!-- Staff Name -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">{{ $staff->staffName }}</div>
                </td>

                <!-- Staff Position -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $staff->staffPosition }}</div>
                </td>

                <!-- Staff Email -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $staff->staffEmail }}</div>
                </td>

                <!-- Status (Dummy) -->
                <td class="px-6 py-4 whitespace-nowrap">
                  @php
                    $statuses = ['Active', 'Inactive', 'Off Work'];
                    $status = $statuses[array_rand($statuses)];
                    $statusClass = [
                      'Active' => 'bg-green-100 text-green-800',
                      'Inactive' => 'bg-red-100 text-red-800',
                      'Off Work' => 'bg-yellow-100 text-yellow-800'
                    ];
                  @endphp
                  <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass[$status] }}">
                    {{ $status }}
                  </span>
                </td>

                <!-- Attendance (Dummy) -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="w-16 mr-2">
                      @php
                        $daysPresent = rand(20, 25);
                        $daysTotal = 25;
                        $percentage = ($daysPresent / $daysTotal) * 100;
                      @endphp
                      <div class="text-sm text-gray-500">{{ $daysPresent }}/{{ $daysTotal }} days</div>
                      <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                      </div>
                    </div>
                  </div>
                </td>

                <!-- Actions -->
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button class="text-green-600 hover:text-green-900 mr-3">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                    </button>
                    <button class="text-blue-600 hover:text-blue-900 mr-3">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                    </button>
                    <form action="{{ route('staff.destroy', $staff->staffID) }}" class="delete-button"  method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </main>
</div>
  <script>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll(".delete-button");

        deleteForms.forEach(form => {
            const button = form.querySelector("button");

            button.addEventListener("click", function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Hapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#10cf81'
            });
        });
    </script>
@endif
</body>
</html>
