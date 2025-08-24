@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Marketer: {{ Auth::user()->name }}</h1>
        <div class="flex space-x-4">
            <a href="{{ route('marketer.products.all') }}" class="text-blue-600 hover:underline">My Products</a>
            <a href="{{ route('marketer.products.manage') }}" class="text-blue-600 hover:underline">Add Products</a>
            <a href="{{ route('marketer.inquiries') }}" class="text-blue-600 hover:underline">Inquiries</a>
        </div>
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

    <!-- Profile Card -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">My Profile</h2>
        <div class="flex items-center space-x-6">
            <div>
                @if ($profile->image_path)
                    <img src="{{ Storage::url($profile->image_path) }}" alt="{{ Auth::user()->name }}" class="w-24 h-24 rounded-full object-cover">
                @else
                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder" class="w-24 h-24 rounded-full object-cover">
                @endif
            </div>
            <div>
                <p class="text-lg font-medium text-gray-700">Name: {{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-600">Email: {{ Auth::user()->email }}</p>
                <p class="text-sm text-gray-600">Type: {{ $profile->type }}</p>
                <p class="text-sm text-gray-600">Location: {{ $profile->location }}</p>
                <p class="text-sm text-gray-600">Description: {{ $profile->description ?? 'Not set' }}</p>
                <p class="text-sm text-gray-600">Phone: {{ $profile->contact_phone ?? 'Not set' }}</p>
                <p class="text-sm text-gray-600">Contact Email: {{ $profile->contact_email ?? 'Not set' }}</p>
                @if ($profile->website)
                    <p class="text-sm text-gray-600">Website: <a href="{{ $profile->website }}" class="text-blue-600 hover:underline" target="_blank">{{ $profile->website }}</a></p>
                @endif
                <a href="{{ route('marketer.profile.show', $profile) }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">View Profile</a>
            </div>
        </div>
    </div>

    <!-- Products -->
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Recent Products</h2>
    @if ($products->isEmpty())
        <p class="text-gray-500">No products found.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="border rounded-lg p-4 shadow-sm bg-white">
                    <img src="{{ $product->image_path ? Storage::url($product->image_path) : asset('images/placeholder.jpg') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
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
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection