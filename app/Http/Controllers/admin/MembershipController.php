<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MembershipRepositoryInterface;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    //
    protected $membershipRepository;
    public function __construct(MembershipRepositoryInterface  $membershipRepository)
    {
        $this->membershipRepository = $membershipRepository;
    }

    public function Add() {
        return view('admin.page.membership.addMembership',[

        ]);

    }
    public function ListMembership() {
        $memberships = $this->membershipRepository->all();

        return view('admin.page.membership.listMembership' , [
            'memberships' => $memberships
        ]);


    }
    public function PostAddMembership(Request $request) {
//        return $request->all();
        $this->membershipRepository->create($request->all());

        return back()->with(['message'=>"add membership successfully"]);

    }
}
