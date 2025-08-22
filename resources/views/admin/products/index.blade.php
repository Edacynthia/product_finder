@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Products</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" class="mb-4">
        @csrf
        <input type="text" name="name" placeholder="Product Name" class="border px-2 py-1 rounded">
        <select name="category_id" class="border px-2 py-1 rounded">
            @foreach(\App\Models\Category::all() as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
        <button class="bg-blue-600 text-white px-3 py-1 rounded">Add</button>
    </form>

    <ul class="list-disc ml-6">
        @foreach($products as $product)
            <li>{{ $product->name }} ({{ $product->category->name }})</li>
        @endforeach
    </ul>
@endsection
