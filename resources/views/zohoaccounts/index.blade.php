<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td><h1>Zoho Accounts</h1></td>
		<td><a href="{{ url('/syncZohoAccounts') }}" style="float:right;">Sync Zoho Accounts</a><a href="{{ url('/truncateZohoAccounts') }}" style="float:right; margin-right:20px;">Truncate Zoho Accounts</a></td>
	</tr>
</table>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>Website</th>
			<th>Account Name</th>
		</tr>
	</thead>
	<tbody>
		@if($zohoaccounts)
			@foreach($zohoaccounts as $zohoaccount)
				<tr>
					<td>{{ $zohoaccount->fullName }}</td>
					<td>{{ $zohoaccount->email }}</td>
					<td>{{ $zohoaccount->phoneNumber }}</td>
					<td>{{ $zohoaccount->website }}</td>
					<td>{{ $zohoaccount->accountName }}</td>
				</tr>
			@endforeach
		@endif
	</tbody>	
</table>