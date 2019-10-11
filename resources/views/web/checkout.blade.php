@extends('web.templet.master')
@section('content')
<section>
   <div class="nav-drict">
       <ul>
           <li><h6>Cart </h6></li>
           <li class="divider"></li>
           <li class="active"><h6>Shiping </h6></li>
           <li class="divider"></li>
           <li><h6>Payment</h6></li>
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
<div class="container">
<<<<<<< HEAD

   @if (isset($shipping_address) && count($shipping_address) > 0 )

   {{ Form::open(array('route' => 'web.place_order', 'method' => 'post')) }}
      <div class="row">
         <div class="col-md-9">
            @php
                $ship_flag = false;
            @endphp
            @foreach ($shipping_address as $addr)
               @if ($ship_flag == false)
                  <div class="col-md-5 checkout_grid shipping" style="border:2px solid #6993f3;">
                     <input type="radio" name="address"  checked/>
                     <p style="margin-top: 10px;">
                     <p><b>State:</b> {{$addr->s_name}}</p>
                     <p><b>City:</b> {{$addr->c_name}}</p>
                     <p><b>pin:</b> {{$addr->pin}}</p>
                     <p>{{$addr->address}}</p>
                  </div>
                  <div class="col-md-1 "></div>
                  @php
                     $ship_flag = true;
                  @endphp
               @else
                  <div class="col-md-5 checkout_grid shipping">
                     <input type="radio" name="address"  />
                     <p style="margin-top: 10px;">
                     <p><b>State:</b> {{$addr->s_name}}</p>
                     <p><b>City:</b> {{$addr->c_name}}</p>
                     <p><b>pin:</b> {{$addr->pin}}</p>
                     <p>{{$addr->address}}</p>
                  </div>
                  <div class="col-md-1 "></div>
               @endif
               
            @endforeach
           
         </div>
         <div class="col-md-3" style="margin-top: 20px;">
            <ul class="shopping-cart-total-list">
               <li>
                  <span>Subtotal</span><span>₹
                     @if (isset($cart_total))
                     {{ number_format($cart_total,2,".",'') }}
                     @else
                        0.00
                     @endif
                  </span></li>
               <li><span>Shopping</span><span>Free</span> </li>
               {{-- 
               <li><span>Taxes</span><span>$0</span></li>
               --}}
               <li>
                  <span>Total</span><span>₹
                        @if (isset($cart_total))
                        {{ number_format($cart_total,2,".",'') }}
                        @else
                           0.00
                        @endif
                  </span>
               </li>
               <li>
                  <span>Payment Method</span>
                  <span>
                  Online <input type="radio" name="pay_method" value="1">
                  COD <input type="radio" name="pay_method" value="2">
                  </span>
               </li>
            </ul>
            <button type="submit" class="btn btn-primary " href="#" >Proceed to Checkout</button>
=======
   <div class="row">
      <div class="col-md-9">
         <div class="col-md-5 checkout_grid shipping">
            <input type="radio" name="address" class="checkout_checkbox" />
            <p style="margin-top: 10px;"><b>Name:</b> Chinmayee</p>
            <p><b>Email:</b> Chinmayee@mail.com</p>
            <p><b>Phone:</b> 89765678</p>
            <p><b>State:</b> Assam</p>
            <p><b>City:</b> Nagaon</p>
            <p><b>pin:</b> 7002123</p>
            <p>webinfotech,dowtown.near sunvally hospital</p>
         </div>
         <div class="col-md-1 "></div>
         <div class="col-md-5 checkout_grid shipping">
            <input type="radio" name="address" class="checkout_checkbox" />
            <p style="margin-top: 10px;"><b>Name:</b> Chinmayee</p>
            <p><b>Email:</b> Chinmayee@mail.com</p>
            <p><b>Phone:</b> 89765678</p>
            <p><b>State:</b> Assam</p>
            <p><b>City:</b> Nagaon</p>
            <p><b>pin:</b> 7002123</p>
            <p>webinfotech,dowtown.near sunvally hospital</p>
         </div>
         <div class="col-md-5 checkout_grid shipping">
            <input type="radio" class="checkout_checkbox" />
            <p style="margin-top: 10px;"><b>Name:</b> Chinmayee</p>
            <p><b>Email:</b> Chinmayee@mail.com</p>
            <p><b>Phone:</b> 89765678</p>
            <p><b>State:</b> Assam</p>
            <p><b>City:</b> Nagaon</p>
            <p><b>pin:</b> 7002123</p>
            <p>webinfotech,dowtown.near sunvally hospital</p>
         </div>
         <div class="col-md-1 "></div>
         <div class="col-md-5 checkout_grid shipping">
            <input type="radio" class="checkout_checkbox" />
            <p style="margin-top: 10px;"><b>Name:</b> Chinmayee</p>
            <p><b>Email:</b> Chinmayee@mail.com</p>
            <p><b>Phone:</b> 89765678</p>
            <p><b>State:</b> Assam</p>
            <p><b>City:</b> Nagaon</p>
            <p><b>pin:</b> 7002123</p>
            <p>webinfotech,dowtown.near sunvally hospital</p>
