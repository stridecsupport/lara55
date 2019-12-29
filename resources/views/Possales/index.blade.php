<!DOCTYPE html>
  <html>
    <head>
      <link rel="stylesheet" href="{{url('/pos/css/bootstrap.css')}}"/>
      <link rel="stylesheet" href="{{url('/pos/css/fontawesome.css')}}"/>
       <link rel="stylesheet" href="{{url('/pos/css/custom.css')}}"/>

    </head>

    <body class="container-fluid">
    
        
<header>        
<div class="sep-title row">
<div class="col-md-3 col">
<h6>Register : 0001</h6>
</div>
<div class="col-md-3">
<h6>Last Receipt : <b>12-HQ-18400</b></h6>
</div>
<div class="col-md-3 text-center">
<h6>Status : <b><span class="status">Online</span></b></h6>
</div>
<div class="col-md-3 text-right">
<h6>Cashier : <b>gnq</b></h6>
</div>
</div>
</header>
 <form role="form" id="pos-form" class="smart-form client-form" route='client_add' method="POST" action="{{url('/possalesstore')}}" enctype="multipart/form-data">
     <input type='hidden' name='_token' value="{!! csrf_token() !!}">
<div class="main">
<div class="row">
<div class="col-md-6 pos-panel-left">
                <div class="col-md-12 l-nospaces">
                <div class="">
                    <div class="input-group">               
                        <input class="form-control" id="demo2" autocomplete="off" onkeypress="return disableEnterKey(event)" type="text"><ul class="typeahead dropdown-menu"></ul>
                        <div class="input-group-addon" onclick="addnew()">+</div>
                    </div>
                </div>
                 <div class="pos-items-container">
                    <table id="price-list" class="price-list" style="background:#fff;" width="100%">


                    <tbody id='pricelisttbody'>
                   </tbody></table>
            
            
                    
                </div>
                <div class="row margin-off">
                <div class="col-md-5 ">
                    <div class="col-md-12 nospaces">
                        <button type="button" id="fin" data-toggle="modal" class="btn btn-success btn-lg pay_cash col-md-12"  data-target="#myModal" > CASH</button>
                      <!--  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
                    </div>
                    <div class="row margin-off">
                        <div class="col-md-6 l-nospaces" >
                        <button type="button" id="id_nets"  data-toggle="modal" class="btn btn-default btn-lg col-md-12" data-target="#myNetModal">NETS</button>
                    </div>
                    <div class="col-md-6 r-nospaces">
                        <button type="button" id="id_cc" data-toggle="modal" class="btn btn-default  btn-lg col-md-12" data-target="#myCreditModal">CREDIT</button>
                        <!--    <button type="button" class="btn btn-default btn-lg col-md-12" id='id_split'>SPLIT</button>-->

                    </div>
                    </div>
                    
                    <!--div class="col-md-6 row nospaces">

                        <button type="button" class="btn btn-default btn-lg col-md-12" id='id_split'>SPLIT</button>

                    </div-->

                    <button type="button" style="display:none;" class="pull-left btn btn-success btn-lg col-md-12" onclick='validation("cash");' id="settle" >Settle</button>
                </div>
                <div class=" pos-totals col-md-7">

                    <div class="col-md-12">

                        <input id="success" value="&quot;495&quot;," type="hidden">

                        <table width="100%">


                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td align="right">$<span id="subtotal">00.00</span>

                                        <input id="subtotal1" value="00.00" type="hidden" name='subtotal'>
                                        <input id="billdiscount" value="00.00" type="hidden" name='order_discount_amount'>

                                        
                                    </td>
                                </tr>


                                <tr id="disc" style="display:none;">
                                    <td>Discount <span class="pers"></span></td>
                                    <td align="right">$<span id="disco">0.00</span>


                                    </td>
                                </tr>

                                <tr id="redeeamt" style="display:none;">
                                    <td>Redeem (<span id="redee_pts_html"></span>pts)</td>
                                    <td align="right">$<span id="redee"></span>
                                        <input id="redee1" name="data[Sales][redeem_amt]" value="" type="hidden">
                                        <input id="redee_points" name="data[Sales][redee]" value="" type="hidden">
                                    </td>
                                </tr>
                                <tr class="service_display">
                                    <td>Service Charge</td>
                                    <td align="right"><span id="service">@if($settings !="") {{$settings[0]->service_percentage}} @endif</span>%

                                        <input name="data[Sales][service]" id="service1" value="0.00" type="hidden">
                                        <input name="data[Sales][GST_method]" value="Inclusive" type="hidden">

                                            
                                    </td>
                                </tr>



                                <tr class="gst_display">
                                    <td>GST @if($settings !="") {{$settings[0]->tax_name}} @endif</td>
                                    <td align="right"><span id="GST">@if($settings !="") {{$settings[0]->tax_percentage}} @endif</span>%

                                        <input name="gstpercentage" id="GST1" value="0.00" type="hidden">


                                    </td>
                                </tr>

                            <tr class="billdiscount_display" style='display:none;'>
                                    <td>Discount</td>
                                    <td align="right">$<span id="billdiscountview"></span>

                                        <input name="billdiscount" id="billdiscount1" value="0.00" type="hidden">


                                    </td>
                                </tr>





                                <tr>
                                    <td>TOTAL</td>
                                    <td align="right">$<span id="total">60.00</span>

                                        <input name="order_granttotal" id="total1" value="" type="hidden">

                                        



                                        <input name="order_cashierby" value=""  id='order_by' type="hidden">
                                        <input name="order_salesby" value="0" id='sales_by' type="hidden">
                                        <input name="order_paymentmode" value="" id='payment_mode' type="hidden">
                                        <input name="order_transactionnumber" value="" id='transaction_number' type="hidden">
                                        <input name="order_customerid" value="" id='customer_id' type='hidden'>
                                        <input name='order_note' value='' id='order_note' type='hidden'/>
                                        <input name='order_paymentmode' value='' id='order_paymentmode' type='hidden'/>
                                        <input name='order_payment_change' id='order_payment_change' type='hidden'>
                                        <input name='currentselecteditem' id='currentselecteditem' type='hidden'  >
                                        <input name='lastitem' id='lastitem' type='hidden' value='0'>
                                        <input name='currentselectedprice' id='currentselectedprice' type='hidden' value='0'>
                                        <input type="hidden" id="hiddenvalueforfocus" />
                                        
                                        

                                        
                                        



                                        
                                    </td>
                                </tr>


                            </tbody>




                            <tbody><tr id="vouch_show" style="display:none;">
                                <td>Voucher Redeem</td>
                                <td align="right">$<span id="vo_am">0</span>

                                </td>
                            </tr>


                            <tr id="tot_vouch_show" style="display:none;">
                                <td>Balance Payable</td>
                                <td align="right">$<span id="tot_vouch_am">0</span>

                                </td>
                            </tr>     

                            <tr id="points_show" style="display:none;">
                                <td>Earn Points</td>
                                <td align="right"><span id="pts_no">6</span>
                                    <input name="data[Sales][earnpoints]" id="earn_pts" value="6" type="hidden">
                                </td>

                            </tr>

                        </tbody></table>          


                    </div>

                </div>



