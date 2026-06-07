<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'user'])->latest();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $articles = $query->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'excerpt' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'status' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'excerpt' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'status' => 'required',
        ]);

        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }
}