<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InternationalPayment;
use App\Models\LocalPayment;
use App\Models\TelecomPayment;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function internationalPayments()
    {
        $data['title'] = 'Payments | International Payments';
        $data['activeTab'] = 11;
        return view('admin/payment/internationalPayments',$data);
    }

    public function localPayments()
    {
        $data['title'] = 'Payments | Local Payments';
        $data['activeTab'] = 11;
        return view('admin/payment/localPayments',$data);
    }

    public function telecomPayments()
    {
        $data['title'] = 'Payments | Telecom Payments';
        $data['activeTab'] = 11;
        return view('admin/payment/telecomPayments',$data);
    }

    public function allInternationalPaymentsPayed(){

        $data['title'] = "Payment | International Payments ";
        $data['internationalPayments'] = InternationalPayment::with('user')->where('is_payed','1')->get();
        return view('admin/payment/internationalPaymentsPayed',$data);

    }

    public function internationalPaymentsPayed($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalIPaymentPayed'] = $this->totalIPaymentPayed();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

         //$data['title'] = "Payment | International Payments ";
        $data['internationalPayments'] = InternationalPayment::with('user')->where('is_payed','1')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/payment/internationalPaymentsPayed',$data)->render();


    }



    public function allInternationalPaymentsNotPayed(){

        $data['title'] = "Payment | International Payments ";
        $data['internationalPayments'] = InternationalPayment::with('user')->where('is_payed','0')->get();
        return view('admin/payment/internationalPaymentsNotPayed',$data);

    }

    public function internationalPaymentsNotPayed($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalIPaymentNotPayed'] = $this->totalIPaymentNotPayed();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

       // $data['title'] = "Payment | International Payments ";
        $data['internationalPayments'] = InternationalPayment::with('user')->where('is_payed','0')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return view('admin/payment/internationalPaymentsNotPayed',$data);
        return view('admin/payment/internationalPaymentsNotPayed',$data)->render();
    }

    public function allLocalPaymentsPayed(){

        $data['title'] = "Payment | Local Payments ";
        $data['localPayments'] = LocalPayment::with('user')->where('is_payed','1')->get();
        return view('admin/payment/localPaymentsPayed',$data);
    }


    public function localPaymentsPayed($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalLPaymentPayed'] = $this->totalLPaymentPayed();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        //$data['title'] = "Payment | Local Payments ";
        $data['localPayments'] = LocalPayment::with('user')->where('is_payed','1')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return view('admin/payment/localPaymentsPayed',$data);
        return view('admin/payment/localPaymentsPayed',$data)->render();

    }

    public function allLocalPaymentsNotPayed(){

        $data['title'] = "Payment | Local Payments ";
        $data['localPayments'] = LocalPayment::with('user')->where('is_payed','0')->get();
        return view('admin/payment/localPaymentsNotPayed',$data);
    }


    public function localPaymentsNotPayed($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalLPaymentNotPayed'] = $this->totalLPaymentNotPayed();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        //$data['title'] = "Payment | Local Payments ";
        $data['localPayments'] = LocalPayment::with('user')->where('is_payed','0')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return view('admin/payment/localPaymentsNotPayed',$data);
        return view('admin/payment/localPaymentsNotPayed',$data)->render();

    }


    public function allTelecomPaymentsPayed(){

        $data['title'] = "Payment | Telecom Payments ";
        $data['telecomPayments'] = TelecomPayment::with('user')->where('is_payed','1')->get();
        return view('admin/payment/telecomPaymentsPayed',$data);
    }

    public function telecomPaymentsPayed($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalTPaymentPayed'] = $this->totalTPaymentPayed();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

        //$data['title'] = "Payment | Telecom Payments ";
        $data['telecomPayments'] = TelecomPayment::with('user')->where('is_payed','1')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return view('admin/payment/telecomPaymentsPayed',$data);
        return view('admin/payment/telecomPaymentsPayed',$data)->render();

    }

    public function allTelecomPaymentsNotPayed(){

        $data['title'] = "Payment | Telecom Payments ";
        $data['telecomPayments'] = TelecomPayment::with('user')->where('is_payed','0')->get();
        return view('admin/payment/telecomPaymentsNotPayed',$data);
    }

    public function telecomPaymentsNotPayed($offset, $pageNumber = null)
    {
        $data['offset'] = $offset;
        $limit = 2;
        $data['limit'] = $limit;
        $data['totalTPaymentNotPayed'] = $this->totalTPaymentNotPayed();

        if ($offset == 0) {
            $data['pageNumber'] = 1;
        } else {
            $data['pageNumber'] = $pageNumber;
        }

       // $data['title'] = "Payment | Telecom Payments ";
        $data['telecomPayments'] = TelecomPayment::with('user')->where('is_payed','0')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        //return view('admin/payment/telecomPaymentsNotPayed',$data);
        return view('admin/payment/telecomPaymentsNotPayed',$data)->render();

    }

    public function totalIPaymentPayed()
    {
        $totalIPaymentPayed = InternationalPayment::where('is_payed','1')->count();
        return $totalIPaymentPayed;
    }


    public function totalIPaymentNotPayed()
    {
        $totalIPaymentNotPayed = InternationalPayment::where('is_payed','0')->count();
        return $totalIPaymentNotPayed;
    }

    public function totalLPaymentPayed()
    {
        $totalLPaymentPayed = LocalPayment::where('is_payed','1')->count();
        return $totalLPaymentPayed;
    }

    public function totalLPaymentNotPayed()
    {
        $totalLPaymentNotPayed = LocalPayment::where('is_payed','0')->count();
        return $totalLPaymentNotPayed;
    }

    public function totalTPaymentPayed()
    {
        $totalTPaymentPayed = TelecomPayment::where('is_payed','1')->count();
        return $totalTPaymentPayed;
    }

    public function totalTPaymentNotPayed()
    {
        $totalTPaymentNotPayed = TelecomPayment::where('is_payed','0')->count();
        return $totalTPaymentNotPayed;
    }

    public function searchIPayed($searchInput)
    {
        $data['searchInput'] = $searchInput;
        $data['searchPayed'] = true;
        $data['searchedPayments'] = InternationalPayment::with('user')->where('is_payed','1')->orderBy('created_at', 'desc')->get();
        //$data['searchedPayments'] = InternationalPayment::get();
        return view('admin/payment/searchPayment',$data)->render();
    }

    public function searchINotPayed($searchInput)
    {
        $data['searchInput'] = $searchInput;
        $data['searchPayed'] = false;
        $data['searchedPayments'] = InternationalPayment::with('user')->where('is_payed','0')->orderBy('created_at', 'desc')->get();
        return view('admin/payment/searchPayment',$data)->render();
    }

    public function searchLPayed($searchInput)
    {
        $data['searchInput'] = $searchInput;
        $data['searchPayed'] = true;
        $data['searchedPayments'] = LocalPayment::with('user')->where('is_payed','1')->orderBy('created_at', 'desc')->get();
        //$data['searchedPayments'] = InternationalPayment::get();
        return view('admin/payment/searchPayment',$data)->render();
    }

    public function searchLNotPayed($searchInput)
    {
        $data['searchInput'] = $searchInput;
        $data['searchPayed'] = false;
        $data['searchedPayments'] = LocalPayment::with('user')->where('is_payed','0')->orderBy('created_at', 'desc')->get();
        return view('admin/payment/searchPayment',$data)->render();
    }

    public function searchTPayed($searchInput)
    {
        $data['searchInput'] = $searchInput;
        $data['searchPayed'] = true;
        $data['searchedPayments'] = TelecomPayment::with('user')->where('is_payed','1')->orderBy('created_at', 'desc')->get();
        //$data['searchedPayments'] = InternationalPayment::get();
        return view('admin/payment/searchPayment',$data)->render();
    }

    public function searchTNotPayed($searchInput)
    {
        $data['searchInput'] = $searchInput;
        $data['searchPayed'] = false;
        $data['searchedPayments'] = TelecomPayment::with('user')->where('is_payed','0')->orderBy('created_at', 'desc')->get();
        return view('admin/payment/searchPayment',$data)->render();
    }
}
