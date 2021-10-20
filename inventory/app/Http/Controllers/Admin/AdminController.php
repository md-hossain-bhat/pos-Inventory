<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Hash;
use Auth;
use Session;
use App\Admin;
use App\Customer;
use App\Product;
use App\Supplier;
use App\Payment;
use App\Purchase;
use App\Invoice;
use App\InvoiceDetail;
use Image;

class AdminController extends Controller
{

    public function dashboard(){
        Session::put('page','dashboard');
        $data['total_customer'] = Customer::count();
        $data['total_stock'] = Product::sum('quantity');
        $data['total_purchase'] = Purchase::sum('buying_price');
        $data['total_supplier'] = Supplier::count();
        $data['total_sell'] = Payment::sum('paid_amount');
        $data['total_invoice'] = Invoice::count();
        $data['cradit_customer'] = Payment::whereIn('paid_status',['full_due','partial_paid'])->count();
        // $selling_price = InvoiceDetail::sum('unit_price'); 
        // $bying_price = Purchase::sum('unit_price'); 
        // $data['total_profit'] = $selling_price - $bying_price;
    	return view('admin.dashboard',$data);
    }

    public function settings(){
    Session::put('page','Admin-Password');
        // echo "<pre>"; print_r(Auth::guard('admin')->user());die;
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.settings')->with(compact('adminDetails'));
    }

