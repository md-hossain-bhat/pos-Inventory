<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Supplier;
use App\Unit;
use App\Category;
use Session;
use Auth;
class ProductController extends Controller
{
    public function products(){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        Session::put('page','products');
        $products = Product::with(['supplier','unit','category'])->get();
        return view('admin.products.products')->with(compact('products'));
    }


    public function AddEditProduct(Request $request, $id=null){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        if ($id=="") {
            $title ="Add Product";
            $product = new Product;
            $productdata = array();
            $message ="Product Add Successfully!";
        }else{
            $title ="Edit Product";
            $productdata = Product::where('id',$id)->first();
            // $getCategories = json_decode(json_encode($getCategories),true);
            // echo "<pre>"; print_r($getCategories); die;
            $product = Product::find($id);
            $message ="Product Update Successfully!";
        }
    if ($request->isMethod('post')) {
        $data = $request->all();
    // echo "<pre>"; print_r($data); die;
        $rulse = [
            'product_name' => 'required',
        ];

        $customMessage = [
            'product_name.required' =>'name is required',
        ];
        $this->validate($request,$rulse,$customMessage);

        
        $product->supplier_id  =$data['supplier_id'];
        $product->unit_id      =$data['unit_id'];
        $product->category_id  =$data['category_id'];
        $product->product_name =$data['product_name'];
        $product->user_id      = Auth::guard('admin')->user()->id;
        $product->quantity     =0;
        $product->save();

        Session::flash('success_message',$message);
        return redirect("admin/products");
    }
    $products = Product::all();
    $suppliers = Supplier::all();
    $units = Unit::all();
    $categories = Category::all();
    return view('admin.products.add_edit_product')->with(compact('title','products','suppliers','units','categories','productdata'));
}

    public function deleteProduct($id){

        Product::where('id',$id)->delete();

        return redirect()->back()->with("success_message","Product has been deleted Successfully!");
    }
}
