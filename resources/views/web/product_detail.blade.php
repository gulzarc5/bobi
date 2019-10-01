@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
  <div class="main-container col1-layout">
    <div class="container">
      @if (isset($data))
        <div class="row">
          <div class="col-main">
            <div class="product-view-area">
              <div class="product-big-image col-xs-12 col-sm-5 col-lg-5 col-md-5">
                <div class="icon-sale-label sale-left">Sale</div>
                <div class="large-image"> <a href="{{asset('images/product/'.$data['product']->main_image.'')}}" class="cloud-zoom" id="magni_img" data-big="{{asset('images/product/'.$data['product']->main_image.'')}}" data-overlay="{{asset('web/images/magnifying_glass.png')}}" rel="useWrapper: false, adjustY:0, adjustX:20"> <img  src="{{asset('images/product/'.$data['product']->main_image.'')}}" alt="pr img"/></a> </div>
                <div class="flexslider flexslider-thumb">
                  <ul class="previews-list slides">
                    @if (isset($data['images']))
                      @foreach ($data['images'] as $image)
                        <li><a href='{{asset('images/product/'.$image->image.'')}}' class='cloud-zoom-gallery' rel="useZoom: 'magni_img', smallImage: '{{asset('images/product/'.$image->image.'')}}' "><img src="{{asset('images/product/'.$image->image.'')}}" alt = "Thumbnail 2"/></a></li>
                      @endforeach
                        
                    @endif
                    {{-- <li><a href='{{asset('web/images/products/img01.jpg')}}' class='cloud-zoom-gallery' rel="useZoom: 'magni_img', smallImage: '{{asset('web/images/products/img01.jpg')}}' "><img src="{{asset('web/images/products/img01.jpg')}}" alt = "Thumbnail 2"/></a></li>
                    <li><a href='{{asset('web/images/products/img07.jpg')}}' class='cloud-zoom-gallery' rel="useZoom: 'magni_img', smallImage: '{{asset('web/images/products/img07.jpg')}}' "><img src="{{asset('web/images/products/img07.jpg')}}" alt = "Thumbnail 1"/></a></li>
                    <li><a href='{{asset('web/images/products/img02.jpg')}}' class='cloud-zoom-gallery' rel="useZoom: 'magni_img', smallImage: '{{asset('web/images/products/img02.jpg')}}' "><img src="{{asset('web/images/products/img02.jpg')}}" alt = "Thumbnail 1"/></a></li>
                    <li><a href='{{asset('web/images/products/img03.jpg')}}' class='cloud-zoom-gallery' rel="useZoom: 'magni_img', smallImage: '{{asset('web/images/products/img03.jpg')}}' "><img src="{{asset('web/images/products/img03.jpg')}}" alt = "Thumbnail 2"/></a></li>
                    <li><a href='{{asset('web/images/products/img04.jpg')}}' class='cloud-zoom-gallery' rel="useZoom: 'magni_img', smallImage: '{{asset('web/images/products/img04.jpg')}}' "><img src="{{asset('web/images/products/img04.jpg')}}" alt = "Thumbnail 2"/></a></li> --}}
                  </ul>
                </div>
                
                <!-- end: more-images --> 
                
              </div>
              <div class="col-xs-12 col-sm-7 col-lg-7 col-md-7 product-details-area">
                <div class="product-name">
                  <h1>{{$data['product']->name}}</h1>
                </div>
                <div class="price-box">
                  <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> ₹329.99 </span> </p>
                  <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $359.99 </span> </p>
                </div>
                <div class="ratings">
                  <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                  <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p>
                  <p class="availability in-stock pull-right">Availability: <span>In Stock</span></p>
                </div>
                <div class="short-description">
                  <h2>Quick Overview</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum.<a class="desp" style="cursor: pointer;">More Description</a></p>
                </div>
                <div class="product-color-size-area">
                  <div class="color-area">
                    <h2 class="saider-bar-title">Color</h2>
                    <div class="color">
                      <ul>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                        <li><a></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="size-area">
                    <h2 class="saider-bar-title">Size</h2>
                    <div class="size">
                      <ul>
                        <li><a><input type="radio" name="size" value="1"  hidden> S</a></li>
                        <li><a><input type="radio" name="size" value="2" checked hidden> L</a></li>
                        <li><a><input type="radio" name="size" value="3" hidden> M</a></li>
                        <li><a><input type="radio" name="size" value="4" hidden> XL</a></li>
                        <li><a><input type="radio" name="size" value="5" hidden> XXL</a></li> 
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="product-variation">
                  <form action="#" method="post">
                    <div class="cart-plus-minus">
                      <label for="qty">Quantity:</label>
                      <div class="numbers-row">
                        <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="dec qtybutton"><i class="fa fa-minus">&nbsp;</i></div>
                        <input type="text" class="qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                        <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="inc qtybutton"><i class="fa fa-plus">&nbsp;</i></div>
                      </div>
                    </div>
                    <button class="button pro-add-to-cart" title="Add to Cart" type="button"><span><i class="pe-7s-cart"></i> Add to Cart</span></button>
                  </form>
                </div>
                <div class="product-cart-option">
                  <ul>
                    <li><a href="#"><i class="pe-7s-like"></i><span>Add to Wishlist</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="product-overview-tab">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="product-tab-inner">
                    <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                      <li class="active"> <a href="#description" data-toggle="tab"> Description </a> </li>
                    </ul>
                    <div id="productTabContent" class="tab-content">
                      <div class="tab-pane fade in active" id="description">
                        <div class="std">
                          <p>Proin lectus ipsum, gravida et mattis vulputate, 
                            tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in 
                            faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend 
                            laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla
                            luctus malesuada tincidunt. Nunc facilisis sagittis ullamcorper. Proin 
                            lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et 
                            lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et 
                            ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus 
                            adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada 
                            tincidunt. Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, 
                            gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                            cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl 
                            ut dolor dignissim semper. Nulla luctus malesuada tincidunt.</p>
                          <p> Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer enim purus, posuere at ultricies eu, placerat a felis. Suspendisse aliquet urna pretium eros convallis interdum. Quisque in arcu id dui vulputate mollis eget non arcu. Aenean et nulla purus. Mauris vel tellus non nunc mattis lobortis.</p>
                          <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et, luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>  
  <!-- Main Container End --> 
  
  <!-- Related Product Slider -->  
  <div class="container mt-20 slider-product">
    <div class="home-tab box-shadow ">
      <div class="page-header" style=" display: flex;justify-content: space-between;margin-top: 0">
        <h2>Related Products</h2>
        <a href="#" class="btn outline btn-color" style="font-size: 13px; letter-spacing: 0px; font-weight: 500; margin: 0px 0px 0px 15px; transition: none 0s ease 0s; line-height: 18px; border-width: 1px; padding: 8px 15px;" target="_blank">View more</a>
      </div><hr>
      <div id="productTabContent" class="tab-content">
        <div class="tab-pane active in" id="women">
          <div class="featured-pro">
            <div class="slider-items-products">
              <div id="women-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="icon-new-label new-left">New</div>
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> 
                            <img class="first-img" src="{{asset('web/images/products/img16.jpg')}}" alt=""> 
                          </figure>
                          </a> </div>
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
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img02.jpg')}}" alt=""> 
                          </figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $456.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $567.00 </span> </p>
                              </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img03.jpg')}}" alt=""> </figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $456.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $567.00 </span> </p>
                              </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="icon-sale-label sale-left">Sale</div>
                      <div class="icon-new-label new-right">New</div>
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img04.jpg')}}" alt=""> </figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="icon-new-label new-left">New</div>
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img16.jpg')}}" alt=""> </figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $456.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $567.00 </span> </p>
                              </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img02.jpg')}}" alt=""> </figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="men">
          <div class="top-sellers-pro">
            <div class="slider-items-products">
              <div id="men-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4 ">
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="icon-sale-label sale-left">Sale</div>
                        <div class="icon-new-label new-right">New</div>
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img03.jpg')}}" alt=""> <img class="hover-img" src="{{asset('web/images/products/img03.jpg')}}" alt=""></figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="icon-sale-label sale-left">Sale</div>
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img08.jpg')}}" alt=""> <img class="hover-img" src="{{asset('web/images/products/img08.jpg')}}" alt=""></figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $456.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $567.00 </span> </p>
                              </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img01.jpg')}}" alt=""> <img class="hover-img" src="{{asset('web/images/products/img01.jpg')}}" alt=""></figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $456.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $567.00 </span> </p>
                              </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img04.jpg')}}" alt=""> <img class="hover-img" src="{{asset('web/images/products/img04.jpg')}}" alt=""></figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img05.jpg')}}" alt=""> <img class="hover-img" src="{{asset('web/images/products/img05.jpg')}}" alt=""></figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $456.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $567.00 </span> </p>
                              </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-item">
                    <div class="item-inner">
                      <div class="product-thumbnail">
                        <div class="pr-img-area"> <a title="Ipsums Dolors Untra" href="single_product.html">
                          <figure> <img class="first-img" src="{{asset('web/images/products/img06.jpg')}}" alt=""> <img class="hover-img" src="{{asset('web/images/products/img06.jpg')}}" alt=""></figure>
                          </a> </div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title"> <a title="Ipsums Dolors Untra" href="single_product.html">Ipsums Dolors Untra </a> </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                            <div class="pro-action flex-center">
                              <div class="mt-button add_to_wishlist"> <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                              <button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Related Product Slider End -->
<script>
  $(".desp").click(function scrollWin() {    
  window.scrollTo(0, 350)
});
</script>
  <!-- Page Content -->
@endsection