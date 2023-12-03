<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
   function category(){
  $Categories =Category::all();

    return view('admin.category.category', compact('Categories'));
   }
   function category_store(Request $request){
    $request->validate([
        'category_name'=>'required|unique:Categories',
        'category_image'=>['required','mimes:jpg,bmp,png,webp','max:5120'],
    ]);

    $image =$request->category_image;
    $extension = $image->extension();
    $file_name = Str::lower(str_replace(' ','-', $request->category_name)).'-'.random_int(500,9999).'.'.$extension;
    Image::make($image)->save(public_path('uploads/category/'.$file_name));

     Category::insert([
        'category_name'=>$request->category_name,
        'category_image'=>$file_name,
        'created_at'=>Carbon::now(),

     ]);
     return back()->with('success','New Category Added!');
   }
   function category_delete($id){
    Category::find($id)->delete();
    return back()->with('del_success','Category Moved to Trashed');
   }
   function category_trash(){
    $Categories =Category::onlyTrashed()->get();
    return view('admin.category.trash',[
        'Categories'=>$Categories
    ]);
   }
   function category_permanent_delete($id){
    $category = category::onlyTrashed()->find($id);
    $delete_from=public_path('uploads/category/'.$category->category_image);
    unlink($delete_from);
    category::onlyTrashed()->find($id)->forceDelete();
    return back();
   }
   function category_restore ($id){
    Category::onlyTrashed()->find($id)->restore();
    return back();
   }
   function delete_checked (Request $request){
    foreach($request->catagory_id as $category){
        Category::find ($category)->delete();
    }
    return back();
   }
    function trash_checked (Request $request){

        if($request->btn_action == 1){
            foreach($request->catagory_id as $category_id){
                $cat = Category::onlyTrashed()->find($category_id);
                $delete_from = public_path('uploads/category/'. $cat->category_image);
                unlink($delete_from);
                Category::onlyTrashed()->find($category_id)->forceDelete();
             }
             return back(); 
        }
        else{
             foreach($request->catagory_id as $category_id){
                Category::onlyTrashed()->find($category_id)->restore();
             }
             return back(); 
        }
       
   }
}
