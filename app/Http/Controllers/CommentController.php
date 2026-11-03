<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    // POST /articles/{article}/comments
    public function store(Request $request, Article $article)
    {
        Gate::authorize('create', Comment::class);

        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'text'   => 'required|string',
        ]);

        $validated['user_id'] = $request->user()->id;

        $article->comments()->create($validated);

        return redirect()->route('articles.show', $article->id)->with('success', 'Комментарий отправлен и ожидает модерации');
    }

    // GET /comments/moderation
    public function moderation()
    {
        Gate::authorize('moderate', Comment::class);

        $pending = Comment::with('article')
            ->whereNull('is_approved')
            ->latest()
            ->get();

        $rejected = Comment::with('article')
            ->where('is_approved', false)
            ->latest()
            ->get();

        return view('comments.moderation', [
            'pending'  => $pending,
            'rejected' => $rejected,
        ]);
    }

    // PATCH /comments/{comment}/approve
    public function approve(Comment $comment)
    {
        Gate::authorize('moderate', Comment::class);

        if ($comment->is_approved !== null) {
            return redirect()->route('comments.moderation');
        }

        $comment->is_approved = true;
        $comment->save();

        Cache::forget('article_' . $comment->article_id);

        return redirect()->route('comments.moderation')->with('success', 'Комментарий принят');
    }

    // PATCH /comments/{comment}/reject
    public function reject(Comment $comment)
    {
        Gate::authorize('moderate', Comment::class);

        if ($comment->is_approved !== null) {
            return redirect()->route('comments.moderation');
        }

        $comment->is_approved = false;
        $comment->save();

        return redirect()->route('comments.moderation')->with('success', 'Комментарий отклонён');
    }

    // GET /comments/{comment}/edit
    public function edit(Comment $comment)
    {
        Gate::authorize('update', $comment);

        return view('comments.edit', ['comment' => $comment]);
    }

    // PUT /comments/{comment}
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update', $comment);

        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'text'   => 'required|string',
        ]);

        $comment->update($validated);

        Cache::forget('article_' . $comment->article_id);

        return redirect()->route('articles.show', $comment->article_id)->with('success', 'Комментарий обновлён');
    }

    // DELETE /comments/{comment}
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $articleId = $comment->article_id;
        $comment->delete();

        Cache::forget('article_' . $articleId);

        return redirect()->route('articles.show', $articleId)->with('success', 'Комментарий удалён');
    }
}