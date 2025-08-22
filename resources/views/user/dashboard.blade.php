@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold">User Dashboard</h1>
    <p class="mt-4">Welcome, {{ auth()->user()->name }}!</p>
</div>
@endsection
