@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Categories</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-4">
        @csrf
        <input type="text" name="name" placeholder="New Category" class="border px-2 py-1 rounded">
        <button class="bg-blue-600 text-white px-3 py-1 rounded">Add</button>
    </form>

    <ul class="list-disc ml-6">
        @foreach($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
@endsection
