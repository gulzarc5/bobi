<!DOCTYPE HTML>
<html>
<head>
    <title>BPlus
    </title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="keywords" content="Template, html, premium, themeforest" />
    <meta name="description" content="TheBox - premium e-commerce template">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="{{asset('src/img/logo-ww.png')}}" type="image/x-icon">
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'> -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('src/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/mystyles.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/switcher.css')}}" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/bright-turquoise.css')}}" title="bright-turquoise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/turkish-rose.css')}}" title="turkish-rose" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/salem.css')}}" title="salem" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/hippie-blue.css')}}" title="hippie-blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/mandy.css')}}" title="mandy" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/green-smoke.css')}}" title="green-smoke" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/horizon.css')}}" title="horizon" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/cerise.css')}}" title="cerise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/brick-red.css')}}" title="brick-red" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/de-york.css')}}" title="de-york" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/shamrock.css')}}" title="shamrock" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/studio.css')}}" title="studio" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/leather.css')}}" title="leather" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/denim.css')}}" title="denim" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('src/css/schemes/scarlet.css')}}" title="scarlet" media="all" />
    
  </head>
  <body>
    <div class="global-wrapper clearfix" id="global-wrapper">
      <style type="text/css">
        .list{
          margin-top: 20px;
        }
      </style>
      <div class="navbar-before mobile-hidden">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p class="navbar-before-sign">Everything You Need is Bplus
              </p>
            </div>
            <div class="col-md-6">
              <ul class="nav navbar-nav navbar-right navbar-right-no-mar">
                <li>
                  <a href="{{url('about_us')}}">About Us
                  </a>
                </li>
                <li>
                  <a href="{{url('contact_us')}}">Contact Us
                  </a>
                </li>
                <li>
                  <a href="#">FAQ
                  </a>
                </li>
                <li>
                  <a href="#">Terms of use
                  </a>
                </li>
                <li>
                  <a href="#">Help
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="nav-login-dialog">
        <h3 class="widget-title">Member Login
        </h3>
        <p>Welcome back, friend. Login to get started
        </p>
        <hr />
        <form>
          <div class="form-group">
            <label>Email or Username
            </label>
            <input class="form-control" type="text" />
          </div>
          <div class="form-group">
            <label>Password
            </label>
            <input class="form-control" type="text" />
          </div>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Remeber Me
            </label>
          </div>
          <input class="btn btn-primary" type="submit" value="Sign In" />
        </form>
        <div class="gap gap-small">
        </div>
        <ul class="list-inline">
          <li>
            <a href="#nav-account-dialog" class="popup-text">Not Member Yet
            </a>
          </li>
          <li>
            <a href="#nav-pwd-dialog" class="popup-text">Forgot Password?
            </a>
          </li>
        </ul>
      </div>
      <div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="nav-account-dialog">
        <h3 class="widget-title">Create TheBox Account
        </h3>
        <p>Ready to get best offers? Let's get started!
        </p>
        <hr />
        <form>
          <div class="form-group">
            <label>Email
            </label>
            <input class="form-control" type="text" />
          </div>
          <div class="form-group">
            <label>Password
            </label>
            <input class="form-control" type="text" />
          </div>
          <div class="form-group">
            <label>Repeat Password
            </label>
            <input class="form-control" type="text" />
          </div>
          <div class="form-group">
            <label>Phone Number
            </label>
            <input class="form-control" type="text" />
          </div>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Subscribe to the Newsletter
            </label>
          </div>
          <input class="btn btn-primary" type="submit" value="Create Account" />
        </form>
        <div class="gap gap-small">
        </div>
        <ul class="list-inline">
          <li>
            <a href="#nav-login-dialog" class="popup-text">Already Memeber
            </a>
          </li>
        </ul>
      </div>
      <div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="nav-pwd-dialog">
        <h3 class="widget-title">Password Recovery
        </h3>
        <p>Enter Your Email and We Will Send the Instructions
        </p>
        <hr />
        <form>
          <div class="form-group">
            <label>Your Email
            </label>
            <input class="form-control" type="text" />
          </div>
          <input class="btn btn-primary" type="submit" value="Recover Password" />
        </form>
      </div>
      <nav class="navbar navbar-inverse navbar-main yamm">
        <div class="container">
          <div class="navbar-header" >
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-nav-collapse" area_expanded="false">
              <span class="sr-only">Main Menu
              </span>
              <span class="icon-bar">
              </span>
              <span class="icon-bar">
              </span>
              <span class="icon-bar">
              </span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">
              <img src="{{asset('src/img/logo-w.png')}}" alt="Image Alternative text" title="Image Title" />
            </a>
          </div>
          <div class="collapse navbar-collapse" id="main-nav-collapse">
            <ul class="nav navbar-nav" >
              <li class="dropdown">
                <a href="#">
                  <i class="fa fa-reorder">
                  </i>&nbsp; Shop by Category
                  <i class="drop-caret" data-toggle="dropdown">
                  </i>
                </a>
                <ul class="dropdown-menu dropdown-menu-category">

                  @if(isset($category_list) && !empty($category_list))

                    @foreach($category_list as $category)

                      <li>
                        <a href="#">
                          <i class="fa fa-home dropdown-menu-category-icon">
                          </i>{{ $category['name'] }}
                        </a>

                       

                        <div class="dropdown-menu-category-section">
                          <div class="dropdown-menu-category-section-inner">
                            <div class="dropdown-menu-category-section-content">
                              <div class="row">
                                <div class="col-md-12">
                                  <h5 class="dropdown-menu-category-title">{{ $category['name'] }}</h5>
                                     <hr>
                                  <ul class="dropdown-menu-category-list">
                                    @if(!empty($category['first_category']))
                                    @php
                                      $first_div = 1;
                                    @endphp

                                    @foreach($category['first_category'] as $first_category)

                                    @if( ($first_div % 2) == 0 )
                                      <div class="col-md-6">
                                        <li>
                                          <a href="{{route('web.sub_category',['first_id'=>encrypt($first_category->id)])}}">{{ $first_category->name }}
                                          </a>
                                        </li>
                                      </div>
                                    @else
                                      <div class="col-md-6">
                                        <li>
                                          <a href="{{route('web.sub_category',['first_id'=>encrypt($first_category->id)])}}">{{ $first_category->name }}
                                          </a>
                                        </li>
                                      </div>
                                    @endif

                                    @php
                                       $first_div++;
                                    @endphp
                                    @endforeach
                                    @endif
                                   </ul>
                                </div>
                              </div>
                            </div>

                           <img class="dropdown-menu-category-section-theme-img" src="{{asset('images/category/main_category/thumb/'.$category['image'].'')}}" alt="Image Alternative text" title="Image Title" style="right: -10px; height:293px; width: 500 " />
                          </div>
                        </div>                      

                      </li>

                    @endforeach
                  @endif
               
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-left navbar-main-search" role="search">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Search the Entire Store..." />
              </div>
              <a class="fa fa-search navbar-main-search-submit" href="#">
              </a>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="{{url('chat_history')}}" data-effect="mfp-move-from-top" class="">
                  <i class="fa fa-comments-o" aria-hidden="true" style="font-size: 20px;">
                  </i> Chat
                </a>
              </li>
              <!-- <li>
