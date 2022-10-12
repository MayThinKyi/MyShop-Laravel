<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Product List Function
    public function list(){
        $products=Product::when(request('searchKey'),function($query){
            $searchKey=request('searchKey');
            $query->where('products.product_name','like','%'.$searchKey.'%');
        })->select('products.*','categories.category_name')
            ->leftJoin('categories','products.product_category','categories.id')
            ->orderBy('products.created_at','desc')
            ->paginate(3);
        return view('admin.product.list',compact('products'));
    }
    //Product Create Page Function
    public function createPage(){
        $categories=Category::get();
        return view("admin.product.create",compact('categories'));
    }
    //Product Create Function
    public function createProduct(Request $request){
        $this->productValidationCheck($request);
        $productData=$this->getProductData($request);
        if($request->hasFile('productImage')){
            $fileName=uniqid().$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$fileName);
            $productData['product_image']=$fileName;
        }
        Product::create($productData);
        return redirect()->route('product#list');
    }
    //Product Read Product Function
    public function readProductPage($id){
        $product=Product::select('products.*','categories.category_name')
                        
                        ->leftJoin('categories','products.product_category','categories.id')
                        ->where('products.id',$id)
                        ->first();
       // $product=Product::wherdd($product->toArray());
        return view('admin.product.productPost',compact('product'));
    }
    //Product Delete Function
    public function deleteProduct($id){
        Product::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Product deleted successfully!']);
    }
    //Product Edit Page Function
    public function editProductPage($id){
       $categories=Category::get();
        $product=Product::where('id',$id)->first();
        return view('admin.product.editPage',compact('product','categories'));
    }
    //Product Update Page
    public function updateProduct(Request $request,$id){
         $this->updateProductValidationCheck($request);
        $updatedData=$this->getUpdateData($request);
       
      
        if($request->hasFile('product_image')){
           
            $oldFileName=Product::where('id',$request->id)->first()->image;
            $fileName=uniqid().$request->file('productImage')->getClientOriginalName();
           
            $request->file('productImage')->storeAs('public',$fileName);
            $updatedData['product_image']=$fileName;
           if($oldFileName!=null){
             Storage::delete('public/'.$oldFileName);
           }
        }
        Product::where('id',$request->id)->update($updatedData);
        return redirect()->route('product#list')->with(['updateSuccess'=>'Product updated successfully!']);
    }
    //Update Product Validation Check Funcion
    private function updateProductValidationCheck($request){
        $validationRules=[
           
             'productName'=>'required',
            'productDescription'=>'required',
            'productCategory'=>'required',
            'productPrice'=>'required',
            'productWaitingTime'=>'required'

        ];
        if($request->productImage!=null){
            $validationRules['productImage']='required|mimes:jpeg,jpg,png,gif,tiff,pfd,pdf,ai';
        }
        Validator::make($request->all(),$validationRules)->validate();
    }
    //Get Update Data function
    private function getUpdateData($request){
        return [
            'product_name'=>$request->productName,
            'product_description'=>$request->productDescription,
            'product_category'=>$request->productCategory,
            'product_price'=>$request->productPrice,
            'waiting_time'=>$request->productWaitingTime
        ];
    }
    //Product Validation Check Function
    public function productValidationCheck($request){
        Validator::make($request->all(),[
            'productName'=>'required',
            'productCategory'=>'required',
            'productDescription'=>'required',
            'productImage'=>'required|mimes:jpeg,jpg,png,gif,tiff,pfd,pdf,ai',
            'productPrice'=>'required',
            'productWaitingTime'=>'required'
        ])->validate();
    }
    //Product GetData Function
    public function getProductData($request){
        return [
            'product_name'=>$request->productName,
            'product_category'=>$request->productCategory,
            'product_description'=>$request->productDescription,
             'product_price'=>$request->productPrice,
            'waiting_time'=>$request->productWaitingTime
        ];
    }
}
