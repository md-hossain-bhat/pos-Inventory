<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Payment;
use App\PaymentDetail;
use Session;
use Auth;
use PDF;
class CustomerController extends Controller
{
    public function Customers(){
        Session::put('page','customers');
        $customers = Customer::all();
        return view('admin.customers.customers')->with(compact('customers'));
    }

    public function AddEditCustomer(Request $request, $id=null){
        if ($id=="") {
            $title ="Add Customer";
            $customer = new Customer;
            $customerdata = array();
            $message ="Customer Add Successfully!";
        }else{
            $title ="Edit Customer";
            $customerdata = Customer::where('id',$id)->first();
            // $getCategories = json_decode(json_encode($getCategories),true);
            // echo "<pre>"; print_r($getCategories); die;
            $customer = Customer::find($id);
            $message ="Customer Update Successfully!";
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

        $customer->name     =$data['name'];
        $customer->email    =$data['email'];
        $customer->mobile   =$data['mobile'];
        $customer->address  =$data['address'];
        $customer->user_id   = Auth::guard('admin')->user()->id;
        $customer->save();

        Session::flash('success_message',$message);
        return redirect("admin/customers");
    }
    $customers = Customer::get();
    return view('admin.customers.add_edit_customer')->with(compact('title','customers','customerdata'));
}

    public function deleteCustomer($id){

        Customer::where('id',$id)->delete();

        return redirect()->back()->with("success_message","Customer has been deleted Successfully!");
    }

    public function craditCustomer(){
        Session::put('page','craditcustomers');
        $payments = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.customers.cradit-customer')->with(compact('payments'));
    }

    public function craditCustomerPdf(){

        $data['payments'] = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('admin.pdf.cradit-customer-pdf-list',$data);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }

    public function invoiceEdit($invoice_id){

        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('admin.customers.creadit-invoice-edit')->with(compact('payment'));
    }

    public function invoiceUpdate(Request $request, $invoice_id){
 
        if($request->new_paid_amount < $request->paid_amount){
           return redirect()->back()->with('error_message','Sorry ! you have paid maximum value'); 
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if($request->paid_status == 'full_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;
            }else if($request->paid_status == 'partial_paid'){
                $payment->paid_amount = Payment::where('invoice_id','$invoice_id')->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->updated_by = Auth::guard('admin')->user()->id;
            $payment_details->save();

            return redirect('admin/cradit')->with('success_message','Update Has been successfully!'); 
        }
    }

    public function invoiceDetailsPdf($invoice_id){

        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $pdf = PDF::loadView('admin.pdf.invoice-details-pdf',$data);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }

    public function paidCustomer(){
          if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        Session::put('page','paidCustomer');
        $payments = Payment::where('paid_status','!=','full_due')->get();
        return view('admin.customers.paid-customer')->with(compact('payments'));
    }

    public function paidCustomerPdf(){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        
        if(Session::get('admiDetails')['nanager_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        $data['payments'] =  Payment::where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('admin.pdf.paid-customer-pdf-list',$data);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }

    public function customerWiseReport(){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        Session::put('page','customerWise');
        $customers = Customer::all();
        return view('admin.customers.customer-wise-report')->with(compact('customers'));
    }

    public function craditReportPdf(Request $request){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        $data['payments'] = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('admin.pdf.customer-wise-cradit-pdf',$data);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }

    public function paidReportPdf(Request $request){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        $data['payments'] =  Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('admin.pdf.customer-wise-paid-pdf',$data);
        return $pdf->setPaper('a4')->stream('document.pdf');
    }

}
