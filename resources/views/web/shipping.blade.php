@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
  <section>
      <div class="nav-drict">
          <ul>
              <li class="done"><h6>Cart </h6></li>
              <li class="divider act"></li>
              <li class="active"><h6>Shiping </h6></li>
              <li class="divider"></li>
              <li><h6>Payment</h6></li>
          </ul>
      </div>
  </section>
  <section class="blog_post" style="margin: 0">
    <div class="container">       
      <!-- row -->
      <div class="row">         
        <!-- Center colunm-->
        <div class="col-main col-sm-9 col-xs-12">
          <div class="page-content checkout-page">
              <h4 class="checkout-sep"> Shipping Information</h4>
              <div class="row">
                <div clas="col-md-6"></div>
                <div clas="col-md-6"></div>
              </div>
              <div class="box-border" id="" style="display: block;">
                <ul>
                  <li class="row">
                    <div class="col-sm-12">
                      <label for="first_name_1" class="required">First Name</label>
                      <input class="input form-control" type="text" name="" id="first_name_1">
                    </div>
                    <!--/ [col] -->
                    
                  </li>
                  <!--/ .row -->
                  
                  <li class="row">
                    <div class="col-sm-6">
                      <label for="company_name_1">Phone</label>
                      <input class="input form-control" type="text" name="" id="company_name_1">
                    </div>
                    <!--/ [col] -->
                    
                    <div class="col-sm-6">
                      <label for="email_address_1" class="required">Email Address</label>
                      <input class="input form-control" type="text" name="" id="email_address_1">
                    </div>
                    <!--/ [col] --> 
                    
                  </li>
                  <!--/ .row -->
                  
                  <li class="row">
                    <div class="col-xs-12">
                      <label for="address_1" class="required">Address</label>
                      <input class="input form-control" type="text" name="" id="address_1">
                    </div>
                    <!--/ [col] --> 
                    
                  </li>
                  <!--/ .row -->
                  
                  <li class="row">
                    <div class="col-sm-6">
                      <label for="city_1" class="required">City</label>
                      <input class="input form-control" type="text" name="" id="city_1">
                    </div>
                    <!--/ [col] -->
                    
                    <div class="col-sm-6">
                      <label class="required">State</label>
                      <input class="input form-control" type="text" name="" id="state_1">
                    </div>
                    <!--/ [col] --> 
                    
                  </li>
                  <!--/ .row -->
                  
                  <li class="row">
                    <div class="col-sm-6">
                      <label for="postal_code_1" class="required">Pincode Code</label>
                      <input class="input form-control" type="text" name="" id="postal_code_1">
                    </div>
                    <!--/ [col] -->
                    
                    <div class="col-sm-6">
                      <label class="required">Country</label>
                      <input class="input form-control" type="text" name="" id="country_1">
                    </div>
                    <!--/ [col] --> 
                    
                  </li>
                  <!--/ .row -->
                  
                </ul>
                <button class="button"><i class="fa fa-angle-double-right"></i>&nbsp; <span>Continue</span></button>
              </div>
          </div>
        </div>
        <!-- ./ Center colunm --> 
        <!-- Right colunm -->
        <aside class="right sidebar col-sm-3 col-xs-12">
          <div class="sidebar-checkout block">
            <div class="sidebar-bar-title">
              <h3>Your Checkout</h3>
            </div>
            <div class="block-content">
              <dl>
                <dt class="complete"> Billing Address <span class="separator">|</span> <a href="#">Change</a> </dt>
                <dd class="complete">
                  <address>
                  Deo Jone<br>
                  Company Name<br>
                  7064 Lorem <br>
                  Ipsum <br>
                  Vestibulum 0 666/13<br>
                  United States<br>
                  T: 12345678 <br>
                  F: 987654
                  </address>
                </dd>
                <dt class="complete"> Shipping Address <span class="separator">|</span> <a href="#">Change</a> </dt>
                <dd class="complete">
                  <address>
                  Deo Jone<br>
                  Company Name<br>
                  7064 Lorem <br>
                  Ipsum <br>
                  Vestibulum 0 666/13<br>
                  United States<br>
                  T: 12345678 <br>
                  F: 987654
                  </address>
                </dd>
                <dt class="complete"> Shipping Method <span class="separator">|</span> <a href="#">Change</a> </dt>
                <dd class="complete"> Flat Rate - Fixed <br>
                  <span class="price">$15.00</span> </dd>
                <dt> Payment Method </dt>
              </dl>
            </div>
          </div>
        </aside>
        <!-- ./right colunm --> 
      </div>
      <!-- ./row--> 
    </div>
  </section>
  <!-- Main Container End --> 
@endsection