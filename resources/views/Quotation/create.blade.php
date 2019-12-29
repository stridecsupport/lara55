 <form role="form" id="create-staff-form" class="smart-form client-form" route='client_add' method="POST" enctype="multipart/form-data" action="{{url('/quotation')}}">
 
 <!-- for table css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/lib/stroke-7/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/lib/jquery.nanoscroller/css/nanoscroller.css')}}"/>
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}" type="text/css"/>
    <link type="text/css" href="{{url('assets/css/themes/theme-google.css')}}" rel="stylesheet">
	
 <!-- for table css -->

<input type='hidden' name='_token' value="{!! csrf_token() !!}">
<div>
<p>
New Quotation 
</p>

<!-- http://jsfiddle.net/jw107go8/ .... for siblings-->
<!-- for sortable table http://jsfiddle.net/DenisHo/dxpLrcd9/embedded/result/ -->
<!--  for datatable drag and drop https://stackoverflow.com/questions/42411539/jquery-datatable-drag-and-drop-rows-row-reordering-from-json-data -->
<!-- BOOTSTRAP DRAP AND DROP http://www.expertphp.in/article/jquery-bootstrap-table-row-draggable-and-sortable-resizable-with-example -->


 <div class="row">
  <div class="col-md-3 form-group">
<!--<input type="text" value="30" id='nawa' />
<input type="text" value="30" id='nawa1' />-->
<label>Issued From<span>*</span></label>
<select name='companyid' class="form-control" required>
<option>Select</option>
@foreach($company as $companies)
<option value="{{$companies->id}}">{{$companies->name}}</option>
@endforeach
</select>
</div>


 <div class="col-md-3 form-group">
<label>Customer<span>*</span></label>
<select name='customerid' class="form-control" onchange=customerdetails(this.value); required>
<option>Select</option>
@foreach($customers as $customer)
<option value="{{$customer->id}}">{{$customer->name}}</option>
@endforeach
</select>
</div>
	

<div class="col-md-3 form-group">
	<label>Email(s)to Send to<span>*</span></label>
	<input type='text' name='customeremails' class="form-control" id='customeremail' required/>
  </div>
</div>
	
 <div class="row">
 <div class="col-md-3 form-group">
<label>Validity<span>*</span></label>
<select name='validity' class="form-control"  required>
<option>Select</option>
<option value='1'>7 days</option>
<option value='2'>14 days</option>
<option value='3'>30 days</option>
<option value='4'>45 days</option>
<option value='5'>60 days</option>
<option value='6'>90 days</option>
</select>
	</div>
	
 <div class="col-md-3 form-group">
<label>Subject<span>*</span></label>
<input type='text' class="form-control" name='subject' required/>
</div>
</div>
<!-- Customer details -->






<!-- Item Table -->
<div class="table-scroller">
<table class="table table-fw-widget" id="postable" width="100%">
<thead>
    <tr>
   
      <td></td>
      <td>Item</td>

      <td>Item Description</td>
      <td>Qty</td>
      <td>Cost Price</td>
      <td>Unit Price</td>
      <td>%</td>
	  <td>Margin</td>
      <td>Amount</td>

    </tr>
    </thead>
<tbody id="dynamic-row">
   
  
</tbody>
</table>
</div>



<button onclick="additems();">
	<b>Add Item</b>
</button>

<button onclick="addsections();" type="button">
	<b>Add Section</b>
</button>
<div>
	<p><b>GrandTotal</b></p><input type='text' id='grandtotal' name='product_grandtotal' readonly />
</div>

<div>
	<button type='submit' style='float:right;'><b>Submit</b></button>
</div>
</form>
<!--Item Table -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
	// Initialise the table
	//$("#postable").tableDnD();
	  $('#postable tbody').sortable();
});
</script>
<script>

