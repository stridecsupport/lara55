

// call this function onclick of the category to get Products of the category 
function getproducts(categoryid)
{

   var categoryid=categoryid;
   var token = $('input[name=_token]').val();   //pass into ajax 
   if(categoryid != "") 
   {
       $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        method: "GET",
        url : "{{ url('/productdetails') }}",  
        data: {categoryid: categoryid},   
        success : function(data){ 

    if(data)
    {

         $("#productcategorydiv").css("display", "none");
  

        var result = data.split("#");
        var productid=result[0];   // get productid
        var productname=result[1];  // get product name
        var productprice=result[2]; // get product price

        var productids=productid.split(",");
        var productnames=productname.split(",");
        var productprices=productprice.split(",");

     

            for(var i=0;i < productids.length;i++)
            {

              // append products of category to the left panel 
            $('#productlistdiv').append('<li data-value="487"><button type="button" style="width: 25%;  white-space:inherit;" class="btn btn-primary hide487" onclick="getproductdetails('+productids[i]+');">'+productnames[i]+'</button></li>');

            }

    }

},error: function(ts) { alert("Please Select valid Product Code"); }

});
}
}

function getproductdetails(productid)  // this function is call on the product click to get the details of the product
{

      var productid=productid;

         if ($('#producttotalprice'+productid).length)   // if product already exist it will calculate the price and increment the quantity
         {
                  
                  var incquantity=$('#productquantity'+productid).val();
                  var producttotalprice=$('#producttotalprice'+productid).val();
                  incquantity++;  // quantity increment
                  $('#productquantity'+productid).val(incquantity);
                  $('#qty'+productid).html(incquantity);
                  var finaltotalprice=parseFloat(incquantity)*parseFloat(producttotalprice);
                  $('#price'+productid).html(finaltotalprice);
                  $('#producttotalprice'+productid).val(finaltotalprice);  
                  subtotalcalculation();  
        }

        else    // if the product is new then this part is cal
        {
                var token = $('input[name=_token]').val();   //pass into ajax 
                if(productid != "") 
                {
                        $.ajax({
                        headers: {'X-CSRF-TOKEN': token},
                        method: "GET",
                        url : "{{ url('/eachproductdetails') }}",  // details of each product in ajax
                        data: {productid: productid},   
                        success : function(data){ 


                                if(data)
                                {

                                    var result = data.split("#");
                                    var productprice=result[0];
                                    var productname=result[1];
                                    // appending in the Right panel dynamically .
                                    $('#pricelisttbody').append('<tr id="495" class="highlighted" onclick="selecteditems('+productid+','+productprice+')"><input type="hidden" name="product_name[]" value="'+productname+'"/><input type="hidden" name="product_price[]" value="'+productprice+'"/><td>'+productname+'</td><td align="right">$<span id="price495">'+productprice+'</span></td><td align="right">x</td><td id="qty'+productid+'" align="right">1</td><td align="right">$<span id="price'+productid+'">'+productprice+'</span><input type="hidden" value='+productprice+' id="producttotalprice'+productid+'" name="product_totalamount[]" /><input type="hidden" value="1" name="product_quantity[]" id="productquantity'+productid+'" /><input type="hidden" name="product_item_discount[]" id="product_item_discount'+productid+'"/></td></tr><tr id="item_dis'+productid+'" style="display:none;" class=""><td></td><td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;DISCOUNT <span class="per_symbol'+productid+'"></span></td><td colspan="2" align="right">-$<span id="item_dis_amt'+productid+'">90.00</span><input type="hidden" id="discount_amount_product'+productid+'" name="discount_amount_product[]"/></td></tr>');
                                    $('#lastitem').val(productid);
                                    $('#lastitemprice').val(productprice);

                                }

                             subtotalcalculation();  // Overall Common Calculation

                          
                            },error: function(ts) { alert("Please Select valid Product Code"); }

                         });
                }

        }

}

// Common function for calcultor need to send the value , spanid to which it has to show and type parameters
function calculator(value,spanid,enable)
{
    

 if(value == "C")
 {
    $('#'+spanid).val('');
 }
 else if(enable == 'discount')
 {
       var inputElementIs = document.getElementById(spanid);
       inputElementIs.value = inputElementIs.value + value;

       var totalinput=document.getElementById(spanid).value;
 }
 else
 {
       var inputElementIs = document.getElementById(spanid);
       inputElementIs.value = inputElementIs.value + value;

       var totalinput=document.getElementById(spanid).value;

       if(enable == 1)
       {
           bal_amount(totalinput);
   
       }

       
 }

 }

// this function is used for manual entry of the product those who need to add instantly
 function manualcalculator(value)
{
    var spanid=$('#hiddenvalueforfocus').val();



     if(value == "C")
     {
        $('#'+spanid).val('');
     }
 
     else
     {
           var inputElementIs = document.getElementById(spanid);
           inputElementIs.value = inputElementIs.value + value;

           var totalinput=document.getElementById(spanid).value;
     }

 }

 function bal_amount(totalinput)   // to know the balance amount when cash is paid 
 {
   

     var grandtotal=$('#total1').val();
     var balance=parseFloat(grandtotal)-parseFloat(totalinput);
     $('#balance').html(balance);

     if(totalinput > grandtotal)
     {
        $('#bal_text').html('Change');
        $('#bal_text').css('color','#32CD32');
     
     }
}

function validation(paymentmode)   // validation part when settle the cash 

