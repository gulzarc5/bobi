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
               <Form>
                  <div class="row">
                        <h3 style="margin-left: 15px;">Personal Information</h3>
                        <div style="margin-top: 30px;">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Name</label>
                                 <input class="form-control" type="text" name="name" id="name" value="" />
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Email</label>
                                 <input class="form-control" type="email" value=""  />
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Mobile</label>
                                 <input class="form-control" type="text"  value="" />
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Date of Birth</label>
                                 <input class="form-control" type="date" name="dob" id="dob" value="" />
                              </div>
                           </div>
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
                                 <select class="form-control" name="state" id="state" >
                                    <option selected disabled>...Select State...</option>
                                    <option >Assam</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>City</label>
                                 <select class="form-control" name="city" id="city" >
                                    <option selected disabled>...Select City...</option>
                                    <option>Guwahati</option>
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
                  <div class="col-md-12" id="profile_btn" style="margin-bottom: 10px;">
                     <a class="btn btn-warning" onclick="userProfileValidation()"> Edit </a>
                  </div>
               </Form>
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
               <div class="row">
               	 <h3 style="margin-left: 15px; margin-top: 50px;">Shipping Address</h3>
                  <div class="col-lg-12">
                     <div style="margin-top: 30px;">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>State</label>
                              <select class="form-control" name="state" id="state" >
                                 <option selected disabled>...Select State...</option>
                                 <option >Assam</option>
                                 <option >Assam</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>City</label>
                              <select class="form-control" name="city" id="city" >
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
               	<div style="margin-bottom: 10px;">
                  <input class="btn btn-primary" type="button" value="Submit" id="pass_change" />
              </div>
               </center>
               <div class="gap gap-small">
               </div>
               <div class="row">
               	 <h3 style="margin-left: 15px; margin-top: 50px;">Shipping Address</h3>
                  <div class="col-lg-12">
                     <div style="margin-top: 30px;">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>State</label>
                              <select class="form-control" name="state" id="state" >
                                 <option selected disabled>...Select State...</option>
                                 <option >Assam</option>
                                 <option >Assam</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>City</label>
                              <select class="form-control" name="city" id="city" >
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
                  <input class="btn btn-primary" type="button" value="Edit" id="pass_change" />
              </div>
              <div class="col-md-2" style="margin-bottom: 10px;">
                  <input class="btn btn-primary" type="button" value="Delete" id="pass_change" />
              </div>
              	<div class="col-md-4"></div>
               </center>
               <div class="gap gap-small">
               </div>
            </div>
         </div>
   </div>
</div>
</div>
@endsection
@section('script')
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
@endsection