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
  {{-- <div id="mobile-menu">
    <div class="mobile-menu-top" style="height: 100px;background: #323d61">
        <img src="{{asset('web/images/testimonials-img2.jpg')}}')}}" style="width: 23%;border-radius: 50%;margin: 12px 0 5px 12px;border: 5px solid #c3c30d;">
        <h6 style="color: #fff;margin-left: 10px">Wellcome User</h6>
    </div>
    <ul>
      <li><a href="index.html" class="home1">Home</a></li>
      <li><a href="#">Pages</a>
        <ul>
          <li><a href="#">Shop Pages </a>
            <ul class="sub-menu">
              <li><a href="Product_List"><span>Grid View Category Page</span></a></li>
              <li><a href="shop_grid_full_width.html"><span>Grid View Full Width</span></a></li>
              <li><a href="shop_list.html"><span>List View Category Page</span></a></li>
              <li><a href="single_product.html"><span>Full Width Product Page</span> </a></li>
              <li><a href="single_product_sidebar.html"><span>Product Page With Sidebar</span> </a></li>
              <li><a href="single_product_magnify_zoom.html"><span>Product Page Magnify Zoom</span> </a></li>
              <li><a href="shopping_cart.html"><span>Shopping Cart</span></a></li>
              <li><a href="wishlist.html"><span>Wishlist</span></a></li>
              <li><a href="compare.html"><span>Compare Products</span></a></li>
              <li><a href="checkout.html"><span>Checkout</span></a></li>
              <li><a href="sitemap.html"><span>Sitemap</span></a></li>
            </ul>
          </li>
          <li><a href="#">Static Pages </a>
            <ul class="sub-menu">
              <li><a href="about_us.html"><span>About Us</span></a></li>
              <li><a href="contact_us.html"><span>Contact Us</span></a></li>
              <li><a href="orders_list.html"><span>Orders List</span></a></li>
              <li><a href="order_details.html"><span>Order Details</span></a></li>
              <li><a href="404error.html"><span>404 Error</span> </a></li>
              <li><a href="faq.html"><span>FAQ Page</span></a></li>
              <li><a href="manufacturers.html"><span>Manufacturers</span></a></li>
              <li><a href="quick_view.html"><span>Quick View</span></a></li>
              <li><a href="dashboard.html"><span>Account Dashboard</span></a></li>
              <li><a href="shortcodes.html"><span>Shortcodes</span> </a></li>
              <li><a href="typography.html"><span>Typography</span></a></li>
            </ul>
          </li>
          <li><a href="#"> Blog Pages </a>
            <ul class="sub-menu">
              <li><a href="blog_right_sidebar.html">Blog – Right sidebar </a></li>
              <li><a href="blog_left_sidebar.html">Blog – Left sidebar </a></li>
              <li><a href="blog_full_width.html">Blog - Full width</a></li>
              <li><a href="blog_single_post.html">Single post </a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><a href="blog.html">Blog</a>
        <ul>
          <li><a href="blog_right_sidebar.html"> Blog – Right Sidebar </a></li>
          <li><a href="blog_left_sidebar.html"> Blog – Left Sidebar </a></li>
          <li><a href="blog_full_width.html"> Blog – Full-Width </a></li>
          <li><a href="blog_single_post.html"> Single post </a></li>
        </ul>
      </li>
      <li><a href="Product_List">Fashion</a>
        <ul>
          <li><a href="#" class="">Accessories</a>
            <ul>
              <li><a href="Product_List">Cocktail</a></li>
              <li><a href="Product_List">Day</a></li>
              <li><a href="Product_List">Evening</a></li>
              <li><a href="Product_List">Sundresses</a></li>
            </ul>
          </li>
          <li><a href="#">Dresses</a>
            <ul>
              <li><a href="Product_List">Accessories</a></li>
              <li><a href="Product_List">Hats and Gloves</a></li>
              <li><a href="Product_List">Lifestyle</a></li>
              <li><a href="Product_List">Bras</a></li>
            </ul>
          </li>
          <li><a href="#">Shoes</a>
            <ul>
              <li><a href="Product_List">Flat Shoes</a></li>
              <li><a href="Product_List">Flat Sandals</a></li>
              <li><a href="Product_List">Boots</a></li>
              <li><a href="Product_List">Heels</a></li>
            </ul>
          </li>
          <li><a href="#">Jwellery</a>
            <ul>
              <li><a href="Product_List">Bracelets</a></li>
              <li><a href="Product_List">Necklaces &amp; Pendent</a></li>
              <li><a href="Product_List">Pendants</a></li>
              <li><a href="Product_List">Pins &amp; Brooches</a></li>
            </ul>
          </li>
          <li><a href="#">Dresses</a>
            <ul>
              <li><a href="Product_List">Casual Dresses</a></li>
              <li><a href="Product_List">Evening</a></li>
              <li><a href="Product_List">Designer</a></li>
              <li><a href="Product_List">Party</a></li>
            </ul>
          </li>
          <li><a href="#">Swimwear</a>
            <ul>
              <li><a href="Product_List">Swimsuits</a></li>
              <li><a href="Product_List">Beach Clothing</a></li>
              <li><a href="Product_List">Clothing</a></li>
              <li><a href="Product_List">Bikinis</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><a href="Product_List">Women</a>
        <ul>
          <li><a href="#" class="">Clothing</a>
            <ul class="level1">
              <li><a href="Product_List">Coats &amp; Jackets</a></li>
              <li><a href="Product_List">Raincoats</a></li>
              <li><a href="Product_List">Blazers</a></li>
              <li><a href="Product_List">Jackets</a></li>
            </ul>
          </li>
          <li><a href="#">Dresses</a>
            <ul class="level1">
              <li><a href="Product_List">Casual Dresses</a></li>
              <li><a href="Product_List">Evening</a></li>
              <li><a href="Product_List">Designer</a></li>
              <li><a href="Product_List">Party</a></li>
            </ul>
          </li>
          <li><a href="#" class="">Shoes</a>
            <ul class="level1">
              <li><a href="Product_List">Sport Shoes</a></li>
              <li><a href="Product_List">Casual Shoes</a></li>
              <li><a href="Product_List">Leather Shoes</a></li>
              <li><a href="Product_List">canvas shoes</a></li>
            </ul>
          </li>
          <li><a href="#">Jackets</a>
            <ul class="level1">
              <li><a href="Product_List">Coats</a></li>
              <li><a href="Product_List">Formal Jackets</a></li>
              <li><a href="Product_List">Leather Jackets</a></li>
              <li><a href="Product_List">Blazers</a></li>
            </ul>
          </li>
          <li><a href="#">Accesories</a>
            <ul class="level1">
              <li><a href="Product_List">Backpacks</a></li>
              <li><a href="Product_List">Wallets</a></li>
              <li><a href="Product_List">Laptops Bags</a></li>
              <li><a href="Product_List">Belts</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><a href="Product_List">Men</a>
        <ul>
          <li><a href="Product_List">Mobiles</a>
            <ul>
              <li><a href="Product_List">iPhone</a></li>
              <li><a href="Product_List">Samsung</a></li>
              <li><a href="Product_List">Nokia</a></li>
              <li><a href="Product_List">Sony</a></li>
            </ul>
          </li>
          <li><a href="Product_List" class="">Music &amp; Audio</a>
            <ul>
              <li><a href="Product_List">Audio</a></li>
              <li><a href="Product_List">Cameras</a></li>
              <li><a href="Product_List">Appling</a></li>
              <li><a href="Product_List">Car Music</a></li>
            </ul>
          </li>
          <li><a href="Product_List">Accessories</a>
            <ul>
              <li><a href="Product_List">Home &amp; Office</a></li>
              <li><a href="Product_List">TV &amp; Home Theater</a></li>
              <li><a href="Product_List">Phones &amp; Radio</a></li>
              <li><a href="Product_List">All Electronics</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><a href="blog.html">Blog</a>
        <ul>
          <li><a href="blog_right_sidebar.html"> Blog – Right Sidebar </a></li>
          <li><a href="blog_left_sidebar.html"> Blog – Left Sidebar </a></li>
          <li><a href="blog_full_width.html"> Blog – Full-Width </a></li>
          <li><a href="blog_single_post.html"> Single post </a></li>
        </ul>
      </li>
      <li><a href="Product_List">Fashion</a>
        <ul>
          <li><a href="#" class="">Accessories</a>
            <ul>
              <li><a href="Product_List">Cocktail</a></li>
              <li><a href="Product_List">Day</a></li>
              <li><a href="Product_List">Evening</a></li>
              <li><a href="Product_List">Sundresses</a></li>
            </ul>
          </li>
          <li><a href="#">Dresses</a>
            <ul>
              <li><a href="Product_List">Accessories</a></li>
              <li><a href="Product_List">Hats and Gloves</a></li>
              <li><a href="Product_List">Lifestyle</a></li>
              <li><a href="Product_List">Bras</a></li>
            </ul>
          </li>
          <li><a href="#">Shoes</a>
            <ul>
              <li><a href="Product_List">Flat Shoes</a></li>
              <li><a href="Product_List">Flat Sandals</a></li>
              <li><a href="Product_List">Boots</a></li>
              <li><a href="Product_List">Heels</a></li>
            </ul>
          </li>
          <li><a href="#">Jwellery</a>
            <ul>
              <li><a href="Product_List">Bracelets</a></li>
              <li><a href="Product_List">Necklaces &amp; Pendent</a></li>
              <li><a href="Product_List">Pendants</a></li>
              <li><a href="Product_List">Pins &amp; Brooches</a></li>
            </ul>
          </li>
          <li><a href="#">Dresses</a>
            <ul>
              <li><a href="Product_List">Casual Dresses</a></li>
              <li><a href="Product_List">Evening</a></li>
              <li><a href="Product_List">Designer</a></li>
              <li><a href="Product_List">Party</a></li>
            </ul>
          </li>
          <li><a href="#">Swimwear</a>
            <ul>
              <li><a href="Product_List">Swimsuits</a></li>
              <li><a href="Product_List">Beach Clothing</a></li>
              <li><a href="Product_List">Clothing</a></li>
              <li><a href="Product_List">Bikinis</a></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div> --}}
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
                          <div class="col-2">
                            <div class="jtv-nav-image1"> <a title="" href="#"><img alt="menu_image" src="{{asset('web/images/menu-img1.jpg')}}"> </a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="mega-menu"> <a class="level-top" href="Product_List"><span>Women</span></a>
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
                          <div class="col-2">
                            <div class="jtv-nav-image1"> <a title="" href="#"><img alt="menu_image" src="{{asset('web/images/menu-img1.jpg')}}"> </a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  {{-- <li class="mega-menu"> <a class="level-top" href="Product_List"><span>Kids</span></a>
                    <div class="jtv-menu-block-wrapper">
                      <div class="jtv-menu-block-wrapper2">
                        <div class="nav-block jtv-nav-block-center">
                          <div class="col-1">
                            <ul class="level0">
                              <li class="parent item"> <a href="Product_List"><span>tassel saddle bag</span></a>
                                <ul class="level1">
                                  <li> <a href="Product_List"><span>Toaster Crossbody</span></a> </li>
                                  <li> <a href="Product_List"><span>Piper Bag</span></a> </li>
                                  <li> <a href="Product_List"><span>Leather Bag</span></a> </li>
                                  <li> <a href="Product_List"><span>Canvas Bag</span></a> </li>
                                </ul>
                              </li>
                              <li class="parent item"> <a href="Product_List"><span>bucket bag</span></a>
                                <ul class="level1">
                                  <li> <a href="Product_List"><span>Travel Accessories</span></a> </li>
                                  <li> <a href="Product_List"><span>Gym Bags</span></a> </li>
                                  <li> <a href="Product_List"><span>Fashion Waist Packs</span></a> </li>
                                  <li> <a href="Product_List"><span>Messenger Bags</span></a> </li>
                                </ul>
                              </li>
                              <li class="parent item"> <a href="Product_List"><span>saddle bag</span></a>
                                <ul class="level1">
                                  <li> <a href="Product_List"><span>Travel Duffels</span></a> </li>
                                  <li> <a href="Product_List"><span>Umbrellas</span></a> </li>
                                  <li> <a href="Product_List"><span>Waist Packs</span></a> </li>
                                  <li> <a href="Product_List"><span>Travel Gear</span></a> </li>
                                </ul>
                              </li>
                              <li class="parent item"> <a href="Product_List"><span>curved boxy sling</span></a>
                                <ul class="level1">
                                  <li> <a href="Product_List"><span>Luggage</span></a> </li>
                                  <li> <a href="Product_List"><span>Briefcases</span></a> </li>
                                  <li> <a href="Product_List"><span>Bowling</span></a> </li>
                                  <li> <a href="Product_List"><span>Bucket Bag</span></a> </li>
                                </ul>
                              </li>
                              <li class="parent item"> <a href="Product_List"><span>floral lattice bag</span></a>
                                <ul class="level1">
                                  <li> <a href="Product_List"><span>Crossbody Bag</span></a> </li>
                                  <li> <a href="Product_List"><span>Clutch Handbag</span></a> </li>
                                  <li> <a href="Product_List"><span>Hobo Shoulder</span></a> </li>
                                  <li> <a href="Product_List"><span>Saddle Bag</span></a> </li>
                                </ul>
                              </li>
                              <li class="parent item"> <a href="Product_List"><span>Bag Accessories</span></a>
                                <ul class="level1">
                                  <li> <a href="Product_List"><span>Wallet Wristlet</span></a> </li>
                                  <li> <a href="Product_List"><span>Solo Premium </span></a> </li>
                                  <li> <a href="Product_List"><span>Laptop Bags</span></a> </li>
                                  <li> <a href="Product_List"><span>Belts</span></a> </li>
                                </ul>
                              </li>
                            </ul>
                          </div>
                          <div class="col-2">
                            <div class="jtv-nav-image1"> <a title="" href="#"><img alt="menu_image" src="{{asset('web/images/menu-img1.jpg')}}"> </a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li> --}}
                  <li class="mega-menu"> <a class="level-top" href="Product_List"><span>Women TRADITIONAL</span></a>
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
                  <li class="mega-menu"> <a class="level-top" href="Product_List"><span>Men TRADITIONAL</span></a>
                    <div class="jtv-menu-block-wrapper">
                      <div class="jtv-menu-block-wrapper2">
                        <div class="nav-block jtv-nav-block-center">
                          <div class="col-12">
                            <ul class="level0">
                              {{-- <li class="parent item"> <a href="Product_List"><span>tassel saddle bag</span></a>
                                <ul class="level1">
                                  <li> <a href="Product_List"><span>Toaster Crossbody</span></a> </li>
                                  <li> <a href="Product_List"><span>Piper Bag</span></a> </li>
                                  <li> <a href="Product_List"><span>Leather Bag</span></a> </li>
                                  <li> <a href="Product_List"><span>Canvas Bag</span></a> </li>
                                </ul>
                              </li> --}}
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
