<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Supplier;
use App\Unit;
use App\Category;
use App\Purchase;
use Session;
use Auth;
use DB;
use PDF;

class PurchaseController extends Controller
{
    public function purchases(){
        Session::put('page','purchases');
        $purchases = Purchase::with(['product','unit'])->orderBy('date','desc')->orderBy('id','desc')->get();
        return view('admin.purchases.purchases')->with(compact('purchases'));
    }

    public function AddPurchase(Request $request){

        if($request->category_id == null){
            // return redirect()->back()->with("error_message","Sorry ! you do not select any item");
        }else{
            $count_category = count($request->category_id);
            for($i=0; $i < $count_category; $i++){
                $purchases = New Purchase();
                // dd($request->all());
                // dd(date('Y-m-d',strtotime($request->date[$i])));
                $purchases->date = date('Y-m-d',strtotime($request->date[$i])); 
                // $purchases->date = $request->date[$i]; 
                $purchases->purchase_no = $request->purchase_no[$i];
                $purchases->supplier_id = $request->supplier_id[$i];
                $purchases->category_id = $request->category_id[$i];
                $purchases->product_id = $request->product_id[$i];
                $purchases->buying_qty = $request->buying_qty[$i];
                $purchases->unit_price = $request->unit_price[$i];
                $purchases->description = $request->description[$i];
                $purchases->buying_price = $request->buying_price[$i];
                $purchases->user_id = Auth::guard('admin')->user()->id;
                $purchases->status = 0; 
                $purchases->save();
            }
            return redirect('admin/purchases')->with("success_message","purchases has been successfully!");
        }

        $suppliers = Supplier::all();
        return view('admin.purchases.add_purchase')->with(compact('suppliers'));
    }

    public function deletePurchase($id){

        Purchase::where('id',$id)->delete();

        return redirect()->back()->with("success_message","purchase has been deleted Successfully!");
    }


    public function panddingList(){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        Session::put('page','pandding');
        $purchases = Purchase::with(['product','unit'])->orderBy('date','desc')->orderBy('id','desc')->where('status',0)->get();
        return view('admin.purchases.view_pandding_list')->with(compact('purchases'));
    }

    public function approvePurchase($id=null){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }        
        $purchases =    Purchase::find($id);
        $product = Product::where('id',$purchases->product_id)->first();
        $purchases_qty = ((float)($purchases->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchases_qty;
        if($product->save()){
            DB::table('purchases')->where('id',$id)->update(['status'=>1]);
        }
        return redirect()->back()->with("success_message","purchase has been Approved Successfully!");
    }

    public function DalyPurchasesReport(){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        Session::put('page','dalypurchasereport');
        return view('admin.purchases.dalyPurchasesReport');
    }

    public function DalyPurchasesReportPdf(Request $request){
          if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        $sdate = date('Y-m-d',strtotime($request->fast_date));
        $edate = date('Y-m-d',strtotime($request->last_date));
        $date['purchases'] = Purchase::whereBetween('date',[$sdate,$edate])->where('status',1)->orderBy('supplier_id')->orderBy('category_id')->orderBy('product_id')->get();
        $date['fast_date'] = date('Y-m-d',strtotime($request->fast_date));
        $date['last_date'] = date('Y-m-d',strtotime($request->last_date));
        $pdf = PDF::loadView('admin.pdf.daly-purchase-report-pdf',$date);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }
}
