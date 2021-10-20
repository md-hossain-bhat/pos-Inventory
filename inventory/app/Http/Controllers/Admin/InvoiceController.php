<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Supplier;
use App\Unit;
use App\Category;
use App\Purchase;
use App\Invoice;
use App\InvoiceDetail;
use App\Payment;
use App\PaymentDetail;
use App\Customer;
use Session;
use Auth;
use DB;
use PDF;

class InvoiceController extends Controller
{    
    public function Invoice(){
        Session::put('page','invoice');
        $invoices = Invoice::orderBy('id','desc')->where('status',1)->get();
        return view('admin.invoices.view_invoice')->with(compact('invoices'));
    }

    public function AddInvoice(){

        $categories = Category::all();
        $invoice_data = Invoice::orderBy('id','DESC')->first();
        if($invoice_data == null){
            $firstReg = 0;
            $invoice_no = $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id','DESC')->first()->invoice_no;
            $invoice_no = $invoice_data+1;
        }
        $customers = Customer::all();
        return view('admin.invoices.add_invoices')->with(compact('categories','invoice_no','customers'));
    }

    public function StoreInvoice(Request $request){

        // dd($request->all());
        if($request->category_id ==null){
            return redirect()->back()->with("error_message","Sorry! you do not have select any product!");
        }else{
            if($request->paid_amount > $request->estamited_amount){
                return redirect()->back()->with("error_message","sorry! paid amount is maximum then total amount!");
            }else{
               $invoice = new Invoice();
               $invoice->invoice_no = $request->invoice_no;
               $invoice->date = date('Y-m-d',strtotime($request->date));
            //    $invoice->date = $request->date;
               $invoice->description = $request->description;
               $invoice->status = '0';
               $invoice->created_by = Auth::guard('admin')->user()->id;
               DB::transaction(function() use ($request,$invoice){
                   if($invoice->save()){
                       $count_category = count($request->category_id);
                       for($i=0; $i < $count_category; $i++){
                           $invoice_details = new InvoiceDetail();
                           $invoice_details->date = date('Y-m-d',strtotime($request->date)); 
                        //    $invoice_details->date = $request->date;
                           $invoice_details->invoice_id = $invoice->id;
                           $invoice_details->category_id = $request->category_id[$i];
                           $invoice_details->product_id = $request->product_id[$i];
                           $invoice_details->selling_qty = $request->selling_qty[$i];
                           $invoice_details->unit_price = $request->unit_price[$i];
                           $invoice_details->selling_price = $request->selling_price[$i];
                           $invoice_details->status = '0';
                           $invoice_details->save();
                       }
                       if($request->customer_id =='0'){
                           $customer = new Customer();
                           $customer->name = $request->name;
                           $customer->mobile = $request->mobile;
                           $customer->address = $request->address;
                           $customer->save();
                           $customer_id = $customer->id;
                       }else{
                           $customer_id = $request->customer_id;
                       }
                       $payment = new Payment();
                       $payment_details = new PaymentDetail();
                       $payment->invoice_id = $invoice->id;
                       $payment->customer_id = $customer_id;
                       $payment->paid_status = $request->paid_status;
                       $payment->discount_amount = $request->discount_amount;
                       $payment->total = $request->estamited_amount;
                       if($request->paid_status == 'full_paid'){
                            $payment->paid_amount = $request->estamited_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estamited_amount;
                       }else if($request->paid_status == 'full_due'){
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estamited_amount;
                            $payment_details->current_paid_amount = '0';
                       }else if($request->paid_status == 'partial_paid'){
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estamited_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                       }
                       $payment->save();
                       $payment_details->invoice_id = $invoice->id;
                       $payment_details->date = date('Y-m-d',strtotime($request->date));
                    //    $payment_details->date = $request->date;
                       $payment_details->save();
                   }
               
               });
            }
        }
        return redirect('admin/pandding-invoice')->with("success_message","Data save hase been Successfully!");
    }

    public function deleteInvoice($id){

        $invoice = Invoice::find($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();

        return redirect()->back()->with("success_message","Invoice has been deleted Successfully!");
    }


    public function panddingInvoiceList(){
        Session::put('page','pandding_invoice');
        $invoices = Invoice::orderBy('id','desc')->where('status',0)->get();
        return view('admin.invoices.view_invoice_pandding')->with(compact('invoices'));
    }

    public function approveInvoice($id=null){
        $invoice = Invoice::with(['Invoice_details'])->find($id);
        return view('admin.invoices.invoice_approve')->with(compact('invoice'));
    }

    public function approvalStore(Request $request ,$id=null){
        foreach($request->selling_qty as $key => $val){
            $invoice_tetails = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_tetails->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                return redirect()->back()->with("error_message","Sorry! you approve maximum value!");
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::guard('admin')->user()->id;
        $invoice->status = '1';
        DB::transaction(function() use($request,$invoice,$id){
            foreach($request->selling_qty as $key => $val){
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $invoice_details->status = 1;
                $invoice_details->save();
                $product = Product::where('id',$invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });
        return redirect('admin/pandding-invoice')->with("success_message","Invoice has been succesfully!");
    }
    
    public function printInvoiceList(){
        Session::put('page','print_invoice');
        $invoices = Invoice::orderBy('id','desc')->where('status',1)->get();
        return view('admin.invoices.print_invoice_list')->with(compact('invoices'));
    }


    public function printInvoice($id=null){
        $data['invoice'] = Invoice::with(['Invoice_details'])->find($id);
        $pdf = PDF::loadView('admin.pdf.invoice-pdf',$data);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }

    public function dalyReportInvoice(){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        Session::put('page','daly_report');
        return view('admin.invoices.daly_report');
    }

    public function dalyReportInvoicePdf(Request $request){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        $sdate = date('Y-m-d',strtotime($request->fast_date));
        $edate = date('Y-m-d',strtotime($request->last_date));
        $date['invoices'] = Invoice::whereBetween('date',[$sdate,$edate])->where('status',1)->get();
        $date['fast_date'] = date('Y-m-d',strtotime($request->fast_date));
        $date['last_date'] = date('Y-m-d',strtotime($request->last_date));
        $pdf = PDF::loadView('admin.pdf.daly-invoice-report-pdf',$date);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }
    
}