var cnt=1;
var sectioncount=1;
var itemtype=0;

	
  function additems()

	{
	
		var rows="<tr id='row_"+cnt+"'><td><input type='hidden' name='input_type[]' value='1'/><input type='checkbox' onclick=boxDisable('items',"+cnt+",$(this),'0'); value='1' name='product_check[]'/><input type='hidden' value='0' id='checkboxhidden_"+cnt+"' name=checkboxhidden[]/></td><td><select name='productid[]' onchange=getproductdetails("+itemtype+","+cnt+",this.value); required><option value='0'>Select Items</option>@foreach($products as $productss)<option value='{{$productss->id}}'>{{$productss->name}}</option>@endforeach</select></td><td><input type='text' id='description"+cnt+"' name='product_description[]' required></td><td><input type='number' id='quantity"+cnt+"' oninput=onchangequantity('"+cnt+"'); name='quantity[]' required/></td><td><input type='text' id='cost_price"+cnt+"' oninput=onchangecostprice('"+cnt+"'); name='cost_price[]' required/></td><td><input type='text' name='unit_price[]' oninput=onchangecalcalculation('"+cnt+"'); id='unit_price"+cnt+"' required/></td><td><input type='text' name='percentage[]' id='product_percentage"+cnt+"' readonly required/></td><td><input id='margin_cost"+cnt+"' type='text' name='margin[]' readonly required/></td><td><input type='text' name='amount[]' id='product_amount"+cnt+"' readonly required/></td><td><button onclick='deleterow("+cnt+",'rows','0');'>Deleteerere</button></td></tr>";
		
		    $("#dynamic-row").append(rows);
		    cnt++;
	}
	
	function addsections()
	{
		var rows="<tr><input type='hidden' name='input_type[]' value='2'/><input type='hidden' value='0'  name='product_check[]'/><input type='hidden' value='0' id='checkboxhidden_"+cnt+"' name=checkboxhidden[]/><input type='hidden' value='0' name='productid[]'/><input type='hidden' value='0'  name='quantity[]'/><input type='hidden' value='0' name='cost_price[]' /><input type='hidden' value='0' name='unit_price[]'/><input type='hidden' value='0' name='percentage[]'/><input  type='hidden' value='0' name='margin[]' /><input type='hidden' value='0' name='amount[]'/><td colspan='10' style='padding: 0px;'><table class='table table-fw-widget'><tbody id='sectionbody"+sectioncount+"'><tr id='rowsection_"+cnt+"'><td>***</td><td colspan='6'><input style='width: 100%;' type='text' name='product_description[]' /></td><td><button type='button' onclick='addsectionitems("+cnt+","+sectioncount+");'><b>Add Item</b></button></td><td><button type='button' onclick='deletesection("+sectioncount+");'>Delete</button></td></tr><tr><td colspan='3'></td><td><input type='text' name='subtotal_section_qty[]' id='subtotal_qty"+sectioncount+"' readonly value='quantity'/></td><td><input type='text' name='subtotal_section_costprice[]' value='costprice' id='subtotal_costprice"+sectioncount+"' readonly/></td><td><input type='text' value='unitprice' name='subtotal_section_unitprice[]'  id='subtotal_unitprice"+sectioncount+"'  readonly/></td><td><input type='text' value='' name='subtotal_section_percentage[]' id='subtotal_percentage"+sectioncount+"' readonly/></td><td><input type='text' name='subtotal_section_margin[]' value='margin' id='subtotal_margin"+sectioncount+"' readonly/></td><td><input type='text' value='subamount' name='subtotal_section_subamount[]' id='subtotal_subamount"+sectioncount+"' readonly/></td><td></td></tr></tbody></table></td></tr>";
		
		    $("#dynamic-row").append(rows);

		
		    cnt++;
		    sectioncount++;
	}
	
	//sectionsubtotalcalculation("+sectioncount+");
	
	function addsectionitems(rowcount,sectioncount)
	{
		//alert(sectioncount);

		var rows="<tr id='row_"+cnt+"'><td><input type='hidden' name='input_type[]' value='3'/><input type='checkbox' onclick=boxDisable('sections',"+cnt+",$(this),"+sectioncount+"); value='1' name='product_check[]'/><input type='hidden' value='0' id='checkboxhidden_"+cnt+"' name=checkboxhidden[]/></td><td><select name='productid[]' onchange=getproductdetails("+sectioncount+","+cnt+",this.value); required><option value='0'>Select Items</option>@foreach($products as $productss)<option value='{{$productss->id}}'>{{$productss->name}}</option>@endforeach</select></td><td><input type='text' id='description"+cnt+"' name='product_description[]' required></td><td><input type='number' id='quantity"+cnt+"' oninput='onchangequantity("+cnt+");sectionsubtotalcalculation("+sectioncount+");' name='quantity[]' required/></td><td><input type='text' id='cost_price"+cnt+"' oninput='onchangecostprice("+cnt+");sectionsubtotalcalculation("+sectioncount+");' name='cost_price[]' required/></td><td><input type='text' name='unit_price[]' oninput='onchangecalcalculation("+cnt+");sectionsubtotalcalculation("+sectioncount+");' id='unit_price"+cnt+"' required/></td><td><input type='text' name='percentage[]' id='product_percentage"+cnt+"' readonly required/></td><td><input id='margin_cost"+cnt+"' type='text' name='margin[]' readonly required/></td><td><input type='text' name='amount[]' id='product_amount"+cnt+"' readonly required/></td><td><button onclick='deleterow("+cnt+",'sections',"+sectioncount+");'>Deletellll</button></td></tr>";
		

		
	     $(rows).insertAfter("#rowsection_"+rowcount);
		
		 cnt++;
		
	}
	
