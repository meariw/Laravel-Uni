<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    // GET /articles — список с пагинацией
    public function index()
    {
        $articles = Article::latest()->paginate(6);

        return view('articles.index', ['articles' => $articles]);
    }

    // GET /articles/create — форма создания
    public function create()
    {
        Gate::authorize('create', Article::class);

        return view('articles.create');
    }

    // POST /articles — сохранение
    public function store(Request $request)
    {
        Gate::authorize('create', Article::class);

        $validated = $request->validate([
            'datePublic' => ['required', 'date_format:Y-m-d', 'regex:/^\d{4}-\d{2}-\d{2}$/', 'after:1900-01-01', 'before:2100-01-01'],
            'title'      => 'required|string|max:255',
            'shortDesc'  => 'required|string|max:255',
            'desc'       => 'nullable|string',
        ]);

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Статья создана');
    }

    // GET /articles/{article} — просмотр одной
    public function show(Article $article)
    {
        $article->load('comments');

        return view('articles.show', ['article' => $article]);
    }

    // GET /articles/{article}/edit — форма редактирования
    public function edit(Article $article)
    {
        Gate::authorize('update', $article);

        return view('articles.edit', ['article' => $article]);
    }

    // PUT /articles/{article} — обновление
    public function update(Request $request, Article $article)
    {
        Gate::authorize('update', $article);

        $validated = $request->validate([
            'datePublic' => ['required', 'date_format:Y-m-d', 'regex:/^\d{4}-\d{2}-\d{2}$/', 'after:1900-01-01', 'before:2100-01-01'],
            'title'      => 'required|string|max:255',
            'shortDesc'  => 'required|string|max:255',
            'desc'       => 'nullable|string',
        ]);

        $article->update($validated);

        return redirect()->route('articles.show', $article->id)->with('success', 'Статья обновлена');
    }

    // DELETE /articles/{article} — удаление
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Статья удалена');
    }
}