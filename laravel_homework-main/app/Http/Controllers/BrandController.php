<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;

use Carbon\Carbon;
//use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
//use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth');

    }

     public function AllBrand(){
         $brands = Brand::latest()->paginate(5);
         return view('admin.brand.index', compact('brands'));
     }
     //For pictures upload
     public function StoreBrand(Request $request){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg.jpeg,png',


        ],
        [
           'brand_name.required' => 'Please input brand name',
           'brand_image.min' => 'Brand longer then 4 character'
        ]);
            $brand_image = $request->file('brand_image');
            //resice packing after outcomment under this line..
            /*
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);
            */

            $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
            $last_img='image/brand/'.$name_gen;

            Brand::insert([
                    'brand_name' => $request->brand_name,
                    'brand_image' => $last_img,
                    'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Brand Inserted Succesfully',
                'alert-type' => 'succes'
            );
                    //return Redirect()->back()->with('succes','Brand inserted succesfully');
                    //ehelyett jön ez
            return Redirect()->back()->with($notification);

        }

        public function Edit($id){
            $brands = Brand::find($id);
            return view('admin.brand.edit',compact('brands'));

        }


        public function Update(Request $request, $id){

            $validatedData = $request->validate([
            'brand_name' => 'required|min:4',

        ],
        [
           'brand_name.required' => 'Please input brand name',
           'brand_image.min' => 'Brand longer then 4 character',
        ]);
            $old_image = $request->old_image;

            $brand_image = $request->file('brand_image');

            if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);

            unlink($old_image);
            Brand::find($id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_image' => $last_img,
                    'created_at' => Carbon::now()
            ]);

                    return Redirect()->back()->with('succes','Brand updated succesfully');
            }else{
                 Brand::find($id)->update([
                    'brand_name' => $request->brand_name,
                    'created_at' => Carbon::now()

            ]);
                    return  Redirect()->back()->with('succes','Brand updated succesfully');
            }
            }
            public function Delete($id){
            $image = Brand::find($id);
            $old_image = $image->brand_image;
            unlink($old_image);


            Brand::find($id)->delete();
            return Redirect()->back()->with('succes','Brand Delete Succesfulyy');

            }
            ////This is for multi image uplkoads
            public function Multipic(){
                $images = Multipic::all();
                return view('admin.multipic.index',compact('images'));
            }
            public function StoreImg(Request $request){

                    $image = $request->file('image');
                    foreach($image as $multi_img){


                    $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
                    Image::make($multi_img)->resize(300,200)->save('image/multi/'.$name_gen);
                    $last_img ='image/multi/'.$name_gen;

                    Multipic::insert([

                            'image' => $last_img,
                            'created_at' => Carbon::now()
                    ]);
                    }//end of foreach
                            return  Redirect()->back()->with('succes','Brand inserted succesfully');
            }
            public function Logout(){
                Auth::logout();
                return Redirect()->route('login')->with('succes','User Logut');
            }

 }
