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
use PDF;
class StockController extends Controller
{
    public function StockReport(){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        Session::put('page','stockreport');
        $products = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('admin.stock.stock-report')->with(compact('products'));
    }

    public function StockReportPdf(){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        $data['products'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        $pdf = PDF::loadView('admin.pdf.stock-report-pdf',$data);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }
    
    public function StockSupplierProductWise(){

        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        Session::put('page','stockSupplierProductwise');
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::all();
        return view('admin.stock.stock-supplier-product-wise',$data);
    }

    public function StockSupplierWisePdf(Request $request){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        $data['products'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
        $pdf = PDF::loadView('admin.pdf.stock-supplier-wise-report-pdf',$data);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }

    public function StockProductWisePdf(Request $request){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        $data['product'] = Product::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
        $pdf = PDF::loadView('admin.pdf.stock-product-wise-report-pdf',$data);
        return $pdf->setPaper('a4')->stream('document.pdf'); 
    }
}
