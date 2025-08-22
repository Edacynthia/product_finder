@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-4">Welcome to Product Finder</h1>
        <form action="{{ route('search') }}" method="GET" class="max-w-lg mx-auto flex">
            <input type="text" name="q" placeholder="Search for a product..." 
                   class="flex-1 border rounded-l px-4 py-2" required>
            <button class="bg-blue-600 text-white px-6 rounded-r">Search</button>
        </form>
    </div>
@endsection
