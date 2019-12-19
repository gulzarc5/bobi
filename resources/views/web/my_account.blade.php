@extends('web.templet.master')
@section('content')
<div class="container">
   <div class="row">
         <div class="col-md-4 col-xs-12 m-p-0">
            <div class="atom-panel atom-panel--left left" style="margin-top: 20px;
               margin-bottom: 20px;">
               <div class="atom-toolbar atom-toolbar-vertical expanded">
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
               </div>
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
               <div id="change_password_msg"></div>
               <div class="form-group" style="margin-top: 20px;">
                  <label>Current Password</label>
                  <input class="form-control" type="text" name="current_password" id="current_password" />
                  <span class="invalid-feedback" role="alert" style="color:red" id="current_password_change_pass"></span>
               </div>
               <div class="form-group">
                  <label>New Password</label>
                  <input class="form-control" type="text" name="new_password" id="new_password" />
                  <span class="invalid-feedback" role="alert" style="color:red" id="new_password_change_pass"></span>
               </div>
               <div class="form-group">
                  <label>Comfirm Password</label>
                  <input class="form-control" type="text" name="confirm_password" id="confirm_password" />
                  <span class="invalid-feedback" role="alert" style="color:red" id="confirm_password_change_pass"></span>
               </div>
               <input class="btn btn-primary" type="button" value="Submit" onclick="changePasses();"/>
               <div class="gap gap-small">
               </div>
            </div>


            <div class="mfp-with-anim " id="shippingaddress-form" style="margin-top: -20px; display: none;">
               @if (isset($shipping_address) && !empty($shipping_address) && ($shipping_address->count()) > 0)               
               {{-- ////////////////Shipping Address View Artea/////////////// --}}
               @php
                   $count_shipping_addr = 1;
               @endphp
                <h3 style="margin-left: 15px; margin-top: 50px;">Shipping Address</h3>
                <div id="message_shipping_s"></div>
               @foreach ($shipping_address as $address)
                  <div class="row">
                  <input type="hidden" id="address_id_s{{$count_shipping_addr}}" value="{{ $address->id}}">
                     <div class="col-lg-12">
                        <div style="margin-top: 30px;">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>State</label>
                              <select class="form-control" name="state" id="state_s{{$count_shipping_addr}}" disabled>
                                    <option selected disabled>...Select State...</option>
                                    @if(isset($states) && !empty($states))
                                          @foreach($states as $state)
                                          @if ($address->state_id == $state->id)
                                             <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                                          @else
                                             <option value="{{ $state->id }}" >{{ $state->name }}</option>
                                          @endif
                                                
                                          @endforeach
                                       @endif
                                 </select>
                                 <span class="invalid-feedback" id="state_shipping_error{{$count_shipping_addr}}" role="alert" style="color:red"></span>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>City</label>
                                 <select class="form-control" name="city" id="city_s{{$count_shipping_addr}}" disabled>
                                    <option selected disabled>...Select City...</option>
                                    @if(isset($address->cities) && !empty($address->cities))
                                    @foreach ($address->cities as $city)
                                       @if ($address->city_id == $city->id )
                                       <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                       @else
                                       <option value="{{ $city->id }}">{{ $city->name }}</option>
                                       @endif                                       
                                    @endforeach
                                    @endif
                                 </select>
                                 <span class="invalid-feedback" id="city_shipping_error{{$count_shipping_addr}}" role="alert" style="color:red"></span>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Pin Code</label>
                              <input class="form-control" type="text" name="pin" value="{{$address->pin}}" id="pin_s{{$count_shipping_addr}}" disabled/>
                              <span class="invalid-feedback" id="pin_shipping_error{{$count_shipping_addr}}" role="alert" style="color:red"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                     <textarea rows="5" cols="45" class="form-control" placeholder="address" name="address" id="address_s{{$count_shipping_addr}}" disabled>{{$address->address}}</textarea>
                     <span class="invalid-feedback" id="address_shipping_error{{$count_shipping_addr}}" role="alert" style="color:red"></span>
                     </div>
                     <center>
                           <div class="col-md-4"></div>
                           <div id="button_s{{$count_shipping_addr}}">
                                 <div class="col-md-2"  style="margin-bottom: 10px;">
                                       <input class="btn btn-warning" type="button" id="edit_s{{$count_shipping_addr}}" value="Edit" /onclick="editShippingAddress({{$count_shipping_addr}});">
                                 </div>
                           </div>
                           
                           <div class="col-md-2" style="margin-bottom: 10px;">
                           <a href="{{ route('web.delete_shipping_address',['address_id'=> encrypt($address->id)])}}" class="btn btn-danger">Delete</a>
                           </div>
                           <div class="col-md-4"></div>
                        </center>
                  </div>
                  @php
                   $count_shipping_addr++;
                  @endphp
               @endforeach
             
               
                 {{--///////////////// End Of Shipping Address View Area ////////////--}}
               <div class="gap gap-small"></div>
               @endif
              
                 {{-- ////////////////Shipping Address Form/////////////// --}}
                  <div class="row">    
                     <hr>                 
                     <div id="message_shipping"></div>
                    <div class="col-lg-12">
                        <h3 >Add New Shipping Address</h3>
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
                                <span class="invalid-feedback" id="state_shipping_error" role="alert" style="color:red"></span>
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="form-group">
                                <label>City</label>
                                <select class="form-control" name="city" id="city_shipping" >
                                   <option selected disabled>...Select City...</option>
                                </select>
                                <span class="invalid-feedback" id="city_shipping_error" role="alert" style="color:red"></span>
                             </div>
                          </div>
                          <div class="col-md-4">
                             <div class="form-group">
                                <label>Pin Code</label>
                                <input class="form-control" type="text" name="pin" value="" id="pin_shipping" />
                                <span class="invalid-feedback" id="pin_shipping_error" role="alert" style="color:red"></span>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <textarea rows="5" cols="45" class="form-control" placeholder="address" name="address" id="address_shipping" ></textarea>
                       <span class="invalid-feedback" id="address_shipping_error" role="alert" style="color:red"></span>
                    </div>
                 </div>
                 <center>
                    <div style="margin-bottom: 10px;">
                       <input class="btn btn-primary" type="button" onclick="shipping_address_add()" value="Submit"  />
                    </div>
                 </center>
                 {{--///////////////// End Of Shipping Address Form ////////////--}}
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
<script>

function editShippingAddress(id) {
   $("#state_s"+id).attr('disabled',false);
   $("#city_s"+id).attr('disabled',false);
   $("#pin_s"+id).attr('disabled',false);
   $("#address_s"+id).attr('disabled',false);
   var btnhtml = '<div class="col-md-2"  style="margin-bottom: 10px;">'+
                     '<input class="btn btn-info" type="button" id="save_s'+id+'"  /value="Save" onclick="saveShippingAddress('+id+');">'+
               '</div>';
   $("#button_s"+id).html(btnhtml);
}

function saveShippingAddress(id) {
   var state_s = $("#state_s"+id).val();
   var city_s = $("#city_s"+id).val();
   var pin_s = $("#pin_s"+id).val();
   var address_s = $("#address_s"+id).val();
   var address_id = $("#address_id_s"+id).val();

   $.ajax({
      type:"POST",
      url:"{{ route('web.update_shipping_address') }}",
      data:{ 
      "_token": "{{ csrf_token() }}",
         state:state_s, 
         city:city_s, 
         pin:pin_s, 
         address:address_s,
         address_id:address_id,
      },
      error:function (error) {
         var err = $.parseJSON(error.responseText)
         $.each(err.errors, function (key, val) {
            $("#" + key + "_shipping_error"+id).html("<strong>"+val[0]+"</strong>");
         });
      },
      success:function(data){
         if (data == 1) {
            $("#state_shipping_error"+id).html("");
            $("#city_shipping_error"+id).html("");
            $("#pin_shipping_error"+id).html("");
            $("#address_shipping_error"+id).html("");
            $("#state_s"+id).attr('disabled',true);
            $("#city_s"+id).attr('disabled',true);
            $("#pin_s"+id).attr('disabled',true);
            $("#address_s"+id).attr('disabled',true);
            $("#message_shipping_s").html("<p class='alert alert-success'>Shipping Address Added Successfully</p>");
            var btnhtml = '<div class="col-md-2"  style="margin-bottom: 10px;">'+
                     '<input class="btn btn-warning" type="button" id="save_s'+id+'"  /value="Edit" onclick="editShippingAddress('+id+');">'+
               '</div>';
            $("#button_s"+id).html(btnhtml);
         }else{
            $("#state_shipping_error"+id).html("");
            $("#city_shipping_error"+id).html("");
            $("#pin_shipping_error"+id).html("");
            $("#address_shipping_error"+id).html("");
            $("#message_shipping_s").html("<p class='alert alert-success'>Something Went Wrong Please Try Again</p>");
         }
         
         console.log(data);
      }
   });
}
function shipping_address_add(){
   var state = $("#state_shipping").val();
   var city = $("#city_shipping").val();
   var pin = $("#pin_shipping").val();
   var address = $("#address_shipping").val();
   $.ajax({
            type:"POST",
            url:"{{ route('web.new_shipping_add') }}",
            data:{ 
            "_token": "{{ csrf_token() }}",
              state:state, 
              city:city, 
              pin:pin, 
              address:address,
            },
            error:function (error) {
               var err = $.parseJSON(error.responseText)
               $.each(err.errors, function (key, val) {
                  $("#" + key + "_shipping_error").html("<strong>"+val[0]+"</strong>");
               });
            },
            success:function(data){
               if (data == 1) {
                  $("#state_shipping_error").html("");
                  $("#city_shipping_error").html("");
                  $("#pin_shipping_error").html("");
                  $("#address_shipping_error").html("");
                  $("#message_shipping").html("<p class='alert alert-success'>Shipping Address Added Successfully</p>");
               }else{
                  $("#state_shipping_error").html("");
                  $("#city_shipping_error").html("");
                  $("#pin_shipping_error").html("");
                  $("#address_shipping_error").html("");
                  $("#message_shipping").html("<p class='alert alert-success'>Something Went Wrong Please Try Again</p>");
               }
               
               console.log(data);
            }
         });
   
}

function changePasses() {
   var current_password = $("#current_password").val();
   var new_password = $("#new_password").val();
   var confirm_password = $("#confirm_password").val();
   $.ajax({
      type:"POST",
      url:"{{ route('web.change_password') }}",
      data:{ 
         "_token": "{{ csrf_token() }}",
         current_password:current_password, 
         new_password:new_password, 
         confirm_password:confirm_password, 
      },
      error:function (error) {
         var err = $.parseJSON(error.responseText)
         console.log(err.errors);
         $("#current_password_change_pass").html("");
         $("#new_password_change_pass").html("");
         $("#confirm_password_change_pass").html("");

         $.each(err.errors, function (key, val) {
            $("#" + key + "_change_pass").html("<strong>"+val[0]+"</strong>");
         });
      },
      success:function(data){
         $("#current_password_change_pass").html("");
         $("#new_password_change_pass").html("");
         $("#confirm_password_change_pass").html("");
         if (data == 1) {
            $("#change_password_msg").html("<p class='alert alert-success'>Password Changed Successfully</p>");
         }else if(data == 2){
            $("#change_password_msg").html("<p class='alert alert-danger'>Current Password Does Not Matched</p>");
         }else{
            $("#change_password_msg").html("<p class='alert alert-danger'>Something Went Wrong Please Try Again</p>");
         }
         
         console.log(data);
      }
   });
}
</script>
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