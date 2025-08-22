@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Update Profile</h2>

    <form action="{{ route('marketer.profile.update') }}" method="POST" class="space-y-3">
        @csrf
        <select name="type" class="border px-2 py-1 rounded">
            <option value="individual">Individual</option>
            <option value="company">Company</option>
        </select>
        <input type="text" name="location" placeholder="Location" class="border px-2 py-1 rounded w-full">
        <textarea name="description" placeholder="Description" class="border px-2 py-1 rounded w-full"></textarea>
        <input type="text" name="contact_phone" placeholder="Phone" class="border px-2 py-1 rounded w-full">
        <input type="email" name="contact_email" placeholder="Email" class="border px-2 py-1 rounded w-full">
        <input type="url" name="website" placeholder="Website" class="border px-2 py-1 rounded w-full">
        <button class="bg-blue-600 text-white px-3 py-1 rounded">Save</button>
    </form>
@endsection
