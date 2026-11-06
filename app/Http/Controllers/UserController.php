<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Setting;
use Illuminate\Http\Request;

class UserController extends Controller 
{
    public function home(Request $request) 
    {
        if ($request->user() && $request->user()->usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        $featuredProperties = Property::with('category')->where('is_featured', true)->take(6)->get();
        $categories = Category::all();
        $setting = Setting::first();
        return view('home', compact('featuredProperties', 'categories', 'setting'));
    }

    public function properties(Request $request) 
    {
        $query = Property::with('category');
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('location', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        $properties = $query->latest()->paginate(9);
        $categories = Category::all();
        return view('properties', compact('properties', 'categories'));
    }

    // Single unified propertyDetail method (Category, Images, Reviews & Related Properties shob load korbe)
    public function propertyDetail($id) 
    {
        $property = Property::with(['category', 'images', 'reviews'])->findOrFail($id);
        
        $relatedProperties = Property::where('category_id', $property->category_id)
                                    ->where('id', '!=', $property->id)
                                    ->take(3)->get();
                                    
        return view('property-detail', compact('property', 'relatedProperties'));
    }

    public function storeInquiry(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
            'property_id' => 'nullable|exists:properties,id'
        ]);

        Inquiry::create([
            'property_id' => $request->property_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 'New'
        ]);

        return redirect()->back()->with('status', 'Your inquiry has been submitted successfully! Our luxury consultant will contact you shortly.');
    }

    public function about() 
    { 
        return view('about'); 
    }
    
    public function contact() 
    { 
        $setting = Setting::first();
        return view('contact', compact('setting')); 
    }

    public function services() 
    { 
        $setting = Setting::first();
        return view('services', compact('setting')); 
    }
}