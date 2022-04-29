<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }


    //
    public function AllCat(){
        //Ez is egy fajta megoldás Join-al összekacsolva a két táblát, és ugy beemelni a felh nevet az id-ja alapján a másik táblából
       /* $categories = DB::table('categories')
                ->join('users', 'categories.user_id', 'users.id')
                ->select('categories.*','users.name')
                ->latest()->paginate(5);*/
        //megjelenítős része. ami oldalakra bontja a rögzített adatokat..
       $categories = Category::latest()->paginate(5);
       $trachCat = Category::onlyTrashed()->latest()->paginate(3);
       //$categories = DB::table('categories')->latest()->paginate(5);
    return view('admin.category.index', compact('categories','trachCat'));
    }
     public function AddCat(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',

        ],
        [
           'category_name.required' => 'Please input category name',
        ]);
        //Az ELSŐ módszer az INSERT-re

        Category::insert ([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        //A MÁSODIK módszer az INSERT-re
        /*
        $category= new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        //HARMADIK módszer INSERT data with query biilder
        $data=array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);*/

        return Redirect()->back()->with('success','Category inserted succesfully!');
    }
    public function Edit($id){
        //$categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();

        return view('admin.category.edit', compact('categories'));
    }
    public function Update(Request $request ,$id){
       /* $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);*/
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        return Redirect()->route('all.category')->with('success','Category updated succesfully!');
    }
    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('succes','Category SoftDelete Succesfully');
    }
    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category restore succesfully!');
    }
    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permanent deleted succesfully!');
    }

}