function getproductdetails(sectioncount,count,productid)
	{
		//alert(productid);
		
 
		
		var token = $('input[name=_token]').val();
		$.ajax({
		headers: {'X-CSRF-TOKEN': token},
		method: "POST",
		url : "{{ url('/productdetails') }}",
		data: {productid:productid},   
		success : function(data)
			{ 
			  //alert(data);
				var result=data.split('#');
				document.getElementById('description'+count).value=result[0];
				document.getElementById('cost_price'+count).value=result[1];
				document.getElementById('unit_price'+count).value=result[2];
				document.getElementById('product_amount'+count).value=result[2];
				document.getElementById('quantity'+count).value='1';
				//calculation(count,'calculation');
				onchangecalcalculation(count);
				grandtotalcalculation();
				
				if(sectioncount != "0")
					{
						sectionsubtotalcalculation(sectioncount);
					}
				
				
				
	       },error: function(ts) { alert("Please Select valid Product Code"); }
        });
		

	}
	
	
	
/*function calculation(count,methodname)
	{
		
		        var cost_price=parseFloat(document.getElementById('cost_price'+count).value);
				var unit_price=parseFloat(document.getElementById('unit_price'+count).value);
		        var quantity=parseFloat(document.getElementById('quantity'+count).value);
		        var product_amount=parseFloat(document.getElementById('product_amount'+count).value);
		
		
		if(methodname == 'calculation')
			{
		        
		         
		        var margin_cost=(unit_price-cost_price)*quantity;
		        document.getElementById('margin_cost'+count).value=margin_cost;
		
		        var subtotal=quantity*unit_price;
		        document.getElementById('product_amount'+count).value=subtotal;
		
		     
		        var percentage=(margin_cost*100)/cost_price;
		
		      document.getElementById('product_percentage'+count).value=percentage;
			}
		else if(methodname == 'quantity')
		{
		        var margin_cost=(unit_price-cost_price)*quantity;
		        document.getElementById('margin_cost'+count).value=margin_cost;
		
		        var subtotal=quantity*unit_price;
		        document.getElementById('product_amount'+count).value=subtotal;
		}
		else if(methodname =='costprice')
			{
				 var margin_cost=(unit_price-cost_price)*quantity;
		        document.getElementById('margin_cost'+count).value=margin_cost;
			}
		
		grandtotalcalculation();
}

*/
	

	function onchangequantity(count)
	{
		        var cost_price=parseFloat(document.getElementById('cost_price'+count).value) || 0;
				var unit_price=parseFloat(document.getElementById('unit_price'+count).value) || 0;
		        var quantity=parseFloat(document.getElementById('quantity'+count).value) || 0;
		 
		        
		        var margin_cost=multiply([subtraction([unit_price,cost_price]),quantity]);
		        document.getElementById('margin_cost'+count).value=margin_cost;
		
		        var subtotal=multiply([quantity,unit_price]);
		        document.getElementById('product_amount'+count).value=subtotal;
		
		      grandtotalcalculation();
	}
	
	
	function onchangecostprice(count)
	{
		
		        var cost_price=parseFloat(document.getElementById('cost_price'+count).value) || 0;
				var unit_price=parseFloat(document.getElementById('unit_price'+count).value) || 0;
		        var quantity=parseFloat(document.getElementById('quantity'+count).value) || 0;
		
		        var margin_cost=multiply([subtraction([unit_price,cost_price]),quantity]);
		        document.getElementById('margin_cost'+count).value=margin_cost;
		
		       grandtotalcalculation();
	}
	
	function onchangecalcalculation(count)
	{
		        
		
		       var cost_price=parseFloat(document.getElementById('cost_price'+count).value);
			   var unit_price=parseFloat(document.getElementById('unit_price'+count).value);
		       var quantity=parseFloat(document.getElementById('quantity'+count).value);
		       var product_amount=parseFloat(document.getElementById('product_amount'+count).value);
		
		
		         
		        var margin_cost=multiply([subtraction([unit_price,cost_price]),quantity]);
		        document.getElementById('margin_cost'+count).value=margin_cost;
		
		         var subtotal=multiply([quantity,unit_price]);
		         document.getElementById('product_amount'+count).value=subtotal;
		
		     
		      //  var percentage=(margin_cost*100)/cost_price;
		       // var percentage=
		
		      document.getElementById('product_percentage'+count).value=percentagecalculation(cost_price,margin_cost);
		
		
		    grandtotalcalculation();
	}

  
