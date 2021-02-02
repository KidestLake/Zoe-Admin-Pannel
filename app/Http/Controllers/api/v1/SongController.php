<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Models\Instrumentalist;
use App\Models\SongDetail;
use Illuminate\Http\Request;
use App\Models\Song;
use Exception;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Song::with('artist','album')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Song::with('artist','album','instrumentalists','details')->find($id));
    }
}
