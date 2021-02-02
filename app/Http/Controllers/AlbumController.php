<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumArtist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlbumController extends Controller
{
    public function __construct()
    {
    }
    public function getAlbums()
    {

        $data['albums'] = Album::with('albumArtists')->get();
        return view('album.albums',$data);
    }
    public function getAlbum($id)
    {
        return response()->json(Album::with('albumArtists', 'songs')->find($id));
        $data['album'] = Album::with('albumArtists', 'songs')->find($id);
        return view('album.viewAlbum',$data);
    }
    public function create(Request $request)
    {
        // Validation
        $this->validate($request, [
            "title" => "required",
            "total_songs" => "required",
            "publisher" => "required"
        ]);
        $file_path = '';
        $msg = '';
        $code = 201;
        try {
            if ($request->hasFile('cover_image')) {
                if ($request->file('cover_image')->isValid()) {
                    $file = $request->file('cover_image');
                    $extenstion = $file->getClientOriginalExtension();
                    $size = $file->getSize();
                    $fileName = $file->getClientOriginalName();
                    $uniqueName = md5($fileName . microtime());
                    // $realPath=$file->getRealPath();
                    $fileMime = $file->getMimeType();
                    if (in_array($fileMime, ['image/jpeg', 'image/jpg', 'image/png'])) {
                        if ($size <= 2084000) {
                            $destinationPath = 'uploads/albums';
                            $file->move($destinationPath, $uniqueName . "." . $extenstion);
                            $file_path = $uniqueName . "." . $extenstion;
                        } else {
                            $msg = 'to large file size ';
                            $type = 'error';
                            Session::flash($type, $msg);
                            return back();
                        }
                    } else {
                        $msg = "The system support only image files!";
                        $type = 'error';
                        Session::flash($type, $msg);
                        return back();
                    }
                }
            }
        } catch (Exception $ex) {
            $msg = "Cover image does not uploaded!";
            $code = 200;
            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }
        $album = new Album();
        $album->title = $request->input('title');
        $album->total_songs = $request->input('total_songs');
        $album->cover_image = $file_path;
        $album->publisher = $request->input('publisher');
        $album->published_date = $request->input('published_date');
        $album->released_date = $request->input('released_date');
        if ($album->save()) {
            $msg = "Album Saved Successfully!";
            $code = 201;
            $type = 'success';
            Session::flash($type, $msg);
           return redirect('index');
        } else {
            $code = 500;
            $msg = "An error occured while creating album. Please try again.";
            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }
    public function update($id, Request $request)
    {
        // Validation
        $this->validate($request, [
            "title" => "required",
            "total_songs" => "required",
            "publisher" => "required"
        ]);
        $file_path = '';
        $msg = '';
        $code = 200;
        try {
            if ($request->hasFile('cover_image')) {
                if ($request->file('cover_image')->isValid()) {
                    $file = $request->file('cover_image');
                    $extenstion = $file->getClientOriginalExtension();
                    $size = $file->getSize();
                    $fileName = $file->getClientOriginalName();
                    $uniqueName = md5($fileName . microtime());
                    // $realPath=$file->getRealPath();
                    $fileMime = $file->getMimeType();
                    if (in_array($fileMime, ['image/jpeg', 'image/jpg', 'image/png'])) {
                        if ($size <= 2084000) {
                            $destinationPath = 'album';
                            $file->move($destinationPath, $uniqueName . "." . $extenstion);
                            $file_path = $uniqueName . "." . $extenstion;
                        } else {
                            $msg = 'to large file size ';
                            $type = 'error';
                            Session::flash($type, $msg);
                            return back();
                        }
                    } else {
                        $msg = "The system support only image files!";
                        $type = 'error';
                        Session::flash($type, $msg);
                        return back();
                    }
                }
            }
        } catch (Exception $ex) {
            $msg = "Cover image does not uploaded!";
            $code = 200;
            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }
        $album = Album::find($id);
        if ($album != null) {
            $album->title = $request->input('title');
            $album->total_songs = $request->input('total_songs');
            $album->publisher = $request->input('publisher');
            $album->published_date = $request->input('published_date');
            $album->released_date = $request->input('released_date');
            if ($request->hasFile('cover_image')) {
                if ($request->file('cover_image')->isValid() && !empty($file_path)) {
                    $album->cover_image = $file_path;
                }
            }
            if ($album->save()) {
                $msg = "Album Updated Successfully!";
                $code = 200;
                $type = 'success';
                Session::flash($type, $msg);
                return redirect('index');
            } else {
                $code = 500;
                $msg = "An error occured while updating album. Please try again.";
                $type = 'error';
                Session::flash($type, $msg);
                return back();
            }
        } else {
            $code = 404;
            $msg = "Album does not exist";
            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }
    public function delete($id)
    {
        $album = Album::find($id);
        $code = 200;
        if ($album !== null) {
            $album->albumArtists()->forceDelete();
            if ($album->delete()) {
                $code = 200;
                $type = 'success';
                $msg = "Album deleted successfully";
                Session::flash($type, $msg);
                return view('album.albums');
            } else {
                $code = 500;
                $type = "error";
                $msg = "Album does not deleted! Please try again";
                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "Album does not exist!";
            Session::flash($type, $msg);
            return back();
        }

    }
    public function addAlbumArtists(Request $request)
    {
        $this->validate($request, [
            "album_id" => "required",
            "artist_name" => "required",
            "album_name" => "required"
        ]);
        $album_id = $request->input('album_id');
        $album = Album::find($album_id);
        $code = 200;
        if ($album !== null) {
            $album->albumArtists()->create([
                "album_name" => $request->input("album_name"),
                "artist_id" => $request->input("artist_id"),
                "artist_name" => $request->input("artist_name")
            ]);

            $data['newAlbum'] = Album::with('albumArtists')->find($album_id);
            $msg = "Successfully Saved";

            $type = 'success';
            Session::flash($type, $msg);
            return view('album.albums',$data);

        } else {
            $code = 404;
            $msg = "Album does not exist!";
            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }
    public function updateAlbumArtists($id, Request $request)
    {
        // Validation
        $this->validate($request, [
            "artist_name" => "required"
        ]);
        $albumArtist = AlbumArtist::find($id);
        $code = 200;
        if ($albumArtist !== null) {
            $albumArtist->artist_id=$request->input('artist_id');
            $albumArtist->artist_name=$request->input('artist_name');
            if ($albumArtist->save()) {
                $data['albumArtist'] = $albumArtist;
                $code = 200;
                $msg = "Album Artist updated successfully";
                $type = 'success';
                Session::flash($type, $msg);
                return view('album.albums',$data);

            } else {
                $code = 500;
                $msg = "Album Artist does not updated! Please try again";
                $type = 'error';
                Session::flash($type, $msg);
                return back();
            }
        } else {
            $code = 404;
            $msg = "Album Artist does not exist!";
            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }
    public function removeAlbumArtists($id)
    {

        $albumArtist = AlbumArtist::find($id);
        $code = 200;
        if ($albumArtist !== null) {
            if ($albumArtist->delete()) {
                $code = 200;
                $type = 'success';
                $msg = "Album Artist deleted successfully";

                Session::flash($type, $msg);
                return view('album.albums');

            } else {
                $code = 500;
                $type = "error";
                $msg = "Album Artist does not deleted! Please try again";
                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "Album Artist does not exist!";
            Session::flash($type, $msg);
            return back();
        }
    }
}
