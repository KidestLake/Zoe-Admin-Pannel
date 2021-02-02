<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class AdvertisementController extends Controller
{

    public function index()
    {

        $data['advertisements'] = Advertisement::all();
        return view('advertisement.advertisements', $data);
    }

    public function allActiveAdvertisements()
    {

        $data['title'] = "Advertisement | Active Advertisements ";
        $data['activeAdvertisements'] = Advertisement::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('admin/advertisement/activeAdvertisements', $data);
    }

    public function activeAdvertisements($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalAd'] = $this->countActiveAdvertisements();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Advertisement | Active Advertisements ";
        $data['activeAdvertisements'] = Advertisement::where('is_active', true)->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/advertisement/activeAdvertisements', $data);
    }

    public function allDeactivatedAdvertisements()
    {

        $data['title'] = "Advertisement | Deactivated Advertisements ";
        $data['deactivatedAdvertisements'] = Advertisement::where('is_active', false)->orderBy('created_at', 'desc')->get();
        return view('admin/advertisement/deactivatedAdvertisements', $data);
    }

    public function deactivatedAdvertisements($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalAd'] = $this->countDeactivatedAdvertisements();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = "Advertisement | Deactivated Advertisements ";
        $data['deactivatedAdvertisements'] = Advertisement::where('is_active', false)->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/advertisement/deactivatedAdvertisements', $data);
    }


    public function addAdvertisement()
    {
        //check if admin here................

        $data['title'] = 'Advertisement | Add Advertisement';
        return view('admin/advertisement/addAdvertisement', $data);
    }

    public function create(Request $request)
    {
        //'banner_image','owner_name','phone','url','start_date','end_date'
        // Validation
        $this->validate($request, [
            "banner_image_one" => "required",
            "banner_image_two" => "required",
            "phone" => "required",
            "owner_name" => "required",
            "start_date" => "required",
            "end_date" => "required"
        ]);
        $file_path = '';
        $msg = '';
        $code = 201;
        $advertisement = new Advertisement();
        try {
            if ($request->hasFile('banner_image_one') && $request->hasFile('banner_image_two')) {
                if ($request->file('banner_image_one')->isValid() && $request->file('banner_image_two')->isValid()) {

                    $fileOne = $request->file('banner_image_one');
                    $fileTwo = $request->file('banner_image_two');

                    $extenstion = $fileOne->getClientOriginalExtension();
                    $size = $fileOne->getSize();
                    $fileName = $fileOne->getClientOriginalName();
                    $uniqueName = md5($fileName . microtime());
                    // $realPath=$file->getRealPath();
                    $fileMime = $fileOne->getMimeType();
                    if (in_array($fileMime, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])) {
                        if ($size <= 2084000) {
                            $destinationPath = 'uploads/ads';
                            $fileOne->move($destinationPath, $uniqueName . "." . $extenstion);
                            $file_name = $uniqueName . "." . $extenstion;
                            $file_path = $file_name;
                            //$file_path = $file_path . ',' . $file_name;

                        } else {
                            $code = 500;
                            $msg = 'The file is too large ';

                            $type = 'error';
                            Session::flash($type, $msg);
                            $request->flash();
                            return back()->withInput();
                        }
                    }


                    $extenstionTwo = $fileTwo->getClientOriginalExtension();
                    $sizeTwo = $fileTwo->getSize();
                    $fileNameTwo = $fileTwo->getClientOriginalName();
                    $uniqueNameTwo = md5($fileNameTwo . microtime());
                    // $realPath=$file->getRealPath();
                    $fileMime = $fileTwo->getMimeType();
                    if (in_array($fileMime, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])) {
                        if ($sizeTwo <= 2084000) {
                            $destinationPath = 'uploads/ads';
                            $fileTwo->move($destinationPath, $uniqueNameTwo . "." . $extenstionTwo);
                            $file_name = $uniqueNameTwo . "." . $extenstionTwo;
                            //$file_path = $file_name;
                            $file_path = $file_path . ',' . $file_name;
                        } else {
                            $code = 500;
                            $msg = 'The file is too large ';

                            $type = 'error';
                            Session::flash($type, $msg);
                            $request->flash();
                            return back()->withInput();
                        }
                    }


                    $advertisement->owner_name = $request->input('owner_name');
                    $advertisement->start_date = $request->input('start_date');
                    $advertisement->banner_image = $file_path;
                    $advertisement->end_date = $request->input('end_date');
                    $advertisement->phone = $request->input('phone');
                    $advertisement->url = $request->input('url');
                    if ($advertisement->save()) {
                        $msg = "Advertisement Saved Successfully!";
                        $code = 201;
                        $data['advertisement'] = $advertisement;
                        $type = 'success';
                        Session::flash($type, $msg);
                        return redirect('Advertisement/activeAdvertisements/0');
                    } else {
                        $code = 500;
                        $msg = "An error occured while creating advertisement. Please try again.";

                        $type = 'error';
                        Session::flash($type, $msg);
                        $request->flash();
                        return back()->withInput();
                    }
                } else {
                    $code = 500;
                    $msg = 'The file is too large ';

                    $type = 'error';
                    Session::flash($type, $msg);
                    $request->flash();
                    return back()->withInput();
                }
            } else {
                $code = 500;
                $msg = "The system support only image files!";

                $type = 'error';
                Session::flash($type, $msg);
                $request->flash();
                return redirect('form')->withInput();
            }
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $code = 500;

            $oldOwnerName = $request->old('owner_name');

            $type = 'error';
            Session::flash($type, $msg);
            $request->flash();
            return back()->withInput();
        }
    }


    public function show($id)
    {
        //return response()->json(Advertisement::find($id));
        $data['advertisement'] = Advertisement::find($id);
        return view('advertisement.viewAdvertisement', $data);
    }

    public function updateAdvertisement($id)
    {
        $data['title'] = 'Advertisement | Update Advertisement';
        $data['advertisement'] = Advertisement::find($id);
        return view('admin/advertisement/updateAdvertisement', $data);
    }

    public function activateAdvertisement($id)
    {
        $data['title'] = 'Advertisement | Activate Advertisement';
        $data['advertisement'] = Advertisement::find($id);
        return view('admin/advertisement/activateAdvertisement', $data);
    }

    public function update(Request $request, $id, $activation = null)
    {
        $activationStatus = $activation;
        // Validation
        $this->validate($request, [
            //"banner_image" => "required",
            "phone" => "required",
            "owner_name" => "required",
            "start_date" => "required",
            "end_date" => "required"
        ]);
        $file_path = '';
        $msg = '';
        $code = 200;
        $advertisement = Advertisement::find($id);
        $bannerImages = explode(',', $advertisement->banner_image);
        try {
            if ($request->hasFile('banner_image_one') || $request->hasFile('banner_image_two')) {

                if (($request->hasFile('banner_image_one') && !($request->file('banner_image_one')->isValid())) || ($request->hasFile('banner_image_two') && !($request->file('banner_image_two')->isValid()))) {

                    $code = 500;
                    $msg = 'to large file size';

                    $type = 'error';
                    Session::flash($type, $msg);
                    return back();
                } else {


                    if ($advertisement != null) {


                        if ($request->hasFile('banner_image_one')) {

                            $fileOne = $request->file('banner_image_one');

                            $extenstion = $fileOne->getClientOriginalExtension();
                            $size = $fileOne->getSize();
                            $fileName = $fileOne->getClientOriginalName();
                            $uniqueName = md5($fileName . microtime());
                            // $realPath=$file->getRealPath();
                            $fileMime = $fileOne->getMimeType();
                            if (in_array($fileMime, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])) {
                                if ($size <= 2084000) {
                                    $destinationPath = 'uploads/ads';
                                    $fileOne->move($destinationPath, $uniqueName . "." . $extenstion);
                                    $file_name = $uniqueName . "." . $extenstion;

                                    $file_path = $file_name;
                                } else {
                                    $code = 500;
                                    $msg = 'The file is too large ';

                                    $type = 'error';
                                    Session::flash($type, $msg);
                                    return back();
                                }
                            }
                        } else {
                            $file_path = $bannerImages[0];
                        }

                        if ($request->hasFile('banner_image_two')) {

                            $fileTwo = $request->file('banner_image_two');

                            $extenstion = $fileTwo->getClientOriginalExtension();
                            $size = $fileTwo->getSize();
                            $fileName = $fileTwo->getClientOriginalName();
                            $uniqueName = md5($fileName . microtime());
                            // $realPath=$file->getRealPath();
                            $fileMime = $fileTwo->getMimeType();
                            if (in_array($fileMime, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])) {
                                if ($size <= 2084000) {
                                    $destinationPath = 'uploads/ads';
                                    $fileTwo->move($destinationPath, $uniqueName . "." . $extenstion);
                                    $file_name = $uniqueName . "." . $extenstion;

                                    $file_path =  $file_path . ',' . $file_name;
                                } else {
                                    $code = 500;
                                    $msg = 'The file is too large ';

                                    $type = 'error';
                                    Session::flash($type, $msg);
                                    return back();
                                }
                            }
                        } else {
                            $file_path = $file_path . ',' . $bannerImages[1];
                        }

                        $advertisement->owner_name = $request->input('owner_name');
                        $advertisement->start_date = $request->input('start_date');
                        $advertisement->end_date = $request->input('end_date');
                        $advertisement->phone = $request->input('phone');
                        $advertisement->url = $request->input('url');
                        $advertisement->is_active = true;
                        $advertisement->banner_image = $file_path;

                        if ($advertisement->save()) {

                            if ($request->hasFile('banner_image_one')) {

                                $imageLocation = '/uploads/ads/' . $bannerImages[0];

                                if (file_exists(public_path() . $imageLocation)) {
                                    unlink(public_path() . $imageLocation);
                                }
                            }

                            if ($request->hasFile('banner_image_two')) {

                                $imageLocation = '/uploads/ads/' . $bannerImages[1];

                                if (file_exists(public_path() . $imageLocation)) {
                                    unlink(public_path() . $imageLocation);
                                }
                            }

                            $msg = "Advertisement Updated Successfully!";
                            if ($activationStatus == true) {
                                $msg = "Advertisement activated Successfully!";
                            }
                            $code = 200;
                            $data['advertisement'] = $advertisement;
                            $type = 'success';
                            Session::flash($type, $msg);
                            return redirect('Advertisement/activeAdvertisements/0');
                        } else {
                            $code = 500;
                            $msg = "An error occured while updating advertisement. Please try again.";
                            if ($activationStatus == true) {
                                $msg = "An error occured while activating advertisement. Please try again.";
                            }
                            $type = 'error';
                            Session::flash($type, $msg);
                            return back();
                        }
                    } else {
                        $code = 404;
                        $msg = "Advertisement does not exist";

                        $type = 'error';
                        Session::flash($type, $msg);
                        return back();
                    }
                }
            } else {

                $advertisement = Advertisement::find($id);
                if ($advertisement != null) {

                    $advertisement->owner_name = $request->input('owner_name');
                    $advertisement->start_date = $request->input('start_date');
                    $advertisement->end_date = $request->input('end_date');
                    $advertisement->phone = $request->input('phone');
                    $advertisement->url = $request->input('url');
                    $advertisement->is_active = true;
                    $advertisement->banner_image = $advertisement['banner_image'];

                    if ($advertisement->save()) {
                        $msg = "Advertisement Updated Successfully!!";
                        $code = 200;
                        $data['advertisement'] = $advertisement;
                        $type = 'success';
                        Session::flash($type, $msg);
                        return redirect('Advertisement/activeAdvertisements/0');
                    } else {
                        $code = 500;
                        $msg = "An error occured while updating advertisement. Please try again.";

                        $type = 'error';
                        Session::flash($type, $msg);
                        return back();
                    }
                } else {
                    $code = 404;
                    $msg = "Advertisement does not exist";

                    $type = 'error';
                    Session::flash($type, $msg);
                    return back();
                }
            }
        } catch (Exception $ex) {
            $msg = "Banner image does not uploaded!";
            $code = 500;

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }
    }


    public function destroy($id)
    {
        $ads = Advertisement::find($id);
        $code = 200;
        if ($ads !== null) {
            if ($ads->delete()) {
                $advertisementImages = explode(',', $ads->banner_image);

                foreach ($advertisementImages as $key => $adImg) {

                    $imageLocation = '/uploads/ads/' . $adImg;
                    if (file_exists(public_path() . $imageLocation)) {
                        unlink(public_path() . $imageLocation);
                    }
                }

                $code = 200;
                $type = 'success';
                $msg = "Advertisement deleted successfully";

                return true;
                //Session::flash($type, $msg);
                //return view('advertisement/advertisements');

            } else {
                $code = 500;
                $type = "error";
                $msg = "Advertisement does not deleted! Please try again";
                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "Advertisement does not exist!";
            Session::flash($type, $msg);
            return back();
        }
    }

    public function deactivateAdvertisement($id)
    {
        $adData = [
            'is_active' => '0'
        ];

        $changeStatus = Advertisement::where('id', $id)->update($adData);
        if ($changeStatus) {
            return true;
        } else {
            return false;
        }
    }


    public function changeDefaultAdBanner(Request $request)
    {
        // Validation
        $this->validate($request, [
            "banner_image" => "required",
        ]);
        $file_path = '';
        $msg = '';
        $code = 200;
        try {
            if ($request->hasFile('banner_image')) {
                if ($request->file('banner_image')[0]->isValid() && $request->file('banner_image')[1]->isValid()) {

                    $files = $request->file('banner_image');

                    foreach ($files as $key => $file) {

                        $extenstion = $file->getClientOriginalExtension();
                        $size = $file->getSize();
                        $fileName = $file->getClientOriginalName();
                        $uniqueName = md5($fileName . microtime());
                        // $realPath=$file->getRealPath();
                        $fileMime = $file->getMimeType();
                        if (in_array($fileMime, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])) {
                            if ($size <= 2084000) {
                                $destinationPath = 'uploads/ads';
                                $file->move($destinationPath, $uniqueName . "." . $extenstion);
                                $file_name = $uniqueName . "." . $extenstion;

                                if ($key == 0) {
                                    $file_path = $file_name;
                                } else {
                                    $file_path = $file_path . ',' . $file_name;
                                }
                            } else {
                                $code = 500;
                                $msg = 'The file is too large ';

                                $type = 'error';
                                Session::flash($type, $msg);
                                return back();
                            }
                        }
                    }

                    $advertisement = Advertisement::find('111');
                    if ($advertisement != null) {

                        $advertisement->is_active = true;
                        $advertisement->banner_image = $file_path;

                        if ($advertisement->save()) {
                            $msg = "Default Advertisement banner Updated Successfully!";
                            $code = 200;
                            $data['advertisement'] = $advertisement;
                            $type = 'success';
                            Session::flash($type, $msg);
                            return back();
                        } else {
                            $code = 500;
                            $msg = "An error occured while updating Default Ad banner. Please try again.";

                            $type = 'error';
                            Session::flash($type, $msg);
                            return back();
                        }
                    } else {
                        $code = 404;
                        $msg = "Default Advertisement banner does not exist";

                        $type = 'error';
                        Session::flash($type, $msg);
                        return back();
                    }
                } else {
                    $code = 500;
                    $msg = 'Invalid Files';

                    $type = 'error';
                    Session::flash($type, $msg);
                    return back();
                }
            } else {

                $code = 500;
                $msg = 'to large file size ';

                $type = 'error';
                Session::flash($type, $msg);
                return back();
            }
        } catch (Exception $ex) {
            $msg = "Banner image does not uploaded!";
            $code = 500;

            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }
    }

    public function countActiveAdvertisements()
    {
        $countAds = Advertisement::where('is_active', '1')->count();
        return $countAds;
    }

    public function countDeactivatedAdvertisements()
    {
        $countAds = Advertisement::where('is_active', '0')->count();
        return $countAds;
    }

    public function searchActiveAdvertisement($searchInput)
    {
        $result = array('data' => array());

        $searchWord =trim($searchInput);


        $data = Advertisement::where([['is_active','1'],['owner_name', 'LIKE', "{$searchWord}"]])->orWhere([['is_active','1'],['phone', 'LIKE', "{$searchWord}"]])->orderBy('created_at', 'desc')->get();
        foreach ($data as $key => $value) {

            $toFormatStartDate = new DateTime($value['start_date']);
            $startDate = $toFormatStartDate->format('M j, Y');

            $toFormatEndDate = new DateTime($value['end_date']);
            $endDate = $toFormatEndDate->format('M j, Y');

            $toCreatedAt = new DateTime($value['created_at']);
            $createdDate = $toCreatedAt->format('M j, Y');


            $dropDownMenu = '';

			$dropDownMenu .= '<div class="dropdown">
                            <button
                                class="btn btn-secondary btn-sm btn-flat dropdown-toggle"
                                type="button" data-toggle="dropdown">Menu<span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                <li><a class="text-secondary"
                                        href="url(Advertisement/updateAdvertisement/)'.$value['id'].'">
                                        <span class="fas fa-edit mr-2"></span> Edit</a>
                                </li>
                                <li><a href="#" class="text-secondary"
                                        data-toggle="modal"
                                        data-target="#deactivateAdvertisementModal" onclick="deactivateModalOpen('.$value['id'].')">
                                        <span class="fas fa-times mr-2"></span>
                                        Deactivate</a></li>
                                <li><a href="#" class="text-secondary"
                                        data-toggle="modal"
                                        data-target="#deleteAdvertisementModal" onclick="deleteModalOpen('.$value['id'].')">
                                        <span class="fas fa-trash-alt mr-2"></span>
                                        Delete</a></li>
                            </ul>
                        </div>';

            $url = '';
            if($value['url']!=null){
                $url = '<a href="'.$value['url'].'" class="text-blue" target="_blank">Open</a>';
            };

            $result['data'][$key] = array(
                "DT_RowId"=>'tr'.$value['id'],
                $key+1,
                $value['owner_name'],
                $value['phone'],
                '<a href="#" class="text-blue view-image" data-images="'.$value['banner_image'].'">View Banner</a>',
                $startDate,
                $endDate,
                $url ,
                $createdDate,
                $dropDownMenu,

            );
        } // /foreach

        echo json_encode($result);
    }

    public function searchDeactivatedAdvertisement($searchInput)
    {
        $result = array('data' => array());

        $searchWord =trim($searchInput);


        $data = Advertisement::where([['is_active','0'],['owner_name', 'LIKE', "{$searchWord}"]])->orWhere([['is_active','1'],['phone', 'LIKE', "{$searchWord}"]])->orderBy('created_at', 'desc')->get();
        foreach ($data as $key => $value) {

            $toFormatStartDate = new DateTime($value['start_date']);
            $startDate = $toFormatStartDate->format('M j, Y');

            $toFormatEndDate = new DateTime($value['end_date']);
            $endDate = $toFormatEndDate->format('M j, Y');

            $toCreatedAt = new DateTime($value['created_at']);
            $createdDate = $toCreatedAt->format('M j, Y');


            $dropDownMenu = '';

			$dropDownMenu .= '<div class="dropdown">
                            <button
                                class="btn btn-secondary btn-sm btn-flat dropdown-toggle"
                                type="button" data-toggle="dropdown">Menu<span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right p-3">
                                <li><a class="text-secondary"
                                        href="url(Advertisement/activateAdvertisement/)'.$value['id'].'">
                                        <span class="fas fa-check mr-2"></span> Activate</a>
                                </li>

                                <li><a href="#" class="text-secondary"
                                        data-toggle="modal"
                                        data-target="#deleteAdvertisementModal" onclick="deleteModalOpen('.$value['id'].')">
                                        <span class="fas fa-trash-alt mr-2"></span>
                                        Delete</a></li>
                            </ul>
                        </div>';

            $url = '';
            if($value['url']!=null){
                $url = '<a href="'.$value['url'].'" class="text-blue" target="_blank">Open</a>';
            };

            $result['data'][$key] = array(
                $key+1,
                $value['owner_name'],
                $value['phone'],
                '<a href="#" class="text-blue view-image" data-images="'.$value['banner_image'].'">View Banner</a>',
                $startDate,
                $endDate,
                $url ,
                $createdDate,
                $dropDownMenu,

            );
        } // /foreach

        echo json_encode($result);
    }
}



