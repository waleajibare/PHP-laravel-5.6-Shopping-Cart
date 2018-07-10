<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function login_check()
    {
    	return view('pages.login');
    }

    public function customer_registration(Request $request)
    {

    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['password'] = md5($request->password);
    	$data['mobile_number'] = $request->mobile_number;

    	   $customer_id = DB::table('tbl_customer')
    	                 ->InsertGetId($data);

    	           Session::put('customer_id', $customer_id);
    	           Session::put('customer_name',$request->customer_name);
                   return Redirect('/checkout');
    }

    public function checkout()
    {
    	//$all_published_category = DB::table('categories')
        //                     ->where('publication_status', 1)
          //                     ->get();
        //$manage_published_category = view('pages.checkout')
          //    ->with('all_published_category', $all_published_category);

      //return view('layout')
        //      ->with('pages.checkout', $manage_published_category);

        return view('pages.checkout');
    }


    public function save_shipping_details(Request $request)
    {

    	$data = array();
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_first_name'] = $request->shipping_first_name;
    	$data['shipping_last_name'] = $request->shipping_last_name;
    	$data['shipping_address'] = $request->shipping_address;
    	$data['shipping_mobile_number'] = $request->shipping_mobile_number;
    	$data['shipping_city'] = $request->shipping_city;

    	$shipping_id = DB::table('shipping')
    	   ->InsertGetId($data);
    	   Session::put('shipping_id', $shipping_id);
    	   return Redirect::to('/payment');

    }

    public function customer_login(Request $request)
    {

        $customer_email = $request->customer_email;
        $password = md5($request->password);
        $result = DB::table('tbl_customer')
                   ->where('customer_email', $customer_email)
                   ->where('password', $password)
                   ->first();

                   if ($result){

                    Session::put('customer_id', $result->customer_id);
                    return Redirect::to('/checkout');
                   }else{
                    return Redirect::to('/login-check');
                   }

    }

    public function customer_logout()
    {

        Session::flush();
        return Redirect::to('/');
    }


     public function payment()
    {

        return view('pages.payment');
    }


     public function place_order(Request $request)
    {

        $payment_gateway = $request->payment_method;

        $pdata = array();
        $pdata['payment_method'] = $payment_gateway;
        $pdata['payment_status'] = 'pending';

        $payment_id = DB::table('payments')
                ->InsertGetId($pdata);

         $odata = array();
         $odata['customer_id'] = Session::get('customer_id');
         $odata['shipping_id'] = Session::get('shipping_id');
         $odata['payment_id'] = $payment_id;
         $odata['order_total'] = Cart::total();
         $odata['order_status'] = 'pending';


         $order_id = DB::table('orders')

            ->InsertGetId($odata);


        $contents = Cart::content();
        $oddata = array();

        foreach ($contents as $v_content) {
            
            
            $oddata['order_id'] = $order_id;
            $oddata['product_id'] = $v_content->id;
            $oddata['product_name'] = $v_content->name;
            $oddata['product_price'] = $v_content->price;
            $oddata['product_sales_quantity'] = $v_content->qty;

            DB::table('order_details')
                ->insert($oddata);

        }
        

         if ($payment_gateway == 'handcash') {

            Cart::destroy();

            return view('pages.handcash');

         }elseif ($payment_gateway == 'card') {

            echo "card";


         }elseif ($payment_gateway == 'paypal') {

            echo "paypal";
            
         }else{

            echo "not selected";
         }


        //$shipping_id = Session::get('shipping_id');

       // $customer_id = Session::get('customer_id');






    }

    

    public function manage_order()
    {

        $all_order_info = DB::table('orders')
                      ->join('tbl_customer', 'orders.customer_id','=','tbl_customer.customer_id')
                      ->select('orders.*','tbl_customer.customer_name')
                      ->get();

          $manage_order = view('admin.manage_order')
              ->with('all_order_info', $all_order_info);

      return view('admin_layout')
              ->with('admin.manage_order', $manage_order);

    }

    public function view_order($order_id)
    {


        
        $order_by_id = DB::table('orders')
                      ->join('tbl_customer', 'orders.customer_id','=','tbl_customer.customer_id')
                      ->join('order_details','orders.order_id','=','order_details.order_id')
                      ->join('shipping','orders.shipping_id','=','shipping.shipping_id')
                      ->select('orders.*','order_details.*','shipping.*','tbl_customer.*')
                      ->get();

          $view_order = view('admin.view_order')
            ->with('order_by_id', $order_by_id);

         return view('admin_layout')
            ->with('admin.view_order', $view_order);

                    
    }

}

















