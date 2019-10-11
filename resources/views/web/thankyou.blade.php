@extends('web.templet.master')
@section('content')
<div class="nav-drict">
       <ul>
           <li><h6>Cart </h6></li>
           <li class="divider"></li>
           <li class=""><h6>Shiping </h6></li>
           <li class="divider"></li>
           <li class="active"><h6>Payment</h6></li>
       </ul>
   </div>
	<center>
		<div style="margin-top: 10%; margin-bottom: 4%;">
			<h3>Order ID : d4569434c676</h3>
			<h2 >Thank You for Shopping With Us</h2>
		<p><a href="{{ route('web.index')}}">Continue Shopping</a></p>
		</div>
	</center>
@endsection