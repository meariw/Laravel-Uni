<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Jobs\VeryLongJob;
use App\Events\NewArticleEvent;
use App\Models\User;
use App\Notifications\NewArticleNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    // GET /articles — список с пагинацией
    public function index()
    {
        $page = request('page', 1);

        $articles = Cache::remember('articles_page_' . $page, 600, function () {
            return Article::latest()->paginate(6);
        });

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

        $article = Article::create($validated);

        // сброс кеша главной страницы и всех страниц пагинации
        $pages = (int) ceil(Article::count() / 6) + 1;
        for ($i = 1; $i <= $pages; $i++) {
            Cache::forget('articles_page_' . $i);
        }

        VeryLongJob::dispatch($article);
        NewArticleEvent::dispatch($article);

        $readers = User::whereHas('role', fn ($q) => $q->where('name', 'reader'))
            ->where('id', '!=', $request->user()->id)
            ->get();

        Notification::send($readers, new NewArticleNotification($article));

        return redirect()->route('articles.index')->with('success', 'Статья создана');
    }

    // GET /articles/{article} — просмотр одной
    public function show(Request $request, Article $article)
    {
        // отметка уведомления вне кеша, иначе она не будет выполняться
        if ($request->user() && $request->query('notification')) {
            $request->user()
                ->unreadNotifications()
                ->where('id', $request->query('notification'))
                ->first()
                ?->markAsRead();
        }

        $article = Cache::rememberForever('article_' . $article->id, function () use ($article) {
            return $article->load(['comments' => fn ($q) => $q->where('is_approved', true)]);
        });

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

        Cache::flush();

        return redirect()->route('articles.show', $article->id)->with('success', 'Статья обновлена');
    }

    // DELETE /articles/{article} — удаление
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);

        $article->delete();

        Cache::flush();

        return redirect()->route('articles.index')->with('success', 'Статья удалена');
    }
}