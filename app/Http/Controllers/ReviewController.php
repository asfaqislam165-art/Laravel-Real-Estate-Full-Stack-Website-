<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReviewController extends Controller 
{
    // Admin View: List all reviews
    public function index() 
    {
        $reviews = Review::with('property')->latest()->get();
        return view('admin.reviews', compact('reviews'));
    }

    // Public Submit Review
    public function store(Request $request) 
    {
        $request->validate([
            'client_role'  => 'nullable|string|max:255',
            'rating'       => 'required|integer|min:1|max:5',
            'comment'      => 'required|string',
            'property_id'  => 'nullable|exists:properties,id',
            'client_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $review = new Review();
        
        // Logged-in user-er nam automatic client_name hisabe set hobe
        if (auth()->check()) {
            $review->client_name = auth()->user()->name;
        } else {
            $review->client_name = $request->client_name ?? 'Guest';
        }

        $review->property_id  = $request->property_id;
        $review->rating       = $request->rating;
        $review->comment      = $request->comment;
        $review->client_role  = $request->client_role ?? 'Valued Client';
        
        // Direct auto-publish (Admin approval lagbe na)
        $review->is_published = 1; 

        if ($request->hasFile('client_image')) {
            $imageName = time() . '_client.' . $request->file('client_image')->getClientOriginalExtension();
            $request->file('client_image')->move(public_path('uploads'), $imageName);
            $review->client_image = $imageName;
        }

        $review->save();

        return redirect()->back()->with('status', 'Thank you! Your review has been submitted successfully.');
    }

    // Admin Toggle Publish Status
    public function toggleStatus($id) 
    {
        $review = Review::findOrFail($id);
        $review->is_published = !$review->is_published;
        $review->save();

        return redirect()->back()->with('status', 'Review publication status updated.');
    }

    // Admin Delete Review
    public function destroy($id) 
    {
        $review = Review::findOrFail($id);
        if ($review->client_image && File::exists(public_path('uploads/' . $review->client_image))) {
            File::delete(public_path('uploads/' . $review->client_image));
        }
        $review->delete();

        return redirect()->back()->with('status', 'Review deleted successfully.');
    }
}