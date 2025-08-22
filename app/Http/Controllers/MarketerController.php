<?php

namespace App\Http\Controllers;

use App\Models\MarketerProfile;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MarketerController extends Controller
{
    use AuthorizesRequests;

    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->marketerProfile ?: $user->marketerProfile()->create([
            'type' => 'individual',
            'location' => 'Not set',
            'description' => 'Please update your profile',
        ]);
        $products = Product::with(['category', 'user'])->latest()->paginate(10);

        return view('marketer.dashboard', compact('profile', 'products'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:individual,company',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'website' => 'nullable|url',
        ]);

        Auth::user()->marketerProfile()->updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return back()->with('success', 'Profile updated');
    }

    public function manageProducts()
    {
        $products = Auth::user()->products()->with('category')->get();
        $profile = Auth::user()->marketerProfile;
        $categories = Category::all();

        return view('marketer.products.manage', compact('products', 'profile', 'categories'));
    }

    public function allProducts()
    {
        $products = Product::with('user', 'category')->latest()->paginate(10);
        return view('marketer.products.all', compact('products'));
    }

    public function attachProduct(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'whatsapp_link' => 'nullable|string|max:255',
            'instagram_handle' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        Auth::user()->products()->create($data);

        return back()->with('success', 'Product added successfully');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'whatsapp_link' => 'nullable|string|max:255',
            'instagram_handle' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return back()->with('success', 'Product updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        $this->authorize('delete', $product);
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();

        return back()->with('success', 'Product deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category_id = $request->input('category_id');

        $products = Product::with('user', 'category')
            ->when($query, function ($q) use ($query) {
                return $q->where('name', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%");
            })
            ->when($category_id, function ($q) use ($category_id) {
                return $q->where('category_id', $category_id);
            })
            ->latest()
            ->paginate(10);

        $categories = Category::all();

        return view('marketer.products.search', compact('products', 'categories', 'query', 'category_id'));
    }

    public function inquiries()
    {
        $profile = Auth::user()->marketerProfile;

        if (!$profile) {
            return redirect()->route('marketer.dashboard')
                ->with('error', 'Please complete your marketer profile first.');
        }

        $inquiries = $profile->inquiries()->latest()->get();

        return view('marketer.inquiries', compact('inquiries'));
    }
}