<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function viewList()
    {
        $articles = Article::paginate(6);

        return view('pages.artikel', compact('articles'));
    }

    public function viewArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $suggestedArticles = Article::where('slug', '!=', $slug)->inRandomOrder()->limit(2)->get();

        return view('pages.detail-artikel', compact('article', 'suggestedArticles'));
    }
}
