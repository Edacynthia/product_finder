@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">Inquiries</h1>

    @if($inquiries->isEmpty())
        <p class="mt-4 text-gray-600">No inquiries yet.</p>
    @else
        <div class="mt-4 space-y-4">
            @foreach($inquiries as $inquiry)
                <div class="border p-4 rounded shadow">
                    <p><strong>From:</strong> {{ $inquiry->user->name }}</p>
                    <p><strong>Message:</strong> {{ $inquiry->message }}</p>
                    <p class="text-sm text-gray-500">Sent on {{ $inquiry->created_at->format('d M Y') }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection
