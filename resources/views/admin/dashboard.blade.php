<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        secondary: '#10b981',
                        dark: '#1e293b',
                        light: '#f8fafc',
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .active-link {
            background-color: rgba(79, 70, 229, 0.1);
            border-left: 4px solid #4f46e5;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-white w-64 md:w-72 border-r border-gray-200 flex flex-col">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-shield-alt text-primary text-2xl"></i>
                    <span class="text-xl font-bold text-dark">AdminPortal</span>
                </div>
                <button id="sidebarToggle" class="md:hidden text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto py-4">
                <div class="px-4 mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 rounded-full bg-primary flex items-center justify-center text-white">
                            <span class="font-semibold">AD</span>
                        </div>
                        <div>
                            <p class="font-medium text-dark">Admin User</p>
                            <p class="text-xs text-gray-500">Super Admin</p>
                        </div>
                    </div>
                </div>
                
                <nav class="px-2 space-y-1">
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-white bg-primary">
                        <i class="fas fa-tachometer-alt mr-3 text-white"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.categories') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-tags mr-3 text-secondary"></i>
                        Manage Categories
                    </a>
                    <a href="{{ route('admin.products') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-box-open mr-3 text-blue-500"></i>
                        Manage Products
                    </a>
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-users mr-3 text-purple-500"></i>
                        User Management
                    </a>
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-chart-line mr-3 text-yellow-500"></i>
                        Analytics
                    </a>
                    <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog mr-3 text-gray-500"></i>
                        Settings
                    </a>
                </nav>
            </div>
            
            <form action="{{ route('logout') }}" method="POST" class="p-4 border-t border-gray-200">
    @csrf
    <button type="submit" class="flex items-center text-sm font-medium text-gray-700 hover:text-primary w-full text-left">
        <i class="fas fa-sign-out-alt mr-2"></i>
        Logout
    </button>
</form>

        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-4 py-3 sm:px-6">
                    <div class="flex items-center">
                        <button id="mobileSidebarToggle" class="md:hidden text-gray-500 mr-2">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-dark">Dashboard Overview</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                        </div>
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-envelope"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-blue-500"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content Area -->
            <main class="p-4 sm:p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Products</p>
                                <p class="text-2xl font-bold text-dark mt-1">1,248</p>
                                <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i>12.5% from last month</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-box-open text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Categories</p>
                                <p class="text-2xl font-bold text-dark mt-1">42</p>
                                <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i>5.2% from last month</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-tags text-green-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Active Users</p>
                                <p class="text-2xl font-bold text-dark mt-1">3,784</p>
                                <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i>2.1% from last month</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-users text-purple-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Revenue</p>
                                <p class="text-2xl font-bold text-dark mt-1">$28,745</p>
                                <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i>18.7% from last month</p>
                            </div>
                            <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity and Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Activity -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-dark">Recent Activity</h2>
                            </div>
                            <div class="divide-y divide-gray-200">
                                <div class="px-6 py-4 flex items-start">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-user-plus text-blue-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-dark">New user registered</p>
                                        <p class="text-xs text-gray-500 mt-1">John Doe registered 2 hours ago</p>
                                    </div>
                                    <span class="ml-auto text-xs text-gray-500">2h ago</span>
                                </div>
                                <div class="px-6 py-4 flex items-start">
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-tag text-green-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-dark">New category added</p>
                                        <p class="text-xs text-gray-500 mt-1">"Electronics" category was added</p>
                                    </div>
                                    <span class="ml-auto text-xs text-gray-500">5h ago</span>
                                </div>
                                <div class="px-6 py-4 flex items-start">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-shopping-cart text-purple-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-dark">New order placed</p>
                                        <p class="text-xs text-gray-500 mt-1">Order #4567 for $245.99</p>
                                    </div>
                                    <span class="ml-auto text-xs text-gray-500">1d ago</span>
                                </div>
                                <div class="px-6 py-4 flex items-start">
                                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-box-open text-yellow-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-dark">Product updated</p>
                                        <p class="text-xs text-gray-500 mt-1">"Wireless Headphones" stock updated</p>
                                    </div>
                                    <span class="ml-auto text-xs text-gray-500">2d ago</span>
                                </div>
                            </div>
                            <div class="px-6 py-3 bg-gray-50 text-right">
                                <a href="#" class="text-sm font-medium text-primary hover:text-primary-dark">View all activity</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div>
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-dark">Quick Actions</h2>
                            </div>
                            <div class="p-6 grid grid-cols-2 gap-4">
                                <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg border border-gray-200 hover:border-primary hover:bg-blue-50 transition-colors">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-plus text-blue-500"></i>
                                    </div>
                                    <span class="text-sm font-medium text-dark">Add Product</span>
                                </a>
                                <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition-colors">
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-tag text-green-500"></i>
                                    </div>
                                    <span class="text-sm font-medium text-dark">Add Category</span>
                                </a>
                                <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg border border-gray-200 hover:border-purple-500 hover:bg-purple-50 transition-colors">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-user-plus text-purple-500"></i>
                                    </div>
                                    <span class="text-sm font-medium text-dark">Add User</span>
                                </a>
                                <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg border border-gray-200 hover:border-yellow-500 hover:bg-yellow-50 transition-colors">
                                    <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-chart-pie text-yellow-500"></i>
                                    </div>
                                    <span class="text-sm font-medium text-dark">View Reports</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Orders -->
                <div class="mt-8">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-dark">Recent Orders</h2>
                            <a href="#" class="text-sm font-medium text-primary hover:text-primary-dark">View all orders</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-dark">#4567</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Smith</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 15, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$245.99</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-primary hover:text-primary-dark">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-dark">#4566</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sarah Johnson</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 14, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$189.50</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Processing</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-primary hover:text-primary-dark">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-dark">#4565</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Michael Brown</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 14, 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$320.00</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="#" class="text-primary hover:text-primary-dark">View</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        document.getElementById('mobileSidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });

        // Close sidebar when clicking the close button
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('hidden');
        });

        // Highlight active link
        const links = document.querySelectorAll('nav a');
        links.forEach(link => {
            link.addEventListener('click', function() {
                links.forEach(l => l.classList.remove('active-link'));
                this.classList.add('active-link');
            });
        });
    </script>
</body>
</html>