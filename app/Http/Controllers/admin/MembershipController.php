<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Membership\AddMembershipRequest;
use App\Models\Category;
use App\Repositories\Interfaces\MembershipCategoryRepositoryInterface;
use App\Repositories\Interfaces\MembershipRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    //
    protected $membershipRepository;
    protected $membershipCategoryRepository;

    public function __construct(MembershipRepositoryInterface  $membershipRepository,
                                MembershipCategoryRepositoryInterface $membershipCategoryRepository)
    {
        $this->membershipRepository = $membershipRepository;
        $this->membershipCategoryRepository = $membershipCategoryRepository;
    }

    public function Add() {
        $categories = Category::all();
        return view('admin.page.membership.addMembership',[
            'categories' => $categories
        ]);

    }
    public function ListMembership() {
        $memberships = $this->membershipRepository->all();

        return view('admin.page.membership.listMembership' , [
            'memberships' => $memberships,

        ]);


    }
    public function PostAddMembership(AddMembershipRequest $request) {
//        return $request->all();
        $memberships = $request->all();


        $categories = $memberships['category'];
        $insert_data= array();
//        return $memberships;


        try {

          $membership =  $this->membershipRepository->create($request->all());
            for ($i =0 ; $i <count($categories) ;$i ++) {
                array_push($insert_data , array('category_id' => $categories[$i] , 'membership_id'=>$membership->id) );
            }
             $this->membershipCategoryRepository->insert($insert_data);

            return back()->with(['message'=>"add membership successfully"]);


        }
        catch (Exception $e){

            return back()->with(['error'=>"add membership fail"]);

        }




    }
}
