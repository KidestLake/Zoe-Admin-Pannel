<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Instrumentalist;
use App\Models\SongDetail;
use Illuminate\Http\Request;
use App\Models\Song;
use Exception;
use Illuminate\Support\Facades\Session;

class SongController extends Controller
{

    public function index()
    {

        $data['songs'] = Song::with('artist','album')->get();
        return view('song.songs',$data);
    }


    public function create(Request $request)
    {
        // Validation
        $this->validate($request, [
            "title" => "required",
            "artist_id" => "required",
            "track_number" => "required",
            "audio" => "required|file"
        ]);
        $file_path = '';
        $song=null;
        $msg = '';
        $code = 201;
        try {
            if ($request->hasFile('audio')) {
                if ($request->file('audio')->isValid()) {
                    $file = $request->file('audio');
                    $extenstion = $file->getClientOriginalExtension();
                    $size = $file->getSize();
                    $fileName = $file->getClientOriginalName();
                    $uniqueName = md5($fileName . microtime());
                    // $realPath=$file->getRealPath();
                    $fileMime = $file->getMimeType();
                    //return $fileMime;
                    if (in_array($fileMime, ['audio/mpeg', 'audio/x-m4a'])) {
                        if ($size <= 15360000) {
                            $destinationPath = 'uploads/audios';
                            $file->move($destinationPath, $uniqueName . "." . $extenstion);
                            $file_path = $uniqueName . "." . $extenstion;
                            $song = new Song();
                            $song->title = $request->input('title');
                            $song->released_date = $request->input('released_date');
                            $song->path = $file_path;
                            $song->language = $request->input('language');
                            $song->artist_id = $request->input('artist_id');
                            $song->artist_name = $request->input('artist_name');
                            $song->created_by = $request->input('created_by');
                            $song->album_id = $request->input('album_id');
                            $song->album_name = $request->input('album_name');
                            if ($song->save()) {
                                $msg = "Song Saved Successfully!";
                                $code = 201;

                                $data['song'] = $song;
                                $type = 'success';
                                Session::flash($type, $msg);
                                return view('song.songs',$data);

                            } else {
                                $code = 500;
                                $msg = "An error occured while creating song. Please try again.";

                                $type = 'error';
                                Session::flash($type, $msg);
                                return back();
                            }
                        } else {
                            $code = 500;
                            $msg = 'The file is too large ';

                            $type = 'error';
                            Session::flash($type, $msg);
                            return back();
                        }
                    } else {
                        $code = 500;
                        $msg = "The system support only audio files!";

                        $type = 'error';
                        Session::flash($type, $msg);
                        return back();
                    }
                }
            }
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $code = 500;

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }
    }


