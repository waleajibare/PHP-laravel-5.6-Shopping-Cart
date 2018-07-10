<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index()

   {

   	$all_published_product = DB::table('tbl_products')
   	                  ->join('categories', 'tbl_products.category_id','=','categories.category_id')
                      ->join('manufacture', 'tbl_products.manufacture_id','=','manufacture.manufacture_id')
                      ->select('tbl_products.*','categories.category_name','manufacture.manufacture_name')
   	                  ->where('tbl_products.publication_status', 1)
   	                  ->limit(9)
   	                  ->get();

   	      $manage_published_product = view('pages.home_content')
   	          ->with('all_published_product', $all_published_product);

   	  return view('layout')
   	          ->with('pages.home_content', $manage_published_product);

 
   	    //return view('pages.home_content');

   	}

      public function show_product_by_category($category_id)
      {
         $product_by_category = DB::table('tbl_products')
                        ->join('categories', 'tbl_products.category_id','=','categories.category_id')
                        ->select('tbl_products.*','categories.category_name')
                        ->where('categories.category_id', $category_id)
                        ->where('tbl_products.publication_status', 1)
                        ->limit(15)
                        ->get();

            $manage_product_by_category = view('pages.product_by_category')
                ->with('product_by_category', $product_by_category);

        return view('layout')
                ->with('pages.product_by_category', $manage_product_by_category);
      }

       public function show_product_by_brand($manufacture_id)
      {
         $product_by_brand = DB::table('tbl_products')
                        ->join('manufacture', 'tbl_products.manufacture_id','=','manufacture.manufacture_id')
                        ->select('tbl_products.*','manufacture.manufacture_name')
                        ->where('manufacture.manufacture_id', $manufacture_id)
                        ->where('tbl_products.publication_status', 1)
                        ->limit(15)
                        ->get();

            $manage_product_by_brand = view('pages.product_by_brand')
                ->with('product_by_brand', $product_by_brand);

        return view('layout')
                ->with('pages.product_by_brand', $manage_product_by_brand);
      }

    public function product_details($product_id)

   {

    $product_by_details = DB::table('tbl_products')
                      ->join('categories', 'tbl_products.category_id','=','categories.category_id')
                      ->join('manufacture', 'tbl_products.manufacture_id','=','manufacture.manufacture_id')
                      ->select('tbl_products.*','categories.category_name','manufacture.manufacture_name')
                      ->where('tbl_products.product_id', $product_id)
                      ->where('tbl_products.publication_status', 1)
                      ->first();

          $manage_product_by_details = view('pages.product_details')
              ->with('product_by_details', $product_by_details);

      return view('layout')
              ->with('pages.product_details', $manage_product_by_details);

    }

   
}