function deleterow(rowcount,type,sectioncount)
  {
    alert(sectioncount);
    var subtotal=parseFloat(document.getElementById('product_amount'+rowcount).value);
    var grantotal=parseFloat(document.getElementById('grandtotal').value);
    var product_amount=parseFloat(document.getElementById('product_amount'+rowcount).value) || 0;
    var unitprice=parseFloat(document.getElementById('unit_price'+rowcount).value) || 0;
    var costprice=parseFloat(document.getElementById('cost_price'+rowcount).value) || 0;
    var marginprice=parseFloat(document.getElementById('margin_cost'+rowcount).value) || 0;
    var quantity=parseFloat(document.getElementById('quantity'+rowcount).value) || 0;
    var grandtotal=parseFloat(document.getElementById('grandtotal').value) || 0;

    var finaltotal=grantotal-subtotal;
    document.getElementById('grandtotal').value=finaltotal;

    alert("Sdfsdsd");
    if((type == "sections") && (sectioncount !='0'))
    {

    
        alert("xsdsdfsdf");
       var sectionsubtotal=parseFloat(document.getElementById('subtotal_subamount'+sectioncount).value) || 0;
         
        var sectionmargin=parseFloat(document.getElementById('subtotal_margin'+sectioncount).value) || 0;
         
        var sectioncost_price=parseFloat(document.getElementById('subtotal_costprice'+sectioncount).value) || 0;
        
        var sectionunit_price=parseFloat(document.getElementById('subtotal_unitprice'+sectioncount).value) || 0;
         
        var sectionquantity=parseFloat(document.getElementById('subtotal_qty'+sectioncount).value) || 0;
         
        
        
          document.getElementById('subtotal_subamount'+sectioncount).value=subtraction([sectionsubtotal,product_amount]);
        document.getElementById('subtotal_qty'+sectioncount).value=subtraction([sectionquantity,quantity]);
        document.getElementById('subtotal_unitprice'+sectioncount).value=subtraction([sectionunit_price,unitprice]);
        document.getElementById('subtotal_costprice'+sectioncount).value=subtraction([sectioncost_price,costprice]);
        document.getElementById('subtotal_margin'+sectioncount).value=subtraction([sectionmargin,marginprice]);
    }

    $("#row_"+rowcount).detach();
  }
	
function deletesection(sectioncount)
	{
		//alert(sectioncount);

		var subtotal=parseFloat(document.getElementById('subtotal_subamount'+sectioncount).value);
		var grantotal=parseFloat(document.getElementById('grandtotal').value);
		var finaltotal=grantotal-subtotal;
		document.getElementById('grandtotal').value=finaltotal;
		
		$("#sectionbody"+sectioncount).detach();
	}
	
function grandtotalcalculation()
	{
		finalamount=0;
		finalamount1=0;
		$('input[name="amount[]"]').each(function() {
        var i = parseInt($(this).val());
        if (!isNaN(i))
		  {
			finalamount += i;
		  }
        });

        

        var total=finalamount;



		
		document.getElementById('grandtotal').value=total;
		
	}

	
