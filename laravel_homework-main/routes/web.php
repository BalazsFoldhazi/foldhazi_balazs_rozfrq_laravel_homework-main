<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePass;
use App\Models\User;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use Illuminate\Http\RedirectResponse;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/email/verify', function (){
    return view('auth.verify-email');

})->middleware(['auth'])->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands','abouts','images'));
});





Route::get('/home', function () {return view('home');});



//Public Site All Route
//Public/Portfolio Page Route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');
//Public/Home contact page rout
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');

Route::post('/contact/form',[ContactController::class, 'ContactForm'])->name('contact.form');
//Pubic/our company site
Route::get('/ourcompany', [AboutController::class, 'Ourcompany'])->name('ourcompany');
//Pubic/our sector site
Route::get('/oursectors', [AboutController::class, 'Oursectors'])->name('oursectors');



//ADMIN DASHBOARD LOGIN
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
   // $users = User::all();// This is the all query from user table...also *FROM USER
   // $users = DB::table('users')->get();
   //return view('dashboard',compact('users'));
   return view('admin.index');
})->name('dashboard');



//Admin Home About left side menu' All Route Start
//**********************************************************************//
//Admin Home About Slider All Route


//Admin DASHBOARD/HOME MENU/SLIDER
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
//Admin DASHBOARD/HOME_MENU/SLIDER/ADD PICTURES SITE
Route::get('/add/slider', [HomeController::class, 'Addslider'])->name('add.slider');
//Admin DASHBOARD/HOME_MENU/SLIDER/ADD PICTURES BUTTON
Route::post('/store/slider', [HomeController::class, 'Storeslider'])->name('store.slider');
//INNEN HIÁNYZIK MÉG..EDIT,DELETE
//....

//ITTT MINDEN MŰŰKÖDIKK!!!!!!!!!!!!!!!!!
//Admin DASHBOARD/HOME_MENU/HOME_ABOUT
Route::get('/home/About', [AboutController::class, 'HomeAbout'])->name('home.about');
//Admin DASHBOARD/HOME_MENU/HOME_ABOUT/ADD_ABOUT_BUTTON
Route::get('/add/About', [AboutController::class, 'AddAbout'])->name('add.about');
//Admin DASHBOARD/HOME_MENU/HOME_ABOUT/ADD_ABOUT_SITE/SUBMIT_BUTTON
Route::post('/store/About', [AboutController::class, 'StoreAbout'])->name('store.about');
//Admin DASHBOARD/HOME_MENU/HOME_ABOUT/EDIT_BUTTON
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
//Admin DASHBOARD/HOME_MENU/HOME_ABOUT/EDIT_BUTTON/UPDATE_BUTTON
Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);
//Admin DASHBOARD/HOME_MENU/HOME_ABOUT/DELETE_BUTTON
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);


//Admin DASHBOARD/HOME_MENU/HOME_PORTFOLIO
Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
//Admin DASHBOARD/HOME_MENU/HOME_PORTFOLIO/ADD_IMAGE_BUTTON
Route::post('/multi/add', [BrandController::class, 'StoreImg'])->name('store.image');


//Admin DASHBOARD/HOME_MENU/HOME_BRAND/
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
//Admin DASHBOARD/HOME_MENU/HOME_BRAND/ADD_BRAND_BUTTON
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
//Admin DASHBOARD/HOME_MENU/HOME_BRAND/EDIT_BUTTON
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
//Admin DASHBOARD/HOME_MENU/HOME_BRAND/EDIT_BUTTON/UPDATE_BRAND_BUTTON
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);//probleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeem
//Admin DASHBOARD/HOME_MENU/HOME_BRAND/DELETE_BUTTON
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);


//Admin DASHBOARD/CONTACT_PAGE_MENU/CONTACT_PROFILE
Route::get('admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
//Admin DASHBOARD/CONTACT_PAGE_MENU/CONTACT_PROFILE/ADD_ABOUT_BUTTON
Route::get('admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
//Admin DASHBOARD/CONTACT_PAGE_MENU/CONTACT_PROFILE/ADD_ABOUT_BUTTON/SUBMIT_BUTTON
Route::post('admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
//INNEN HIÁNYZIK MÉG..EDIT,DELETE

//....


//Admin DASHBOARD/CONTACT_PAGE_MENU/CONTACT_MESSAGE
Route::get('admin/add/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
//Admin Home About left side menu' All Route END
//**********************************************************************//

//Admin DASHBOARD/RIGHT_SIDE_HAMBRUGER_MENU/MY_PROFIL
Route::get('/user/profile', [ChangePass::class, 'PUpdate'])->name('profile.update');
//Admin DASHBOARD/RIGHT_SIDE_HAMBRUGER_MENU/MY_PROFIL/SAVE_BUTTON
Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');
//Admin DASHBOARD/RIGHT_SIDE_HAMBRUGER_MENU/CHANGE_PASSWORD
Route::get('/user/password', [ChangePass::class, 'CPassword'])->name('change.password');
//Admin DASHBOARD/RIGHT_SIDE_HAMBRUGER_MENU/CHANGE_PASSWORD/SAVE_BUTTON
Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');
//Admin DASHBOARD/RIGHT_SIDE_HAMBRUGER_MENU/LOGOUT
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');














//Category controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

//Edit
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pdelete']);






