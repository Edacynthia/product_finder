@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold mb-6">Search Products</h2>

    <!-- Search Form -->
    <form action="{{ route('marketer.products.search') }}" method="GET" class="mb-8 flex flex-col sm:flex-row gap-4">
        <input type="text" name="query" value="{{ $query ?? '' }}" placeholder="Search by product name or description" class="w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <select name="category_id" class="w-full sm:w-1/4 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Search</button>
    </form>

    <!-- Search Results -->
    @if ($products->isEmpty())
        <p class="text-gray-500">No products found.</p>
    @else
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <div class="border rounded-lg p-4 shadow-md bg-white">
                    @if ($product->image_path)
                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                    @endif
                    <h4 class="text-lg font-semibold">{{ $product->name }}</h4>
                    <p class="text-gray-600">{{ Str::limit($product->description, 100) }}</p>
                    <p class="text-blue-600 font-medium">${{ number_format($product->price, 2) }}</p>
                    <p class="text-sm text-gray-500">Category: {{ $product->category->name }}</p>
                    <p class="text-sm text-gray-500">Sold by: {{ $product->user->name }}</p>
                    @if ($product->whatsapp_link)
                        <a href="{{ $product->whatsapp_link }}" class="text-green-500 hover:underline" target="_blank">Contact via WhatsApp</a>
                    @endif
                    @if ($product->instagram_handle)
                        <a href="https://instagram.com/{{ ltrim($product->instagram_handle, '@') }}" class="text-pink-500 hover:underline" target="_blank">Instagram</a>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection