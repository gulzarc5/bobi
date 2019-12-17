<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Bibibobi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('web/images/fab.png')}}">
  <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('web/css/url.css')}}">
</head>

<body class="cms-index-index cms-home-page product-page">
  <!-- mobile menu -->
  <div id="mobile-menu">
    <div class="mobile-menu-top" style="background: #fff">
        <img src="{{asset('web/images/logo.png')}}" style="width: 100%;padding: 10px 48px;">
    </div>
    <ul>
      <li><a href="{{ route('web.index') }}" class="home1">Home</a></li>

      <li><a>Men</a>
        <ul class="level0">
          @if (isset($category_list['category_list_men']) && !empty($category_list['category_list_men']))
          @foreach ($category_list['category_list_men'] as $f_category)
                @if (count($f_category['second_category']) > 0)
                  <li class="parent item"> <a><span>{{ $f_category['name'] }}</span></a>
                  <ul class="level1">
                    @foreach ($f_category['second_category'] as $s_category)
                      <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                    @endforeach
                  </ul>
                  @endif
              @endforeach                                  
          @endif
        </ul>
      </li>
      <li><a>Women</a>
        <ul class="level0">
            @if (isset($category_list['category_list_women']) && !empty($category_list['category_list_women']))
              @foreach ($category_list['category_list_women'] as $f_category)
                @if (count($f_category['second_category']) > 0)
                  <li> <a><span>{{ $f_category['name'] }}</span></a>
                  <ul>
                    @foreach ($f_category['second_category'] as $s_category)
                      <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                    @endforeach
                  </ul>
                @endif
              @endforeach
            @endif
        </ul>
      </li>
      <li><a href="#">Women Traditional</a>
        <ul>
          @if (isset($category_list['category_list_womenTraditional']) && !empty($category_list['category_list_womenTraditional']))
            @foreach ($category_list['category_list_womenTraditional'] as $f_category)
              @if (count($f_category['second_category']) > 0)
                <li> <a><span>{{ $f_category['name'] }}</span></a>
                <ul>
                  @foreach ($f_category['second_category'] as $s_category)
                    <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                  @endforeach
                </ul>
              @endif
            @endforeach
          @endif
        </ul>
      </li>
      <li><a href="#">Men Traditional</a>
        <ul>
          @if (isset($category_list['category_list_menTraditional']) && !empty($category_list['category_list_menTraditional']))
            @foreach ($category_list['category_list_menTraditional'] as $f_category)
              @if (count($f_category['second_category']) > 0)
                <li> <a><span>{{ $f_category['name'] }}</span></a>
                <ul>
                  @foreach ($f_category['second_category'] as $s_category)
                    <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                  @endforeach
                </ul>
              @endif
            @endforeach
          @endif
        </ul>
      </li>

      <li><a href="#">GIFT ITEM</a>
        <ul>
          @if (isset($category_list['category_list_gift_item']) && !empty($category_list['category_list_gift_item']))
            @foreach ($category_list['category_list_gift_item'] as $f_category)
              @if (count($f_category['second_category']) > 0)
                <li> <a><span>{{ $f_category['name'] }}</span></a>
                <ul>
                  @foreach ($f_category['second_category'] as $s_category)
                    <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                  @endforeach
                </ul>
              @endif
            @endforeach
          @endif
        </ul>
      </li>

      <li><a href="#">HANDICRAFT</a>
        <ul>
          @if (isset($category_list['category_list_handicuft_item']) && !empty($category_list['category_list_handicuft_item']))
            @foreach ($category_list['category_list_handicuft_item'] as $f_category)
              @if (count($f_category['second_category']) > 0)
                <li> <a><span>{{ $f_category['name'] }}</span></a>
                <ul>
                  @foreach ($f_category['second_category'] as $s_category)
                    <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                  @endforeach
                </ul>
              @endif
            @endforeach
          @endif
        </ul>
      </li>
      <li><a href="{{ route('web.contact')}}">Contact Us</a></li>
    </ul>
  </div>
  <!-- end mobile menu -->
  <div id="page">   
    <!-- Header -->
    <header>
      <div class="header-container">
        <!-- header inner -->
        <div class="header-inner">
          <div class="container">
            <div class="row">
              <div class="col-sm-3 col-md-2 col-xs-12 jtv-logo-block">
                <div class="mega-container">
                  <div class="navleft-container">
                    <div class="mega-menu-title hidden-xs hidden-lg"> <i class="pe-7s-menu icons"></i>
                      <h3 class="hidden">Shop by category</h3>
                    </div>
                    <div class="mm-toggle-wrap">
                      <div class="mm-toggle"><i class="pe-7s-menu icons"></i> </div>
                      <span class="mm-label hidden">Categories</span> 
                    </div>
                    <!-- Header Logo -->
                    <div class="logo"><a title="e-commerce" href="{{ route('web.index')}}"><img alt="e-commerce" src="{{asset('web/images/logo.png')}}"></a> </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 col-md-5 jtv-top-search">
                <div class="top-search">
                  <div id="search">
                    <form>
                      <div class="input-group flex">
                        <input type="text" class="form-control" placeholder="Search for product..." name="search">
                        <button class="btn-search" type="button"><i class="fa fa-search"></i></button>
                      </div>
                      <div class="dialog-box" style="display: ;">
                        <ul>
                          <li><a href="#">T-Shirt</a></li>
                          <li><a href="#">Jeans</a></li>
                          <li><a href="#">Jackets</a></li>
                          <li><a href="#">Shoes</a></li>
                          <li><a href="#">Sunglasses</a></li>
                          <li><a href="#">Sweater</a></li>
                          {{-- /////////////////////////////////// --}}
                          <li class="flex-center"><i class="fa fa-spinner fa-spin"></i></li>
                          {{-- /////////////////////////////////// --}}
                        </ul>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-sm-5 col-md-5 col-xs-12 header-right">
                <div class="top-cart-contain tab-head">
                  <div style="width: 100%">
                    <div class="basket dropdown-toggle" style="width: 100%">
                      <a href="{{ route('seller_login') }}" target="_blank" class="flex-center">
                        <div class="cart-icon"><i class="pe-7s-home" style="font-size: 26px"></i></div>
                        <div class="shoppingcart-inner" style="margin-top: 9px;"><span class="cart-title hidden-xs">&nbsp;Sell</span></div>
                      </a>
                    </div>
                  </div>
                </div>
                <!-- My Account --> 
                <div class="jtv-user-info hidden-xs tab-head" id="account-head">
                  <div class="dropdown"><a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i style="font-size: 26px" class="pe-7s-user"></i><span>Account</span> <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="{{ route('web.myprofile')}}">My Account</a></li>
                      <li><a href="{{ route('web.order_history')}}">My Orders</a></li>
                      <li class="divider"></li>
                      
                      @auth('buyer')
                        <li><a  class="btn outline btn-color" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Log Out</a></li>
                        <form id="logout-form" action="{{ route('web.buyerLogout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      @else
                        <li style="text-align: center;"><a href="{{ route('web.user_registration_form')}}"> <span>If you are a new user</span><br><strong>Register</strong></a></li>
                        <li class="login"><a href="{{ route('web.userLoginForm')}}" class="btn outline btn-color" >Login</a></li>
                      @endauth
                     
                    </ul>
                  </div>
                </div>
                <!-- Whishlist-->
                <div class="top-cart-contain">
                  <div class="mini-cart">
                    <div class="basket dropdown-toggle"><a href="{{ route('web.view_wish_list')}}">
                      <div class="cart-icon"><i class="pe-7s-like"></i></div>
                      <div class="shoppingcart-inner"><span class="cart-title hidden-xs">My Wishlist</span> <span class="cart-total">
                        @if (isset($category_list['wish_list_count']) && !empty($category_list['wish_list_count']))
                          {{ $category_list['wish_list_count'] }}
                        @else
                          0
                        @endif
                         items</span></div>
                      </a>
                    </div>
                  </div>
                </div>
                <!-- My Cart -->
                <div class="top-cart-contain">
                  <div class="mini-cart">
                    <div class="basket dropdown-toggle"><a href="{{ route('web.viewCart')}}">
                      <div class="cart-icon"><i class="pe-7s-shopbag"></i></div>
                      <div class="shoppingcart-inner"><span class="cart-title hidden-xs">My Basket</span> <span class="cart-total">
                  
                        @if (isset($category_list['cart_count']) && !empty($category_list['cart_count']))
                          {{ $category_list['cart_count'] }}
                        @else
                          0
                        @endif
                         items</span></div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>        
          <!-- Navigation -->  
          <nav class="hidden-xs desktop-menu">
            <div class="container">
              <div class="mm-toggle-wrap">
                <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
              </div>
              <div class="nav-inner"> 
                <!-- BEGIN NAV -->
                <ul id="nav" class="hidden-xs">
                  <li class="drop-menu"><a href="{{ route('web.index') }}" class="level-top active"><span>Home</span></a></li>
                  <li class="mega-menu"> <a class="level-top" href="#"><span>Men</span></a>
                    <div class="jtv-menu-block-wrapper">
                      <div class="jtv-menu-block-wrapper2">
                        <div class="nav-block jtv-nav-block-center">
                          <div class="col-1">
                            <ul class="level0">
                              @if (isset($category_list['category_list_men']) && !empty($category_list['category_list_men']))
                              @foreach ($category_list['category_list_men'] as $f_category)
                                    @if (count($f_category['second_category']) > 0)
                                      <li class="parent item"> <a><span>{{ $f_category['name'] }}</span></a>
                                      <ul class="level1">
                                        @foreach ($f_category['second_category'] as $s_category)
                                          <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                                        @endforeach
                                      </ul>
                                      @endif
                                  @endforeach                                  
                              @endif
                            </ul>
                          </div>
                          <div class="col-2">
                            <div class="jtv-nav-image1"> <a title="" href="#"><img alt="menu_image" src="{{asset('web/images/menu-img1.jpg')}}"> </a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="mega-menu"> <a class="level-top" href="#"><span>Women</span></a>
                    <div class="jtv-menu-block-wrapper">
                      <div class="jtv-menu-block-wrapper2">
                        <div class="nav-block jtv-nav-block-center">
                          <div class="col-1">
                            <ul class="level0">
                                @if (isset($category_list['category_list_women']) && !empty($category_list['category_list_women']))
                                  @foreach ($category_list['category_list_women'] as $f_category)
                                    @if (count($f_category['second_category']) > 0)
                                      <li class="parent item"> <a><span>{{ $f_category['name'] }}</span></a>
                                      <ul class="level1">
                                        @foreach ($f_category['second_category'] as $s_category)
                                          <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                                        @endforeach
                                      </ul>
                                    @endif
                                  @endforeach
                                @endif
                            </ul>
                          </div>
                          <div class="col-2">
                            <div class="jtv-nav-image1"> <a title="" href="#"><img alt="menu_image" src="{{asset('web/images/menu-img1.jpg')}}"> </a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                
                  <li class="mega-menu"> <a class="level-top" href="#"><span>Women TRADITIONAL</span></a>
                    <div class="jtv-menu-block-wrapper">
                      <div class="jtv-menu-block-wrapper2">
                        <div class="nav-block jtv-nav-block-center">
                          <div class="col-12">
                            <ul class="level0">
                              @if (isset($category_list['category_list_womenTraditional']) && !empty($category_list['category_list_womenTraditional']))
                                @foreach ($category_list['category_list_womenTraditional'] as $f_category)
                                  @if (count($f_category['second_category']) > 0)
                                    <li class="parent item"> <a><span>{{ $f_category['name'] }}</span></a>
                                    <ul class="level1">
                                      @foreach ($f_category['second_category'] as $s_category)
                                        <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                                      @endforeach
                                    </ul>
                                  @endif
                                @endforeach
                              @endif
                              {{-- <li class="parent item"> <a href="Product_List"><span>tassel saddle bag</span></a>
                                <ul class="level1">
                                  <li> <a href="Product_List"><span>Toaster Crossbody</span></a> </li>
                                  <li> <a href="Product_List"><span>Piper Bag</span></a> </li>
                                  <li> <a href="Product_List"><span>Leather Bag</span></a> </li>
                                  <li> <a href="Product_List"><span>Canvas Bag</span></a> </li>
                                </ul>
                              </li> --}}
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="mega-menu"> <a class="level-top" href="#"><span>Men TRADITIONAL</span></a>
                    <div class="jtv-menu-block-wrapper">
                      <div class="jtv-menu-block-wrapper2">
                        <div class="nav-block jtv-nav-block-center">
                          <div class="col-12">
                            <ul class="level0">
                              @if (isset($category_list['category_list_menTraditional']) && !empty($category_list['category_list_menTraditional']))
                                @foreach ($category_list['category_list_menTraditional'] as $f_category)
                                  @if (count($f_category['second_category']) > 0)
                                    <li class="parent item"> <a><span>{{ $f_category['name'] }}</span></a>
                                    <ul class="level1">
                                      @foreach ($f_category['second_category'] as $s_category)
                                        <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                                      @endforeach
                                    </ul>
                                  @endif
                                @endforeach
                              @endif
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                  <li class="mega-menu"> <a class="level-top" href="#"><span>GIFT ITEM</span></a>
                    <div class="jtv-menu-block-wrapper">
                      <div class="jtv-menu-block-wrapper2">
                        <div class="nav-block jtv-nav-block-center">
                          <div class="col-12">
                            <ul class="level0">
                              @if (isset($category_list['category_list_gift_item']) && !empty($category_list['category_list_gift_item']))
                                @foreach ($category_list['category_list_gift_item'] as $f_category)
                                  @if (count($f_category['second_category']) > 0)
                                    <li class="parent item"> <a><span>{{ $f_category['name'] }}</span></a>
                                    <ul class="level1">
                                      @foreach ($f_category['second_category'] as $s_category)
                                        <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                                      @endforeach
                                    </ul>
                                  @endif
                                @endforeach
                              @endif
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                  <li class="mega-menu"> <a class="level-top" href="#"><span>HANDICRAFT</span></a>
                    <div class="jtv-menu-block-wrapper">
                      <div class="jtv-menu-block-wrapper2">
                        <div class="nav-block jtv-nav-block-center">
                          <div class="col-12">
                            <ul class="level0">
                              @if (isset($category_list['category_list_handicuft_item']) && !empty($category_list['category_list_handicuft_item']))
                                @foreach ($category_list['category_list_handicuft_item'] as $f_category)
                                  @if (count($f_category['second_category']) > 0)
                                    <li class="parent item"> <a><span>{{ $f_category['name'] }}</span></a>
                                    <ul class="level1">
                                      @foreach ($f_category['second_category'] as $s_category)
                                        <li> <a href="{{ route('web.product_list',['second_category_id'=>encrypt($s_category->id)]) }}"><span>{{ $s_category->name }}</span></a> </li>
                                      @endforeach
                                    </ul>
                                  @endif
                                @endforeach
                              @endif
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                  <li class="drop-menu"><a href="{{ route('web.contact')}}" class="level-top active"><span>Contact Us</span></a></li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- end nav --> 
        </div>
      </div>
    </header>
    <!-- end header --> 
