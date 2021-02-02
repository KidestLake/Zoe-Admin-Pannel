<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumArtist;
use Exception;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        return response()->json(Album::with('albumArtists')->get());
    }
    public function show($id)
    {
        return response()->json(Album::with('albumArtists', 'songs')->find($id));
    }
}
