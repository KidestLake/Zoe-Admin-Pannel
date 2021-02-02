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

         $data['title'] = "Payment | International Payments ";
        $data['internationalPayments'] = InternationalPayment::with('user')->where('is_payed','1')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/payment/internationalPaymentsPayed',$data);


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

        $data['title'] = "Payment | International Payments ";
        $data['internationalPayments'] = InternationalPayment::with('user')->where('is_payed','0')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/payment/internationalPaymentsNotPayed',$data);
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

        $data['title'] = "Payment | Local Payments ";
        $data['localPayments'] = LocalPayment::with('user')->where('is_payed','1')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/payment/localPaymentsPayed',$data);

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

        $data['title'] = "Payment | Local Payments ";
        $data['localPayments'] = LocalPayment::with('user')->where('is_payed','0')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/payment/localPaymentsNotPayed',$data);

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

        $data['title'] = "Payment | Telecom Payments ";
        $data['telecomPayments'] = TelecomPayment::with('user')->where('is_payed','1')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/payment/telecomPaymentsPayed',$data);

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

        $data['title'] = "Payment | Telecom Payments ";
        $data['telecomPayments'] = TelecomPayment::with('user')->where('is_payed','0')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
        return view('admin/payment/telecomPaymentsNotPayed',$data);

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


}
