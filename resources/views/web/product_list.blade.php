@extends('web.templet.master')


@section('content')
  <!-- Main Container -->
  <div class="main-container col2-left-layout">
    <div class="container">
      <div class="row">
        <div class="col-main col-sm-9 col-xs-12 col-sm-push-3">
          {{-- <div class="category-description std">
            <div class="slider-items-products">
              <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col1 owl-carousel owl-theme" style="opacity: 1; display: block;"> 
                  
                  <!-- Item -->
                  <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 2228px; left: 0px; display: block; transition: all 800ms ease 0s; transform: translate3d(-557px, 0px, 0px);"><div class="owl-item" style="width: 557px;"><div class="item"> <a href="#x"><img alt="" src="{{asset('web/images/cat-slider-img1.jpg')}}"></a>
                    <div class="inner-info">
                      <div class="cat-img-title"> <span>Best Product 2017</span>
                        <h2 class="cat-heading">SUMMER COLLECTION</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                        <a class="info" href="#">Shop Now</a> </div>
                    </div>
                  </div></div><div class="owl-item" style="width: 557px;"><div class="item"> <a href="#x"><img alt="" src="{{asset('web/images/cat-slider-img2.jpg')}}"></a> </div></div></div></div>
                  <!-- End Item --> 
                  
                  <!-- Item -->
                  
                  
                  <!-- End Item --> 
                  
                <div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"><a class="flex-prev"></a></div><div class="owl-next"><a class="flex-next"></a></div></div></div></div>
              </div>
            </div>
          </div> --}}
          <div class="shop-inner slider-product">
            <div class="page-title">
              <h2>Men > T-Shirt</h2>
            </div><hr>
            <div class="product-grid-area">
              <ul class="products-grid">
                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> 
                          <a title="Ipsums Dolors Untra" href="single_product.html">
                            <figure><img class="first-img" src="{{asset('web/images/products/img02.jpg')}}" alt=""></figure>
                          </a> 
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> 
                          <a title="Ipsums Dolors Untra" href="single_product.html">
                            <figure><img class="first-img" src="{{asset('web/images/products/img03.jpg')}}" alt=""></figure>
                          </a> 
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> 
                          <a title="Ipsums Dolors Untra" href="single_product.html">
                            <figure><img class="first-img" src="{{asset('web/images/products/img04.jpg')}}" alt=""></figure>
                          </a> 
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> 
                          <a title="Ipsums Dolors Untra" href="single_product.html">
                            <figure><img class="first-img" src="{{asset('web/images/products/img07.jpg')}}" alt=""></figure>
                          </a> 
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> 
                          <a title="Ipsums Dolors Untra" href="single_product.html">
                            <figure><img class="first-img" src="{{asset('web/images/products/img14.jpg')}}" alt=""></figure>
                          </a> 
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> 
                          <a title="Ipsums Dolors Untra" href="single_product.html">
                            <figure><img class="first-img" src="{{asset('web/images/products/img08.jpg')}}" alt=""></figure>
                          </a> 
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> 
                          <a title="Ipsums Dolors Untra" href="single_product.html">
                            <figure><img class="first-img" src="{{asset('web/images/products/img05.jpg')}}" alt=""></figure>
                          </a> 
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> 
                          <a title="Ipsums Dolors Untra" href="single_product.html">
                            <figure><img class="first-img" src="{{asset('web/images/products/img03.jpg')}}" alt=""></figure>
                          </a> 
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> 
                          <a title="Ipsums Dolors Untra" href="single_product.html">
                            <figure><img class="first-img" src="{{asset('web/images/products/img02.jpg')}}" alt=""></figure>
                          </a> 
                        </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="pagination-area">
              <div class="loader loader--style6" title="Loading">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                   width="24px" height="30px" viewBox="0 0 24 30" xml:space="preserve">
                  <rect x="0" y="13" width="4" height="8" fill="#555">
                    <animate attributeName="height" attributeType="XML"
                      values="5;21;5" 
                      begin="0s" dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="y" attributeType="XML"
                      values="13; 5; 13"
                      begin="0s" dur="0.6s" repeatCount="indefinite" />
                  </rect>
                  <rect x="10" y="13" width="4" height="8" fill="#00b9f5">
                    <animate attributeName="height" attributeType="XML"
                      values="5;21;5" 
                      begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="y" attributeType="XML"
                      values="13; 5; 13"
                      begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                  </rect>
                  <rect x="20" y="13" width="4" height="8" fill="#555">
                    <animate attributeName="height" attributeType="XML"
                      values="5;21;5" 
                      begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="y" attributeType="XML"
                      values="13; 5; 13"
                      begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                  </rect>
                </svg>
              </div>
            </div>
          </div>
        </div>
        <aside class="sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          <div class="block shop-by-side">
            <div class="sidebar-bar-title">
              <h3>Men</h3>
            </div>
            <div class="block-content">
              <p class="block-subtitle">Shopping Options</p>
              <div class="manufacturer-area">
                <h2 class="saider-bar-title">Manufacturer</h2>
                <div class="saide-bar-menu">
                  <ul>
                    <li><a href="#"><i class="fa fa-angle-right"></i> Aliquam</a></li>
                    <li><a href="#"><i class="fa fa-angle-right"></i> Duis tempus id </a></li>
                    <li><a href="#"><i class="fa fa-angle-right"></i> Leo quis molestie. </a></li>
                    <li><a href="#"><i class="fa fa-angle-right"></i> Suspendisse </a></li>
                    <li><a href="#"><i class="fa fa-angle-right"></i> Nunc gravida </a></li>
                  </ul>
                </div>
              </div>
              <div class="layered-Category">
                <h2 class="saider-bar-title">Color</h2>
                <div class="layered-content color">
                  <ul class="check-box-list ">
                    <li>
                      <input type="checkbox" id="jtv1" name="jtvc">
                      <label for="jtv1"> <span class="button"></span><a style="background:#333333"></a> Black</label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv2" name="jtvc">
                      <label for="jtv2"> <span class="button"></span><a style="background:#e32b00"></a> Red</label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv3" name="jtvc">
                      <label for="jtv3"> <span class="button"></span><a style="background:#ff9000"></a> Orange</label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv4" name="jtvc">
                      <label for="jtv4"> <span class="button"></span><a style="background:#8BC44A"></a> Green</label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv5" name="jtvc">
                      <label for="jtv5"> <span class="button"></span><a style="background:#10b9b9"></a> Blue</label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv7" name="jtvc">
                      <label for="jtv7"> <span class="button"></span><a style="background:#FFFFFF"></a> White</label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv8" name="jtvc">
                      <label for="jtv8"> <span class="button"></span><a style="background:#333333"></a> Black</label>
                    </li>
                  </ul>
                </div>
              </div>              
              <div class="layered-Category">
                <h2 class="saider-bar-title">Size</h2>
                <div class="layered-content size">
                  <ul class="check-box-list ">
                    <li>
                      <input type="checkbox" id="jtv12" name="jtvc">
                      <label for="jtv12"> <span class="button"></span><a>XS</a> </label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv13" name="jtvc">
                      <label for="jtv13"> <span class="button"></span><a>S</a> </label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv14" name="jtvc">
                      <label for="jtv14"> <span class="button"></span><a>M</a> </label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv15" name="jtvc">
                      <label for="jtv15"> <span class="button"></span><a>L</a> </label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv17" name="jtvc">
                      <label for="jtv17"> <span class="button"></span><a>XL</a> </label>
                    </li>
                    <li>
                      <input type="checkbox" id="jtv18" name="jtvc">
                      <label for="jtv18"> <span class="button"></span><a>XXL</a> </label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="block product-price-range ">
            <div class="sidebar-bar-title">
              <h3>Price</h3>
            </div>
            <div class="block-content">
              <div class="slider-range">
                <div data-label-reasult="Range:" data-min="0" data-max="500" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="50" data-value-max="350"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 10%; width: 60%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 10%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 70%;"></span></div>
                <div class="amount-range-price">Range: $10 - $550</div>
                <ul class="check-box-list">
                  <li>
                    <input type="checkbox" id="p1" name="cc">
                    <label for="p1"> <span class="button"></span> $20 - $50<span class="count">(0)</span> </label>
                  </li>
                  <li>
                    <input type="checkbox" id="p2" name="cc">
                    <label for="p2"> <span class="button"></span> $50 - $100<span class="count">(0)</span> </label>
                  </li>
                  <li>
                    <input type="checkbox" id="p3" name="cc">
                    <label for="p3"> <span class="button"></span> $100 - $250<span class="count">(0)</span> </label>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <!-- Main Container End --> 
@endsection