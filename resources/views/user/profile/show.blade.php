@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Profile: {{ Auth::user()->name }}</h1>
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
                    @if ($profile->image_path)
                        <img src="{{ Storage::url($profile->image_path) }}" alt="{{ Auth::user()->name }}"
                            class="w-32 h-32 rounded-full object-cover">
                    @else
                        <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder"
                            class="w-32 h-32 rounded-full object-cover">
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
                        <p class="text-sm text-gray-600">Website: <a href="{{ $profile->website }}"
                                class="text-blue-600 hover:underline" target="_blank">{{ $profile->website }}</a></p>
                    @endif
                    @if ($profile->whatsapp_link)
                        <p class="text-sm text-gray-600">WhatsApp: <a href="{{ $profile->whatsapp_link }}"
                                class="text-green-600 hover:underline" target="_blank">{{ $profile->whatsapp_link }}</a>
                        </p>
                    @endif
                    @if ($profile->telegram_handle)
                        <p class="text-sm text-gray-600">Telegram: <a
                                href="https://t.me/{{ ltrim($profile->telegram_handle, '@') }}"
                                class="text-blue-600 hover:underline" target="_blank">{{ $profile->telegram_handle }}</a>
                        </p>
                    @endif
                    @if ($profile->instagram_handle)
                        <p class="text-sm text-gray-600">Instagram: <a
                                href="https://instagram.com/{{ ltrim($profile->instagram_handle, '@') }}"
                                class="text-pink-600 hover:underline" target="_blank">{{ $profile->instagram_handle }}</a>
                        </p>
                    @endif
                    <a href="{{ route('marketer.profile.edit', $profile) }}"
                        class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Edit
                        Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
