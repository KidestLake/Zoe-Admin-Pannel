<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Profile;
use App\Models\User;
use App\Models\BankAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Array_;

class UserController extends Controller
{

    public function index()
    {
        //
    }



    public function allActiveArtists(){
        $data['title'] = "Artists | Active Artists ";
        $data['activeArtists'] = User::where([['is_active','1'],['role','artist']])->with('profile')->get();
        //return $data['activeArtists'];

        return view('admin/user/activeArtists',$data);
    }

    public function activeArtists($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalActiveArtists'] = $this->totalActiveArtists();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Artists | Active Artists ";
        $data['activeArtists'] = User::where([['is_active','1'],['role','artist']])->with('profile')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return $data['activeArtists'];

        return view('admin/user/activeArtists',$data);
    }


    public function AllDeactivatedArtists(){
        $data['title'] = "Artists | Deactivated Artists ";
        $data['deactivatedArtists'] = User::where([['is_active','0'],['role','artist']])->with('profile')->get();
        //return $data['activeArtists'];

        return view('admin/user/deactivatedArtists',$data);
    }

    public function deactivatedArtists($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalDeactivatedArtists'] = $this->totalDeactivatedArtists();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Artists | Deactivated Artists ";
        $data['deactivatedArtists'] = User::where([['is_active','0'],['role','artist']])->with('profile')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return $data['activeArtists'];

        return view('admin/user/deactivatedArtists',$data);

    }

    public function allActiveClients(){
        $data['title'] = "Clients | Active Clients ";
        $data['activeClients'] = User::where([['is_active','1'],['role','client']])->get();

        return view('admin/user/activeClients',$data);
    }


    public function activeClients($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalActiveClients'] = $this->totalActiveClients();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Clients | Active Clients ";
        $data['activeClients'] = User::where([['is_active','1'],['role','client']])->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();

        return view('admin/user/activeClients',$data);

    }

    public function allDeactivatedClients(){
        $data['title'] = "Clients | Deactivated Clients ";
        $data['deactivatedClients'] = User::where([['is_active','0'],['role','client']])->get();

        return view('admin/user/deactivatedClients',$data);
    }

    public function deactivatedClients($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalDeactivatedClients'] = $this->totalDeactivatedClients();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Clients | Deactivated Clients ";
        $data['deactivatedClients'] = User::where([['is_active','0'],['role','client']])->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();

        return view('admin/user/deactivatedClients',$data);

    }

    public function allActiveAdmins(){
        $data['title'] = "Administrators | Active Admin ";
        $data['activeAdmins'] = User::where([['is_active','1'],['role','admin']])->with('profile')->get();
        //return $data['activeArtists'];

        return view('admin/user/activeAdmins',$data);
    }


    public function activeAdmins($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalActiveAdmins'] = $this->totalActiveAdmins();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Administrators | Active Admin ";
        $data['activeAdmins'] = User::where([['is_active','1'],['role','admin']])->with('profile')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return $data['activeArtists'];

        return view('admin/user/activeAdmins',$data);

    }

    public function allDeactivatedAdmins(){
        $data['title'] = "Administrators | Deactivated Admin ";
        $data['deactivatedAdmins'] = User::where([['is_active','0'],['role','admin']])->with('profile')->get();
        //return $data['activeArtists'];

        return view('admin/user/deactivatedAdmins',$data);
    }

    public function deactivatedAdmins($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalDeactivatedAdmins'] = $this->totalDeactivatedAdmins();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Administrators | Deactivated Admin ";
        $data['deactivatedAdmins'] = User::where([['is_active','0'],['role','admin']])->with('profile')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return $data['activeArtists'];

        return view('admin/user/deactivatedAdmins',$data);


    }

    public function activateUser($id){
        $userData=[
            'is_active' => '1'
        ];

        $changeStatus = User::where('id', $id)->update($userData);
        if($changeStatus){
            return true;
        }else{
            return false;
        }
    }

    public function deactivateUser($id){
        $userData=[
            'is_active' => '0'
        ];

        $changeStatus = User::where('id', $id)->update($userData);
        if($changeStatus){
            return true;
        }else{
            return false;
        }
    }

