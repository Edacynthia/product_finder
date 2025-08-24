@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Profile</h1>

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

    <div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
        <form method="POST" action="{{ route('marketer.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                    <option value="individual" {{ $profile->type === 'individual' ? 'selected' : '' }}>Individual</option>
                    <option value="company" {{ $profile->type === 'company' ? 'selected' : '' }}>Company</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endif
            </div>

            <div class="mb-6">
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', $profile->location) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" required>
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endif
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('description', $profile->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endif
            </div>

            <div class="mb-6">
                <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $profile->contact_phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                @error('contact_phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endif
            </div>

            <div class="mb-6">
                <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $profile->contact_email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                @error('contact_email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endif
            </div>

            <div class="mb-6">
                <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                <input type="url" name="website" id="website" value="{{ old('website', $profile->website) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                @error('website')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endif
            </div>

            <div>
                <label for="whatsapp_link" class="block text-sm font-medium text-gray-700">WhatsApp Link</label>
                <input type="url" name="whatsapp_link" id="whatsapp_link" value="{{ old('whatsapp_link', $profile->whatsapp_link) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                @error('whatsapp_link')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endif
            </div>

            <div>
                <label for="telegram_handle" class="block text-sm font-medium text-gray-700">Telegram Handle</label>
                <input type="text" name="telegram_handle" id="telegram_handle" value="{{ old('telegram_handle', $profile->telegram_handle) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                @error('telegram_handle')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endif
            </div>

            <div>
                <label for="instagram_handle" class="block text-sm font-medium text-gray-700">Instagram Handle</label>
                <input type="text" name="instagram_handle" id="instagram_handle" value="{{ old('instagram_handle', $profile->instagram_handle) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                @error('instagram_handle')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endif
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                <div class="flex items-center space-x-4">
                    <div>
                        <label for="image" class="inline-block bg-gradient-to-r from-purple-600 to-purple-700 text-white py-2 px-4 rounded-lg font-medium hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 cursor-pointer">
                            Choose File
                        </label>
                        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg" class="hidden" onchange="previewImage(event)">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @endif
                    </div>
                    <img id="image-preview" src="{{ $profile->image_path ? Storage::url($profile->image_path) : asset('images/placeholder.jpg') }}" alt="{{ Auth::user()->name }}" class="w-32 h-32 object-cover rounded-md">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-purple-700 text-white px-4 py-2 rounded-md hover:from-purple-700 hover:to-purple-800 w-full">Update Profile</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('marketer.profile.show', $profile) }}" class="text-purple-600 hover:underline">View Profile</a>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = "{{ $profile->image_path ? Storage::url($profile->image_path) : asset('images/placeholder.jpg') }}";
        }
    }
</script>
@endsection