>>>>>>> header
         </div>
      </div>
   {{ Form::close() }}
      <div class="col-md-12">
      <ul class="list-inline">
            <li><a class="btn btn-success" id="add_new_ship_btn" >Add New</a></li>
      </ul>
      </div>
<<<<<<< HEAD

   @else
      {{-- ///////////////////Add New Shipping Area //////////////////--}}
      <div class="col-md-9 checkout" >
         <div class="mfp-with-anim">
            {{ Form::open(array('route' => 'web.new_ship_add', 'method' => 'post')) }}
               <div class="row">
                  <div class="col-lg-12">
                     <div style="margin-top: 30px;">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>State</label>
                              <select class="form-control" name="state" id="state"  >
                                 <option value="" selected>...Select State...</option>
                                 @if (isset($states))
                                    @foreach ($states as $item)
                                       <option value="{{$item->id}}" >{{$item->name}}</option>
                                    @endforeach
                                 @endif
                              </select>
                              @if($errors->has('state'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                       <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>City</label>
                              <select class="form-control" name="city" id="city" >
                                 <option value="" selected >...Select City...</option>
                              </select>
                              @if($errors->has('city'))
                                 <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('city') }}</strong>
                                 </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Pin Code</label>
                              <input class="form-control" type="text" name="pin" value="" id="pin" />
                              @if($errors->has('pin'))
                                 <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('pin') }}</strong>
                                 </span>
                              @enderror
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <textarea rows="3" cols="45" class="form-control" placeholder="address" name="address" id="address" ></textarea>
                     @if($errors->has('address'))
                        <span class="invalid-feedback" role="alert" style="color:red">
                           <strong>{{ $errors->first('address') }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-12"  style="margin-bottom: 10px;" id="profile_btn">
                     <button type="submit" class="btn btn-success"> Submit </button>
               </div>
            {{ Form::close() }}
            <div class="gap gap-small">
            </div>
         </div>
      </div>

      <div class="col-md-3" style="margin-top: 20px;">
            <ul class="shopping-cart-total-list">
               <li>
                  <span>Subtotal</span><span>₹
                     @if (isset($cart_total))
                     {{ number_format($cart_total,2,".",'') }}
                     @else
                        0.00
                     @endif
                  </span></li>
               <li><span>Shopping</span><span>Free</span> </li>
               {{-- 
               <li><span>Taxes</span><span>$0</span></li>
               --}}
               <li>
                  <span>Total</span><span>₹
                        @if (isset($cart_total))
                        {{ number_format($cart_total,2,".",'') }}
                        @else
                           0.00
                        @endif
                  </span>
               </li>
            </ul>
            <a class="btn btn-primary " href="#" >Proceed to Checkout</a>
         </div>
   @endif

   <div class="col-md-9 checkout"  id="add_new_ship" style="display:none">
      <div class="mfp-with-anim">
         {{ Form::open(array('route' => 'web.new_ship_add', 'method' => 'post')) }}
            <div class="row">
               <div class="col-lg-12">
=======
   </div>
   {{-- 
   <ul class="list-inline">
      <li><a href="{{ route('web.index') }}" class="btn btn-default" href="#">Continue Shopping</a></li>
   </ul>
   --}}
   <div class="col-md-12">
      <ul class="list-inline">
         <li><a href="" class="btn btn-success" >Add New</a></li>
      </ul>
   </div>
   <div class="col-md-9 checkout" >
      <div class="mfp-with-anim">
         <form>
            <div class="row">
               <h3 style="margin-left: 15px;">Personal Information</h3>
               <div style="margin-top: 30px;">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" id="name" value=""/>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" value=""/>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Mobile</label>
                        <input class="form-control" type="text"  value=""/>
                     </div>
                  </div>
                  {{--  
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Date of Birth</label>
                        <input class="form-control" type="date" name="dob" id="dob" value=""/>
                     </div>
                  </div>
                  --}}
                  {{-- 
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Gender</label>
                        <div style="display: flex;">
                           <label class="container">
                           <input type="radio" checked="checked" name="gender" value="M"  id="m" > Male
                           <span class="checkmark"></span>
                           </label>
                           <label class="container">
                           <input type="radio" name="gender" value="F"  id="f" checked> Female
                           <span class="checkmark"></span>
                           </label>
                        </div>
                     </div>
                  </div>
                  --}}
               </div>
            </div>
            <hr>
            <div class="row">
               <div class="col-lg-12">
                  <h3 style="margin-left: 15px;">Address </h3>
>>>>>>> header
                  <div style="margin-top: 30px;">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>State</label>
                           <select class="form-control" name="state" id="state"  >
<<<<<<< HEAD
                              <option value="" selected>...Select State...</option>
                              @if (isset($states))
                                 @foreach ($states as $item)
                                    <option value="{{$item->id}}" >{{$item->name}}</option>
                                 @endforeach
                              @endif
                           </select>
                           @if($errors->has('state'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('state') }}</strong>
                              </span>
                           @enderror
=======
                              <option selected>...Select State...</option>
                              <option>Assam</option>
                              <option>Assam</option>
                           </select>
>>>>>>> header
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>City</label>
                           <select class="form-control" name="city" id="city" >
                              <option selected >...Select City...</option>
                              <option>Guwahati</option>
                              <option>Nagaon</option>
                           </select>
<<<<<<< HEAD
                           @if($errors->has('city'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('city') }}</strong>
                              </span>
                           @enderror
=======
>>>>>>> header
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Pin Code</label>
                           <input class="form-control" type="text" name="pin" value="" id="pin" />
<<<<<<< HEAD
                           @if($errors->has('pin'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('pin') }}</strong>
                              </span>
                           @enderror
=======
>>>>>>> header
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <textarea rows="3" cols="45" class="form-control" placeholder="address" name="address" id="address" ></textarea>
<<<<<<< HEAD
                  @if($errors->has('address'))
                     <span class="invalid-feedback" role="alert" style="color:red">
                        <strong>{{ $errors->first('address') }}</strong>
                     </span>
                  @enderror
               </div>
            </div>
            <div class="col-md-12"  style="margin-bottom: 10px;" id="profile_btn">
               <button type="submit" class="btn btn-success"> Submit </button>
            </div>
         {{ Form::close() }}
=======
               </div>
            </div>
            <div class="col-md-12"  style="margin-bottom: 10px;" id="profile_btn">
               <a class="btn btn-success"> Submit </a>
            </div>
         </form>
>>>>>>> header
         <div class="gap gap-small">
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
<<<<<<< HEAD
$('.shipping').click(function (e){
   var checkbox = $(this).find('input[type=radio]');
   checkbox. prop("checked", true);
   // checkbox.prop("checked", !checkbox.prop("checked"));
   $('.shipping').css("border", "1px solid #ccc");
   if(checkbox.prop("checked") == true) {
     $(this).css("border", "2px solid #6993f3");
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
=======
   $('.shipping').click(function (e)
   {
   var checkbox = $(this).find('input[type=radio]');
   checkbox.prop("checked", !checkbox.prop("checked"));
   $('.shipping').css("border", "1px solid #ccc");
   if(checkbox.prop("checked") == true) {
    $(this).css("border", "2px solid #6993f3");
   }else{
   $(this).css("border", "2px solid #ccc");
   }
   
   });
>>>>>>> header
</script>
@endsection