<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show()
    {
        $articles = Article::paginate(6);

        return view('pages.artikel', compact('articles'));
    }

    public function articleDetail($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $suggestedArticles = Article::where('slug', '!=', $slug)->inRandomOrder()->limit(2)->get();

        return view('pages.detail-artikel', compact('article', 'suggestedArticles'));
    }
}
