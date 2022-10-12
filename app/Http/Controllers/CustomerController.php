<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Storage;
class CustomerController extends Controller
{
    //Customer Home Page Function
    public function homePage(){
        $categories=Category::get();
        $products=Product::get();
        $orders=Order::where('user_id',Auth::user()->id)->get();
        $carts=Cart::where('user_id',Auth::user()->id)->get();
        return view("user.home",compact('categories','products','carts','orders'));
    }
    //Customer Change Password Page
    public function changePasswordPage(){
        return view('user.changePasswordPage');
    }
    //Customer Change Password
    public function changePassword(Request $request){
        $dbPw=User::select('password')->where('id',Auth::user()->id)->first()->password;
       $this->checkPasswordValidation($request);
     if(Hash::check($request->oldPassword,$dbPw)){
        $newPw=Hash::make($request->newPassword);
        User::where('id',Auth::user()->id)->update(['password'=>$newPw]);
        return back()->with(['changePwSuccess'=>'Password Changed Successfully!']);
     }else{
         return  back()->with(['oldPwError'=>'Your old password is not credential!']);
     }

    }
    //Customer Profile Page
    public function customerProfilePage(){
        $user=User::where('id',Auth::user()->id)->first();
        return view('user.profile',compact('user'));
    }
    //Customer Update Profile
    public function updateProfile(Request $request){

       $this->updateProfileValidationCheck($request);
       $updatedData=$this->updateProfileData($request);
       if($request->hasFile('image')){
        $oldFileName=User::select('image')->where('id',Auth::user()->id)->first()->image;
        $fileName=uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $updatedData['image']=$fileName;
        if($oldFileName!=null){

            Storage::delete('public/'.$oldFileName);
        }
       }
       User::where('id',Auth::user()->id)->update($updatedData);
       return back()->with(['updateSuccess'=>'Account Updated Successfully!']);
    }
    //Customer Product Filter Category
    public function filterCategory($id){
       $products=Product::where('product_category',$id)->get();
      $categories=Category::get();
      $orders=Order::where('user_id',Auth::user()->id)->get();
        $carts=Cart::where('user_id',Auth::user()->id)->get();
       return view('user.home',compact('products','categories','orders','carts'));
    }
    //Customer Product Detail Page
    public function detailPage($id){
        $product=Product::where('id',$id)->first();
        $products=Product::get();
       return view('user.detail',compact('product','products'));
    }
    //Password Validation Check Function
    public function checkPasswordValidation($request){
        $validationRules=[
            'oldPassword'=>'required',
            'newPassword'=>'required|min:6|',
            'confirmPassword'=>'required|min:6|same:newPassword'
        ];
        Validator::make($request->all(),$validationRules)->validate();
    }
    //Customer Update Profile Validation Check
    private function updateProfileValidationCheck($request){

        $validationRules=[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required'
        ];
        if($request->image!=null){
             $validationRules['image']='required|required|mimes:jpeg,jpg,png,gif,tiff,pfd,pdf,ai';
        }
        Validator::make($request->all(),$validationRules)->validate();
    }
    //Customer Update Profile Data Function
    private function updateProfileData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
        ];
    }

}
