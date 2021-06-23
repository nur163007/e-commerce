<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function manageCategory()
    {
        $categories = Category::all();
        return view('admin.category.manage-category',compact('categories'));
    }


    public function addCategory()
    {
        return view('admin.category.add-category');
    }

   
    public function saveCategory(Request $request){
        // return ($request);
        $this->validate($request,[
            'category_name' => 'required|unique:categories,category_name',
        ]);
        $categories = new Category();

        $categories->category_name = $request->category_name;
        $categories->category_slug = $this->slug_generator($request->category_name);

        if($categories->save()){
            return back()->with('success','Category saved successfully.');
        }
        else{
            return back()->with('error','Something wrong, please try again.');
        }
    }

    public function slug_generator($string){
        $string = str_replace('' , '-' , $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/' , '' , $string);
        return strtolower(preg_replace('/-+/' , '' , $string));
    }

    public function categoryStatus($id, $status){
        // dd($id);
        $active = Category::findOrFail($id);
        $active->status= $status;

        if($active->save()){
            return response()->json(['message'=> 'Success']);
        }
    }

    public function editCategory($id){
        // dd($id);
        $editCategory = Category::findOrFail($id);
        // dd($editBrand);
        return view('admin.category.edit-category',compact('editCategory'));
    }

    public function updateCategory(Request $request){
        // return ($request);
      
        $id = $request->categoryID;
     
        $update = Category::findOrFail($id);

        $update->category_name = $request->category_name;
        $update->category_slug = $this->slug_generator($request->category_name);
        
        $this->validate($request,[
            'category_name' => 'required|unique:categories,category_name',
        ]);

        if($update->save()){
            return back()->with('success','Category Updated successfully.');
        }
        else{
            return back()->with('error','Something wrong, please try again.');
        }

    }


    public function deleteCategory($id){
        $delete = Category::findOrFail($id);
        // dd($delete);
        if($delete){
            $delete->delete();
            return redirect()->back()->with('success','Category successfully deleted.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.');
        }
    }

}
