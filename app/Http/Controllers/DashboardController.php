<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard(){

        if(session('role') == 'admin'){
            return view('admin.dashboard');

        }elseif (session('role') == 'artist') {
            return view('artist.dashboard');

        }elseif (session('role') == 'church') {
            return view('church.dashboard');

        }else {
            return view('admin/dashboard');
            //return view('login');
        }

    }

}
