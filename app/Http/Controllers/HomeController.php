<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->latest()
            ->paginate(12);
        $categories = Category::all();
        return view('home', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::with(['category', 'user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        $related = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
        $categories = Category::all();
        return view('article', compact('article', 'related', 'categories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = Article::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(9);
        $categories = Category::all();
        return view('category', compact('category', 'articles', 'categories'));
    }
}