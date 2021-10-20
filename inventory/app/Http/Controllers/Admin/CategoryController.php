<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Session;
class CategoryController extends Controller
{
    public function categories(){
        Session::put('page','categories');
        $categories = Category::all();
        return view('admin.categories.categories')->with(compact('categories'));
    }


    public function AddEditCategory(Request $request, $id=null){
        if(Session::get('admiDetails')['moderator_acc']==0){
            return redirect('/admin/dashboard')->with("success_error","access denied !");
        }
        if ($id=="") {
            $title ="Add Category";
            $category = new Category;
            $categorydata = array();
            $message ="Unit Add Successfully!";
        }else{
            $title ="Edit Category";
            $categorydata = Category::where('id',$id)->first();
            // $getCategories = json_decode(json_encode($getCategories),true);
            // echo "<pre>"; print_r($getCategories); die;
            $category = Category::find($id);
            $message ="Category Update Successfully!";
        }
    if ($request->isMethod('post')) {
        $data = $request->all();
    // echo "<pre>"; print_r($data); die;
        $rulse = [
            'name' => 'required',
        ];

        $customMessage = [
            'name.required' =>'name is required',
        ];
        $this->validate($request,$rulse,$customMessage);

        $category->name     =$data['name'];
        $category->save();

        Session::flash('success_message',$message);
        return redirect("admin/categories");
    }
    $categories = Category::get();
    return view('admin.categories.add_edit_category')->with(compact('title','categories','categorydata'));
}

    public function deleteCategory($id){

        Category::where('id',$id)->delete();

        return redirect()->back()->with("success_message","Category has been deleted Successfully!");
    }
}
