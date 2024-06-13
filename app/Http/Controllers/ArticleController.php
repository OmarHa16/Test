<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\authors;
use App\Models\sources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ArticleController extends Controller
{
    public function index(Request $request)
{
    $apiURL = 'https://newsapi.org/v2/everything?q=tesla&from=2024-05-13&sortBy=publishedAt&apiKey=26bf1a5671214f9aa8c87c71fd465472';
    
    $response = Http::get($apiURL);
    $data = $response->json();
   
    foreach ($data['articles'] as $item) {
        $source = sources::where('name', $item['source']['name'])->first();
        $author = authors::where('name', $item['author'])->first();
    
        if (!$source && $item['source']['name'] != null) {
            $source = sources::create(['name' => $item['source']['name']]);
            $source_id = $source->source_id;
        }
        else
        {
            $source_id = null;

        }
    
        if (!$author && $item['author'] != null) {
            $author = authors::create(['name' => $item['author']]);
            $author_id = $author->author_id;

        }
        else
        {
            $author_id = null;
        }
    
        if(Article::where('title',$item['title'])->first()->title != $item['title'])
        {
            Article::create([
                'title'=>$item['title'],
                'source_id'=> $source_id,
                'author_id'=> $author_id,
                'Descreption'=>$item['description'],
                'url'=>$item['url'],
                'urlOfImage'=>$item['urlToImage'],
                'content'=>$item['content'],
                'published_at'=>$item['publishedAt']
            ]);
        }
        
        
        
    }
    
    return response(Article::all(),200);
}
public function search(Request $request)
{
    if($request['source'])
    {
        $source_id = Sources::where('name', $request['source'])->first()->source_id;
    }
    if($request['author'])
    {
        $author_id = Authors::where('name', $request['author'])->first()->author_id;
    }
    
    
    if($request['filter_by'] == 'date')
    {
        return Article::search($request->search)
        ->filter('date', '>=', strtotime($request['start_date']))
        ->filter('date', '<=', strtotime($request['end_date']))->get();
    }
    elseif($request['filter_by'] == 'source'){
        return Article::search($request->search)
        ->filter('source_id', '=', $source_id)->get();
    }
    elseif($request['filter_by'] == 'author'){
        return Article::search($request->search)
        ->filter('author_id', '=', $author_id)->get();
    }

    return Article::search($request->search)->get();
    
}


}
