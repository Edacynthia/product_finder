@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Marketer Dashboard</h1>

    <div class="flex space-x-4 mb-8">
        <a href="{{ route('marketer.products.manage') }}" class="text-blue-600 hover:underline">Manage My Products</a>
        <a href="{{ route('marketer.inquiries') }}" class="text-blue-600 hover:underline">View Inquiries</a>
        <a href="{{ route('marketer.products.all') }}" class="text-blue-600 hover:underline">Browse All Products</a>
        <a href="{{ route('marketer.products.search') }}" class="text-blue-600 hover:underline">Search Products</a>
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-4">All Products</h2>
        @if ($products->isEmpty())
            <p class="text-gray-500">No products available.</p>
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
</div>
@endsection