    public function destroy($id)
    {

        $user = User::find($id);
        $code = 200;
        if ($user !== null) {
            if ($user->delete()) {
                $profile = Profile::where('user_id',$id)->delete();
                $code = 200;
                $type = 'success';
                $msg = "User deleted successfully";

                return true;
                //Session::flash($type, $msg);
                //return view('advertisement/advertisements');

            } else {
                $code = 500;
                $type = "error";
                $msg = "User does not deleted! Please try again";
                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "User does not exist!";
            Session::flash($type, $msg);
            return back();
        }
    }

    public function registerArtist(){

        $data['title'] = 'Artist | Register Artist';
        return view('admin/user/registerArtist',$data);

    }


    public function addArtist(Request $request){

        $this->validate($request, [
            "first_name" => "required",
            "last_name" => "required",
            "phone" => "required",
            "bank_name" => "required",
            "account_name" => "required",
            "account_number" => "required"
        ]);

        $msg = '';
        $code = 201;
        $password = $this->getPassword();
        //$password = '1223';

        try {

                $user = new User();
                $user->name = $request->input('first_name').' '.$request->input('last_name');
                $user->email = $request->input('email');
                $user->phone = $request->input('phone');
                $user->password = Crypt::encrypt($password);
                $user->role = 'artist';
                $user->created_by = 1; // to be changed with session done

                $profile = new Profile();
                $profile->first_name = $request->input('first_name');
                $profile->last_name = $request->input('last_name');
                $profile->location = $request->input('location');

                $bank = new BankAccount();
                $bank->bank_name = $request->input('bank_name');
                $bank->account_number = $request->input('account_number');
                $bank->artist_name = $request->input('account_name');

                if ($user->save()) {
                    $profile->user_id = $user->id;
                    if($profile->save()){
                        $bank->user_id = $user->id;
                        if($bank->save()){
                            $msg = "Artist registered Successfully!Password for the artist is ".$password;
                            $code = 201;
                            $type = 'successRegistering';
                            Session::flash($type, $msg);
                            return redirect('User/activeArtists/0');
                        }else{

                            $profileDelete = User::where('user_id',$user->id)->delete();
                            $userDelete = User::where('user_id',$user->id)->delete();

                            $code = 500;
                            $msg = "An error occured while registering artist. Please try again.";
                            $type = 'error';
                            Session::flash($type, $msg);
                            return back();
                        }

                    }else{

                        $userDelete = User::where('user_id',$user->id)->delete();
                        $code = 500;
                        $msg = "An error occured while registering artist. Please try again.";
                        $type = 'error';
                        Session::flash($type, $msg);
                        return back();

                    }


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


    private function getPassword() {
        $length=10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%&()';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function registerChurchAdmin(){

        $data['title'] = 'Church Admins | Register Church Admins ';
        return view('admin/user/registerChurchAdmin',$data);

    }


    public function addChurchAdmin(Request $request){

        $this->validate($request, [
            "first_name" => "required",
            "last_name" => "required",
            "phone" => "required"
        ]);

        $msg = '';
        $code = 201;
        $password = $this->getPassword();
        //$password = '1223';

        try {

                $user = new User();
                $user->email = $request->input('email');
                $user->phone = $request->input('phone');
                $user->password = Crypt::encrypt($password);
                $user->role = 'church_admin';
                $user->created_by = 1; // to be changed with session done

                $profile = new Profile();
                $profile->first_name = $request->input('first_name');
                $profile->last_name = $request->input('last_name');
                $profile->location = $request->input('location');


                if ($user->save()) {
                    $profile->user_id = $user->id;
                    if($profile->save()){

                            $msg = "Church Admin registered Successfully!Password for the admin is ".$password;
                            $code = 201;
                            $type = 'successRegistering';
                            Session::flash($type, $msg);
                            return redirect('User/activeChurchAdministrators');

                    }else{

                        $userDelete = User::where('user_id',$user->id)->delete();
                        $code = 500;
                        $msg = "An error occured while registering artist. Please try again.";
                        $type = 'error';
                        Session::flash($type, $msg);
                        return back();

                    }


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


    public function allActiveChurchAdministrators(){
        $data['title'] = "Church Administrators | Active church Administrators ";
        $data['activeChurchAdmins'] = User::where([['is_active','1'],['role','church_admin']])->with('profile')->get();
        //return $data['activeArtists'];

        return view('admin/user/activeChurchAdmins',$data);
    }


    public function activeChurchAdministrators($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalActiveChurchAdministrators'] = $this->totalActiveChurchAdministrators();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Church Administrators | Active church Administrators ";
        $data['activeChurchAdmins'] = User::where([['is_active','1'],['role','church_admin']])->with('profile')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return $data['activeArtists'];

        return view('admin/user/activeChurchAdmins',$data);


    }

    public function allDeactivatedChurchAdministrators(){
        $data['title'] = "Church Administrators | Deactivated church Administrators ";
        $data['deactivatedChurchAdmins'] = User::where([['is_active','0'],['role','church_admin']])->with('profile')->get();
        //return $data['activeArtists'];

        return view('admin/user/deactivatedChurchAdmins',$data);
    }

    public function deactivatedChurchAdministrators($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalDeactivatedChurchAdministrators'] = $this->totalDeactivatedChurchAdministrators();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Church Administrators | Deactivated church Administrators ";
        $data['deactivatedChurchAdmins'] = User::where([['is_active','0'],['role','church_admin']])->with('profile')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return $data['activeArtists'];

        return view('admin/user/deactivatedChurchAdmins',$data);

    }

   public function totalActiveArtists()
    {
        $totalActiveArtists = User::where([['is_active','1'],['role','artist']])->count();
        return $totalActiveArtists;
    }

    public function totalDeactivatedArtists()
    {
        $totalDeactivatedArtists = User::where([['is_active','0'],['role','artist']])->count();
        return $totalDeactivatedArtists;
    }

    public function totalActiveClients()
    {
        $totalActiveClients = User::where([['is_active','1'],['role','client']])->count();
        return $totalActiveClients;
    }

    public function totalDeactivatedClients()
    {
        $totalDeactivatedClients = User::where([['is_active','0'],['role','client']])->count();
        return $totalDeactivatedClients;
    }

    public function totalActiveAdmins()
    {
        $totalActiveAdmins = User::where([['is_active','1'],['role','admin']])->count();
        return $totalActiveAdmins;
    }

    public function totalDeactivatedAdmins()
    {
        $totalDeactivatedAdmins = User::where([['is_active','0'],['role','admin']])->count();
        return $totalDeactivatedAdmins;
    }

    public function totalActiveChurchAdministrators()
    {
        $totalActiveChurchAdministrators = User::where([['is_active','1'],['role','church_admin']])->count();
        return $totalActiveChurchAdministrators;
    }

    public function totalDeactivatedChurchAdministrators()
    {
        $totalDeactivatedChurchAdministrators = User::where([['is_active','0'],['role','church_admin']])->count();
        return $totalDeactivatedChurchAdministrators;
    }

}
