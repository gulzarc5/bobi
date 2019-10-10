@extends('web.templet.master')
@section('content')
<div class="container">
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
      </div> 
      </div>
      <div class="col-md-3" style="margin-top: 20px;">
         <ul class="shopping-cart-total-list">
            <li><span>Subtotal</span><span>₹599</span></li>
            <li><span>Shopping</span><span>Free</span> </li>
            {{-- 
            <li><span>Taxes</span><span>$0</span></li>
            --}}
            <li><span>Total</span><span>₹599</span></li>
         </ul>
         <a class="btn btn-primary " href="#" >Proceed to Checkout</a>
      </div>
   </div>
   {{-- <ul class="list-inline">
      <li><a href="{{ route('web.index') }}" class="btn btn-default" href="#">Continue Shopping</a></li>
  </ul> --}}
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
                          {{--  <div class="col-md-4">
                              <div class="form-group">
                                 <label>Date of Birth</label>
                                 <input class="form-control" type="date" name="dob" id="dob" value=""/>
                              </div>
                           </div> --}}
                           {{-- <div class="col-md-6">
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
                           </div> --}}
                        </div>
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-lg-12">
                        <h3 style="margin-left: 15px;">Address </h3>
                        <div style="margin-top: 30px;">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>State</label>
                                 <select class="form-control" name="state" id="state"  >
                                    <option selected>...Select State...</option>
                                    <option>Assam</option>
                                    <option>Assam</option>
                                 </select>
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
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Pin Code</label>
                                 <input class="form-control" type="text" name="pin" value="" id="pin" />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <textarea rows="3" cols="45" class="form-control" placeholder="address" name="address" id="address" ></textarea>
                     </div>
                  </div>
                  <div class="col-md-12"  style="margin-bottom: 10px;" id="profile_btn">
                     <a class="btn btn-success"> Submit </a>
                  </div>
               </form>
               <div class="gap gap-small">
               </div>
            </div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
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
</script>
@endsection