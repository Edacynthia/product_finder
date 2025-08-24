@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Profile: {{ $relatedUser->name }}</h1>
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

        <!-- Profile Details -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center space-x-6">
                <div>
                    @if ($relatedUser->marketerProfile->image_path)
                        <img src="{{ Storage::url($relatedUser->marketerProfile->image_path) }}" alt="{{ $relatedUser->name }}"
                             class="w-32 h-32 rounded-full object-cover">
                    @else
                        <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder"
                             class="w-32 h-32 rounded-full object-cover">
                    @endif
                </div>
                <div>
                    <p class="text-lg font-medium text-gray-700">Name: {{ $relatedUser->name }}</p>
                    <p class="text-sm text-gray-600">Email: {{ $relatedUser->email }}</p>
                    <p class="text-sm text-gray-600">Type: {{ $relatedUser->marketerProfile->type }}</p>
                    <p class="text-sm text-gray-600">Location: {{ $relatedUser->marketerProfile->location }}</p>
                    <p class="text-sm text-gray-600">Description: {{ $relatedUser->marketerProfile->description ?? 'Not set' }}</p>
                    <p class="text-sm text-gray-600">Phone: {{ $relatedUser->marketerProfile->contact_phone ?? 'Not set' }}</p>
                    <p class="text-sm text-gray-600">Contact Email: {{ $relatedUser->marketerProfile->contact_email ?? 'Not set' }}</p>
                    @if ($relatedUser->marketerProfile->website)
                        <p class="text-sm text-gray-600">Website: <a href="{{ $relatedUser->marketerProfile->website }}"
                                                                     class="text-blue-600 hover:underline" target="_blank">{{ $relatedUser->marketerProfile->website }}</a></p>
                    @endif
                    @if ($relatedUser->marketerProfile->whatsapp_link)
                        <p class="text-sm text-gray-600">WhatsApp: <a href="{{ $relatedUser->marketerProfile->whatsapp_link }}"
                                                                      class="text-green-600 hover:underline" target="_blank">{{ $relatedUser->marketerProfile->whatsapp_link }}</a>
                        </p>
                    @endif
                    @if ($relatedUser->marketerProfile->telegram_handle)
                        <p class="text-sm text-gray-600">Telegram: <a
                                href="https://t.me/{{ ltrim($relatedUser->marketerProfile->telegram_handle, '@') }}"
                                class="text-blue-600 hover:underline" target="_blank">{{ $relatedUser->marketerProfile->telegram_handle }}</a>
                        </p>
                    @endif
                    @if ($relatedUser->marketerProfile->instagram_handle)
                        <p class="text-sm text-gray-600">Instagram: <a
                                href="https://instagram.com/{{ ltrim($relatedUser->marketerProfile->instagram_handle, '@') }}"
                                class="text-pink-600 hover:underline" target="_blank">{{ $relatedUser->marketerProfile->instagram_handle }}</a>
                        </p>
                    @endif
{{--                    <a href="{{ route('marketer.profile.edit', $relatedUser->marketerProfile->id) }}"--}}
{{--                       class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Edit--}}
{{--                        Profile</a>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
