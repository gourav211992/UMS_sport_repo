<h1>Hi, </h1> 
<h2>Payment status successfully subbmitted</h2>
<table class="table">
							<tr>
								<th scope="col">Sr.No</th>
								<th scope="col">Course</th>
							</tr>
							<tr scope="row">
								@foreach($data['course'] as $index=> $courseData)
								<td>{{$index+1}}</td>
								<td>{{$courseData->name}}</td>
								@endforeach
							</tr>
						</table> 

<table class="table">
							<tr>
								<th scope="col">Application Id</th>
								<th scope="col">Order Id</th>
								<th scope="col">Transaction Ide</th>
								<th scope="col">Paid Amount</th>
								<th scope="col">Transaction Date</th>
								<th scope="col">Transaction Status</th>
							</tr>
							<tr scope="row">
								@foreach($data['paymentDetail'] as $paymentShow)
								<td>{{$paymentShow->application_id}}</td>
								<td>{{$paymentShow->order_id}}</td>
								<td>{{$paymentShow->transaction_id}}</td>
								<td>{{$paymentShow->paid_amount}}</td>
								<td>{{$paymentShow->txn_date}}</td>
								<td>{{$paymentShow->txn_status}}</td>
								@endforeach
							</tr>
						</table> 