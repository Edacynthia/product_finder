<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Product Finder</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        purple: {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            500: '#a855f7',
                            600: '#9333ea',
                            700: '#7c3aed',
                            800: '#6b21a8'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.2);
        }
        .password-toggle {
            cursor: pointer;
            transition: all 0.2s;
        }
        .password-toggle:hover {
            color: #9333ea;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 to-purple-100 min-h-screen flex items-center justify-center p-4">
    <!-- Decorative elements -->
    <div class="absolute top-10 left-10 w-24 h-24 bg-purple-200 rounded-full opacity-50 animate-float"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-purple-300 rounded-full opacity-30 animate-float" style="animation-delay: 2s;"></div>
    
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-xl z-10">
        <!-- Decorative header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6 text-center relative">
            <div class="absolute top-2 right-2 opacity-20">
                <i class="fas fa-lock text-white text-6xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2 relative z-10">Product Finder</h1>
            <p class="text-purple-200 relative z-10">Sign in to your account</p>
        </div>
        
        <div class="p-8">
            <div class="flex justify-center mb-6">
                <div class="bg-purple-100 p-4 rounded-full">
                    <i class="fas fa-user-lock text-purple-600 text-2xl"></i>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="email">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            value="{{ old('email') }}" 
                            required
                            class="form-input w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                            placeholder="you@example.com"
                        >
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="password">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            required
                            class="form-input w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                            placeholder="••••••••"
                        >
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="password-toggle fas fa-eye-slash text-gray-400" id="togglePassword"></i>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>
                    
                    <div class="text-sm">
                        <a href="#" class="font-medium text-purple-600 hover:text-purple-500 transition-colors duration-200">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <button 
                    type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 to-purple-700 text-white py-3 px-4 rounded-lg font-medium hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 shadow-md hover:shadow-lg"
                >
                    Sign in
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-medium text-purple-600 hover:text-purple-500 transition-colors duration-200">
                        Sign up now
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>