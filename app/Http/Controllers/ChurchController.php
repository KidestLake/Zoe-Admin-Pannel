<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Church;
use App\Models\ChurchAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ChurchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function churches(){

        $data['title'] = 'Churches | Manage Churches';
        $data['activeTab'] = 11;
        return view('admin/church/addChurch',$data);

    }

    public function getChurches($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalChurches'] = $this->countChurches();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['churches'] = Church::with('address')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();


        return view('admin/church/churches', $data)->render();
    }

    public function show($id)
    {
        //return response()->json(Church::with('address')->find($id));
        $data['church'] = Church::with('address')->find($id);
        return view('church.viewChurch',$data);
    }


    public function create(Request $request)
    {
        // Validation
        $this->validate($request, [
            "user_id" => "required",
            "name" => "required",
            "phone" => "required|max:20|unique:churches",
            "city" => "required",
        ]);

        $code = 201;
        // Check the user existance
        try {
            $church = new Church();
            $church->user_id = $request->input('user_id');
            $church->name = $request->input('name');
            $church->website = $request->input('website');
            $church->phone = $request->input('phone');
            $church->email = $request->input('email');
            if ($church->save()) {

                $churchAddress = new ChurchAddress();
                $churchAddress->church_id = $church->id;
                $churchAddress->country = $request->input('country');
                $churchAddress->city = $request->input('city');
                $churchAddress->subcity = $request->input('subcity');
                $churchAddress->woreda = $request->input('woreda');
                $churchAddress->specific_location = $request->input('specific_location');

                if ($churchAddress->save()) {

                    $msg = "Church registered Successfully!";
                    $code = 201;
                    $type = 'success';
                    Session::flash($type, $msg);
                    return back();

                }else{
                    $churchDelete = Church::where('user_id',$church->id)->delete();
                    $code = 500;
                    $msg = "Error occured while creating the church! please try again.";

                    $type = 'error';
                    Session::flash($type, $msg);
                    return back();
                }

            } else {
                $code = 500;
                $msg = "Error occured while creating the church! please try again.";

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


    public function update(Request $request, $id)
    {
        // Validation
        $this->validate($request, [
            "user_id" => "required",
            "name" => "required",
            "phone" => "required|max:20|unique:churches"
        ]);
        $church = null;
        $msg = '';
        $code = 200;
        try {
            $userId = $request->input('user_id');
            //check user existance
            $church = Church::find($id);
            if ($church != null) {
                $church->user_id = $userId;
                $church->name = $request->input('name');
                $church->website = $request->input('website');
                $church->phone = $request->input('phone');
                $church->email = $request->input('email');
                if ($church->save()) {
                    $msg = "Church Updated Successfully!";
                    $code = 200;
                    $data['church'] = $church;

                    $type = 'success';
                    Session::flash($type, $msg);
                    return view('church.churches',$data);
                } else {
                    $code = 500;
                    $msg = "An error occured while updating Church. Please try again.";

                    $type = 'error';
                    Session::flash($type, $msg);
                    return back();
                }
            } else {
                $code = 404;
                $msg = "Church does not exist";

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

    public function destroy($id)
    {
        $church = Church::find($id);
        $code = 200;
        if ($church !== null) {
            if ($church->delete()) {
                $code = 200;
                $type = 'success';
                $msg = "church deleted successfully";

                Session::flash($type, $msg);
                return back();

            } else {
                $code = 500;
                $type = "error";
                $msg = "church does not deleted! Please try again";

                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "church does not exist!";

            Session::flash($type, $msg);
            return back();
        }

    }
    public function addAddress(Request $request)
    {
        $this->validate($request, [
            //"church_id" => "required",
            "city" => "required",
            "country" => "required"
        ]);
        //'country','city','subcity','woreda','specific_location'
        //$churchId=$request->input('church_id');
        $churchId=1; //to be changed after session done (if neccessary)
        $church = Church::find($churchId);
        $code = 200;
        if ($church !== null) {
            $church->address()->create([
                "city" => $request->input("city"),
                "country" => $request->input("country"),
                "subcity" => $request->input("subcity"),
                "woreda" => $request->input("woreda"),
                "specific_location" => $request->input("specific_location")
            ]);
            $msg = "Address Successfully Saved";
            $data['newChurch']= Church::with('address')->find($churchId);

            $type = 'success';
            Session::flash($type, $msg);
            return view('church.churches',$data);

        } else {
            $code = 404;
            $msg = "Church does not exist!";

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }
    }
    public function updateAddress($id, Request $request)
    {
        // Validation
        $this->validate($request, [
            'country' => "required",
            'city' => "required"
        ]);
        $address = ChurchAddress::find($id);
        $code = 200;
        if ($address !== null) {
            $address->country = $request->input('country');
            $address->specific_location = $request->input('specific_location');
            $address->city = $request->input('city');
            $address->subcity = $request->input('subcity');
            $address->woreda = $request->input('woreda');
            if ($address->save()) {
                $code = 200;
                $msg = "Address updated successfully";
                $data['address'] = $address;

                $type = 'success';
                Session::flash($type, $msg);
                return view('church.churches',$data);
            } else {
                $code = 500;
                $msg = "Address does not updated! Please try again";

                $type = 'error';
                Session::flash($type, $msg);
                return back();
            }
        } else {
            $code = 404;
            $msg = "Address does not exist!";

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }

    }
    public function removeAddress($id)
    {

        $address = ChurchAddress::find($id);
        $code = 200;
        if ($address !== null) {
            if ($address->delete()) {
                $code = 200;
                $type = 'success';
                $msg = "Address deleted successfully";

                Session::flash($type, $msg);
                return back();
            } else {
                $code = 500;
                $type = "error";
                $msg = "Address does not deleted! Please try again";

                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "Address does not exist!";

            Session::flash($type, $msg);
            return back();
        }
    }

    public function countChurches()
    {
        $countChurches = Church::count();
        return $countChurches;
    }

    public function searchChurch($searchInput)
    {
        $data['searchInput'] = $searchInput;
        $data['searchedChurches'] = Church::with('address')->where([['is_active','1'],['name', 'LIKE', "{$searchInput}"]])->orWhere([['is_active','1'],['phone', 'LIKE', "{$searchInput}"]])->orderBy('created_at', 'desc')->get();
        return view('admin/church/searchChurch', $data)->render();
    }

}
