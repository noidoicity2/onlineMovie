<?php

namespace App\Http\Controllers\client;

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
    public function ListMemberShip() {
        $memberships = $this->membershipRepository->all();

        return view('client.page.membership.ListMembership');

    }

    public function BuyVip() {
//        $membership =
    }
}
