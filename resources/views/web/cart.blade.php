@extends('web.templet.master')
@section('content')
<section>
    <div class="nav-drict">
        <ul>
            <li class="active"><h6>Cart </h6></li>
            <li class="divider"></li>
            <li><h6>Shiping </h6></li>
            <li class="divider"></li>
            <li><h6>Payment</h6></li>
        </ul>
    </div>
</section>
<div class="container">
   @if ( isset($cart_data) && !empty($cart_data) && (count($cart_data) > 0))
   <div class="row">
      <div class="col-md-10 table-responsive">
         <table class="table  table-shopping-cart">
            <thead>
               <tr class="tabletr">
                  <th class="text-center">SI</th>
                  <th class="text-center">Product</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Color</th>
                  <th class="text-center">Size</th>
                  <th class="text-center">Quatity</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Action</th>
               </tr>
            </thead>
            <tbody>
               @php
               $total = 0; 
               @endphp
               @foreach($cart_data as $cart)
               @php
               $total = $total+ ($cart['price']*$cart['quantity']);
               @endphp
               {{ Form::open(['method' => 'post','route'=>'web.updateCart']) }}
               <tr class="text-center">
                  <td class="text-center">1</td>
                  <td class="table-shopping-cart-img text-center">
                     <a href="#">
                     <img src="{{ asset('images/product/thumb/'.$cart['image'].'')}}" alt="Image Alternative text" title="Image Title" />
                     </a>
                  </td>
                  <td class="table-shopping-cart-title text-center"><a href="#">{{ $cart['title'] }}</a>
                  </td>
                  <td class="text-center"><span style="height: 25px; width: 25px;background-color: {{$cart['color_value']}}; border-radius: 50%; display: inline-block;"></span></td>
                  <td class="text-center">{{$cart['size']}}</td>
                  <td class="text-center">
                     <input type="hidden" name="p_id" value="{{ encrypt($cart['product_id']) }}">
                     <input class="form-control table-shopping-qty" name="quantity" type="number" value="{{$cart['quantity']}}" min="1" />
                  </td>
                  <td class="text-center">₹{{ number_format($cart['price'],2,".",'') }}</td>
                  <td class="text-center">₹{{ number_format($cart['price']*$cart['quantity'],2,".",'') }}</td>
                  <td class="text-center">
                     <a href="{{ route('cartItemRemove',['p_id'=>encrypt($cart['product_id'])]) }}" type="submit" class="fa fa-close table-shopping-remove" ></a>
                     <button type="submit" class="fa fa-check table-shopping-check"></>
                  </td>
               </tr>
               {{ Form::close() }}
               @endforeach                            
            </tbody>
         </table>
      </div>
      <div class="col-md-2">
         <ul class="shopping-cart-total-list">
            <li><span>Subtotal</span><span>₹{{ number_format($total,2,".",'')}}</span></li>
            <li><span>Shopping</span><span>Free</span> </li>
            {{-- 
            <li><span>Taxes</span><span>$0</span></li>
            --}}
            <li><span>Total</span><span>₹{{ number_format($total,2,".",'')}}</span></li>
         </ul>
         <a class="btn btn-primary " href="{{ route('web.checkout_ship') }}" >Checkout</a>
      </div>
   </div>
   <ul class="list-inline mob-check">
      <li><a href="{{ route('web.index') }}" class="btn btn-default" href="#">Continue Shopping</a></li>
      {{-- 
      <li><a class="btn btn-default" href="#">Update Bag</a></li>
      --}}
   </ul>
   @else

   <div class="container" style="margin-bottom: 20px;">
   <div class="text-center"><i class="fa fa-cart-arrow-down empty-cart-icon" style="    font-size: 100px;color: gray;"></i>
       <p class="lead">You haven't Fill Your Shopping Cart Yet</p><a class="btn btn-primary btn-lg" href="{{route('web.index')}}">Start Shopping <i class="fa fa-long-arrow-right"></i></a>
   </div>
   <div class="gap"></div>
   @endif
</div>
</div>
<!-- Main Container End --> 
@endsection