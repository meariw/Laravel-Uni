<?php

namespace App\Http\Middleware;

use App\Models\ArticleView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogArticleView
{
    public function handle(Request $request, Closure $next): Response
    {
        ArticleView::create(['url' => $request->url()]);

        return $next($request);
    }
}