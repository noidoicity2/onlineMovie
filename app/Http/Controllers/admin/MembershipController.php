<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Membership\AddMembershipRequest;
use App\Models\Category;
use App\Models\Membership;
use App\Models\MembershipCategory;
use App\Models\MovieCategory;
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
    public function Edit($id=null) {
        $membership = Membership::find($id);

        $categories = Category::all();
        $selectedCategories = MembershipCategory::select('category_id')->where('membership_id' ,$id)->pluck('category_id')->toArray();

        $selectCats= $this->toChoiceJsArray($selectedCategories, $categories);
        return view('admin.page.membership.editMembership' , [
           'membership' => $membership,
            'selected_categories' => $selectCats,
        ]);
    }
    public function PostEditMembership(Request $request) {
        $membership = $request->except('id');

        $categories = $membership['category'] ;


        $insert_categories =  array();
//        $insert_actor = array();
//        $test = array();

        $affected_rows = Membership::find($request->id)->update($membership);
        MembershipCategory::where('membership_id' , $request->id)->delete();
        for ($i =0 ; $i <count($categories) ;$i ++) {
            array_push($insert_categories , array('category_id' => $categories[$i] , 'membership_id'=>$request->id) );
        }
        MembershipCategory::insert($insert_categories);

        return back()->with([
            'success' => true ,
            'message' => "update membership successfully"
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
    private  function toChoiceJsArray($selectArray , $collection) {
        $data= [];
        foreach ($collection as $cat) {
            if(in_array($cat->id , $selectArray)) {
                array_push($data, ['value' => $cat->id , 'label' => $cat->name , 'selected' => true]);
            }
            else {
                array_push($data, ['value' => $cat->id , 'label' => $cat->name , 'selected' => false]);
            }

        }
        return $data;
    }
    public function PostDelete(Request  $request) {
        $id = $request->id;
        try{
            Membership::destroy($id);
            return json_encode([
                'success' => true,
                'message' => "delete actor successfully",
            ]);
        }
        catch (\Exception $exception) {
            return json_encode([
//                'success' => false,
                'message' => "Cannot delete actor",
            ]);
        }
    }

}
