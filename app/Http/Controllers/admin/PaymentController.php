<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    protected  $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface  $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function ListPaymentMethod() {

        return view('admin.page.paymentMethod.ListPaymentMethod' , [
            'paymentMethods' => $this->paymentMethodRepository->all(),
        ]);

    }
    public function Add() {
        return view('admin.page.paymentMethod.addPaymentMethod' , [

        ]);

    }
    public  function  Edit($id) {
        $paymentMethod = $this->paymentMethodRepository->get($id);

    }
    public function PostEditPayment() {

    }
    public function PostAddPayment() {

    }
    public function PostDeletePayment() {

    }
}