</div>
                </div>
                
            </div>
<div class="col-md-6 pos-quickadd-products r-nospaces">
<div class="">
<div class="pos-quickadd-products-list pro-items1" id='productcategorydiv'>
<ul class="typeahead">
@if($category !="")
@foreach($category as $categories)
<li data-value="2">
<button type="button" class="btn btn-default" onclick="getproducts('{{$categories->category_id}}')">{{$categories->category_name}}</button>
</li>
@endforeach
@endif
</ul>
</div>
<div class="pos-category-products-list pro-items" style="display:block;">  <ul class="" id="productlistdiv">
</ul>
</div>
</div>
    
    <div class="pos-products-page-select row maring-off"> 

                <div class="col-md-8 nospaces row maring-off">
                    <div class="col-md-4 nospaces">
                        <!-- clear button-->

                            

                            
                        <div class="col-md-12 bg-color-blue txt-color-white">ITEM</div>                     

                        <!-- <button type="button" class="btn btn-default btn-lg setval11 col-md-12" data-myval='10' data-mytype='%'>x QTY</button> -->
                        <button type="button" class="btn btn-default btn-lg setval11 col-md-12" onclick="itemDiscount();" data-target="#Itemdiscount" data-toggle="modal">DISC.</button>
                        <!-- <button type="button" class="btn btn-default btn-lg setval21 col-md-12" data-myval='20' data-mytype='%'><> PRICE</button> -->


                        <button type="button" class="btn btn-danger btn-lg col-md-12" id="delete">DEL</button>
                    </div>
                    <div class="col-md-4 nospaces">
                        <div class="col-md-12 bg-color-blue txt-color-white">MEMBER</div>
                                                    <!--button type="button" class="btn btn-danger btn-lg col-md-12" id="hold">HOLD</button--> 
                        
                        <!-- <button type="button" class="btn btn-danger btn-lg col-md-12" id="void">CLEAR</button> -->
            
                        <button type="button" class="btn btn-success btn-lg col-md-12 " id="mem_btn" onclick="pointClick();">MEMBER</button>

                        <button type="button" class="btn btn-danger btn-lg col-md-12 " onclick="memCancel();" disabled="" id="mem_cancel_btn">CLR MBR</button>


                    </div>

                    <div class="col-md-4 nospaces">
                        <!--    <button type="button" class="btn btn-default btn-lg newdis col-md-12" data-mytype='%'>% DIS</button> 
                        
                                <button type="button" class="btn btn-default btn-lg newdis1 col-md-12" data-mytype='$'>$ DIS</button> 
                                
                        -->
                        <div class="col-md-12 bg-color-blue txt-color-white">SPECIAL</div>
                        <button type="button" class="btn btn-default btn-lg newdis col-md-12" data-target="#Billdiscount" data-toggle="modal">SLS DISC.</button>

                        <button type="button" class="btn btn-danger btn-lg col-md-12" disabled="" id="discount_cancel">CLR DISC.</button>
                                            </div>
                    <!-- clear button end-->
                </div>

                <div class="col-md-4 nospaces row maring-off">
                    <div class="col-md-8 nospaces">
                        <div class="col-md-12 bg-color-blue txt-color-white">ENTRY</div>
                        <button type="button" class="btn btn-warning btn-lg cuspro col-md-12" onclick="passmodal('manual','');" data-target="#ManualItems" data-toggle="modal">MANUAL ITEM</button> 
                        <button type="button" class="btn btn-default btn-lg col-md-12" id="note">NOTE</button>
                    </div>
                    <div class="col-md-4 nospaces">
                        <div class="col-md-12 bg-color-blue txt-color-white">NAV</div>
                        <button type="button" class="btn btn-default btn-lg col-md-12" id="showcat"><i class="fa fa-home fa-fw"></i></button>

                        <button type="button" class="btn btn-default btn-lg col-md-12" id="scroller-top"><i class="fa fa-caret-up"></i></button> 

                        <button type="button" class="btn btn-default btn-lg col-md-12" id="scroller-bottom"><i class="fa fa-caret-down"></i></button>



                        <!--<button type="button" class="btn btn-default btn-lg col-md-12" id="scroller-top" style="padding-top:28px;
                        
                        padding-bottom:28px;
                        "><i class="fa fa-caret-up"></i></button>           
                                                
                        <button type="button" class="btn btn-default btn-lg col-md-12" id="scroller-bottom" style="padding-top:28px;
                        
                        padding-bottom:28px;
                        "><i class="fa fa-caret-down"></i></button> -->         

                    </div>
                </div>
                
