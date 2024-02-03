<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Models\Listing;      #Model ko iss file me le aaya
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

// Route::get('/', function () {
//     return view('listings',[
//         // 'heading'=>'LIST',
// //         'listings'=>[        
// //         [
// //         'id' => 1,
// //         'title' => 'Listing One',
// //         ],
// // [
// //     'id' => 2,
// //     'title' => 'Listing two',
// // ]
// //         ] 
// 'listings'=> Listing::all()           #Ye data model se liya   
//     ]);       #we can pass in array of data(that comes from a model, here we have hardcoded)
// });

// Route::get('/listings/{id}', function ($id){
// $listings= Listing::all();
// $k=0;
// foreach($listings as $listing){
//     if($listing['id']==$id){
//         $k=1;
//         break;
//     }
// }
// if($k==1)return view('listing',['listing'=>$listing]);
// else abort('404');        #Error 404 dedega... (but there exists better way---> Route Model Binding)
// });
// #better way to do the above thing ---
// // Route::get('/listings/{id}', function($id) {
// //     return view('listing', [
// //     'listing' => Listing: : find($id)
// //     ]);
// //     });
// #ROUTE MODEL BINDING
// Route::get("/listings/{listing}", function (Listing
// $listing) {
// return view('listing', [
// 'listing' => $listing                #We'll pass id only in the link ,but it will auto take the corr. listing...and this method by default displays 404 ,incase of invalid argument.
// ]);
// });
// Route::get('/hello', function() {
//     return 'hello lelo';
// });
// We could wrap the string in response and then use html.
// return response('<h1>hello lelo</h1>',200)
                // ->header('Content-Type', 'text/plain');    (200 is status code)  (You can have any custom header values(mappings)

//Example:  for ids.                Route::get('/posts/{id}', function($id) {
                //     return response( 'Post '. $id);
                //     })->where('id', '[0-9]+');   //constraint
     //when pass in query           Route::get('/search', function (Request $request){
                                    // dd ($request->name .' '.$request->city);
                                    // });




#USING CONTROLLER
Route::get('/',[ListingController::class ,'index']);
Route::get('/sort',[ListingController::class ,'sort']);
Route::get('/listings/create',[ListingController::class ,'create'])->middleware('auth');   #Only authenticated logged in users should be able to post job.
Route::post("/listings",[ListingController::class ,'store'])->middleware('auth');
Route::get("/listings/{listing}/edit",[ListingController::class ,'edit'])->middleware('auth');
Route::put("/listings/{listing}",[ListingController::class ,'update'])->middleware('auth');
Route::put("/listings/attach/{listing}",[ListingController::class ,'attach'])->middleware('auth');
Route::delete("/listings/{listing}",[ListingController::class ,'destroy'])->middleware('auth');
Route::get('/register',[UserController::class ,'create'])->middleware('guest');
Route::post('/users',[UserController::class ,'store'])->middleware('guest');
Route::post('/logout',[UserController::class ,'logout'])->middleware('auth');
Route::get('/login',[UserController::class ,'login'])->name('login')->middleware('guest'); #Passing name of route for middleware.
Route::post('/users/authenticate',[UserController::class ,'authenticate'])->middleware('guest');
Route::get("/listings/{listing}/download",[ListingController::class ,'download']);
Route::get("/listings/manage",[ListingController::class ,'manage'])->middleware('auth');
Route::get("/listings/{listing}",[ListingController::class ,'show']);  #Ye last rkhna bec fir wo create ko as an id lene lg jata hai.


// Common Resource Routes:
// index -Show all listings
// show -Show single listing
// create -Show form to create new listing
// store -Store new listing
// edit -Show form to edit listing
// update -Update listing
// destroy - Delete listing