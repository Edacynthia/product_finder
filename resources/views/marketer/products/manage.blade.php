@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Add Products</h1>
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

    <!-- Add Product Form -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Add New Product</h2>
        <form action="{{ route('marketer.products.attach') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="whatsapp_link" class="block text-sm font-medium text-gray-700">WhatsApp Link</label>
                    <input type="text" name="whatsapp_link" id="whatsapp_link" value="{{ old('whatsapp_link') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., https://wa.me/1234567890">
                    @error('whatsapp_link') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="instagram_handle" class="block text-sm font-medium text-gray-700">Instagram Handle</label>
                    <input type="text" name="instagram_handle" id="instagram_handle" value="{{ old('instagram_handle') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., @username">
                    @error('instagram_handle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="4">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Product</button>
        </form>
    </div>

    <!-- Product List -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">My Products</h2>
        @if ($products->isEmpty())
            <p class="text-gray-500">No products added yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="border rounded-lg p-4 shadow-sm bg-white">
                        @if ($product->image_path)
                            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                        @endif
                        <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($product->description, 100) }}</p>
                        <p class="text-blue-600 font-medium">${{ number_format($product->price, 2) }}</p>
                        <p class="text-sm text-gray-500">Category: {{ $product->category->name }}</p>
                        <div class="mt-2 flex space-x-2">
                            @if ($product->whatsapp_link)
                                <a href="{{ $product->whatsapp_link }}" class="text-green-500 hover:underline text-sm" target="_blank">WhatsApp</a>
                            @endif
                            @if ($product->instagram_handle)
                                <a href="https://instagram.com/{{ ltrim($product->instagram_handle, '@') }}" class="text-pink-500 hover:underline text-sm" target="_blank">Instagram</a>
                            @endif
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <button onclick="openEditModal({{ $product->id }})" class="text-blue-600 hover:underline">Edit</button>
                            <form action="{{ route('marketer.products.delete', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete {{ $product->name }}?')">Delete</button>
                            </form>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div id="edit-modal-{{ $product->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg p-6 w-full max-w-lg">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Product: {{ $product->name }}</h3>
                            <form action="{{ route('marketer.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="name-{{ $product->id }}" class="block text-sm font-medium text-gray-700">Product Name</label>
                                    <input type="text" name="name" id="name-{{ $product->id }}" value="{{ old('name', $product->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="price-{{ $product->id }}" class="block text-sm font-medium text-gray-700">Price ($)</label>
                                    <input type="number" step="0.01" name="price" id="price-{{ $product->id }}" value="{{ old('price', $product->price) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="category_id-{{ $product->id }}" class="block text-sm font-medium text-gray-700">Category</label>
                                    <select name="category_id" id="category_id-{{ $product->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="image-{{ $product->id }}" class="block text-sm font-medium text-gray-700">Product Image</label>
                                    <input type="file" name="image" id="image-{{ $product->id }}" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    @if ($product->image_path)
                                        <img src="{{ Storage::url($product->image_path) }}" alt="Current Image" class="mt-2 w-24 h-24 object-cover rounded-md">
                                    @endif
                                </div>
                                <div>
                                    <label for="whatsapp_link-{{ $product->id }}" class="block text-sm font-medium text-gray-700">WhatsApp Link</label>
                                    <input type="text" name="whatsapp_link" id="whatsapp_link-{{ $product->id }}" value="{{ old('whatsapp_link', $product->whatsapp_link) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., https://wa.me/1234567890">
                                    @error('whatsapp_link') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="instagram_handle-{{ $product->id }}" class="block text-sm font-medium text-gray-700">Instagram Handle</label>
                                    <input type="text" name="instagram_handle" id="instagram_handle-{{ $product->id }}" value="{{ old('instagram_handle', $product->instagram_handle) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., @username">
                                    @error('instagram_handle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="description-{{ $product->id }}" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description-{{ $product->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="4">{{ old('description', $product->description) }}</textarea>
                                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex space-x-2">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Update Product</button>
                                    <button type="button" onclick="closeEditModal({{ $product->id }})" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
function openEditModal(id) {
    document.getElementById(`edit-modal-${id}`).classList.remove('hidden');
}
function closeEditModal(id) {
    document.getElementById(`edit-modal-${id}`).classList.add('hidden');
}
</script>
@endsection