    public function chkPassword(Request $request){

        $data = $request->all();

        // echo "<pre>"; print_r($data);

        $current_password = $data['current_pwd'];
        // echo "<pre>"; print_r(Auth::guard('admin')->user()->password);die;
        // $check_password = Auth::guard('admin')User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password,Auth::guard('admin')->user()->password)){
            echo "true"; die;
        }else {
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();

            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){

                if ($data['new_pwd']==$data['confirm_pwd']) {
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    Session::flash('success_message','Password has been updated Successfully!');
                }else{
                   Session::flash('error_message','new Password & confirm password not match!');
                }

            }else {

                Session::flash('error_message','Incorrect Current Password!');
            }
           return redirect()->back();
      }
    }

    public function adminDetails(Request $request){
        Session::put('page','AdminDetails');
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rulse = [
                'name' => 'required',
                'mobile' => 'required|numeric',
                'image' => 'image',
            ];

            $customMessage = [
                'name.required' =>'name is required',
                'mobile.required' =>'mobile is required',
                'mobile.numeric' =>'Valid mobile is required',
                'image.image' =>'Valid image is required',
            ];

            $this->validate($request,$rulse,$customMessage);

            //upload image
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $imagePath = 'images/admin_img/admin_photo/'.$fileName;

                    Image::make($image_tmp)->resize(150, 150)->save($imagePath);

                }
            }else if(!empty($data['current_image'])){
                $fileName = $data['current_image'];
            }


            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'image'=>$fileName]);
            Session::flash('success_message','Admin Details has been updated Successfully!');
            
            return redirect()->back();
        }
        return view('admin.settings');
    }
    public function login(Request $request){
		//echo $password = Hash::make('123456');die;
    	if ($request->isMethod('post')) {
    		$data = $request->all();

    		$rulse = [
    			'email' => 'required|email|max:255',
		        'password' => 'required',
    		];

    		$customMessage = [
    			'email.required' =>'Email is required',
    			'email.email' =>'Valid Email is password',
    			'password.required' =>'password is required',
    		];

    		$this->validate($request,$rulse,$customMessage);

    		if (Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])) {
    			return redirect('admin/dashboard');
    		}else{
    			Session::flash('error_message','Invalide Email or Password');
    			return redirect()->back();
    		}
    	}
    	 
    	return view('admin.login');
    }

    public function logout(){
    	Auth::guard('admin')->logout();
    	return redirect('/');
    }

    public function admins(){
        Session::put('page','admin');
        $admins = Admin::get()->toArray();
        return view('admin.Admin.admins')->with(compact('admins'));
    }


    public function updateAdminStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Admin::where('id',$data['admin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'admin_id'=>$data['admin_id']]);
        }
    }


        public function addAdmin(Request $request){
          if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rulse = [
                'name' => 'required|min:2|max:100',
                'type' => 'required',
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessage = [
                'name.required' =>'name is required',
                'type.required' =>'role is required',
                'email.required' =>'Email is required',
                'email.email' =>'Valid Email is password',
                'password.required' =>'password is required',
            ];

            $this->validate($request,$rulse,$customMessage);
            
            if ($data['type'] == "Super Admin") {
                $admin = new Admin;
                $admin->name = $data['name'];
                $admin->type = $data['type'];
                $admin->email = $data['email'];
                $admin->password = bcrypt($data['password']);
                $admin->status = 1;
                $admin->nanager_acc = 1;
                $admin->moderator_acc = 1;
                $admin->save();
            }else if($data['type'] == "Manager"){
                $admin = new Admin;
                $admin->name = $data['name'];
                $admin->type = $data['type'];
                $admin->email = $data['email'];
                $admin->password = bcrypt($data['password']);
                $admin->status = 1;
                $admin->nanager_acc = 0;
                $admin->moderator_acc = 1;
                $admin->save();
            }else{
                $admin = new Admin;
                $admin->name = $data['name'];
                $admin->type = $data['type'];
                $admin->email = $data['email'];
                $admin->password = bcrypt($data['password']);
                $admin->status = 1;
                $admin->nanager_acc = 0;
                $admin->moderator_acc = 0;
                $admin->save();
            }

            return redirect('admin/admins')->with("success_message","User add has been Successfully!");
        }
        return view('admin.Admin.add_admin');
    }

     public function editAdmin(Request $request,$id=null){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); */

            $rulse = [
                'name' => 'required|min:2|max:100',
                'type' => 'required',
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessage = [
                'name.required' =>'name is required',
                'type.required' =>'role is required',
                'email.required' =>'Email is required',
                'email.email' =>'Valid Email is password',
                'password.required' =>'password is required',
            ];

            $this->validate($request,$rulse,$customMessage);
            if ($data['type'] == "Super Admin") {
            Admin::where(['id'=>$id])->update(['name'=>$data['name'],'email'=>$data['email'],'password'=>bcrypt($data['password']),'type'=>$data['type'],'user_acc'=>1,'admin_acc'=>1]);

            }else if($data['type'] == "Manager"){
                Admin::where(['id'=>$id])->update(['name'=>$data['name'],'email'=>$data['email'],'password'=>bcrypt($data['password']),'type'=>$data['type'],'user_acc'=>1,'admin_acc'=>0]);
            }else{
                Admin::where(['id'=>$id])->update(['name'=>$data['name'],'email'=>$data['email'],'password'=>bcrypt($data['password']),'type'=>$data['type'],'user_acc'=>0,'admin_acc'=>0]);
            }
            return redirect('admin/admins')->with("success_message","User Update has been Successfully!");;
        }

        $adminDetails = Admin::where(['id'=>$id])->first();
        return view('admin.Admin.edit_admin')->with(compact('adminDetails'));
    }

    public function deleteAdmin($id=null){
        $profileImage = Admin::select('image')->where('id',$id)->first();

        if(!empty($profileImage['image'])){
            $admin_image_path = "images/admin_img/admin_photo/";
                if (file_exists($admin_image_path.$profileImage->image)) {
                    unlink($admin_image_path.$profileImage->image);
                }
            Admin::where(['id'=>$id])->delete();
        }else{
            // Delete Image from Products Images table
            Admin::where(['id'=>$id])->delete();
        }
    return redirect('admin/admins')->with("success_message","User has been deleted Successfully!");
    }

    public function deleteUserImage($id=null){
        $ProfileImage = Admin::select('image')->where('id',$id)->first();
        $image_path = "images/admin_img/admin_photo/";
        if (file_exists($image_path.$ProfileImage->main_image)) {
            unlink($image_path.$ProfileImage->image);
        }
        Admin::where('id',$id)->update(['image'=>'']);
        return redirect()->back()->with("success_message","Image has been deleted Successfully!");
    }

}
