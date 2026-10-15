<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // POST /articles/{article}/comments
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'text'   => 'required|string',
        ]);

        $article->comments()->create($validated);

        return redirect()->route('articles.show', $article->id)->with('success', 'Комментарий добавлен');
    }

    // GET /comments/{comment}/edit
    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
    }

    // PUT /comments/{comment}
    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'text'   => 'required|string',
        ]);

        $comment->update($validated);

        return redirect()->route('articles.show', $comment->article_id)->with('success', 'Комментарий обновлён');
    }

    // DELETE /comments/{comment}
    public function destroy(Comment $comment)
    {
        $articleId = $comment->article_id;
        $comment->delete();

        return redirect()->route('articles.show', $articleId)->with('success', 'Комментарий удалён');
    }
}