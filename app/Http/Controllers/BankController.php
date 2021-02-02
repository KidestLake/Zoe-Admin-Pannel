<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BankAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BankController extends Controller
{

    public function index()
    {
       // return response()->json(Church::with('address')->get());
        $data['Banks'] = BankAccount::where('is_active','1')->get();
        return view('admin/bank/bankAccounts',$data);
    }

    public function deactivatedBankAccount()
    {
       // return response()->json(Church::with('address')->get());
        $data['Banks'] = BankAccount::where('is_active','0')->get();
        return view('admin/bank/deactivatedBankAccounts',$data);
    }


    public function show($id)
    {
        //return response()->json(Church::with('address')->find($id));
        $data['bank'] = BankAccount::find($id);
        //return view('bank',$data);
    }

    public function createBankAccount()
    {
         //check if admin here................
         $data['title'] = 'Bank Account | Add Bank Account';
         return view('admin/bank/addBankAccount',$data);
    }

    public function create(Request $request)
    {
        $user_id = '1111111';// to be changed with session done

        // Validation
        $this->validate($request, [
            "account_number" => "required",
            "bank_name" => "required",
        ]);

        if( $request->input('artist_name')){
            $artist_name = $request->input('artist_name');
        }else{
            $artist_name = 'zoe';
        }

        // Check the user existance
        try {
            $bankAccount = new BankAccount();
            $bankAccount->user_id = $user_id;
            $bankAccount->artist_name =$artist_name;
            $bankAccount->account_number = $request->input('account_number');
            $bankAccount->bank_name = $request->input('bank_name');
            if ($bankAccount->save()) {
                $data['bank'] = $bankAccount;
                $code = 201;
                $msg = "Bank account saved successfully!";

                $type = 'success';
                Session::flash($type, $msg);
                return view('admin/bank/bankAccounts',$data);
            } else {
                $code = 500;
                $msg = "Error occured while creating bank account! please try again.";

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


    public function destroy($id)
    {
        $bank = BankAccount::find($id);
        $code = 200;
        if ($bank !== null) {
            if ($bank->delete()) {
                $code = 200;
                $type = 'success';
                $msg = "Bank Account deleted successfully";

                Session::flash($type, $msg);
                return redirect('index');

            } else {
                $code = 500;
                $type = "error";
                $msg = "Bank Account does not deleted! Please try again";

                Session::flash($type, $msg);
                return back();
            }
        } else {
            $type = 'error';
            $code = 404;
            $msg = "Bank Account does not exist!";

            Session::flash($type, $msg);
            return back();
        }

    }

    public function activateBankAccount($id){
        try {
            $accountData=[
            'is_active' => '1'
            ];

            $changeStatus = BankAccount::where('id', $id)->update($accountData);
            if($changeStatus){
                return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            $code = 500;
            $msg = $ex->getMessage();

            $type = 'error';
            Session::flash($type, $msg);
            return false;
        }
    }

    public function deactivateBankAccount($id){
        try {
            $accountData=[
            'is_active' => '0'
            ];

            $changeStatus = BankAccount::where('id', $id)->update($accountData);
            if($changeStatus){
                return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            $code = 500;
            $msg = $ex->getMessage();

            $type = 'error';
            Session::flash($type, $msg);
            return false;
        }
    }

}
