<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'star_rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $product->reviews()->create([
            'user_id' => auth()->id(),
            'star_rating' => $request->input('star_rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }

}
