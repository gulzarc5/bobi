
<!DOCTYPE html>
<html>
<head>
    <!-- Basic page needs -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- Mobile specific metas  -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('web/images/fab.png')}}">
  <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js')}}"></script>
  <!-- CSS Style -->
  <link rel="stylesheet" href="{{asset('web/css/url.css')}}">
  <title>Bibibobi || Seller </title>
</head>
<body>
    <!-- Page Content  style="background: url(web/images/slider/slider-bg1.jpg);" -->
    <section class="main-container col1-layout seller">
      <div class="main container">
        <div class="row">  
          <div class="col-md-9" style="z-index: 9;">
            <div class="row spl-sell">
              <div class="col-sm-6 inst"><img src="{{asset('web/images/seller/create account.jpg')}}"><img class="arrow1" src="{{asset('web/images/seller/arrow.png')}}"></div>
              <div class="col-sm-6 inst"><img src="{{asset('web/images/seller/add-product.jpg')}}"><img class="arrow2" src="{{asset('web/images/seller/arrow.png')}}"></div>
              <div class="clearfix"></div>
              <div class="col-sm-6 inst"><img src="{{asset('web/images/seller/money to seller1.jpg')}}"><img class="arrow3" src="{{asset('web/images/seller/arrow.png')}}"></div>
              <div class="col-sm-6 inst" style="float: right;"><img src="{{asset('web/images/seller/delivery-product.jpg')}}"></div>
            </div>
          </div>
          <div class="col-md-3 page-content" style="margin-top: -26px;">            
            <div class="flex-center"><img src="{{asset('web/images/logo.png')}}"></div>          
            <div class="account-login">
              {{ Form::open(['method' => 'post','route'=>'web.seller_registration']) }}
                <div class="box-authentication" style="padding-top: 10px">
                  <h4>Register</h4>
                    @if (Session::has('message'))
                      <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif @if (Session::has('error'))
                      <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                  <label for="emmail_login">Name<span class="required">*</span></label>
                  <input id="emmail_login" name="name" type="text" class="form-control">
                    @if($errors->has('name'))
                      <span class="invalid-feedback" role="alert" style="color:red">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span> <br>
                    @enderror
                  <label for="emmail_login">Email address<span class="required">*</span></label>
                  <input id="emmail_login" name="email" type="text" class="form-control">
                    @if($errors->has('email'))
                      <span class="invalid-feedback" role="alert" style="color:red">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span> <br>
                    @enderror
                  <label for="emmail_login">Mobile<span class="required">*</span></label>
                  <input id="emmail_login" name="mobile" type="number" class="form-control">
                      @if($errors->has('mobile'))
                        <span class="invalid-feedback" role="alert" style="color:red">
                          <strong>{{ $errors->first('mobile') }}</strong>
                        </span> <br>
                      @enderror
                  <label for="password_login">Password<span class="required">*</span></label>
                  <input id="password_login" name="password" type="password" class="form-control">  
                    @if($errors->has('password'))
                      <span class="invalid-feedback" role="alert" style="color:red">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span> <br>
                    @enderror            
                  <label for="password_login">Confirm Password<span class="required">*</span></label>
                  <input id="password_login" name="confirmed" type="password" class="form-control">
                    @if($errors->has('confirmed'))
                      <span class="invalid-feedback" role="alert" style="color:red">
                        <strong>{{ $errors->first('confirmed') }}</strong>
                      </span> <br>
                    @enderror  

                  <button class="button"><i class="icon-lock icons"></i>&nbsp; <span>Signup</span></button>              
                  <hr>
                  <p class="forgot-pass"><span class="required">*</span>If you are already registered <a href="{{ route('seller_login')}}"><span style="text-decoration: underline;">Login</span></a></p>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div> 
      </div>      
      <div class="overley"></div>
      <div class="footer-fixd">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-xs-12 coppyright"> Copyright © 2019 <a href="#"> Bibibobi </a>. All Rights Reserved. || Developed By <a href="https://www.webinfotech.net.in/">Webinfotech</a></div>
            <div class="col-sm-6 col-xs-12">
              <ul class="footer-company-links">
                <li> <a href="#">Sell on Bibibobi</a> </li>
                <li> <a href="#">Terms & Condition</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Page Content -->
     <!-- jquery js --> 
      <script type="text/javascript" src="{{asset('web/js/jquery.min.js')}}"></script> 

      <!-- bootstrap js --> 
      <script type="text/javascript" src="{{asset('web/js/bootstrap.min.js')}}"></script> 

      <!-- owl.carousel.min js --> 
      <script type="text/javascript" src="{{asset('web/js/owl.carousel.min.js')}}"></script> 

      <!-- jquery.mobile-menu js --> 
      <script type="text/javascript" src="{{asset('web/js/mobile-menu.js')}}"></script> 

      <!--jquery-ui.min js --> 
      <script type="text/javascript" src="{{asset('web/js/jquery-ui.js')}}"></script> 

      <!-- main js --> 
      <script type="text/javascript" src="{{asset('web/js/main.js')}}"></script> 
      <!-- <script type="text/javascript" src="html/js/main.js"></script>  -->

      <!-- countdown js --> 
      <script type="text/javascript" src="{{asset('web/js/countdown.js')}}"></script> 
</body>
</html>