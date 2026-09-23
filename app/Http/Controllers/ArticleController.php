<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    // список новостей из БД
    public function index()
    {
        $articles = Article::all();

        return view('articles.index', ['articles' => $articles]);
    }
}