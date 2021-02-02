<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $data['title'] = 'News | List Of News';
        $data['news'] = News::all();
        return view('admin/news/news', $data);
    }

    public function getNews($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalNews'] = $this->countNews();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        $data['title'] = 'News | List Of News';
        $data['news'] = News::offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/news/news', $data);
    }

    public function show($id)
    {

        $data['news'] = News::find($id);
        return view('news.viewNews', $data);
    }
    public function showNews($slug)
    {

        $data['news'] = News::where('slug', $slug)->get();
        return view('news.viewNews', $data);
    }

    public function addNews()
    {
        //check if admin here................
        $data['title'] = 'News | Add News';
        return view('admin/news/addNews', $data);
    }

    public function create(Request $request)
    {
        // Validation
        $this->validate($request, [
            "title" => "required",
            "description" => "required"
        ]);
        // $church_name='';
        // $church_id='';
        $publisher_name = '';
        // $publisher_id='';

        if (!$request->has('publisher_name')) {
            $publisher_name = 'Admin';
        }

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
                            $destinationPath = 'uploads/news';
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
        $news = new News();
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->cover_image = $file_path;
        /* $news->publisher_id = $request->input('publisher_id');
        $news->publisher_name = $publisher_name;
        $news->church_id = $request->input('church_id');
        $news->church_name = $request->input('church_name');*/

        $news->publisher_id = 11111111; // to be changed with session done
        $news->publisher_name = "publisher name";
        $news->church_id = 11111111; // to be changed with session done
        $news->church_name = 'church name';
        $news->slug = $request->input('title');

        if ($news->save()) {
            $msg = "News Saved Successfully!";
            $code = 201;
            $data['news'] = $news;
            $type = 'success';
            Session::flash($type, $msg);
            return redirect('News/getNews/0');
        } else {
            $code = 500;
            $msg = "An error occured while creating news. Please try again.";
            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }
    }

    public function updateNews($id)
    {
        $data['title'] = 'News | Update News';
        $data['news'] = News::find($id);
        return view('admin/news/updateNews', $data);
    }

    public function update($id, Request $request)
    {
        // Validation
        $this->validate($request, [
            "title" => "required",
            "description" => "required"
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
                            $destinationPath = 'uploads/news';
                            $file->move($destinationPath, $uniqueName . "." . $extenstion);
                            $file_path = $uniqueName . "." . $extenstion;

                            $news = News::find($id);
                            $newsCoverImage = $news->cover_image;
                            if ($news != null) {
                                $news->title = $request->input('title');
                                $news->description = $request->input('description');
                                $news->cover_image = $file_path;
                                if ($news->save()) {

                                    $imageLocation = '/uploads/news/'.$newsCoverImage;

                                    if(file_exists(public_path().$imageLocation)) {
                                        unlink(public_path().$imageLocation);
                                    }

                                    $msg = "News Updated Successfully!";
                                    $code = 200;

                                    $data['news'] = $news;
                                    $type = 'success';
                                    Session::flash($type, $msg);
                                    return redirect('News/getNews/0');
                                } else {
                                    $code = 500;
                                    $msg = "An error occured while updating news. Please try again.";
                                    $type = 'error';
                                    Session::flash($type, $msg);
                                    return back();
                                }
                            } else {
                                $code = 404;
                                $msg = "News does not exist";
                                $type = 'error';
                                Session::flash($type, $msg);
                                return back();
                            }
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
            } else {
                $news = News::find($id);
                if ($news != null) {
                    $news->title = $request->input('title');
                    $news->description = $request->input('description');
                    if ($news->save()) {
                        $msg = "News Updated Successfully!";
                        $code = 200;

                        $data['news'] = $news;
                        $type = 'success';
                        Session::flash($type, $msg);
                        return redirect('News/getNews/0');
                    } else {
                        $code = 500;
                        $msg = "An error occured while updating news. Please try again.";
                        $type = 'error';
                        Session::flash($type, $msg);
                        return back();
                    }
                } else {
                    $code = 404;
                    $msg = "News does not exist";
                    $type = 'error';
                    Session::flash($type, $msg);
                    return back();
                }
            }
        } catch (Exception $ex) {
            $msg = "Cover image does not uploaded!";
            $code = 200;
            $type = 'error';
            Session::flash($type, $msg);
            return back();
        }
    }
    public function delete($id)
    {
        $news = News::find($id);

        $code = 200;
        if ($news !== null) {
            $newsCoverImage = $news->cover_image;
            if ($news->delete()) {
                $imageLocation = '/uploads/news/'.$newsCoverImage;

                if(file_exists(public_path().$imageLocation)) {
                    unlink(public_path().$imageLocation);
                }

                $code = 200;
                $type = 'success';
                $msg = "News deleted successfully";

                $type = 'success';
                Session::flash($type, $msg);
                //return redirect('index');
                return true;
            } else {
                $code = 500;
                $type = "error";
                $msg = "News does not deleted! Please try again";

                $type = 'error';
                Session::flash($type, $msg);
                //return back();
                return false;
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "News does not exist!";

            $type = 'error';
            Session::flash($type, $msg);
            //return back();
            return false;
        }
    }

    public function countNews()
    {
        $countNews = News::count();
        return $countNews;
    }
}
