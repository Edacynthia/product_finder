<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MarketerProfile;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MarketerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->marketerProfile ?: $user->marketerProfile()->create([
            'type' => 'individual',
            'location' => 'Not set',
            'description' => 'Please update your profile',
        ]);
        $products = Product::where('user_id', Auth::id())->with('category', 'user')->latest()->paginate(10);

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
            'whatsapp_link' => 'nullable|string|max:255',
            'telegram_handle' => 'nullable|string|max:255',
            'instagram_handle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile = Auth::user()->marketerProfile;
        if ($request->hasFile('image')) {
            if ($profile->image_path) {
                Storage::disk('public')->delete($profile->image_path);
            }
            $data['image_path'] = $request->file('image')->store('profiles', 'public');
        }

        $profile->update($data);

        return redirect()->route('marketer.profile.show', $profile)->with('success', 'Profile updated');
    }

    public function editProfile(MarketerProfile $profile)
    {
        if (Auth::id() !== $profile->user_id) {
            abort(403, 'Unauthorized access');
        }
        return view('marketer.profile.edit', compact('profile'));
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
        $products = Product::where('user_id', Auth::id())->with('user', 'category')->latest()->paginate(10);
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

        $data['user_id'] = Auth::id();

        Product::create($data);

        return back()->with('success', 'Product added successfully');
    }

    public function editProduct(Product $product)
    {
        if (Auth::id() !== $product->user_id) {
            abort(403, 'Unauthorized access');
        }
        $categories = Category::all();
        return view('marketer.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        if (Auth::id() !== $product->user_id) {
            abort(403, 'Unauthorized access');
        }
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

        return redirect()->route('marketer.products.all')->with('success', 'Product updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        if (Auth::id() !== $product->user_id) {
            abort(403, 'Unauthorized access');
        }
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();

        return back()->with('success', 'Product deleted successfully');
    }

    public function inquiries()
    {
        $profile = Auth::user()->marketerProfile;

        if (!$profile) {
            return redirect()->route('marketer.dashboard')
                ->with('error', 'Please complete your profile first.');
        }

        $inquiries = $profile->inquiries()->latest()->get();

        return view('marketer.inquiries', compact('inquiries'));
    }

    public function showProfile(string $userid)
    {
//        $relatedUser = User::with(['products', 'marketerProfile'])->find($userid);
//        dd($relatedUser->hasRole('marketer'), );

        try {
            $relatedUser = User::with(['products', 'marketerProfile'])->find($userid);

//            if ($relatedUser->hasRole('marketer') && !auth()->user()->hasRole('marketer')) {
//                dd('taosdih');
//                Log::warning('MarketerController@showProfile: Profile does not belong to a marketer', [
//                    'profile_id' => $relatedUser->marketerProfile->id,
//                    'user_id' => $relatedUser->id,
//                ]);
//                return redirect()->route('home')->with('error', 'Invalid marketer profile.');
//            }

//            Log::info('MarketerController@showProfile: Fetched marketer profile', [
//                'profile_id' => $relatedUser->marketerProfile->id,
//                'user_id' => $relatedUser->id,
//                'auth_user_id' => Auth::id(),
//            ]);

//            dd('aif');

            return view('marketer.profile.show_marketer', compact('relatedUser'));
        } catch (\Exception $e) {
            Log::error('MarketerController@showProfile: Failed to fetch profile', [
                'profile_id' => $relatedUser->marketerProfile->id,
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('home')->with('error', 'Failed to load marketer profile.');
        }
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $category_id = $request->input('category_id');

        $products = Product::with('user', 'category')
            ->when($query, function ($queryBuilder, $query) {
                return $queryBuilder->where('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->when($category_id, function ($queryBuilder, $category_id) {
                return $queryBuilder->where('category_id', $category_id);
            })
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('marketer.products.search', compact('products', 'categories', 'query', 'category_id'));
    }
}
