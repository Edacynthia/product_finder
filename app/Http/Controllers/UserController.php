<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with(['user', 'category'])->get();

            Log::info('UserController@index: Fetched products for user dashboard', [
                'user_id' => Auth::id(),
                'product_count' => $products->count(),
            ]);

            return view('user.dashboard', compact('products'));
        } catch (\Exception $e) {
            Log::error('UserController@index: Failed to fetch products', [
                'user_id' => Auth::id() ?? 'guest',
                'error' => $e->getMessage(),
            ]);
            return view('user.dashboard', ['products' => collect([])])
                ->with('error', 'Failed to load products. Please try again.');
        }
    }
}
