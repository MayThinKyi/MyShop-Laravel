<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Storage;
class AdminController extends Controller
{
    //Admin Change Password Page Function
    public function changePasswordPage(){
        return view('admin.profile.changePasswordPage');
    }
    //Admin Change Password Function
    public function changePassword(Request $request){
      $this->passwordValidationCheck($request);
      $dbPassword=User::select('password')->where('id',Auth::user()->id)->first()->password;
      if(Hash::check($request->oldPassword,$dbPassword)){
        $hashPassword=Hash::make($request->newPassword);
        User::where('id',Auth::user()->id)->update(['password'=>$hashPassword]);
        return back()->with(['changePwSuccess'=>'Changed Password Successfully']);
      }else{
        return back()->with(['oldPwError'=>'Your old Password does not Credential.']);
      }
    }
    //Admin Profile info Page
    public function infoPage(){
        $user=User::where('id',Auth::user()->id)->first();
        
        return view('admin.profile.info',compact('user'));
    }
    //Admin Edit Profile Info Page
    public function editInfoPage(){
        $user=User::where('id',Auth::user()->id)->first();
        return view('admin.profile.editInfo',compact('user'));
    }
    //Admin Update Profile Info Page
    public function updateInfoPage(Request $request){
      
        $this->updateProfileValidationCheck($request);
        $updatedData=$this->getUpdateData($request);
       
      
        if($request->hasFile('image')){
           
            $oldFileName=User::where('id',Auth::user()->id)->first()->image;
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
           
            $request->file('image')->storeAs('public',$fileName);
            $updatedData['image']=$fileName;
           if($oldFileName!=null){
             Storage::delete('public/'.$oldFileName);
           }
        }
        User::where('id',Auth::user()->id)->update($updatedData);
        return redirect()->route('admin#profileInfo')->with(['msg'=>'Account updated successfully!']);
        
    }
    //Admin List Page Function
    public function adminListPage(){
        $admins=User::when(request('searchKey'),function($query){
            $searchKey=request('searchKey');
            $query->where('name','like','%'.$searchKey.'%');
        })->where('role','admin')->paginate(3);
      
        return view('admin.profile.adminList',compact('admins'));
    }
    //Password Validation Check Function
    private function passwordValidationCheck($request){
        $validationRules=[
            'oldPassword'=>'required',
            'newPassword'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:newPassword'
        ];
        Validator::make($request->all(),$validationRules)->validate();
    }
    //Update Profile Validation Check Funcion
    private function updateProfileValidationCheck($request){
        $validationRules=[
           
             'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required'

        ];
        if($request->image!=null){
            $validationRules['image']='required|mimes:jpeg,jpg,png,gif,tiff,pfd,pdf,ai';
        }
        Validator::make($request->all(),$validationRules)->validate();
    }
    //Get Update Data function
    private function getUpdateData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender
        ];
    }
}