<div class="col-md-12 nospaces row maring-off" style="margin-top:10px;">
    <div class="col-md-8 pull-left btn btn-primary  btn-lg pull-right" style="min-height:54px;">
    <!--span >Member  <span class="points_value Salescust" ></span-->
    <span><span class="points_value Salescust"></span>
    <span class="pts"></span>
    <!--                                     <span>[Name]</span>    -->
    </span>
                            

    

</div>
    <a href="http://pos.stridecdev.com/webpos/Sales/index" class="col-md-2 btn bg-color-blueLight txt-color-white  btn-lg pull-right" id="back">EXIT</a>    

            
    <button type="button" class="col-md-2 btn btn-danger  btn-lg pull-right" id="void">CLEAR</button>              
    

</div>
    

                
                
                
                

            </div>
    </div>
        
        </div>
        
     </div>


    <!--Import jQuery before bootstarp.js-->
<script src="{{url('/pos/js/jquery.min.js')}} "></script>
<script src="{{url('/pos/js/bootstrap.min.js')}} "></script>
<script src="{{url('/pos/js/poscalculation.js')}}"></script>


<script>

$(document).ready(function(){

$('#total').html('0.00');
$('#total1').val('0');
$('#amount').val('');
$('#total_tot').html('00.00');
$('#balance').html('0.00');
$('#discount_input').val('0');

});

function subtotalcalculation()
{

    service_percentage=0;
    tax_percentage=0;

    value=0;
    value1=0;
    value2=0;
    $('input[name="product_totalamount[]"]').each(function() {
    var i = parseFloat($(this).val());
    // alert(i);
        if (!isNaN(i))
          {
            value1 += i;
          }
    });

    $('input[name="discount_amount_product[]"]').each(function() {
    var d = parseFloat($(this).val());
    // alert(i);
        if (!isNaN(d))
          {
            value2 += d;
          }
    });

    var value=parseFloat(value1)-parseFloat(value2);



    

    $('#subtotal').html(value);
    $('#subtotal1').val(value);
<?php 

if($settings != "")
{?>

    var service_percentage="{{$settings[0]->service_percentage}}";
    var tax_percentage="{{$settings[0]->tax_percentage}}";


<?php } ?>

    var tax_percentage_amount=((tax_percentage / 100) * value).toFixed(2);
    var service_percentage_amount=((service_percentage / 100) * value).toFixed(2);

   // alert(tax_percentage_amount);
   //alert(service_percentage_amount);

<?php if($settings!="" && $settings[0]->tax_id ==2){ ?>
    var finaltotalamount=(parseFloat(value)+parseFloat(tax_percentage_amount)+parseFloat(service_percentage_amount)).toFixed(2);<?php }else{?>
    var finaltotalamount=(parseFloat(value)+parseFloat(service_percentage_amount)).toFixed(2);<?php }?>

    $('#total').html(finaltotalamount);
    $('#total1').val(finaltotalamount);
    $('#total_tot').html(finaltotalamount);


}










