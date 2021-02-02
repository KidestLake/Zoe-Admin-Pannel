<?php
namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Models\News;
use Exception;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct(){}
    public function index()
    {
        return response()->json(News::all());
    }
    public function show($id)
    {
        return response()->json(News::find($id));
    }
    public function showNews($slug)
    {
        $news = News::where('slug', $slug)->get();
        return response()->json($news);
    }
}
