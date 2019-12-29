<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

use DB;

class EmailVerficationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       




        $customers=DB::table('user_info')->where('site_id','3')->where('email','<>','')->groupBy('email')->orderby('inc_id','desc')->get();

  foreach ($customers as $customer)
        {

     
                           
     DB::table('customers_info')->insert(array('email'=>$customer->email,'phone'=>$customer->phone_no,'verified_status'=>'1'));

                 

}


exit();


        foreach ($customers as $customer)
        {
        
   
                $res = $client->post('https://api.hunter.io/v2/email-verifier?email=ticsayjulius@gmail.com&api_key=6b273dcb04c7e322280d3ea1ac7e6c93d1af550c',['auth' =>  ['user', 'pass']],[
            'json' => [ "user_id" => 1],"http_errors" => false,]);

           if($res)
           {
                 $nawa=$res->getBody();

              
                 $convertarray=json_decode($nawa,true);

                 print_r($convertarray);


                 if(isset($convertarray['data']))
                    {


                            if($convertarray['data']['result'] != "undeliverable")

                            {
                           
                               DB::table('customers_info')->insert(array('email'=>$customer->email,'phone'=>$customer->phone_no,'verified_status'=>'1'));

                            }

                         }

                  }


              }

       

      

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}
