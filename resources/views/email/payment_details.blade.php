<h1>Hi, </h1> 

<table class="table">
							<tr>
								<th>Application Id</th>
								<th>Order Id</th>
								<th>Transaction Ide</th>
								<th>Paid Amount</th>
								<th>Transaction Date</th>
								<th>Transaction Status</th>
							</tr>
							<tr>
								<td>{{$data['application']->application_id}}</td>
								<td>{{$data['application']->order_id}}</td>
								<td>{{$data['application']->transaction_id}}</td>
								<td>{{$data['application']->paid_amount}}</td>
								<td>{{$data['application']->txn_date}}</td>
								<td>{{$data['application']->txn_status}}</td>
							</tr>
						</table> 