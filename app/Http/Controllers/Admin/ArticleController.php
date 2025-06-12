<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // ... (index, create, destroy methods remain the same)

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug', // slug harus unik
            'content' => 'required|string', // 'body' diganti 'content', 'summary' dihapus
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('articles', 'public');
        }

        $validated['slug'] = Str::slug($request->title);
        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string', // 'body' diganti 'content', 'summary' dihapus
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($article->photo) {
                Storage::disk('public')->delete($article->photo);
            }
            $validated['photo'] = $request->file('photo')->store('articles', 'public');
        }

        $validated['slug'] = Str::slug($request->title);
        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }
    
    // index(), create(), destroy() methods here...
    public function index()
    {
        $articles = Article::latest()->get();
        return view('admin.articles.index', compact('articles'));
    }
    public function create()
    {
        return view('admin.articles.create');
    }
    public function destroy(Article $article)
    {
        if ($article->photo) { Storage::disk('public')->delete($article->photo); }
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
