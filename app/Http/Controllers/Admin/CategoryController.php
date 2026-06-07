<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories',
            'logo' => 'nullable|image|max:1024',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'logo' => 'nullable|image|max:1024',
        ]);

        $logoPath = $category->logo;
        if ($request->hasFile('logo')) {
            if ($category->logo) {
                Storage::disk('public')->delete($category->logo);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(Category $category)
    {
        if ($category->logo) {
            Storage::disk('public')->delete($category->logo);
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }
}