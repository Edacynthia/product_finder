@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Search Results for "{{ $query }}"</h2>

    @forelse($products as $product)
        <div class="border p-4 rounded mb-4">
            <h3 class="font-semibold">{{ $product->name }}</h3>
            <p class="text-sm text-gray-500">Category: {{ $product->category->name }}</p>

            <h4 class="mt-2 font-medium">Available Marketers:</h4>
            <ul class="list-disc ml-6">
                @forelse($product->marketers as $marketer)
                    <li>
                        {{ $marketer->user->name }} ({{ $marketer->location }})  
                        - Price: ₦{{ number_format(optional($marketer->products->find($product->id))->pivot->price ?? 0, 2) }}

                        <form action="{{ route('inquiries.store', $marketer->id) }}" method="POST" class="mt-1">
                            @csrf
                            <input type="text" name="message" placeholder="Send inquiry..." 
                                   class="border px-2 py-1 rounded text-sm w-1/2">
                            <button class="bg-green-600 text-white px-3 py-1 rounded text-sm">Send</button>
                        </form>
                    </li>
                @empty
                    <li>No marketers found</li>
                @endforelse
            </ul>
        </div>
    @empty
        <p>No results found.</p>
    @endforelse
@endsection
