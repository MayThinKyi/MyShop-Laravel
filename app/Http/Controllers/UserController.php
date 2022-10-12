<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //userListPage Function
    public function userListPage(){
        $users=User::orderBy('created_at','desc')->where("role",'user')->get();
        return view('admin.profile.userList',compact('users'));
    }
    //User change Status Function
    public function changeStatus(Request $request){
       User::where('id',$request->userId)->update(['role'=>$request->changeStatusValue]);
             return response()->json(['msg' => 'success']); 
    }
    //Delete User From UserList
    public function deleteUser($id){
       User::where('id',$id)->delete();
       return back();
    }
}
