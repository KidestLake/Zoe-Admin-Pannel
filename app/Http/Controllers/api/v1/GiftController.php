<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Models\Gift;
use Exception;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Gift::with('user')->get());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //'user_id','sender_name','reciever_phone','song_id'
         // Validation
         $this->validate($request, [
            "user_id" => "required",
            "reciever_phone" => "required",
            "song_id" => "required"
        ]);
        $userId = $request->input('user_id');
        $songId = $request->input('song_id');
        $code = 201;
        // Check the user and song existance
        try {
            $gift = new Gift();
            $gift->user_id = $userId;
            $gift->sender_name = $request->input('sender_name');
            $gift->reciever_phone = $request->input('reciever_phone');
            $gift->song_id = $songId;
            if ($gift->save()) {
                $code = 201;
                $msg = "Gift send successfully!";
                //Send text msg or notification or email
            } else {
                $code = 500;
                $msg = "Error occured while giving the gift! please try again.";
            }
        } catch (Exception $ex) {
            $code = 500;
            $msg = $ex->getMessage();
        }
        $output = [
            "status" => $code,
            "msg" => $msg,
            "gift" => $gift
        ];
        return response()->json($output, $code);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Gift::with('user')->find($id));
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMyGifts($phoneNumber)
    {
        $myGift = Gift::where('reciever_phone', $phoneNumber)->get();
        return response()->json($myGift);
    }
    public function getMyGiftHistory($userId)
    {
        $gifts = Gift::where('user_id', $userId)->get();
        return response()->json($gifts);
    }
    public function getSongGiftHistory($songId)
    {
        $songGift = Gift::where('song_id', $songId)->get();
        return response()->json($songGift);
    }
}
