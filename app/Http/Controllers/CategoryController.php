<?php
namespace App\Http\Controllers;
use App\Models\{Category, Setting};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller {
    public function index() {
        $categories = Category::latest()->get();
        return view('admin.categories', compact('categories'));
    }
    public function store(Request $request) {
        $request->validate(['name' => 'required|string|unique:categories,name']);
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->back()->with('status', 'Category created successfully!');
    }
    public function destroy($id) {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'Category deleted successfully!');
    }
}