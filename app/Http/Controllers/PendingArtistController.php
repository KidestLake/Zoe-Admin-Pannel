<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App\Models\Profile;
use App\Models\User;
use App\Models\BankAccount;
use App\Models\PendingArtist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class PendingArtistController extends Controller
{
    public function addArtist(Request $request)
    {

        $password = $request->input('password');

        $this->validate($request, [

            "first_name" => "required",
            "last_name" => "required",
            "phone" => "required",
            "bank_name" => "required",
            "account_name" => "required",
            "account_number" => "required",
            "password" => "required",
            "id_image" => "required",
            'confirmPassword' => 'required|min:8|max:30|in:' . $password,

        ]);

        $msg = '';
        $code = 201;
        $uniqueIdName = '';
        try {

            $pendingArtist = new PendingArtist();

            $pendingArtist->first_name = $request->input('first_name');
            $pendingArtist->last_name = $request->input('last_name');
            $pendingArtist->email = $request->input('email');
            $pendingArtist->phone = $request->input('phone');
            $pendingArtist->password = Crypt::encrypt($password);
            $pendingArtist->location = $request->input('location');
            $pendingArtist->bank_name = $request->input('bank_name');
            $pendingArtist->account_number = $request->input('account_number');
            $pendingArtist->artist_name = $request->input('account_name');

            if ($request->hasFile('id_image')) {
                if ($request->file('id_image')->isValid()) {
                    $idImg = $request->file('id_image');
                    $extenstion = $idImg->getClientOriginalExtension();
                    $size = $idImg->getSize();
                    $fileName = $idImg->getClientOriginalName();
                    $uniqueIdName = md5($fileName . microtime());
                    // $realPath=$file->getRealPath();
                    $fileMime = $idImg->getMimeType();
                    if (in_array($fileMime, ['image/jpeg', 'image/jpg', 'image/png'])) {
                        if ($size <= 2084000) {
                            $destinationPath = 'uploads/ids';
                            $idImg->move($destinationPath, $uniqueIdName . "." . $extenstion);
                            $file_path = $uniqueIdName . "." . $extenstion;
                            $pendingArtist->id_image = $file_path;
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

            if ($request->hasFile('profile_image')) {
                if ($request->file('profile_image')->isValid()) {
                    $profileImg = $request->file('profile_image');
                    $extenstion = $profileImg->getClientOriginalExtension();
                    $size = $profileImg->getSize();
                    $fileName = $profileImg->getClientOriginalName();
                    $uniqueName = md5($fileName . microtime());
                    // $realPath=$file->getRealPath();
                    $fileMime = $profileImg->getMimeType();
                    if (in_array($fileMime, ['image/jpeg', 'image/jpg', 'image/png'])) {
                        if ($size <= 2084000) {
                            $destinationPath = 'uploads/profiles';
                            $profileImg->move($destinationPath, $uniqueName . "." . $extenstion);
                            $file_path = $uniqueName . "." . $extenstion;
                            $pendingArtist->profile_image = $file_path;
                        } else {

                            if ($uniqueIdName != '') {
                                $imageLocation = '/uploads/ids/' . $uniqueIdName;

                                if (file_exists(public_path() . $imageLocation)) {
                                    unlink(public_path() . $imageLocation);
                                }
                            }

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



            if ($pendingArtist->save()) {
                $msg = "Artist registered successfully";
                $code = 201;
                $type = 'successRegistering';
                Session::flash($type, $msg);
                return redirect('User/activeArtists');
            } else {
                $code = 500;
                $msg = "An error occured while registering artist. Please try again.";

                $type = 'error';
                Session::flash($type, $msg);
                return back();
            }
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $code = 500;

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }
    }

    public function allPendingArtists()
    {
        $data['title'] = "Artists | Pending Artists ";
        $data['totalPendingArtists'] = $this->totalPendingArtists();
        $data['pendingArtists'] = PendingArtist::orderBy('created_at', 'desc')->get();
        return view('admin/user/pendingArtists', $data);
    }

    public function pendingArtists($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalPendingArtists'] = $this->totalPendingArtists();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Artists | Pending Artists ";
        $data['pendingArtists'] = PendingArtist::offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();

        return view('admin/user/pendingArtists', $data);
    }

     public static function totalPendingArtists()
    {
        $totalPendingArtists = PendingArtist::count();
        return $totalPendingArtists;
    }

    public function approveArtist($id)
    {

        $pendingArtist = PendingArtist::find($id);
        if ($pendingArtist != null) {

            try {

                $user = new User();
                $user->email = $pendingArtist->email;
                $user->phone = $pendingArtist->phone;
                $user->password = $pendingArtist->password;
                $user->role = 'artist';
                $user->created_by = 1; // to be changed with session done

                $profile = new Profile();
                $profile->first_name = $pendingArtist->first_name;
                $profile->last_name = $pendingArtist->last_name;
                $profile->location = $pendingArtist->location;
                $profile->profile_image = $pendingArtist->profile_image;

                $bank = new BankAccount();
                $bank->bank_name = $pendingArtist->bank_name;
                $bank->account_number = $pendingArtist->account_number;
                $bank->artist_name = $pendingArtist->artist_name;

                if ($user->save()) {
                    $profile->user_id = $user->id;
                    if ($profile->save()) {
                        $bank->user_id = $user->id;
                        if ($bank->save()) {
                            $msg = "Artist approved Successfully! ";
                            $code = 201;
                            $type = 'success';
                            Session::flash($type, $msg);
                            //return redirect('User/activeArtists/0');

                            $pendingArtistIdImg = $pendingArtist->id_image;
                            $pendingArtistProfileImg = $pendingArtist->profile_image;

                            $delete = $pendingArtist->delete();
                            $idImageLocation = '/uploads/ids/'.$pendingArtistIdImg;
                            $profileImageLocation = '/uploads/profiles/'.$pendingArtistProfileImg;

                            if(file_exists(public_path().$idImageLocation)) {
                                unlink(public_path().$idImageLocation);
                            }

                            if(file_exists(public_path().$profileImageLocation)) {
                                unlink(public_path().$profileImageLocation);
                            }

                            $code = 200;
                            $type = 'success';
                            $msg = "Artist deleted successfully";

                            $type = 'success';
                            Session::flash($type, $msg);
                            //return redirect('index');
                            return true;

                        } else {

                            $profileDelete = User::where('user_id', $user->id)->delete();
                            $userDelete = User::where('user_id', $user->id)->delete();

                            $code = 500;
                            $msg = "An error occured while approving artist. Please try again.";
                            $type = 'error';
                            Session::flash($type, $msg);
                            return false;
                        }
                    } else {

                        $userDelete = User::where('user_id', $user->id)->delete();
                        $code = 500;
                        $msg = "An error occured while approving artist. Please try again.";
                        $type = 'error';
                        Session::flash($type, $msg);
                        return false;
                    }
                }else {
                    $code = 500;
                    $msg = "An error occured while approving artist. Please try again.";

                    $type = 'error';
                    Session::flash($type, $msg);
                    return false;
                }
            } catch (Exception $ex) {

                $msg = $ex->getMessage();
                $code = 500;

                $type = 'error';
                Session::flash($type, $msg);
                return false;
            }
        } else {
            $code = 404;
            $msg = "Artist does not exist";
            $type = 'error';
            Session::flash($type, $msg);
            return false;
        }
    }


    public function disApproveArtist($id)
    {
        $pendingArtist = PendingArtist::find($id);

        $code = 200;
        if ($pendingArtist !== null) {
            $pendingArtistIdImg = $pendingArtist->id_image;
            $pendingArtistProfileImg = $pendingArtist->profile_image;

            if ($pendingArtist->delete()) {
                $idImageLocation = '/uploads/ids/'.$pendingArtistIdImg;
                $profileImageLocation = '/uploads/profiles/'.$pendingArtistProfileImg;

                if(file_exists(public_path().$idImageLocation)) {
                    unlink(public_path().$idImageLocation);
                }

                if(file_exists(public_path().$profileImageLocation)) {
                    unlink(public_path().$profileImageLocation);
                }

                $code = 200;
                $type = 'success';
                $msg = "Artist deleted successfully";

                $type = 'success';
                Session::flash($type, $msg);
                //return redirect('index');
                return true;
            } else {
                $code = 500;
                $type = "error";
                $msg = "Artist does not deleted! Please try again";

                $type = 'error';
                Session::flash($type, $msg);
                //return back();
                return false;
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "Artist does not exist!";

            $type = 'error';
            Session::flash($type, $msg);
            //return back();
            return false;
        }
    }
}
