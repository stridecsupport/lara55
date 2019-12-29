<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

use Session;

class PossalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $category=DB::table('category')->where('activestatus','0')->get();

      $categoryid=$request->input('categoryid');

      $settings=DB::table('settings')->join('tax','tax.tax_id','=','settings.tax_id')->select('settings.*', 'tax.tax_name')->get();

      $salesperson=DB::table('salesperson')->where('activestatus','0')->get();



      $tax="";

      $service_charges="";

      

      $products="";

    






      

        return view('Possales.index',['category'=>$category,'products'=>$products,'settings'=>$settings,'salesperson'=>$salesperson]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function possalesstore(Request $request)
    {

        //print_r($request->input());



        $order_date=date('Y-m-d');
        $order_discount_amount=$request->input('billdiscount');
        $order_subtotal=$request->input('subtotal');
        $order_granttotal=$request->input('order_granttotal');
        $order_paymentmode=$request->input('order_paymentmode');
        $order_salesby=$request->input('order_salesby');
        $order_cashierby=$request->input('order_cashierby');
        $order_transactionnumber=$request->input('order_transactionnumber');
        $order_customerid=$request->input('order_customerid');
        $order_note=$request->input('order_note');
        $order_payment_change=$request->input('order_payment_change');
        $order_card_type=$request->input('order_card_type');
    

        $product_name=$request->input('product_name');
        $product_quantity=$request->input('product_quantity');
        $product_item_discount=$request->input('discount_amount_product');
        $product_price=$request->input('product_price');
        $product_totalamount=$request->input('product_totalamount');


        $lastid=DB::table('orders')->insertGetId(array('order_date'=>$order_date,'order_discount_amount'=>$order_discount_amount,'order_subtotal'=>$order_subtotal,'order_granttotal'=>$order_granttotal,'order_paymentmode'=>$order_paymentmode,'order_salesby'=>$order_salesby,'order_cashierby'=>$order_cashierby,'order_transactionnumber'=>$order_transactionnumber,'order_customerid'=>$order_customerid,'order_note'=>$order_note,'order_payment_change'=>$order_payment_change,'order_card_type'=>$order_card_type,'order_paymentmode'=>$order_paymentmode));

     
        foreach ($product_name as $key => $value)
        {
           DB::table('order_details')->insert(array('product_name'=>$value,'product_quantity'=>$product_quantity[$key],'product_totalamount'=>$product_totalamount[$key],'product_price'=>$product_price[$key],'order_id'=>$lastid,'product_item_discount'=>$product_item_discount[$key]));
        }


      return redirect('/possales');




         
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
 



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function productdetails(Request $request)
	{

        $result='';
        $productid=array();
        $productname=array();
        $productprice=array();
        $id="";
        $name="";
        $price="";



		if($request->ajax())
        {
           $categoryid=$request->input('categoryid');
           $products=DB::table('product')->where('product_category_id',$categoryid)->get();
           if(count($products)>0)
           { 
              foreach ($products as $product) {
                  $productid[]=$product->product_id;
                  $productname[]=$product->product_name;
                  $productprice[]=$product->product_price;

              }

              if($productid)
              {
                  $id=@implode(',',$productid);
                  $name=@implode(',',$productname);
                  $price=@implode(',',$productprice);
              }


           }

           $result=$id."#".$name."#".$price;
        }

        echo $result;
		
	}


    public function eachproductdetails(Request $request)
    {

        $result='';
       
        $productname="";
        $productprice="";
   


        if($request->ajax())
        {
           $productid=$request->input('productid');
           $products=DB::table('product')->where('product_id',$productid)->get();
           if(count($products)>0)
           { 
               $productprice=$products[0]->product_price;
               $productname=$products[0]->product_name;


           }

           $result=$productprice."#".$productname;
        }

        echo $result;
        
    }
	
	public function customerdetails(Request $request)
	{
		
		
	}

    public function denyograph(Request $request)
    {

         
    }

     public function denyograph1(Request $request)
    {

         
    }

    public function googlechartdenyo(Request $request)
    {
         
    }
}
