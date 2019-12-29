<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

use Session;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      


       $innerjoin= DB::table('quotation_parents')->join('quotation_childs','quotation_parents.id','=','quotation_childs.quote_parent_id')->select('quotation_parents.*', 'quotation_childs.id')->get();
         



        print_r($innerjoin);

        exit();

        return view('Quotation.index');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$company=DB::table('companies')->where('activestatus','0')->get();
		$customers=DB::table('customers')->where('activestatus','0')->get();
		$product=DB::table('products')->get();
        return view('Quotation.createnew',['products'=>$product,'customers'=>$customers,'company'=>$company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



         $product_description=$request->input('product_description');
         $input_type=$request->input('input_type');
         $subtotal_section_qty=$request->input('subtotal_section_qty');
       
         $quantity=$request->input('quantity');
         $cost_price=$request->input('cost_price');
         $unit_price=$request->input('unit_price');
         $percentage=$request->input('percentage');
         $margin=$request->input('margin');
         $amount=$request->input('amount');
         $product_check=$request->input('checkboxhidden');
   


        $companyid=$request->input('companyid');
        $customerid=$request->input('customerid');
        $customeremails=$request->input('customeremails');
        $validity=$request->input('validity');
        $subject=$request->input('subject');
        $productid=$request->input('productid');
        $product_grandtotal=$request->input('product_grandtotal');
        $parent_section_id='';
        $lastsectionid=array();


        DB::table('quotation_parents')->insert(array('customer_id'=>$customerid,'grandtotal'=>$product_grandtotal,'company_id'=>$companyid,'validity'=>$validity,'subject'=>$subject));
        
        $lastid=DB::table('quotation_parents')->orderBy('id','desc')->skip(0)->take(1)->get();



        foreach($product_description as $key => $value)
        {

         
            DB::table('quotation_childs')->insert(array('item_description'=>$value,'quote_parent_id'=>$lastid[0]->id,'product_id'=>$productid[$key],'subtotal'=>$amount[$key],'product_cost'=>$cost_price[$key],'unit_cost'=>$unit_price[$key],'product_check'=>$product_check[$key],'quantity'=>$quantity[$key],'percentage'=>$percentage[$key],'margin'=>$margin[$key],'Input_type'=>$input_type[$key]));  

       
        }
          
        




        

		
		return redirect('/quotation/create');
		
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

        $company=DB::table('companies')->where('activestatus','0')->get();
        $customers=DB::table('customers')->where('activestatus','0')->get();
        $product=DB::table('products')->get();

        $parent_quote_id=DB::table('quotation_parents')->where('id',$id)->get();
        $child_quote_items=DB::table('quotation_childs')->where('quote_parent_id',$id)->get();

        return view('Quotation.edit',['products'=>$product,'customers'=>$customers,'company'=>$company,'parent_quote_id'=>$parent_quote_id,'child_quote_items'=>$child_quote_items]);

        
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
 



         $product_description=$request->input('product_description');
         $input_type=$request->input('input_type');
         $subtotal_section_qty=$request->input('subtotal_section_qty');
       
         $quantity=$request->input('quantity');
         $cost_price=$request->input('cost_price');
         $unit_price=$request->input('unit_price');
         $percentage=$request->input('percentage');
         $margin=$request->input('margin');
         $amount=$request->input('amount');
         $product_check=$request->input('checkboxhidden');




        $companyid=$request->input('companyid');
        $customerid=$request->input('customerid');
        $customeremails=$request->input('customeremails');
        $validity=$request->input('validity');
        $subject=$request->input('subject');
        $productid=$request->input('productid');
        $product_grandtotal=$request->input('product_grandtotal');
        $parent_section_id='';
        $lastsectionid=array();


        DB::table('quotation_parents')->where('id',$id)->update(array('customer_id'=>$customerid,'grandtotal'=>$product_grandtotal,'company_id'=>$companyid,'validity'=>$validity,'subject'=>$subject));
        
      
        DB::table('quotation_childs')->where('quote_parent_id',$id)->delete();



        foreach($product_description as $key => $value)
        {

         
            DB::table('quotation_childs')->insert(array('item_description'=>$value,'quote_parent_id'=>$id,'product_id'=>$productid[$key],'subtotal'=>$amount[$key],'product_cost'=>$cost_price[$key],'unit_cost'=>$unit_price[$key],'product_check'=>$product_check[$key],'quantity'=>$quantity[$key],'percentage'=>$percentage[$key],'margin'=>$margin[$key],'Input_type'=>$input_type[$key]));  

       
        }


        return redirect('/quotation/create');
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
		if($request->ajax())
		{
			$result="";
			$id=$request->input('productid');
		    $product=DB::table('products')->where('id',$id)->get();
			
		}
		
		echo $result=$product[0]->description."#".$product[0]->product_cost."#".$product[0]->product_price;
		
	}
	
	public function customerdetails(Request $request)
	{
		if($request->ajax())
		{
			$result="";
			$id=$request->input('customerid');
		    $customer=DB::table('customers')->where('id',$id)->get();
			
		}
		
		echo $result=$customer[0]->email;
		
	}

    public function denyograph(Request $request)
    {

          return view('Quotation.denyograph');
    }

     public function denyograph1(Request $request)
    {

          return view('Quotation.denyograph1');
    }

    public function googlechartdenyo(Request $request)
    {
         $users=DB::connection('mysql2')->table('User')->get();

         print_r($users);

         exit();

        return view('Quotation.googlechartdenyo');
    }
}
