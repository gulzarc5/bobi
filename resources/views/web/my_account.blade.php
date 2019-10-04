@extends('web.templet.master')
@section('content')
<div class="container">
   <div class="row">
         <div class="col-md-4">
            <div class="atom-panel atom-panel--left left" style="margin-top: 20px;
               margin-bottom: 20px;">
               <nav class="atom-toolbar atom-toolbar-vertical expanded">
                  <a href="#" class="btn btn-default active" id="myprofile-form-link">
                  <span class="octicon octicon-beaker"></span>
                  <span class="title">My Profile</span>
                  </a>
                  <hr class="atom-toolbar-spacer">
                  <a href="#" class="btn btn-default"  id="shippingaddress-form-link">
                  <span class="octicon octicon-terminal"></span>
                  <span class="title">Shipping Address</span>
                  </a>
                  <hr class="atom-toolbar-spacer">
                  <a href="#" class="btn btn-default" id="changepass-form-link">
                  <span class="octicon octicon-telescope"></span>
                  <span class="title">Change Password</span>
                  </a>
               </nav>
            </div>
         </div>
         <div class="col-md-8 account" >
            <div class="mfp-with-anim" id="myprofile-form" style=" display: block;">
               @if(isset($user_data) && !empty($user_data))
               {{ Form::open(['method' => 'post','route'=>'web.myprofile_update']) }}
                  <div class="row">
                        <h3 style="margin-left: 15px;">Personal Information</h3>
                        @if (Session::has('message'))
                           <div class="alert alert-success" >{{ Session::get('message') }}</div>
                        @endif
                        @if (Session::has('error'))
                           <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                        <div style="margin-top: 30px;">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Name</label>
                                 <input class="form-control" type="text" name="name" id="name" value="{{ $user_data['user']->name }}" disabled />
                              </div>
                              @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                       <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                              @enderror
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Email</label>
                                 <input class="form-control" type="email" value="{{ $user_data['user']->email }}"  disabled />
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Mobile</label>
                                 <input class="form-control" type="text"  value="{{ $user_data['user']->mobile }}" disabled />
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Date of Birth</label>
                                 <input class="form-control" type="date" name="dob" id="dob" value="{{ $user_data['user_details']->dob }}" disabled />
                              </div>
                              @if($errors->has('dob'))
                                 <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                 </span>
                              @enderror
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Gender</label>
                                 @if(!empty($user_data['user_details']->gender) && ($user_data['user_details']->gender == 'F') )
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
                                 @else
                                    <div style="display: flex;">
                                       <label class="container">
                                       <input type="radio" checked="checked" name="gender" value="M"  id="m" > Male
                                       <span class="checkmark" checked></span>
                                       </label>
                                       <label class="container">
                                       <input type="radio" name="gender" value="F"  id="f" > Female
                                       <span class="checkmark"></span>
                                       </label>
                                    </div>
                                 @endif

                                 @if($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                       <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                 @enderror
                              </div>
                           </div>
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
                                 <select class="form-control" name="state" id="state" disabled >
                                    <option selected disabled>...Select State...</option>
                                    @if(isset($states) && !empty($states))
                                       @foreach($states as $state)
                                          @if($user_data['user_details']->state_id == $state->id)
                                             <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                                          @else
                                             <option value="{{ $state->id }}">{{ $state->name }}</option>
                                          @endif
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
                                 <select class="form-control" name="city" id="city" disabled>
                                    <option selected disabled>...Select City...</option>
                                    @if(!empty($user_data['city_list']))
                                       @foreach($user_data['city_list'] as $city)
                                          @if( $user_data['user_details']->city_id == $city->id)
                                             <option  value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                          @else
                                             <option  value="{{ $city->id }}">{{ $city->name }}</option>
                                          @endif                                             
                                       @endforeach
                                    @endif
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
                                 <input class="form-control" type="text" name="pin" value="{{ $user_data['user_details']->pin  }}" id="pin" disabled/>
                              </div>
                              @if($errors->has('pin'))
                                 <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('pin') }}</strong>
                                 </span>
                              @enderror
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <textarea rows="3" cols="45" class="form-control" placeholder="address" name="address" id="address" disabled>{{ $user_data['user_details']->address  }}</textarea>
                     </div>
                  </div>
                  <div class="col-md-12"  style="margin-bottom: 10px;" id="profile_btn">
                     <a class="btn btn-warning" onclick="userProfileValidation()"> Edit </a>
                  </div>
               {{ Form::close() }}
               @endif
               <div class="gap gap-small">
               </div>
            </div>


            <div class="mfp-with-anim mfp-dialog clearfix" id="changepass-form" style=" display: none;">
               <div id="err_msg"></div>
               <h3 style="margin-left: 15px; margin-top: -60px;">Change Password</h3>
               <div class="form-group" style="margin-top: 20px;">
                  <label>Current Password</label>
                  <input class="form-control" type="text" name="current_pass" />
               </div>
               <div class="form-group">
                  <label>New Password</label>
                  <input class="form-control" type="text" name="new_pass" />
               </div>
               <div class="form-group">
                  <label>Comfirm Password</label>
                  <input class="form-control" type="text" name="confirm_pass" />
               </div>
               <input class="btn btn-primary" type="button" value="Submit" id="pass_change" />
               <div class="gap gap-small">
               </div>
            </div>


            <div class="mfp-with-anim " id="shippingaddress-form" style="margin-top: -20px; display: none;">
               @if (isset($shipping_address) && !empty($shipping_address) && ($shipping_address->count()) > 0))  
               {{-- @php
                  print_r($shipping_address->count());
                  print_r($shipping_address);
               @endphp --}}
               
               {{-- ////////////////Shipping Address View Artea/////////////// --}}
               <div class="row">
                     <h3 style="margin-left: 15px; margin-top: 50px;">Shipping Address</h3>
                    <div class="col-lg-12">
                       <div style="margin-top: 30px;">
                          <div class="col-md-4">
                             <div class="form-group">
                                <label>State</label>
                                <select class="form-control" name="state" id="" >
                                   <option selected disabled>...Select State...</option>
                                   @if(isset($states) && !empty($states))
                                       @foreach($states as $state)
                                             <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                                       @endforeach
                                    @endif
                                </select>
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="form-group">
                                <label>City</label>
                                <select class="form-control" name="city" >
                                   <option selected disabled>...Select City...</option>
                                   <option >Assam</option>
                                   <option >Assam</option>
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
                       <textarea rows="5" cols="45" class="form-control" placeholder="address" name="address" id="address" ></textarea>
                    </div>
                 </div>
                 <center>
                    <div class="col-md-4"></div>
                    <div class="col-md-2"  style="margin-bottom: 10px;">
                    <input class="btn btn-primary" type="button" value="Edit"/>
                </div>
                <div class="col-md-2" style="margin-bottom: 10px;">
                    <input class="btn btn-primary" type="button" value="Delete"/>
                </div>
                   <div class="col-md-4"></div>
                 </center>
                 {{--///////////////// End Of Shipping Address View Area ////////////--}}
               <div class="gap gap-small"></div>
               @else
                 {{-- ////////////////Shipping Address Form/////////////// --}}
                 {{ Form::open(['method' => 'post','route'=>'web.new_shipping_add']) }}
                  <div class="row">
                     <h3 style="margin-left: 15px; margin-top: 50px;">Shipping Address</h3>
                    <div class="col-lg-12">
                       <div style="margin-top: 30px;">
                          <div class="col-md-4">
                             <div class="form-group">
                                <label>State</label>
                                <select class="form-control" name="state" id="state_shipping" >
                                   <option selected disabled>...Select State...</option>
                                   @if(isset($states) && !empty($states))
                                       @foreach($states as $state)
                                             <option value="{{ $state->id }}">{{ $state->name }}</option>
                                       @endforeach
                                    @endif
                                </select>
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="form-group">
                                <label>City</label>
                                <select class="form-control" name="city" id="city_shipping" >
                                   <option selected disabled>...Select City...</option>
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
                       <textarea rows="5" cols="45" class="form-control" placeholder="address" name="address" id="address" ></textarea>
                    </div>
                 </div>
                 <center>
                    <div style="margin-bottom: 10px;">
                       <input class="btn btn-primary" type="submit" value="Submit"  />
                    </div>
                 </center>
                 {{ Form::close() }}
                 {{--///////////////// End Of Shipping Address Form ////////////--}}
               @endif
               <div class="gap gap-small">
               </div>
            </div>
         </div>
   </div>
</div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/web_user_profile.js') }}"></script>
<script type="text/javascript">
   $(function() {
   
      $('#myprofile-form-link').click(function(e) {
   		$("#myprofile-form").delay(100).fadeIn(100);
    		$("#changepass-form").fadeOut(100);
   		$('#changepass-form-link').removeClass('active');
      $("#shippingaddress-form").fadeOut(100);
      $('#shippingaddress-form-link').removeClass('active');
   		$(this).addClass('active');
   		e.preventDefault();
   	});
   	$('#changepass-form-link').click(function(e) {
   		$("#changepass-form").delay(100).fadeIn(100);
    		$("#myprofile-form").fadeOut(100);
   		$('#myprofile-form-link').removeClass('active');
      $("#shippingaddress-form").fadeOut(100);
      $('#shippingaddress-form-link').removeClass('active');
   		$(this).addClass('active');
   		e.preventDefault();
   	});

      $('#shippingaddress-form-link').click(function(e) {
      $("#shippingaddress-form").delay(100).fadeIn(100);
      $("#changepass-form").fadeOut(100);
      $('#changepass-form-link').removeClass('active');
      $("#myprofile-form").fadeOut(100);
      $('#myprofile-form-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });
   
   });
</script>

<script>
   $(document).ready(function(){
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

      $("#state_shipping").change(function(){
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
                        $("#city_shipping").append("<option value='"+key+"'>"+value+"</option>");
                  });

               }
            });
      });
   });

</script>

@endsection