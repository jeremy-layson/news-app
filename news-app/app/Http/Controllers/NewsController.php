<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News\NewsFetcherFactory;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $apis = ['guardian'];

        $articles = collect([]);

        foreach ($apis as $key => $api) {
            $newsFetcher = NewsFetcherFactory::get($api);
            $results = $newsFetcher->search($search);
            $articles = $articles->merge($results);
        }

        return response($articles);
    }
}
