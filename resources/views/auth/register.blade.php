<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Product Finder</title>
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
                <i class="fas fa-user-plus text-white text-6xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2 relative z-10">Product Finder</h1>
            <p class="text-purple-200 relative z-10">Create your account</p>
        </div>
        
        <div class="p-8">
            <div class="flex justify-center mb-6">
                <div class="bg-purple-100 p-4 rounded-full">
                    <i class="fas fa-user-plus text-purple-600 text-2xl"></i>
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

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Role Selection -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Register As</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="user" class="form-radio text-purple-600" checked @if(old('role') === 'user') checked @endif onchange="toggleMarketerFields()">
                            <span class="ml-2 text-gray-600">Regular User</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="marketer" class="form-radio text-purple-600" @if(old('role') === 'marketer') checked @endif onchange="toggleMarketerFields()">
                            <span class="ml-2 text-gray-600">Marketer</span>
                        </label>
                    </div>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endif
                </div>

                <!-- Name -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="name">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            value="{{ old('name') }}" 
                            required
                            class="form-input w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                            placeholder="John Doe"
                        >
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endif
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="email">Email Address</label>
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
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="password">Password</label>
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
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="password_confirmation">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation"
                            required
                            class="form-input w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                            placeholder="••••••••"
                        >
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="password-toggle fas fa-eye-slash text-gray-400" id="toggleConfirmPassword"></i>
                        </div>
                    </div>
                </div>

                <!-- Marketer Fields -->
                <div id="marketer-fields" class="hidden">
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="type">Type</label>
                        <select name="type" id="type" class="form-input w-full py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500">
                            <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select Type</option>
                            <option value="individual" {{ old('type') === 'individual' ? 'selected' : '' }}>Individual</option>
                            <option value="company" {{ old('type') === 'company' ? 'selected' : '' }}>Company</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="location">Location</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                name="location" 
                                id="location"
                                value="{{ old('location') }}"
                                class="form-input w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                                placeholder="Lagos, Nigeria"
                            >
                        </div>
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="description">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="4" 
                            class="form-input w-full py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                            placeholder="Tell us about yourself or your business"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="contact_phone">Contact Phone</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                name="contact_phone" 
                                id="contact_phone"
                                value="{{ old('contact_phone') }}"
                                class="form-input w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                                placeholder="+234 801 234 5678"
                            >
                        </div>
                        @error('contact_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="contact_email">Contact Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                type="email" 
                                name="contact_email" 
                                id="contact_email"
                                value="{{ old('contact_email') }}"
                                class="form-input w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                                placeholder="contact@yourbusiness.com"
                            >
                        </div>
                        @error('contact_email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2" for="website">Website</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-globe text-gray-400"></i>
                            </div>
                            <input 
                                type="url" 
                                name="website" 
                                id="website"
                                value="{{ old('website') }}"
                                class="form-input w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                                placeholder="https://yourwebsite.com"
                            >
                        </div>
                        @error('website')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 to-purple-700 text-white py-3 px-4 rounded-lg font-medium hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 shadow-md hover:shadow-lg"
                >
                    Create Account
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500 transition-colors duration-200">
                        Sign in here
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
        
        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Toggle marketer fields
        function toggleMarketerFields() {
            const marketerFields = document.getElementById('marketer-fields');
            const role = document.querySelector('input[name="role"]:checked').value;
            marketerFields.classList.toggle('hidden', role !== 'marketer');
        }

        // Run on page load to set initial state
        document.addEventListener('DOMContentLoaded', toggleMarketerFields);
    </script>
</body>
</html>