function sectionsubtotalcalculation(count)
	{
		
		//alert(count);
		
	    finalamount=0;
		finalquantity=0;
		finalunitprice=0;
		finalcostprice=0;
		finalmarginprice=0;



		$('#sectionbody'+count+' input[name="amount[]"]').each(function() {
        var a = parseInt($(this).val());
        if (!isNaN(a))
		  {
			finalamount += a;
		  }
        });
		
		$('#sectionbody'+count+' input[name="quantity[]"]').each(function() {
        var q = parseInt($(this).val());
        if (!isNaN(q))
		  {
			finalquantity += q;
		  }
        });
		
		$('#sectionbody'+count+' input[name="unit_price[]"]').each(function() {
        var u = parseInt($(this).val());
        if (!isNaN(u))
		  {
			finalunitprice += u;
		  }
        });
		
		
		$('#sectionbody'+count+' input[name="cost_price[]"]').each(function() {
        var c = parseInt($(this).val());
        if (!isNaN(c))
		  {
			finalcostprice += c;
		  }
        });

		
		$('#sectionbody'+count+' input[name="margin[]"]').each(function() {
        var m= parseInt($(this).val());
        if (!isNaN(m))
		  {
			finalmarginprice += m;
		  }
        });



       
		
		

		
		
		
		
	    document.getElementById('subtotal_subamount'+count).value=finalamount;
		document.getElementById('subtotal_qty'+count).value=finalquantity;
		document.getElementById('subtotal_costprice'+count).value=finalcostprice;
		document.getElementById('subtotal_unitprice'+count).value=finalunitprice;
		document.getElementById('subtotal_margin'+count).value=finalmarginprice;
		
		
		
		
		
	}
function customerdetails(customerid)
	{
		
   var token = $('input[name=_token]').val();
		$.ajax({
		headers: {'X-CSRF-TOKEN': token},
		method: "POST",
		url : "{{ url('/customerdetails') }}",
		data: {customerid:customerid},   
		success : function(data)
			{ 
			  //alert(data);
				document.getElementById('customeremail').value=data;
				
				
	       },error: function(ts) { alert("Please Select valid Customer"); document.getElementById('customeremail').value=""; }
        });
		
	}

	
/*function sum(){
 var args = Array.prototype.slice.call(arguments);
 return args.reduce(function(pre,curr){
   if(!isNaN(curr)){
     return pre+curr;
   }
   else
   {
    throw Error("Non-Numeric arguments"+curr);
   }
},0)
}*/

	
function subtraction(arr) 
 {
  if (Object.prototype.toString.call(arr) === '[object Array]') {
    var total = arr[0];
    if (typeof (total) !== 'number') {
      return false;
    }
    for (var i = 1, length = arr.length; i < length; i++)
    {
      if (typeof (arr[i]) === 'number')
      {
        total -= arr[i];
      } 
      else 
      return false;
    }
    return total;
   } 
    else
     return false;
  }
	
	
	function summ(arr) 
 {
  if (Object.prototype.toString.call(arr) === '[object Array]') {
    var total = arr[0];
    if (typeof (total) !== 'number') {
      return false;
    }
    for (var i = 1, length = arr.length; i < length; i++)
    {
      if (typeof (arr[i]) === 'number')
      {
        total += arr[i];
      } 
      else 
      return false;
    }
    return total;
   } 
    else
     return false;
  }
//console.log(subtraction([7,3, 2,-1]));
	
	
	function multiply(arr) 
   {
     if (Object.prototype.toString.call(arr) === '[object Array]') {
     var total = arr[0];
     if (typeof (total) !== 'number') {
      return false;
   }
    for (var i = 1, length = arr.length; i < length; i++)
    {
       if (typeof (arr[i]) === 'number')
       {
        total *= arr[i];
       } 
        else 
        return false;
    }
    return total;
   } 
    else
     return false;
  }
	

	
	function div(arr) 
    {
		 if (Object.prototype.toString.call(arr) === '[object Array]') {
		 var total = arr[0];
		 if (typeof (total) !== 'number') {
		  return false;
    }
    for (var i = 1, length = arr.length; i < length; i++)
    {
		   if (typeof (arr[i]) === 'number')
		   {
			  total /= arr[i];
		   } 
			else 
			return false;
    }
       return total;
   } 
      else
       return false;
  }
	
	
