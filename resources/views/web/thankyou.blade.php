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
		<div style="margin-top: 0%; margin-bottom: 4%;">
      <img src="{{asset('web/images/check.png')}}" class="thanks-img">
			<h2 >Thank You for Shopping With Us</h2>
		<p><a class="btn outline btn-color" style="font-size: 12px" href="{{ route('web.order_history')}}">Click Here to Check Order History</a></p>
		</div>
	</center>
@endsection