<a href="#nav-login-dialog" data-effect="mfp-move-from-top" class="popup-text">Sign In
</a>
</li> -->
              <!--  <li>
<a href="#nav-account-dialog" data-effect="mfp-move-from-top" class="popup-text">Create Account
</a>
</li> -->
              <li class="dropdown">
                <a href="shopping-cart.html">
                  <i class="fa fa-shopping-cart" style="font-size: 20px;">
                  </i> 3 Items
                </a>
                <ul class="dropdown-menu dropdown-menu-shipping-cart">
                  <li>
                    <a class="dropdown-menu-shipping-cart-img" href="#">
                      <img src="img/cart/1.jpg" alt="Image Alternative text" title="Image Title" />
                    </a>
                    <div class="dropdown-menu-shipping-cart-inner">
                      <p class="dropdown-menu-shipping-cart-price">$52
                      </p>
                      <p class="dropdown-menu-shipping-cart-item">
                        <a href="#">Gucci Patent Leather Open Toe Platform
                        </a>
                      </p>
                    </div>
                  </li>
                  <li>
                    <a class="dropdown-menu-shipping-cart-img" href="#">
                      <img src="{{asset('src/img/cart/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
                    </a>
                    <div class="dropdown-menu-shipping-cart-inner">
                      <p class="dropdown-menu-shipping-cart-price">$43
                      </p>
                      <p class="dropdown-menu-shipping-cart-item">
                        <a href="#">Nikon D5200 24.1 MP Digital SLR Camera
                        </a>
                      </p>
                    </div>
                  </li>
                  <li>
                    <a class="dropdown-menu-shipping-cart-img" href="#">
                      <img src="{{asset('src/img/cart/3.jpg')}}" alt="Image Alternative text" title="Image Title" />
                    </a>
                    <div class="dropdown-menu-shipping-cart-inner">
                      <p class="dropdown-menu-shipping-cart-price">$41
                      </p>
                      <p class="dropdown-menu-shipping-cart-item">
                        <a href="#">Apple 11.6" MacBook Air Notebook 
                        </a>
                      </p>
                    </div>
                  </li>
                  <li>
                    <a class="dropdown-menu-shipping-cart-img" href="#">
                      <img src="{{asset('src/img/cart/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
                    </a>
                    <div class="dropdown-menu-shipping-cart-inner">
                      <p class="dropdown-menu-shipping-cart-price">$77
                      </p>
                      <p class="dropdown-menu-shipping-cart-item">
                        <a href="#">Fossil Women's Original Boyfriend
                        </a>
                      </p>
                    </div>
                  </li>
                  <li>
                    <p class="dropdown-menu-shipping-cart-total">Total: $150
                    </p>
                    <button class="dropdown-menu-shipping-cart-checkout btn btn-primary">Checkout
                    </button>
                  </li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="">
                  <i class="fa fa-user" style="font-size: 20px;">
                  </i> User Account
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#nav-login-dialog" data-effect="mfp-move-from-top" class="popup-text">Sign In
                    </a>
                  </li>
                  <br>
                  <li>
                    <a href="#nav-account-dialog" data-effect="mfp-move-from-top" class="popup-text">Create Account
                    </a>
                  </li>
                  <br>
                  <li>
                    <a href="{{url('seller_login')}}" data-effect="mfp-move-from-top" class="">Sell On Bplus
                    </a>
                  </li>
                  <br>
                  <li>
                    <a href="" data-effect="mfp-move-from-top" class="">Your Orders
                    </a>
                  </li>
                  <br>
                  <li>
                    <a href="" data-effect="mfp-move-from-top" class="">Your Returns
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav> 
