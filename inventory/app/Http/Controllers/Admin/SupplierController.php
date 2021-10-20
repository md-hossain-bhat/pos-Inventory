<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use Session;
class SupplierController extends Controller
{
    public function Suppliers(){
        Session::put('page','suppliers');
        $suppliers = Supplier::all();
        return view('admin.suppliers.suppliers')->with(compact('suppliers'));
    }



    public function AddEditSupplier(Request $request, $id=null){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        if ($id=="") {
            $title ="Add Supplier";
            $supplier = new Supplier;
            $supplierdata = array();
            $message ="Supplier Add Successfully!";
        }else{
            $title ="Edit Supplier";
            $supplierdata = Supplier::where('id',$id)->first();
            // $getCategories = json_decode(json_encode($getCategories),true);
            // echo "<pre>"; print_r($getCategories); die;
            $supplier = Supplier::find($id);
            $message ="Supplier Update Successfully!";
        }
    if ($request->isMethod('post')) {
        $data = $request->all();
    // echo "<pre>"; print_r($data); die;
        $rulse = [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ];

        $customMessage = [
            'name.required' =>'name is required',
            'email.required' =>'email is required',
            'email.email' =>'valid email is required',
            'mobile.required' =>'mobile is required',
            'address.required' =>'address is required'
        ];
        $this->validate($request,$rulse,$customMessage);

        $supplier->name     =$data['name'];
        $supplier->email    =$data['email'];
        $supplier->mobile   =$data['mobile'];
        $supplier->address  =$data['address'];
        $supplier->save();

        Session::flash('success_message',$message);
        return redirect("admin/suppliers");
    }
    $suppliers = Supplier::get();
    return view('admin.suppliers.add_edit_supplier')->with(compact('title','suppliers','supplierdata'));
}

    public function deleteSupplier($id){

        Supplier::where('id',$id)->delete();

        return redirect()->back()->with("success_message","Supplier has been deleted Successfully!");
    }
}