</script>
<!-- Modal -->
<!-- Trigger the modal with a button -->
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <table><tbody><tr><td style="width:80%;"> 

                            <h1>Balance Payable: $<span id="total_tot">320.00</span></h1> 

 <!--<span class='col-md-offset-4 mypay-charge'>Payment Charge :<span id='paycharge' ></span> </span>-->

                        </td>




<!-- <td>   <div class="btn cash-change-message red-bg" id='redo'><span id='bal_text'>Short Of : </span><span class='cur'>$</span><span id='balance'></span></div>
       
       <button type='button' class="btn-success btn-lg"  id='cash'>PAY (F10)</button>
               
   </td> -->
                    </tr></tbody></table>
      </div>
      <div class="modal-body">
      <div class="pos-payment-methods">
       <div class="col-md-12 mycash nospaces">

                                <div class="btn-success btn-lg" style="margin-bottom:10px;">                                 
                                    <table>
                                        <tbody><tr><td>
                                                <label>Customer Pay in <span id="cash_ch">Cash </span>:&nbsp;</label> 
                                            </td>
                                            <td>
                                                <!-- onkeyup="return bal_amount(this.value,$('#total').html())" onchange="return bal_amount(this.value,$('#total').html())" -->
                                                <input  class="form-control input-lg pay-txt defaultKeypad_bycash 0" id="amount"  oninput="bal_amount();" type="text">
                                            </td></tr>
                                    </tbody></table>
                                    <input id="my_am1" name="data[Sales][multiple_amount][0]" type="hidden">


                                    <input name="data[Sales][payment_mode][0]" id="payment_mode" value="Cash" type="hidden">

                                    <input name="data[Sales][payment_charge][0]" id="payment_charge" value="" type="hidden">

                                    <input name="data[Sales][referit][0]" value="0" checked="" style="display:none;" type="checkbox">

                                </div>
                            </div>
        <div id="keypadTest_bycash" class="keypad-size-item pull-left is-keypad"> <div class="keypad-inline"><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("7","amount","1");'>7</button><button type="button" class="keypad-key" onclick='calculator("8","amount","1");'>8</button><button type="button" class="keypad-key" onclick='calculator("9","amount","1");'>9</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("4","amount","1");'>4</button><button type="button" class="keypad-key" onclick='calculator("5","amount","1");'>5</button><button type="button" class="keypad-key" onclick='calculator("6","amount","1");'>6</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("1","amount","1");'>1</button><button type="button" class="keypad-key" onclick='calculator("2","amount","1");'>2</button><button type="button" class="keypad-key" onclick='calculator("3","amount","1");'>3</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator(".","amount","1");'>.</button><button type="button" class="keypad-key" onclick='calculator("0","amount","1");'>0</button><button type="button" class="keypad-special keypad-clear" title="Erase all the text" onclick='calculator("C","amount","1");'>C</button></div></div></div>
        
        <div class="pull-right">

                                <div class="pull-right">
                                    <div class="btn cash-change-message red-bg" id="redo"><span id="bal_text">Short Of : </span><span class="cur">$</span><span id="balance">320.00</span><input name="data[Sales][balance]" class="balance" value="320.00" type="hidden"></div>
                                </div>

                                <div class="pay-bottom">
                                    <span id="salesby_error" class="span-msg col col-10"></span>
                                    <div class="">
                                        <table class="pull-right">

                                            <tbody><tr><td>
                                                    <label>Sales By :</label>
                                                </td></tr>  
                                            <tr><td>                                    
                                                    <label class="select"> 
                                                        <select  class="spl-select"  onchange="salesby(this.value);">
                                                            <option value="0" selected></option>
                                                                @if(count($salesperson)>0)
                                                                @foreach($salesperson as $person)
                                                                <option value="{{$person->salesperson_id}}">{{$person->salesperson_name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>                                       
                                                    </label>

                                                </td> </tr> 
                                        </tbody></table>    
                                    </div>

                                    <div class="">
                                        <div class="">
                                              
                                        </div>                              
                                    </div>


                                </div>

                                <div>

                                    <button type="button" class="btn btn-success btn-lg pull-right spl" id="cash" onclick="validation('cash')">SETTLE</button>                           
                                </div>      
                            </div>
                            </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>


<!-- Modal Item Discount-->
<div id="Itemdiscount" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <table><tbody><tr><td style="width:80%;"> 

                            <h4>Please Enter the Discount Amount</h4> 

 <!--<span class='col-md-offset-4 mypay-charge'>Payment Charge :<span id='paycharge' ></span> </span>-->

                        </td>




<!-- <td>   <div class="btn cash-change-message red-bg" id='redo'><span id='bal_text'>Short Of : </span><span class='cur'>$</span><span id='balance'></span></div>
       
       <button type='button' class="btn-success btn-lg"  id='cash'>PAY (F10)</button>
               
   </td> -->
                    </tr></tbody></table>
      </div>
      <div class="modal-body">
      <div class="pos-payment-methods">
       <div class="col-md-12 mycash nospaces">

                                <div class="btn-success btn-lg" style="margin-bottom:10px;">                                 
                                    <table>
                                        <tbody><tr><td>
                                               <!-- <label>Customer Pay in <span id="cash_ch">Cash </span>:&nbsp;</label> -->
                                            </td>
                                            <td>
                                                <!-- onkeyup="return bal_amount(this.value,$('#total').html())" onchange="return bal_amount(this.value,$('#total').html())" -->
                                                <input  class="form-control input-lg pay-txt defaultKeypad_bycash 0" value='0' type="text" id='discount_input'>
                                            </td></tr>
                                    </tbody></table>
                                

                                </div>
                            </div>
        <div  class="keypad-size-item pull-left is-keypad"> <div class="keypad-inline"><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("7","discount_input","discount");'>7</button><button type="button" class="keypad-key" onclick='calculator("8","discount_input","discount");'>8</button><button type="button" class="keypad-key" onclick='calculator("9","discount_input","discount");'>9</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("4","discount_input","discount");'>4</button><button type="button" class="keypad-key" onclick='calculator("5","discount_input","discount");'>5</button><button type="button" class="keypad-key" onclick='calculator("6","discount_input","discount");'>6</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("1","discount_input","discount");'>1</button><button type="button" class="keypad-key" onclick='calculator("2","discount_input","discount");'>2</button><button type="button" class="keypad-key" onclick='calculator("3","discount_input","discount");'>3</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator(".","discount_input","discount");'>.</button><button type="button" class="keypad-key" onclick='calculator("0","discount_input","discount");'>0</button><button type="button" class="keypad-special keypad-clear" title="Erase all the text" onclick='calculator("C","discount_input","discount");'>C</button></div></div></div>
        
        <div class="pull-right">

                                <div class="pull-right">
                     
                                </div>

                                <div class="pay-bottom">
                                    <span id="salesby_error" class="span-msg col col-10"></span>
                                    <div class="">
                                        <table class="pull-right">

                                            <tbody><tr><td>
                                                     <button type="button" class="btn btn-success btn-lg pull-right spl" onclick="discountcalculation('1');">% Dis</button>    
                                                </td></tr>  
                                            <tr><td>                                    
                                                    
                                                    <button type="button" class="btn btn-success btn-lg pull-right spl" onclick="discountcalculation('2');" >$ Dis</button>    
                                                </td> </tr> 
                                        </tbody></table>    
                                    </div>

                                    <div class="">
                                        <div class="">
                                              
                                        </div>                              
                                    </div>


                                </div>

                                <div>

                                                          
                                </div>      
                            </div>
                            </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>


<!-- Modal Item Discount-->
<div id="Billdiscount" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <table><tbody><tr><td style="width:80%;"> 

                            <h4>Please Enter the Bill Discount Amount</h4> 

 <!--<span class='col-md-offset-4 mypay-charge'>Payment Charge :<span id='paycharge' ></span> </span>-->

                        </td>




<!-- <td>   <div class="btn cash-change-message red-bg" id='redo'><span id='bal_text'>Short Of : </span><span class='cur'>$</span><span id='balance'></span></div>
       
       <button type='button' class="btn-success btn-lg"  id='cash'>PAY (F10)</button>
               
   </td> -->
                    </tr></tbody></table>
      </div>
      <div class="modal-body">
      <div class="pos-payment-methods">
       <div class="col-md-12 mycash nospaces">

                                <div class="btn-success btn-lg" style="margin-bottom:10px;">                                 
                                    <table>
                                        <tbody><tr><td>
                                               <!-- <label>Customer Pay in <span id="cash_ch">Cash </span>:&nbsp;</label> -->
                                            </td>
                                            <td>
                                                <!-- onkeyup="return bal_amount(this.value,$('#total').html())" onchange="return bal_amount(this.value,$('#total').html())" -->
                                                <input  class="form-control input-lg pay-txt defaultKeypad_bycash 0" value='0' type="text" id='bill_discount_input'>
                                            </td></tr>
                                    </tbody></table>
                                

                                </div>
                            </div>
        <div  class="keypad-size-item pull-left is-keypad"> <div class="keypad-inline"><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("7","bill_discount_input","discount");'>7</button><button type="button" class="keypad-key" onclick='calculator("8","bill_discount_input","discount");'>8</button><button type="button" class="keypad-key" onclick='calculator("9","bill_discount_input","discount");'>9</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("4","bill_discount_input","discount");'>4</button><button type="button" class="keypad-key" onclick='calculator("5","bill_discount_input","discount");'>5</button><button type="button" class="keypad-key" onclick='calculator("6","bill_discount_input","discount");'>6</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("1","bill_discount_input","discount");'>1</button><button type="button" class="keypad-key" onclick='calculator("2","bill_discount_input","discount");'>2</button><button type="button" class="keypad-key" onclick='calculator("3","bill_discount_input","discount");'>3</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator(".","bill_discount_input","discount");'>.</button><button type="button" class="keypad-key" onclick='calculator("0","bill_discount_input","discount");'>0</button><button type="button" class="keypad-special keypad-clear" title="Erase all the text" onclick='calculator("C","bill_discount_input","discount");'>C</button></div></div></div>
        
        <div class="pull-right">

                                <div class="pull-right">
                     
                                </div>

                                <div class="pay-bottom">
                                    <span id="salesby_error" class="span-msg col col-10"></span>
                                    <div class="">
                                        <table class="pull-right">

                                            <tbody><tr><td>
                                                     <button type="button" class="btn btn-success btn-lg pull-right spl" onclick="billdiscountcalculation('1');">% Dis</button>    
                                                </td></tr>  
                                            <tr><td>                                    
                                                    
                                                    <button type="button" class="btn btn-success btn-lg pull-right spl" onclick="billdiscountcalculation('2');" >$ Dis</button>    
                                                </td> </tr> 
                                        </tbody></table>    
                                    </div>

                                    <div class="">
                                        <div class="">
                                              
                                        </div>                              
                                    </div>


                                </div>

                                <div>

                                                          
                                </div>      
                            </div>
                            </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>


<!-- Modal Item Discount-->
<div id="ManualItems" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <table><tbody><tr><td style="width:80%;"> 

                            <h4>Manual Item</h4> 

 <!--<span class='col-md-offset-4 mypay-charge'>Payment Charge :<span id='paycharge' ></span> </span>-->

                        </td>




<!-- <td>   <div class="btn cash-change-message red-bg" id='redo'><span id='bal_text'>Short Of : </span><span class='cur'>$</span><span id='balance'></span></div>
       
       <button type='button' class="btn-success btn-lg"  id='cash'>PAY (F10)</button>
               
   </td> -->
                    </tr></tbody></table>
      </div>
      <div class="modal-body">
      <div class="pos-payment-methods">
       <div class="col-md-12 mycash nospaces">

                                <div class="btn-success btn-lg" style="margin-bottom:10px;">                                 
                                    <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Qty</th>
                                                    <th>Selling Price ($)</th>
                                                </tr>
                                            </thead>
                                            <tbody><tr>
                                                <td><input id="cus_pro" class="form-control defaultKeypad_manual" type="text"></td> 

                                                <td style="width:15%;"><input id="cus_qty" onchange="gettot()" onkeypress="return isNumber(event)" class="form-control defaultKeypad_manual qty" type="text"></td>  

                                                <td style="width:25%;"><input id="cus_uprice" onchange="gettot()" onkeypress="return isDecimal(event)" class="form-control defaultKeypad_manual price" type="text">

                                                    <input id="cus_tprice" value="" type="hidden">

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                

                                </div>
                            </div>
        <div  class="keypad-size-item pull-left is-keypad"> <div class="keypad-inline"><div class="keypad-row"><button type="button" class="keypad-key" onclick='manualcalculator("7");'>7</button><button type="button" class="keypad-key" onclick='manualcalculator("8");'>8</button><button type="button" class="keypad-key" onclick='manualcalculator("9");'>9</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='manualcalculator("4");'>4</button><button type="button" class="keypad-key" onclick='manualcalculator("5");'>5</button><button type="button" class="keypad-key" onclick='manualcalculator("6");'>6</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='manualcalculator("1");'>1</button><button type="button" class="keypad-key" onclick='manualcalculator("2");'>2</button><button type="button" class="keypad-key" onclick='manualcalculator("3");'>3</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='manualcalculator(".");'>.</button><button type="button" class="keypad-key" onclick='manualcalculator("0");'>0</button><button type="button" class="keypad-special keypad-clear" title="Erase all the text" onclick='manualcalculator("C");'>C</button></div></div></div>
        
        <div class="pull-right">

                                <div class="pull-right">
                     
                                </div>

                                <div class="pay-bottom">
                                    <span id="salesby_error" class="span-msg col col-10"></span>
                                    <div class="">
                                        <table class="pull-right">

                                            <tbody><tr><td>
                                                     <button type="button" class="btn btn-success btn-lg pull-right spl" onclick="addmanualentry();">ADD</button>    
                                                </td></tr>  
                                     
                                        </tbody></table>    
                                    </div>

                                    <div class="">
                                        <div class="">
                                              
                                        </div>                              
                                    </div>


                                </div>

                                <div>

                                                          
                                </div>      
                            </div>
                            </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>


<div id="myNetModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <table><tbody><tr><td style="width:80%;"> 

                            <h1>Nets<span></span></h1> 

 <!--<span class='col-md-offset-4 mypay-charge'>Payment Charge :<span id='paycharge' ></span> </span>-->

                        </td>


                        

<!-- <td>   <div class="btn cash-change-message red-bg" id='redo'><span id='bal_text'>Short Of : </span><span class='cur'>$</span><span id='balance'></span></div>
       
       <button type='button' class="btn-success btn-lg"  id='cash'>PAY (F10)</button>
               
   </td> -->
                    </tr></tbody></table>
      </div>
      <div class="modal-body">
      <div class="pos-payment-methods">
       <div class="col-md-12 mycash nospaces">

                                <div class="btn-success btn-lg" style="margin-bottom:10px;">                                 
                                    <table>
                                        <tbody><tr><td>
                                                <label>Transaction Ref: <span id="cash_ch_nets"> </span>:&nbsp;</label> 
                                            </td>
                                            <td>
                                                <!-- onkeyup="return bal_amount(this.value,$('#total').html())" onchange="return bal_amount(this.value,$('#total').html())" -->
                                                <input  class="form-control input-lg pay-txt defaultKeypad_bycash 0" id="amount_nets" name='order_transactionnumber' oninput="transaction_ref(this.value,'cash_ch_nets');" type="text">
                                            </td></tr>
                                    </tbody></table>
                                    <input id="my_am1" name="data[Sales][multiple_amount][0]" type="hidden">


                                    <input name="data[Sales][payment_mode][0]" id="payment_mode" value="Cash" type="hidden">

                                    <input name="data[Sales][payment_charge][0]" id="payment_charge" value="" type="hidden">

                                    <input name="data[Sales][referit][0]" value="0" checked="" style="display:none;" type="checkbox">

                                </div>
                            </div>
        <div id="keypadTest_bycash" class="keypad-size-item pull-left is-keypad"> <div class="keypad-inline"><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("7","amount_nets","0");'>7</button><button type="button" class="keypad-key" onclick='calculator("8","amount_nets","0");'>8</button><button type="button" class="keypad-key" onclick='calculator("9","amount_nets","0");'>9</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("4","amount_nets","0");'>4</button><button type="button" class="keypad-key" onclick='calculator("5","amount_nets","0");'>5</button><button type="button" class="keypad-key" onclick='calculator("6","amount_nets","0");'>6</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("1","amount_nets","0");'>1</button><button type="button" class="keypad-key" onclick='calculator("2","amount_nets","0");'>2</button><button type="button" class="keypad-key" onclick='calculator("3","amount_nets","0");'>3</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator(".","amount_nets","0");'>.</button><button type="button" class="keypad-key" onclick='calculator("0","amount_nets","0");'>0</button><button type="button" class="keypad-special keypad-clear" title="Erase all the text" onclick='calculator("C","amount_nets","0");'>C</button></div></div></div>
        
        <div class="pull-right">

                              <!--  <div class="pull-right">
                                    <div class="btn cash-change-message red-bg" id="redo"><span id="bal_text">Short Of : </span><span class="cur">$</span><span id="balance">320.00</span><input name="data[Sales][balance]" class="balance" value="320.00" type="hidden"></div>
                                </div>-->

                                <div class="pay-bottom">
                                    <span id="salesby_error" class="span-msg col col-10"></span>
                                    <div class="">
                                        <table class="pull-right">

                                            <tbody><tr><td>
                                                    <label>Sales By :</label>
                                                </td></tr>  
                                            <tr><td>                                    
                                                    <label class="select"> 
                                                        <select name="" class="spl-select" onchange="salesby(this.value);" id='salesbynets'>
                                                            <option value="0"></option>
                                                            @if(count($salesperson)>0)
                                                            @foreach($salesperson as $person)
                                                            <option value="{{$person->salesperson_id}}">{{$person->salesperson_name}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>                                             
                                                    </label>

                                                </td> </tr> 
                                        </tbody></table>    
                                    </div>

                                    <div class="">
                                        <div class="">
                                              
                                        </div>                              
                                    </div>


                                </div>

                                <div>

                                    <button type="button" class="btn btn-success btn-lg pull-right spl" id="cash" onclick='validation("nets");'>SETTLE</button>                           
                                </div>      
                            </div>
                            </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>


<div id="myCreditModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <table><tbody><tr><td style="width:80%;"> 

                            <h1>Credit Card<span></span></h1> 

 <!--<span class='col-md-offset-4 mypay-charge'>Payment Charge :<span id='paycharge' ></span> </span>-->

                        </td>


                        

<!-- <td>   <div class="btn cash-change-message red-bg" id='redo'><span id='bal_text'>Short Of : </span><span class='cur'>$</span><span id='balance'></span></div>
       
       <button type='button' class="btn-success btn-lg"  id='cash'>PAY (F10)</button>
               
   </td> -->
                    </tr></tbody></table>
      </div>
      <div class="modal-body">
      <div class="pos-payment-methods">
       <div class="col-md-12 mycash nospaces">

                                <div class="btn-success btn-lg" style="margin-bottom:10px;">                                 
                                    <table>
                                        <tbody><tr><td>
                                                <label>Transaction Ref:<span id="cash_ch_credits"> </span>:&nbsp;</label> 
                                            </td>
                                            <td>
                                                <!-- onkeyup="return bal_amount(this.value,$('#total').html())" onchange="return bal_amount(this.value,$('#total').html())" -->
                                                
                                                <input  class="form-control input-lg pay-txt defaultKeypad_bycash 0" id="cash_ch_credit" name='order_transactionnumber' oninput="transaction_ref(this.value,'cash_ch_credits');" type="text">
                                            </td></tr>
                                    </tbody></table>
                                    <input id="my_am1" name="data[Sales][multiple_amount][0]" type="hidden">


                                    <input name="data[Sales][payment_mode][0]" id="payment_mode" value="Cash" type="hidden">

                                    <input name="data[Sales][payment_charge][0]" id="payment_charge" value="" type="hidden">

                                    <input name="data[Sales][referit][0]" value="0" checked="" style="display:none;" type="checkbox">

                                </div>
                            </div>
        <div id="keypadTest_bycash" class="keypad-size-item pull-left is-keypad"> <div class="keypad-inline"><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("7","cash_ch_credit","0");'>7</button><button type="button" class="keypad-key" onclick='calculator("8","cash_ch_credit","0");'>8</button><button type="button" class="keypad-key" onclick='calculator("9","cash_ch_credit","0");'>9</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("4","cash_ch_credit","0");'>4</button><button type="button" class="keypad-key" onclick='calculator("5","cash_ch_credit","0");'>5</button><button type="button" class="keypad-key" onclick='calculator("6","cash_ch_credit","0");'>6</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator("1","cash_ch_credit","0");'>1</button><button type="button" class="keypad-key" onclick='calculator("2","cash_ch_credit","0");'>2</button><button type="button" class="keypad-key" onclick='calculator("3","cash_ch_credit","0");'>3</button></div><div class="keypad-row"><button type="button" class="keypad-key" onclick='calculator(".","cash_ch_credit","0");'>.</button><button type="button" class="keypad-key" onclick='calculator("0","cash_ch_credit","0");'>0</button><button type="button" class="keypad-special keypad-clear" title="Erase all the text" onclick='calculator("C","cash_ch_credit","0");'>C</button></div></div></div>
        
        <div class="pull-right">

                               <!-- <div class="pull-right">
                                    <div class="btn cash-change-message red-bg" id="redo"><span id="bal_text">Short Of : </span><span class="cur">$</span><span id="balance">320.00</span><input name="data[Sales][balance]" class="balance" value="320.00" type="hidden"></div>
                                </div>-->

                                <div class="pay-bottom">
                                    <span id="salesby_error" class="span-msg col col-10"></span>
                                    <div class="">
                                        <table class="pull-right">

                                            <tbody>
                                                <tr><td>
                                                    <label>Sales By :</label>
                                                </td></tr>  
                                            <tr><td>                                    
                                                    <label class="select"> 
                                                        <select name="" class="spl-select" onchange="salesby(this.value);" id='salesbycard'>
                                                                <option value="0"></option>
                                                                @if(count($salesperson)>0)
                                                                @foreach($salesperson as $person)
                                                                <option value="{{$person->salesperson_id}}">{{$person->salesperson_name}}</option>
                                                                @endforeach
                                                                @endif
                                                        </select>                                             
                                                    </label>

                                                </td> </tr> 


                                                <tr><td>
                                                    <label>Card type:</label>
                                                </td></tr>  
                                            <tr><td>                                    
                                                    <label class="select"> 
                                                        <select name="data[Sales][salesby]" class="spl-select" id='cardtype'>
                                                            <option value="0"></option>
                                                            <option value="10">He Qing Qing</option>
                                                            <option value="28">NG LEE LEE</option>
                                                            <option value="6">Shirley Hong</option>
                                                            <option value="18">WU HONG</option>
                                                            <option value="19">Yu Ling</option>
                                                            </select>                                       
                                                    </label>

                                                </td> </tr> 


                                        </tbody></table>    
                                    </div>

                                    <div class="">
                                        <div class="">
                                              
                                        </div>                              
                                    </div>


                                </div>

                                <div>

                                    <button type="button" class="btn btn-success btn-lg pull-right spl" id="cash" onclick='validation("card");'>SETTLE</button>                           
                                </div>      
                            </div>
                            </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
</form>
<script>
$("#cus_pro").focus(function(){
   
   $("#hiddenvalueforfocus").val('cus_pro'); 
   
});

$("#cus_qty").focus(function(){
   
   $("#hiddenvalueforfocus").val('cus_qty'); 
   
});

$("#cus_uprice").focus(function(){
   
   $("#hiddenvalueforfocus").val('cus_uprice'); 
   
});


</script>
    </body>
  </html>
   <style>.sep-title.row {
    border-bottom: 1px solid #eee;
}</style>     