function percentagecalculation(actual,formal)
	{
		var result = (formal *100)/actual;
		
		var resultdecimal=result.toFixed(2);
		
		
		return resultdecimal;
	}
	

	function boxDisable(type,rowcount,t,sectioncount) {
		
		//alert(sectioncount);
		
		 var product_amount=parseFloat(document.getElementById('product_amount'+rowcount).value) || 0;
		 var unitprice=parseFloat(document.getElementById('unit_price'+rowcount).value) || 0;
		 var costprice=parseFloat(document.getElementById('cost_price'+rowcount).value) || 0;
		 var marginprice=parseFloat(document.getElementById('margin_cost'+rowcount).value) || 0;
		 var quantity=parseFloat(document.getElementById('quantity'+rowcount).value) || 0;
		 var grandtotal=parseFloat(document.getElementById('grandtotal').value) || 0;
		
		
    if (t.is(':checked'))
	{
		
		
		
		      document.getElementById('grandtotal').value=subtraction([grandtotal,product_amount]) || 0 ;
		      document.getElementById('checkboxhidden_'+rowcount).value="1";
		      

		    if((type == 'sections') && (sectioncount != "0"))
			 {
			    var sectionsubtotal=parseFloat(document.getElementById('subtotal_subamount'+sectioncount).value) || 0;
				 
				var sectionmargin=parseFloat(document.getElementById('subtotal_margin'+sectioncount).value) || 0;
				 
				var sectioncost_price=parseFloat(document.getElementById('subtotal_costprice'+sectioncount).value) || 0;
				
				var sectionunit_price=parseFloat(document.getElementById('subtotal_unitprice'+sectioncount).value) || 0;
				 
				var sectionquantity=parseFloat(document.getElementById('subtotal_qty'+sectioncount).value) || 0;
				 
				
				
			    document.getElementById('subtotal_subamount'+sectioncount).value=subtraction([sectionsubtotal,product_amount]);
				document.getElementById('subtotal_qty'+sectioncount).value=subtraction([sectionquantity,quantity]);
				document.getElementById('subtotal_unitprice'+sectioncount).value=subtraction([sectionunit_price,unitprice]);
				document.getElementById('subtotal_costprice'+sectioncount).value=subtraction([sectioncost_price,costprice]);
				document.getElementById('subtotal_margin'+sectioncount).value=subtraction([sectionmargin,marginprice]);
				 
				 
			 }
	} 
		
	else
	{
         
		           document.getElementById('grandtotal').value=summ([grandtotal,product_amount]) || 0;
		              document.getElementById('checkboxhidden_'+rowcount).value="0";
		
		 if((type == 'sections') && (sectioncount != "0"))
			 {
			    var sectionsubtotal=parseFloat(document.getElementById('subtotal_subamount'+sectioncount).value) || 0;
				 
				var sectionmargin=parseFloat(document.getElementById('subtotal_margin'+sectioncount).value) || 0;
				 
				var sectioncost_price=parseFloat(document.getElementById('subtotal_costprice'+sectioncount).value) || 0;
				
				var sectionunit_price=parseFloat(document.getElementById('subtotal_unitprice'+sectioncount).value) || 0;
				 
				var sectionquantity=parseFloat(document.getElementById('subtotal_qty'+sectioncount).value) || 0;
				 
				
				
			    document.getElementById('subtotal_subamount'+sectioncount).value=summ([sectionsubtotal,product_amount]);
				 
				document.getElementById('subtotal_qty'+sectioncount).value=summ([sectionquantity,quantity]);
				 
				document.getElementById('subtotal_unitprice'+sectioncount).value=summ([sectionunit_price,unitprice]);
				 
				document.getElementById('subtotal_costprice'+sectioncount).value=summ([sectioncost_price,costprice]);
				 
				document.getElementById('subtotal_margin'+sectioncount).value=summ([sectionmargin,marginprice]);
				 
				 
			 }
		
		
		
    }
}



	
	

</script>