<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function create(User $user): Response
    {
        return Response::allow();
    }

    public function update(User $user, Comment $comment): Response
    {
        return $user->id === $comment->user_id
            ? Response::allow()
            : Response::deny('Редактировать комментарий может только его автор или модератор.');
    }

    public function delete(User $user, Comment $comment): Response
    {
        return $user->id === $comment->user_id
            ? Response::allow()
            : Response::deny('Удалять комментарий может только его автор или модератор.');
    }
}