{
    
    $("#payment_mode").val(paymentmode);
    var grandtotal=$('#total1').val();
    var cashpaid=$('#amount').val();
    var sales_by =$('#sales_by').val();
    var salesbynets= $('#salesbynets').val();
    var salesbycard=$('#salesbycard').val();
    var cardtype= $('#cardtype').val();
    var cash_ch_credit=$('#cash_ch_credit').val();
    var amount_nets=$('#amount_nets').val();



if(paymentmode == 'cash')
{
    $('#order_paymentmode').val('1');
    if(grandtotal == 0)
    {
        alert("Please Select Atleast One Product");

       
    }
    else if(cashpaid < grandtotal)
    { 
       alert("Insufficient Payment");

    }
    else if(sales_by == 0)
    {
       alert("Please Choose Sales By");
    }
    else
    {
       $('#pos-form').submit();
    }
}
else if(paymentmode == 'card')
{
    $('#order_paymentmode').val('2');

    if(salesbycard == 0)
    { 
        alert("Please Choose Sales by");
    }
    else if(cardtype == 0)
    {
        alert("Please Choose Card Type");
    }
    else if(grandtotal == 0)
    {
        alert("Please Select Atleast One Product");
    }
      else if(cash_ch_credit == "")
      {
        alert("Please Enter Transaction Ref");
      }
    else
    {
        $('#pos-form').submit();
    }

}
else if(paymentmode == 'nets')
{
  $('#order_paymentmode').val('3');

  if(salesbynets == 0)
  {
      alert("Please Choose Sales by");
  }
  else if(grandtotal == 0)
  {
    alert("Please Select Atleast One Product");
  }
  else if(amount_nets == "")
  {
    alert("Please Enter Transaction Ref");
  }
  else
  {
     $('#pos-form').submit();
  }
}


}

function salesby(salemanid)
{
   $('#sales_by').val(salemanid);
}

function discountcalculation(discounttype)
{

    
    var productid= $('#currentselecteditem').val();
    var discount_input =$('#discount_input').val();
    var currentselectedprice=$('#currentselectedprice').val();

   

   

    if(productid == 0)
    {
        var productid=$('#lastitem').val(); // lastitem
        var currentselectedprice = $('#lastitemprice').val();

       
    }

    if(discount_input == 0)
    {
         alert("Please Enter the Discount Value");
    }
    else
    {
            if(discounttype == 1) // percentage
            {
                var discount_percentage_amount=((discount_input / 100) * currentselectedprice).toFixed(2);
                $('#item_dis'+productid).show();
                $('#item_dis_amt'+productid).html(discount_percentage_amount);
                $('#discount_amount_product'+productid).val(discount_percentage_amount);

            }
            else if(discounttype == 2)
            {
              
              $('#item_dis'+productid).show();
              $('#item_dis_amt'+productid).html(discount_input);
              $('#discount_amount_product'+productid).val(discount_input);
            }

       subtotalcalculation();
    }

    $('#Itemdiscount').modal('hide');
}

function billdiscountcalculation(discounttype)   // calculation for discount of bill 
{

    

    var discount_input =$('#bill_discount_input').val();

     var subtotal=$('#subtotal1').val();

     var grandtotal=$('#total1').val();
  

   



    if(discount_input == 0)
    {
         alert("Please Enter the Discount Value");
    }
    else if(grandtotal == 0.00)
    {
        alert("please select atleast one product");
    }
    else
    {
            if(discounttype == 1) // percentage
            {
                var billdiscountamount=((discount_input / 100) * subtotal).toFixed(2);
               

            }
            else if(discounttype == 2)
            {
              
              var billdiscountamount=discount_input;
            }

       

        var finaltotalamount=parseFloat(subtotal)-parseFloat(billdiscountamount);


        $('#total').html(finaltotalamount);
        $('#total1').val(finaltotalamount);
        $('#total_tot').html(finaltotalamount);
        $('.service_display').detach();
        $('.gst_display').detach();
        $('.billdiscount_display').show();
        $('#billdiscountview').html(billdiscountamount);
        $('#billdiscount1').val(billdiscountamount);

    }

    $('#Billdiscount').modal('hide');
}

function selecteditems(productid,productprice)
{
   
    $('#currentselecteditem').val(productid);
    $('#currentselectedprice').val(productprice);
}

function addmanualentry()   // Manual product entry and to append in the Left panel 
{
    var cnt=1;
    var productid='qw'+cnt;
    var productprice=$('#cus_uprice').val();
    var productname=$('#cus_pro').val();
    var productqty=$('#cus_qty').val();


     $('#pricelisttbody').append('<tr id="495" class="highlighted" onclick="selecteditems('+productid+','+productprice+')"><input type="hidden" name="product_name[]" value="'+productname+'"/><input type="hidden" name="product_price[]" value="'+productprice+'"/><td>'+productname+'</td><td align="right">$<span id="price495">'+productprice+'</span></td><td align="right">x</td><td id="qty'+productid+'" align="right">'+productqty+'</td><td align="right">$<span id="price'+productid+'">'+productprice+'</span><input type="hidden" value='+productprice+' id="producttotalprice'+productid+'" name="product_totalamount[]" /><input type="hidden" value="'+productqty+'" name="product_quantity[]" id="productquantity'+productid+'" /><input type="hidden" name="product_item_discount[]" id="product_item_discount'+productid+'"/></td></tr><tr id="item_dis'+productid+'" style="display:none;" class=""><td></td><td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;DISCOUNT <span class="per_symbol'+productid+'"></span></td><td colspan="2" align="right">-$<span id="item_dis_amt'+productid+'">90.00</span><input type="hidden" id="discount_amount_product'+productid+'" name="discount_amount_product[]"/></td></tr>');
     $('#lastitem').val(productid);
     $('#lastitemprice').val(productprice);
     subtotalcalculation();

     cnt++;
}

