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
          <form method="POST" action="http://localhost/bobi/public/User/Place/Order" accept-charset="UTF-8">
              <input name="_token" type="hidden" value="Xw0zXN2qjAawISV2yaXTYoYzomgb4HXEPkkQ4mdv">
              <div class="row">
                  <div class="col-md-9">
                     <h3 style="color: #333;text-transform: uppercase;margin-bottom: 20px">Select Payment</h3>
                     {{-- ///////////////// Item 1 ///////////////// --}}
                      <div class="col-md-5 checkout_grid shipping" style="padding: 22px;">
                          <div class="col-md-1">
                              <input type="radio" name="address" value="10" checked="">
                          </div>
                          <div class="col-md-11">
                              <h5>Cash On Delivery</h5>
                          </div>
                      </div>
                      <div class="col-md-1 "></div>
                     {{-- ///////////////// Item 2 ///////////////// --}}
                      <div class="col-md-5 checkout_grid shipping" style="padding: 22px;">
                          <div class="col-md-1">
                              <input type="radio" name="address" value="10" checked="">
                          </div>
                          <div class="col-md-11">
                              <h5>Online Payment</h5>
                          </div>
                      </div>
                      {{-- /////////////////// Button /////////////////// --}}   
                       <div class="col-md-12 flex-center">                   
                         <button type="submit" class="btn btn-primary " href="#">Proceed </button>
                      </div>
                  </div>

                  <div class="col-md-3" style="margin-top: 20px;">
                      <ul class="shopping-cart-total-list">
                          <li><span>Subtotal</span><span>₹ 599.00</span></li>
                          <li><span>Shipping</span><span>Free</span> </li>
                          <li><span>Total</span><span>₹ 599.00</span></li>
                      </ul>
                  </div>
              </div>
          </form>
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