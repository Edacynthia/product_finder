@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">My Products</h2>
        <a href="{{ route('marketer.dashboard') }}" class="text-blue-600 hover:underline">Back to Dashboard</a>
    </div>

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
        <p class="text-gray-500">You have no products listed.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="border rounded-lg p-4 shadow-sm bg-white">
                    <img src="{{ $product->image_path ? Storage::url($product->image_path) : asset('images/placeholder.jpg') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                    <h4 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h4>
                    <p class="text-gray-600 text-sm">{{ Str::limit($product->description, 100) }}</p>
                    <p class="text-blue-600 font-medium">${{ number_format($product->price, 2) }}</p>
                    <p class="text-sm text-gray-500">Category: {{ $product->category->name }}</p>
                    <div class="mt-2 flex space-x-2">
                        @if ($product->whatsapp_link)
                            <a href="{{ $product->whatsapp_link }}" class="text-green-500 hover:underline text-sm" target="_blank">Contact via WhatsApp</a>
                        @endif
                        @if ($product->instagram_handle)
                            <a href="https://instagram.com/{{ ltrim($product->instagram_handle, '@') }}" class="text-pink-500 hover:underline text-sm" target="_blank">Instagram</a>
                        @endif
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('marketer.products.edit', $product) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                        <form action="{{ route('marketer.products.delete', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                        </form>
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