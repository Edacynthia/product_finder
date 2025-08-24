<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MarketerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,marketer',
            'type' => 'required_if:role,marketer|in:individual,company',
            'location' => 'required_if:role,marketer|string|max:255',
            'description' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        try {
            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Assign role
            $user->assignRole($validated['role']);

            // Create marketer profile if role is marketer
            if ($validated['role'] === 'marketer') {
                MarketerProfile::create([
                    'user_id' => $user->id,
                    'type' => $validated['type'],
                    'location' => $validated['location'],
                    'description' => $validated['description'] ?? null,
                    'contact_phone' => $validated['contact_phone'] ?? null,
                    'contact_email' => $validated['contact_email'] ?? null,
                    'website' => $validated['website'] ?? null,
                ]);
            }

            // Log registration
            Log::info('RegisterController@register: User registered', [
                'email' => $validated['email'],
                'role' => $validated['role'],
            ]);

            // Log in user
            Auth::login($user);

            // Redirect based on role
            return redirect()->route($validated['role'] === 'marketer' ? 'marketer.dashboard' : 'user.dashboard')
                ->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            Log::error('RegisterController@register: Registration failed', [
                'email' => $validated['email'] ?? 'unknown',
                'error' => $e->getMessage(),
            ]);
            return back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}