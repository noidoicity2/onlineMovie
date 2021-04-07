<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\AddPayment;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use App\Services\FIleUploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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
    public function PostAddPayment(AddPayment $request) {
        $imgPath    =   FIleUploadServices::UploadPaymentImage($request->file('img') , Str::slug($request->name));
        $img = Storage::url($imgPath);
//        =   Storage::url($imgPath);
//        dd($request->all());
       return $this->paymentMethodRepository->create([
           'name' => $request->name,
           'img' => $img,
           'description' => $request->description,
       ]);

    }
    public function PostDeletePayment() {

    }
}
