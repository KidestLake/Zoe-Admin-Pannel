<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Gift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GiftController extends Controller
{

    public function index()
    {

        $data['gifts'] = Gift::with('user')->get();
        return view('gift.gifts',$data);
    }

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

                $data['gift'] = $gift;
                $type = 'success';
                Session::flash($type, $msg);
                return view('gift.gifts',$data);
                //Send text msg or notification or email
            } else {
                $code = 500;
                $msg = "Error occured while giving the gift! please try again.";

                $type = 'error';
                Session::flash($type, $msg);
                return back();
            }
        } catch (Exception $ex) {
            $code = 500;
            $msg = $ex->getMessage();

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }

    public function show($id)
    {
        //return response()->json(Gift::with('user')->find($id));

        $data['gift'] = Gift::with('user')->find($id);
        return view('gift.viewGift',$data);
    }


    public function getMyGifts($phoneNumber)
    {
        $data['myGifts'] = Gift::where('reciever_phone', $phoneNumber)->get();

        return view('gift.myGifts',$data);
    }
    public function getMyGiftHistory($userId)
    {
        $data['gifts'] = Gift::where('user_id', $userId)->get();
        return view('gift.giftHistory',$data);
    }
    public function getSongGiftHistory($songId)
    {
        $data['songGift'] = Gift::where('song_id', $songId)->get();
        return view('gift.songGiftHistory',$data);
    }
}
