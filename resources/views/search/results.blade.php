@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Search Results</h2>
        <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Back to Home</a>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('search') }}" class="mb-8">
        <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
            <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Search by name or description" class="w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <select name="category_id" class="w-full sm:w-1/4 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Search</button>
        </div>
    </form>

    <!-- Messages -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Products -->
    @if ($products->isEmpty())
        <p class="text-gray-500">No products found.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="border rounded-lg p-4 shadow-sm bg-white">
                    <img src="{{ $product->image_path ? Storage::url($product->image_path) : asset('images/placeholder.jpg') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                    <h4 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h4>
                    <p class="text-gray-600 text-sm">{{ Str::limit($product->description, 100) }}</p>
                    <p class="text-blue-600 font-medium">${{ number_format($product->price, 2) }}</p>
                    <p class="text-sm text-gray-500">Category: {{ $product->category->name }}</p>
                    <p class="text-sm text-gray-500">Marketer: {{ $product->user->name ?? 'Unknown Marketer' }}</p>
                    <div class="mt-2 flex space-x-2">
                        @if ($product->whatsapp_link)
                            <a href="{{ $product->whatsapp_link }}" class="text-green-500 hover:underline text-sm" target="_blank">Contact via WhatsApp</a>
                        @endif
                        @if ($product->instagram_handle)
                            <a href="https://instagram.com/{{ ltrim($product->instagram_handle, '@') }}" class="text-pink-500 hover:underline text-sm" target="_blank">Instagram</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection