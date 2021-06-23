<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function addBrand(){
        return view('admin.brand.add-brand');
    }


    public function saveBrand(Request $request){
        // return ($request);
        $this->validate($request,[
            'brand_name' => 'required|unique:brands,brand_name',
        ]);
        $brand = new Brand();

        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = $this->slug_generator($request->brand_name);

        if($brand->save()){
            return back()->with('success','Brand saved successfully.');
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

    public function manageBrand(){

        $brand = Brand::all();
        return view('admin.brand.brand-list',compact('brand'));
    }

    // public function inactiveBrand($id){
    //     // dd($id);
    //     $inactive = Brand::findOrFail($id);
    //     $inactive->status=0;

    //     if($inactive->save()){
    //         return back()->with('success','Brand inactive successfully.');
    //     }
    // }

    // public function activeBrand($id){
    //     // dd($id);
    //     $active = Brand::findOrFail($id);
    //     $active->status=1;

    //     if($active->save()){
    //         return back()->with('success','Brand Active successfully.');
    //     }
    // }

    public function brandStatus($id, $status){
        // dd($id);
        $active = Brand::findOrFail($id);
        $active->status= $status;

        if($active->save()){
            return response()->json(['message'=> 'Success']);
        }
    }

    public function editBrand($id){
        // dd($id);
        $editBrand = Brand::findOrFail($id);
        // dd($editBrand);
        return view('admin.brand.edit-brand',compact('editBrand'));
    }

    public function updateBrand(Request $request){
        // return ($request);
      
        $id = $request->brandID;
     
        $update = Brand::findOrFail($id);

        $update->brand_name = $request->brand_name;
        $update->brand_slug = $this->slug_generator($request->brand_name);
        
        $this->validate($request,[
            'brand_name' => 'required|unique:brands,brand_name',
        ]);

        if($update->save()){
            return back()->with('success','Brand Updated successfully.');
        }
        else{
            return back()->with('error','Something wrong, please try again.');
        }

    }

    public function deleteBrand($id){
        $delete = Brand::findOrFail($id);
        // dd($delete);
        if($delete){
            $delete->delete();
            return redirect()->back()->with('success','Brand successfully deleted.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.');
        }
    }

    
}
