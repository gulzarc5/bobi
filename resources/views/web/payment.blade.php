@extends('web.templet.master')
@section('content')
   <section>
      <div class="nav-drict">
          <ul>
              <li><h6>Cart </h6></li>
              <li class="divider"></li>
              <li><h6>Shiping </h6></li>
              <li class="divider"></li>
              <li class="active"><h6>Payment</h6></li>
          </ul>
      </div>
      <div class="nav-drict">
         @if ($errors->any())
            <ul>
               @foreach ($errors->all() as $error)
                     <li class="invalid-feedback" role="alert" style="color:red">{{$error}}</li>
               @endforeach
            </ul>
         @endif
      </div>
   </section>
   <section>
      <div class="container" style="padding-bottom: 50px;">
         @if (isset($user_pin_details) && !empty($user_pin_details) && !empty($address))
         {{ Form::open(array('route' => 'web.place_order', 'method' => 'post')) }}
            <input type="hidden" name="address" value="{{encrypt($address)}}">
            <div class="row">
               <div class="col-md-9">
                  <h3 style="color: #333;text-transform: uppercase;margin-bottom: 20px">Select Payment</h3>
                  {{-- ///////////////// Item 1 ///////////////// --}}
                  @if (isset($user_pin_details->cod) && !empty($user_pin_details->cod) && $user_pin_details->cod == 'Y')
                     <div class="col-md-5 checkout_grid shipping" style="padding: 22px;">
                        <div class="col-md-1">
                              <input type="radio" name="pay_method" value="1" checked>
                        </div>
                        <div class="col-md-11">
                              <h5>Cash On Delivery</h5>
                        </div>
                     </div>
                  @else
                     <div class="col-md-5 checkout_grid shipping" style="padding: 22px;">
                        <div class="col-md-1">
                           <input type="radio" name="pay_method" value="1" disabled>
                        </div>
                        <div class="col-md-11">
                           <h5>Cash On Delivery</h5>
                        </div>
                     </div>
                  @endif
                  
                  <div class="col-md-1 "></div>
                  {{-- ///////////////// Item 2 ///////////////// --}}
                  <div class="col-md-5 checkout_grid shipping" style="padding: 22px;">
                     <div class="col-md-1">
                           <input type="radio" name="pay_method" value="2">
                     </div>
                     <div class="col-md-11">
                           <h5>Online Payment</h5>
                     </div>
                  </div>
               </div>
               @if (isset($cart_total) && !empty($cart_total))
                  <div class="col-md-3" style="margin-top: 20px;">
                     <ul class="shopping-cart-total-list">
                        <li><span>Subtotal</span><span>₹ {{ number_format($cart_total,2,".",'') }}</span></li>
                        <li><span>Shipping</span><span>Free</span> </li>
                        <li><span>Total</span><span>₹ {{ number_format($cart_total,2,".",'') }}</span></li>
                     </ul>
               </div>
               @endif
               {{-- /////////////////// Button /////////////////// --}}   
               <div class="col-md-9 flex-center"> 
                  <hr>                  
                  <button type="submit" class="btn btn-primary " href="#">Proceed </button>
               </div>
               
            </div>
         {{ Form::close() }}
         @endif
          
      </div>      
   </section>
@endsection
@section('script')
<script type="text/javascript">
$('.shipping').click(function (e){
   var checkbox = $(this).find('input[type=radio]');
   checkbox. prop("checked", true);
   // checkbox.prop("checked", !checkbox.prop("checked"));
   $('.shipping').css("border", "1px solid #ccc");
   if(checkbox.prop("checked") == true) {
     $(this).css("border", "1px solid #6993f3");
   }else{
      $(this).css("border", "2px solid #ccc");
   }
});

$("#add_new_ship_btn").click(function(){
   $("#add_new_ship").css('display','block');
})

$("#state").change(function(){
   var state = $(this).val();
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });
   $.ajax({
      type:"GET",
      url:"{{ url('City/list/')}}"+"/"+state+"",
      success:function(data){
         // console.log(data);
         // var cat = JSON.parse(data);
         $("#city").html("<option value=''>Select City</option>");

         $.each( data, function( key, value ) {
               $("#city").append("<option value='"+key+"'>"+value+"</option>");
         });

      }
   });
});
</script>
@endsection