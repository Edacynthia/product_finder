<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        try {
            if (Auth::user()->hasRole('marketer')) {
                return redirect()->route('marketer.dashboard');
            } elseif (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            $products = Product::with(['user', 'user.marketerProfile', 'category'])->get();

            Log::info('HomeController@index: Loaded products for user dashboard', [
                'user_id' => Auth::id(),
                'product_count' => $products->count(),
            ]);

            return view('user.dashboard', compact('products'));
        } catch (\Exception $e) {
            Log::error('HomeController@index: Failed to load dashboard', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            return view('user.dashboard', ['products' => []])->with('error', 'Failed to load products.');
        }
    }
}