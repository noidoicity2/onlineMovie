<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Movie;
use App\Models\User;
use App\Services\FileUntil;
use App\Services\FIleUploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function Add() {
        return view('admin.page.user.add');
    }
    public function Edit($id = null) {
        $user = User::find($id);
        return view('admin.page.user.edit', [
            'user' => $user
        ]);
    }
    public function PostEdit(Request $request) {

        $user = User::find($request->id);

        $updateData = $request->except('id');

        $rows = $user->update($updateData);


        if($rows> 0) {
            return back()->with([
                'success' => true ,
                'message' => "Update actor successfully"
            ]);
        }
        else {
            return back()->withErrors([
                'error' => 'error cannot update actor'
            ]);
        }
    }
    public function PostAdd(Request $request) {

        $user = $request->all();
        $user['password'] = bcrypt($user['password']);

        User::create($user);
        return back()->with([
            'message' => "add User sucessfully"
        ]);

    }

    public function ListUser () {
        $users = User::with('role')->get();

        return view ('admin.page.user.list' , [
            'users' => $users
        ]);
    }

    public function PostDelete(Request  $request) {
        $id = $request->id;
        try{
            User::destroy($id);
            return json_encode([
                'success' => true,
                'message' => "delete user successfully",
            ]);
        }
        catch (\Exception $exception) {
            return json_encode([
//                'success' => false,
                'message' => "Cannot delete user",
            ]);
        }
    }
}