    public function show($id)
    {
        return response()->json(Song::with('artist','album','instrumentalists','details')->find($id));

        $data['song'] = Song::with('artist','album','instrumentalists','details')->find($id);
        return view('song.viewSong',$data);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function archive($id)
    {
        $song = Song::find($id);
        $code = 200;
        if ($song !== null) {
            if ($song->delete()) {
                $code = 200;
                $type = 'success';
                $msg = "Song deleted successfully";

                $type = 'success';
                Session::flash($type, $msg);
                return view('song.songs');

            } else {
                $code = 500;
                $type = "error";
                $msg = "Song does not deleted! Please try again";

                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "Song does not exist!";

            Session::flash($type, $msg);
            return back();
        }

    }
    public function addSongDetail(Request $request){
           // Validation
           $this->validate($request, [
            "song_id"=>"required",
            "detail_name" => "required",
            "detail_value"=>"required"
        ]);
        $song_id = $request->input('song_id');
        $song = Song::find($song_id);
        $code = 200;
        if ($song !== null) {
            $song->details()->create([
                "detail_name" => $request->input("detail_name"),
                "detail_value" => $request->input("detail_value")
            ]);
            $msg = "Successfully Saved";

            $data['currentSong'] = Song::with('details')->find($song_id);
            $type = 'success';
            Session::flash($type, $msg);
            return view('song.songs',$data);

        } else {
            $code = 404;
            $msg = "Song does not exist!";

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }
    public function addSongInstrumentalist(Request $request){
          // Validation
        $this->validate($request, [
            "instrument" => "required",
            "song_id"=>"required",
            "players"=>"required"
        ]);
        $song_id = $request->input('song_id');
        $song = Song::find($song_id);
        $code = 200;
        if ($song !== null) {
            $song->instrumentalists()->create([
                "instrument" => $request->input("instrument"),
                "players" => $request->input("players")
            ]);
            $msg = "Successfully Saved";

            $data['currentSong'] = Song::with('details')->find($song_id);
            $type = 'success';
            Session::flash($type, $msg);
            return view('song.songs',$data);

        } else {
            $code = 404;
            $msg = "Song does not exist!";

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }
    public function updateSongDetail($id,Request $request){
         // Validation
         $this->validate($request, [
            "detail_name" => "required",
            "detail_value" => "required"
        ]);
        $songDetail = SongDetail::find($id);
        $code = 200;
        if ($songDetail !== null) {
            $songDetail->detail_name=$request->input('detail_name');
            $songDetail->detail_value=$request->input('detail_value');
            if ($songDetail->save()) {
                $code = 200;
                $msg = "Song Detail updated successfully";

                $data['songDetail'] = $songDetail;
                $type = 'success';
                Session::flash($type, $msg);
                return view('song.songs',$data);

            } else {
                $code = 500;
                $msg = "Song Detail does not updated! Please try again";

                $type = 'error';
                Session::flash($type, $msg);
                return back();
            }
        } else {
            $code = 404;
            $msg = "Song Detail does not exist!";

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }
    public function updateSongInstrumentalist($id,Request $request){
         // Validation
         $this->validate($request, [
            "instrument" => "required",
            "song_id"=>"required",
            "players"=>"required"
        ]);
        $instrumentalist = Instrumentalist::find($id);
        $code = 200;
        if ($instrumentalist !== null) {
            $instrumentalist->song_id=$request->input('song_id');
            $instrumentalist->instrument=$request->input('instrument');
            $instrumentalist->players=$request->input('players');
            if ($instrumentalist->save()) {
                $code = 200;
                $msg = "Song Instrumentalist updated successfully";

                $data['instrumentalist'] = $instrumentalist;
                $type = 'success';
                Session::flash($type, $msg);
                return view('song.songs',$data);

            } else {
                $code = 500;
                $msg = "Song Instrumentalist does not updated! Please try again";

                $type = 'error';
                Session::flash($type, $msg);
                return back();
            }
        } else {
            $code = 404;
            $msg = "Song Instrumentalist does not exist!";

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }
    public function removeSongDetail($id){
        $detail = SongDetail::find($id);
        $code = 200;
        if ($detail !== null) {
            if ($detail->delete()) {
                $code = 200;
                $type = 'success';
                $msg = "Song detail deleted successfully";

                Session::flash($type, $msg);
                return view('song.songs');
            } else {
                $code = 500;
                $type = "error";
                $msg = "Song detail does not deleted! Please try again";

                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "Song detail does not exist!";

            Session::flash($type, $msg);
            return back();
        }

    }
    public function removeSongInstrumentalist($id){
        $instrumentalist = Instrumentalist::find($id);
        $code = 200;
        if ($instrumentalist !== null) {
            if ($instrumentalist->delete()) {
                $code = 200;
                $type = 'success';
                $msg = "Song Instrumentalist deleted successfully";

                Session::flash($type, $msg);
                return view('song.songs');

            } else {
                $code = 500;
                $type = "error";
                $msg = "Song Instrumentalist does not deleted! Please try again";

                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "Song Instrumentalist does not exist!";

            Session::flash($type, $msg);
            return back();
        }

    }
}
