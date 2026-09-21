<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    // читаем и декодируем json с новостями
    protected function getArticles(): array
    {
        $path = public_path('data/articles.json');
        $json = file_get_contents($path);

        return json_decode($json, true) ?? [];
    }

    // главная страница — список новостей
    public function index()
    {
        $articles = $this->getArticles();

        return view('welcome', ['articles' => $articles]);
    }

    // страница отдельной новости — full_image
    public function galery($id)
    {
        $articles = $this->getArticles();

        if (!isset($articles[$id])) {
            abort(404);
        }

        $article = $articles[$id];

        return view('galery', [
            'article' => $article,
            'id'      => $id,
        ]);
    }
}