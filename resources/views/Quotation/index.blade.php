
<!-- practising -->

<table id="data">
<tr><th>Name</th><th>Age</th><th>Weight</th></tr>
 
<tr><td>Joe</td><td>30</td><td class="sum">175</td><td class="sum">1</td></tr>
<tr><td>Jack</td><td>29</td><td class="sum">165</td><td class="sum">1</td></tr>
<tr><td>Jim</td><td>31</td><td class="sum">178</td><td class="sum">1</td></tr>
<tr><td>Jeff</td><td>28</td><td class="sum">173</td><td class="sum">1</td></tr>
<tr><th colspan="2" align="right">Sum</th><td class="subtotal"></td><td class="subtotal"></td></tr>
<tr><td>Jane</td><td>30</td><td class="sum">120</td><td class="sum">2</td></tr>
<tr><td>Jackie</td><td>30</td><td class="sum">112</td><td class="sum">2</td></tr>
<tr><th colspan="2" align="right">Sum</th><td class="subtotal"></td><td class="subtotal"></td></tr>
<tr><th colspan="2" align="right">Total</th><td class="total"></td><td class="total"></td></tr>
</table>






<!-- Practising ---->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
<script>
	
	$(function(){
	function tally (selector) {
		$(selector).each(function () {
			var total = 0,
				column = $(this).siblings(selector).addBack().index(this);
			$(this).parents().prevUntil(':has(' + selector + ')').each(function () {
				total += parseFloat($('td.sum:eq(' + column + ')', this).html()) || 0;
			})
			$(this).html(total);
		});
	}
	tally('td.subtotal');
	tally('td.total');
});
</script>