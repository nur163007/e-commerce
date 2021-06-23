<?php

namespace App\Http\Controllers;
use App\Subsubcategory;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use DB;
class SubSubController extends Controller
{
    public function manageSubSubCategory(){
        $subsubcat = Subsubcategory::with('category','subcategory')->get();
        // dd($subsubcat);
        return view('admin.subsubcat.manage-subsubcat',compact('subsubcat'));
    }

    public function addSubSubCategory(){
        $categories = Category::where('status',1)->orderBy('category_name','ASC')->get();
        // dd($categories);
        return view('admin.subsubcat.add-subsubcat',compact('categories'));
    }

    public function loadSubCat(Request $request){
        $subcat = SubCategory::select('sub_cat','id')->where('cat_id',$request->id)->get();
        // dd($subcat);
        return response()->json($subcat);

    }
    public function saveSubSubCategory(Request $request){
        // return($request);
            $this->validate($request,[
                'sub_sub_cat' => 'required',
            ]);
            $subsubcat = new Subsubcategory();
    
            $subsubcat->cat_id = $request->cat_id;
            $subsubcat->sub_cat_id = $request->sub_cat_id;
            $subsubcat->sub_sub_cat = $request->sub_sub_cat;
            
            if($subsubcat->save()){
                return back()->with('success','Sub subcategory saved successfully.');
            }
            else{
                return back()->with('error','Something wrong, please try again.');
            }
        }

        public function subSubStatus($id, $status){
            // dd($id);
            $active = Subsubcategory::findOrFail($id);
            $active->status= $status;
    
            if($active->save()){
                return response()->json(['message'=> 'Success']);
            }
        }

        public function editSubSub($id){
            // dd($id);
            $categories = Category::where('status',1)->orderBy('category_name','ASC')->get();
            // $subcategories = SubCategory::findOrFail($id);
            $subsubcat = DB::table('subsubcategories')
            ->join('categories','subsubcategories.cat_id','categories.id')
            ->join('sub_categories','subsubcategories.sub_cat_id','sub_categories.id')
            ->select('subsubcategories.*','categories.category_name','sub_categories.sub_cat')
            ->where('subsubcategories.id',$id)->first();
     
            // dd($subsubcat);
            return view('admin.subsubcat.edit-subsubcat',compact('categories','subsubcat'));
        }


        public function updateSubSub(Request $request){
            // return($request);
    
            $id = $request->subsubID;
            // dd($id);
             $subsubcat = Subsubcategory::findOrFail($id);
        
             $subsubcat->cat_id = $request->cat_id;
             $subsubcat->sub_cat_id = $request->sub_cat_id;
             $subsubcat->sub_sub_cat = $request->sub_sub_cat;
             
             if($subsubcat->save()){
                 return back()->with('success','Sub subcategory updated successfully.');
             }
             else{
                 return back()->with('error','Something wrong, please try again.');
             }
            }
        public function deleteSubSub($id){
            // dd($id);
            
            $delete = Subsubcategory::findOrFail($id);
            // dd($delete);
            if($delete){
                $delete->delete();
                return redirect()->back()->with('success','Sub subcategory successfully deleted.');
            }else{
                return redirect()->back()->with('error','Something Error Found !, Please try again.');
            }
        }
}
