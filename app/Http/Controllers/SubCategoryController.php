<?php

namespace App\Http\Controllers;

use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;
use DB;
class SubCategoryController extends Controller
{
    public function manageSubCategory()
    {
        $subcategories = SubCategory::with('category')->get();
        // return $subcategories;
        return view('admin.subcategory.manage-subcategory',compact('subcategories'));
    }

    public function addSubCategory()
    {
        $categories = Category::where('status',1)->orderBy('category_name','ASC')->get();
        // dd($categories);
        return view('admin.subcategory.add-subcategory',compact('categories'));
    }
    
    public function saveSubcategory(Request $request){
    // return($request);
        $this->validate($request,[
            'sub_cat' => 'required|unique:sub_categories,sub_cat',
        ]);
        $subcategories = new SubCategory();

        $subcategories->cat_id = $request->cat_id;
        $subcategories->sub_cat = $request->sub_cat;
        
        if($subcategories->save()){
            return back()->with('success','Subcategory saved successfully.');
        }
        else{
            return back()->with('error','Something wrong, please try again.');
        }
    }

    public function subStatus($id, $status){
        // dd($id);
        $active = SubCategory::findOrFail($id);
        $active->status= $status;

        if($active->save()){
            return response()->json(['message'=> 'Success']);
        }
    }

    public function editSub($id){
        // dd($id);
        $categories = Category::where('status',1)->orderBy('category_name','ASC')->get();
        // $subcategories = SubCategory::findOrFail($id);
        $subcategories = DB::table('sub_categories')->join('categories','sub_categories.cat_id','categories.id')->select('sub_categories.*','categories.category_name','categories.id')->where('sub_categories.id',$id)->first();
 
        // dd($subcategories);
        return view('admin.subcategory.edit-subCat',compact('categories','subcategories'));
    }

    public function updateSub(Request $request){
        // return($request);

        $id = $request->subID;
        // dd($id);
         $subcategories = SubCategory::findOrFail($id);
    
            $subcategories->cat_id = $request->cat_id;
            $subcategories->sub_cat = $request->sub_cat;
            
            if($subcategories->save()){
                return back()->with('success','Subcategory Updated successfully.');
            }
            else{
                return back()->with('error','Something wrong, please try again.');
            }
        }

    public function deleteSub($id){
        // dd($id);
        
        $delete = SubCategory::findOrFail($id);
        // dd($delete);
        if($delete){
            $delete->delete();
            return redirect()->back()->with('success','SubCategory successfully deleted.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.');
        }
    }
}
