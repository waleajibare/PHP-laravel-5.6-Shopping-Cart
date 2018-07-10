<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandController extends Controller
{
    public function index()
    {

    	return view('admin.add_brand');
    }


    public function save_brand(Request $request)

   {

       $data=array();
             $data['manufacture_id']= $request->manufacture_id;
             $data['manufacture_name']= $request->manufacture_name;
             $data['manufacture_description']= $request->manufacture_description;
             $data['publication_status']= $request->publication_status;

             DB::table('manufacture')->insert($data);
             Session::put('message', 'Brand added successfully');
             return Redirect::to('/add-brand');
   	 
   }


   public function all_brand()

   {
      $all_brands_info = DB::table('manufacture')->get();
   	      $manage_brand = view('admin.all_brand')
   	          ->with('all_brands_info', $all_brands_info);

   	  return view('admin_layout')
   	          ->with('admin.all_brand', $manage_brand);


   	  //return view('admin.all_category');
   }

   public function delete_brand($manufacture_id)

   {
       DB::table('manufacture')
          ->where('manufacture_id', $manufacture_id)
          ->delete();

      Session::get('message', 'Brand deleted successfully');
      return Redirect::to('/all-brand');

      //return view('admin.add_category');
   }


   public function unactive_brand($manufacture_id)

   {

   	  DB::table('manufacture')
   	      ->where('manufacture_id', $manufacture_id)
   	      ->update(['publication_status' => 0]);
   	  Session::put('message', 'Brand Unactivated successfully');
   	      return Redirect::to('/all-brand');


   	  //return view('admin.add_category');
   }

   public function active_brand($manufacture_id)

   {

   	  DB::table('manufacture')
   	      ->where('manufacture_id', $manufacture_id)
   	      ->update(['publication_status' => 1]);
   	  Session::put('message', 'Brand Activated Successfully');
   	      return Redirect::to('/all-brand');

   }


    public function edit_brand($manufacture_id)

   {
       $brand_info = DB::table('manufacture')
                          ->where('manufacture_id', $manufacture_id)
                          ->first();

       $brand_info = view('admin.edit_brand')
   	          ->with('brand_info', $brand_info);

   	   return view('admin_layout')
   	          ->with('admin.edit_brand', $brand_info);

   	  //return view('admin.edit_category');
   }


   public function update_brand(Request $request, $manufacture_id)
   {
      $data = array();
      $data['manufacture_name'] = $request->manufacture_name;
      $data['manufacture_description'] = $request->manufacture_description;

      DB::table('manufacture')
          ->where('manufacture_id', $manufacture_id)
          ->update($data);

          Session::get('message', 'Brand successfully updated');
          return Redirect::to('/all-brand');

   }

























}
