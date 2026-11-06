<?php
namespace App\Http\Controllers;
use App\Models\{Property, PropertyImage, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PropertyController extends Controller {
    public function index() {
        $properties = Property::with('category')->latest()->get();
        return view('admin.properties', compact('properties'));
    }
    public function create() {
        $categories = Category::all();
        return view('admin.add-property', compact('categories'));
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048'
        ]);

        $property = new Property($request->except(['featured_image', 'images', 'is_featured']));
        $property->is_featured = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('featured_image')) {
            $imageName = time() . '_feat.' . $request->file('featured_image')->getClientOriginalExtension();
            $request->file('featured_image')->move(public_path('uploads'), $imageName);
            $property->featured_image = $imageName;
        }
        $property->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $imgName = time() . "_{$index}." . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $imgName);
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $imgName
                ]);
            }
        }

        return redirect()->route('admin.properties.index')->with('status', 'Luxury property added successfully!');
    }

    public function edit($id) {
        $property = Property::with('images')->findOrFail($id);
        $categories = Category::all();
        return view('admin.update-property', compact('property', 'categories'));
    }

    public function update(Request $request, $id) {
        $property = Property::findOrFail($id);
        $property->fill($request->except(['featured_image', 'images', 'is_featured']));
        $property->is_featured = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('featured_image')) {
            if ($property->featured_image && File::exists(public_path('uploads/'.$property->featured_image))) {
                File::delete(public_path('uploads/'.$property->featured_image));
            }
            $imageName = time() . '_feat.' . $request->file('featured_image')->getClientOriginalExtension();
            $request->file('featured_image')->move(public_path('uploads'), $imageName);
            $property->featured_image = $imageName;
        }
        $property->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $imgName = time() . "_{$index}." . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $imgName);
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $imgName
                ]);
            }
        }

        return redirect()->route('admin.properties.index')->with('status', 'Property updated successfully!');
    }

    public function destroy($id) {
        $property = Property::with('images')->findOrFail($id);
        if ($property->featured_image && File::exists(public_path('uploads/'.$property->featured_image))) {
            File::delete(public_path('uploads/'.$property->featured_image));
        }
        foreach ($property->images as $img) {
            if (File::exists(public_path('uploads/'.$img->image_path))) {
                File::delete(public_path('uploads/'.$img->image_path));
            }
            $img->delete();
        }
        $property->delete();
        return redirect()->route('admin.properties.index')->with('status', 'Property deleted successfully!');
    }

    public function destroyImage($id) {
        $img = PropertyImage::findOrFail($id);
        if (File::exists(public_path('uploads/'.$img->image_path))) {
            File::delete(public_path('uploads/'.$img->image_path));
        }
        $img->delete();
        return redirect()->back()->with('status', 'Image removed successfully.');
    }
}