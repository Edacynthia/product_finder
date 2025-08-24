<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $category_id = $request->input('category_id');

        $products = Product::with(['user.marketerProfile', 'category'])
            ->when($query, function ($queryBuilder, $query) {
                return $queryBuilder->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->when($category_id, function ($queryBuilder, $category_id) {
                return $queryBuilder->where('category_id', $category_id);
            })
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('search.results', compact('products', 'query', 'category_id', 'categories'));
    }
}