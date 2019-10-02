@extends('web.templet.master')


@section('content')
<style>
  .dot {
    height: 21px;
    width: 35px;
    border-radius: 20%;
    display: inline-block;
    border: 1px solid;
  }
</style>
  <!-- Page Container -->
  <div class="main-container col1-layout">
    <div class="container">
      @if (isset($data))
      <input type="hidden" name="product_id" id="product_id" value="{{encrypt($data['product']->id)}}">
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
                  @if (isset($data['min_price']) && !empty($data['min_price']))
                    <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> ₹{{ number_format($data['min_price']->price,2,".",'') }} </span> </p>
                    <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> ₹{{ number_format($data['min_price']->mrp,2,".",'') }} </span> </p>
                  @endif
                  
                </div>
                <div class="ratings">
                  {{-- <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div> --}}
                  {{-- <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p> --}}
                  @if (isset($data['min_price']) && !empty($data['min_price']))
                    @if ($data['min_price']->stock > 0)
                      <p class="availability in-stock ">Availability: <span>In Stock</span></p>
                    @else
                      <p class="availability out-of-stock ">Availability: <span>Out Of Stock</span></p>
                    @endif
                  @endif
                  
                </div>
                <div class="short-description">
                  <h2>Quick Overview</h2>
                  <p>{{$data['product']->short_description}}</a></p>
                </div>

                {{ Form::open(['method' => 'post','route'=>'web.add_cart']) }}
              <input type="hidden" name="product_id" value="{{ $data['product']->id }}">
                  <div class="product-color-size-area">
                    <div class="color-area">
                      <h2 class="saider-bar-title">Color</h2>
                      <div class="color">
                        <ul>
                          @if (isset($data['colors']) && !empty($data['colors']) )
                            @php
                                $count_color = 1;
                            @endphp
                              @foreach ($data['colors'] as $color)
                                @if ($count_color == 1)
                                  <li><input type="radio" name="color" value="{{ $color->color_id}}" checked><span class="dot" style="background-color: {{ $color->color_value}};"></span></li>
                                @else
                                  <li><input type="radio" name="color" value="{{ $color->color_id}}"><span class="dot" style="background-color: {{ $color->color_value}};"></span></li>
                                @endif
                                @php
                                    $count_color++;
                                @endphp
                              @endforeach
                          @endif
                          
                        </ul>
                      </div>
                    </div>
                    <div class="size-area">
                      <h2 class="saider-bar-title">Size</h2>
                      <div class="size">
                        <select name="size" id="size_div">
                        @if (isset($data['sizes']) && !empty($data['sizes']))
                            @foreach ($data['sizes'] as $size)
                              @if ($data['min_price']->price ==  $size->price)
                                <option value="{{$size->size_id}}" selected>{{$size->size_name}}</option>
                              @else
                                <option value="{{$size->size_id}}">{{$size->size_name}}</option>
                              @endif
                              
                            @endforeach
                        @endif
                      </select>
                        {{-- <ul>
                          <li><a><input type="radio" name="size" value="1"  hidden> S</a></li>
                          <li><a><input type="radio" name="size" value="2" checked hidden> L</a></li>
                          <li><a><input type="radio" name="size" value="3" hidden> M</a></li>
                          <li><a><input type="radio" name="size" value="4" hidden> XL</a></li>
                          <li><a><input type="radio" name="size" value="5" hidden> XXL</a></li> 
                        </ul> --}}
                      </div>
                    </div>
                  </div>
                  <div class="product-variation">
                    <form action="#" method="post">
                      <div class="cart-plus-minus">
                        <label for="qty">Quantity:</label>
                        <div class="numbers-row">
                          <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="dec qtybutton"><i class="fa fa-minus">&nbsp;</i></div>
                          <input type="text" class="qty" title="Qty" value="1" maxlength="12" id="qty" name="quantity">
                          <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="inc qtybutton"><i class="fa fa-plus">&nbsp;</i></div>
                        </div>
                      </div>
                      <button type="submit" class="button pro-add-to-cart" title="Add to Cart" type="button"><span><i class="pe-7s-cart"></i> Add to Cart</span></button>
                    </form>
                  </div>
                  <div class="product-cart-option">
                    <ul>
                      <li><a href="#"><i class="pe-7s-like"></i><span>Add to Wishlist</span></a></li>
                    </ul>
                  </div>
                {{ Form::close() }}


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
                          <p>{{$data['product']->long_description}}</p>
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

  $(document).ready(function () {
    $("#size_div").change(function(){
      var product_id = $("#product_id").val();
      var size_id = $(this).val();
        
      var product_route = '{{route('web.product_detail',['product_id' => ':id','size_id' => ':size_id'])}}';
      product_route = product_route.replace(':id', product_id);
      product_route = product_route.replace(':size_id', size_id);
      window.location.href = product_route;
    })
  });
</script>
  <!-- Page Content -->
@endsection