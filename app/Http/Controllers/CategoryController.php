<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Category list function
    public function list(){
      $categories=Category::when(request('searchKey'),function($query){
        $searchKey=request('searchKey');
        $query->where('category_name','like','%'.$searchKey.'%');

      })->orderBy('created_at','desc')->paginate(3);
    
        return view('admin.category.list',compact('categories'));
    }
    //Category Create Function
    public function createPage(){
       return view('admin.category.create');
    }
    //Category Create Function 
    public function createCategory(Request $request){
       Validator::make($request->all(),['categoryName'=>'required'])->validate();
       $data=['category_name'=>$request->categoryName];
       Category::create($data);
       return redirect()->route('category#list');
    }
    //Category Delete Function
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category deleted successfully!']);
    }
    //Category Edit Page Function
    public function editCategoryPage($id){
        $category=Category::where('id',$id)->first();
        
       return view('admin.category.edit',compact('category'));
    }
    //Category Update Function
    public function updateCategory(Request $request,$id){
       Category::where('id',$id)->update(['category_name'=>$request->categoryName]);
       return redirect()->route('category#list');
    }
    
    
    
}
