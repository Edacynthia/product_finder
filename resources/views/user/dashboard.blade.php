@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6 rounded-2xl shadow-md text-center mb-8">
        <h1 class="text-3xl font-bold text-white">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="text-purple-200 mt-2">Explore all available products below</p>
    </div>

    <!-- Messages -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Products Grid -->
    @if ($products->isEmpty())
        <div class="text-center text-gray-600">
            <p>No products available at the moment.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl">
                    <!-- Product Image -->
                    <img 
                        src="{{ $product->image_path ? Storage::url($product->image_path) : asset('images/placeholder.jpg') }}" 
                        alt="{{ $product->name }}" 
                        class="w-full h-48 object-cover"
                    >
                    <!-- Product Details -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($product->description, 100) }}</p>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <i class="fas fa-user mr-2"></i>
                            <span>{{ $product->user->name }}</span>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <i class="fas fa-folder mr-2"></i>
                            <span>{{ $product->category->name }}</span>
                        </div>
                        <div class="mt-4">
                            <a 
                                href="{{ route('marketer.profile.show', $product->user->marketerProfile->id) }}" 
                                class="inline-block bg-gradient-to-r from-purple-600 to-purple-700 text-white py-2 px-4 rounded-lg font-medium hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                            >
                                Contact Marketer
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection