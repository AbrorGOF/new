<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getNews(): \Illuminate\Http\JsonResponse
    {
      $news = News::where('status', 'active')->get();
      return response()->json($news);
    }
}
