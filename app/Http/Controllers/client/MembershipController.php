<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\PurchaseMembership;
use App\Models\Membership;
use App\Models\MembershipCategory;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserMembership;
use App\Repositories\Interfaces\MembershipRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MembershipController extends Controller
{
    //
    protected $membershipRepository;


    public function __construct(MembershipRepositoryInterface  $membershipRepository)
    {
        $this->membershipRepository = $membershipRepository;

    }
    public function ListMemberShip() {
        $memberships = $this->membershipRepository->all();

        return view('client.page.membership.ListMembership' , [
            'memberships' => $memberships,
        ]);

    }
    public function GetUserMembership() {
        $memberships =  Membership::where('user_id' , Auth::id())->get();

        return view('client.page.membership.yourMembership' , [
           'memberships' => $memberships
        ]);
    }

    public function BuyVip() {
//        $membership =
    }
    public function  PreviewPurchase($id=null , $day = null) {
        $membership = $this->membershipRepository->get($id);
        $membership_categories = MembershipCategory::where('membership_id' , $membership->id);

        return view('client.page.membership.previewPurchase',[
            'membership' => $membership
        ]);
    }

    public function createPaymentUrl(Request $request)
    {
        $membership = $this->membershipRepository->get($request->membership_id);
//create transaction
      $transation = Transaction::create([
          'user_id' => Auth::id(),
          'membership_id' => $membership->id,
          'number_of_day' => $membership->number_of_day ,
          'status'        => "unsuccessfully" ,
          'total_amount'   => $membership->price

      ]);
      session(['transaction_id' => $transation->id]);
      session(['membership_id' => $transation->membership_id]);
      session(['days' => $transation->number_of_day]);

//        session(['cost_id' => $request->id]);
//        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "WG9G2BRL"; //Mã website tại VNPAY
        $vnp_HashSecret = "RMTCYZAVLOOVMBYMQZRHXAPEMLEWCUNP"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('return_payment');
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
//        $vnp_Amount = $request->input('amount') * 100;
        $vnp_Amount = doubleval($membership->price)*100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
//        return $inputData;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
//            return $hashdata;
            $query .= urlencode($key) . "=" . urlencode($value) . '&';

        }
//        return $query;
        $vnp_Url = $vnp_Url . "?" . $query;

        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;


        }
        return redirect($vnp_Url);
    }

    public function return(Request $request)
    {
//        return $request;
//        $url = session('url_prev','/');

        $transaction_id = session('transaction_id');
//        Mail::to(Auth::user())->send(new PurchaseMembership(Transaction::find($transaction_id)));
        $membership_id = session('membership_id');
        $days = session('days');
//        session(['membership_id' => $transation->membership_id]);
        if($request->vnp_ResponseCode == "00") {
//            $this->apSer->thanhtoanonline(session('cost_id'));
            $transation = Transaction::find($transaction_id);
//            if($transation)
            $transation->update(['status' => "success"]);
            $user_membership = UserMembership::where('user_id' , Auth::id())->where('membership_id' , $membership_id)->first();
//            return $user_membership;
            if($user_membership!= null) {
                UserMembership::find($user_membership->id)->update([
                    'expired_date' =>       Carbon::parse($user_membership->expired_date)->addDays($days)
                ]);
            }
            else {
                UserMembership::create([
                    'user_id' => Auth::id(),
                    'membership_id' => $membership_id ,
                    'expired_date'  => now()->addDays($days),
                ]);
                User::find(Auth::id())->update([
                    'is_vip' =>1
                ]);
            }
//            return redirect($url)->with('success' ,'Đã thanh toán phí dịch vụ');
            // update order status
            // update user membership
            session()->forget('transaction_id');
            session()->forget('membership_id');
            session()->forget('days');
            return $request;
        }
//        session()->forget('url_prev');
        Transaction::find($transaction_id)->update(['status' => "failed"]);
        session()->forget('transaction_id');
        session()->forget('membership_id');
        session()->forget('days');
        return "ERROR";
    }
}
