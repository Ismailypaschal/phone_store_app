@extends('layouts.app')

@section('content')
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-6">
    <h1 class="text-lg font-semibold mb-4">Register</h1>
    <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Username</label>
            <input type="name" name="name" class="mt-1 w-full border rounded px-3 py-2" required autofocus>
            @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border rounded px-3 py-2" required autofocus>
            @error('email')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" class="mt-1 w-full border rounded px-3 py-2" required>
        </div>
         <div>
            <label class="block text-sm font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation" class="mt-1 w-full border rounded px-3 py-2" required>
        </div>
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember" class="border rounded"> Remember me
        </label>
        <div class="flex gap-2 items-center">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Register</button>
            <a href="{{ route('login') }}" class="text-sm text-blue-700">Already have an account? Sign in!</a>
        </div>
    </form>
</div>
@endsection