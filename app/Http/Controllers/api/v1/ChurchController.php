<?php
namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Models\Church;
use App\Models\ChurchAddress;
use Exception;
use Illuminate\Http\Request;

class ChurchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Church::with('address')->get());
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Church::with('address')->find($id));
    }
}
