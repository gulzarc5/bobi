@extends('web.templet.master')


@section('content')
  <!-- Main Container -->
  <div class="main-container col2-left-layout">
    <div class="container">
      <div class="row">
        <div class="col-main col-sm-9 col-xs-12 col-sm-push-3 shop-inner">
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
          <div class=" slider-product">
            <div class="page-title" style="padding-top: 13px;">
              <h2>
                @if (isset($data['category_name'] ) && !empty($data['category_name'] ))
                    {{$data['category_name'] ->category_name}} > {{ $data['category_name'] ->second_cat_name }}
                @endif
                
              </h2>
            </div><hr>
            <div class="product-grid-area">
              <ul class="products-grid">
                @if (isset($data['product_list']) && !empty($data['product_list']))
                  @foreach ($data['product_list'] as $product)
                    <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                      <div class="product-item">
                        <div class="item-inner">
                          <div class="product-thumbnail">
                            <div class="pr-img-area"> 
                              <a  href="{{ route('web.product_detail',['product_id' => encrypt($product['id'])])}}">
                                <figure><img class="first-img" src="{{asset('images/product/thumb/'.$product['image'].'')}}" alt=""></figure>
                              </a> 
                            </div>
                          </div>
                          <div class="item-info">
                            <div class="info-inner">
                              <div class="item-title"> 
                                <a href="{{ route('web.product_detail',['product_id' => encrypt($product['id'])])}}">
                                  {{ $product['name'] }}
                                 </a> </div>
                              <div class="item-content">
                                <div class="item-price">
                                  <div class="price-box"> <span class="regular-price"> <span class="price">
                                      {{ number_format($product['price'],2,".",'') }}
                                    </span> </span> </div>
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
                  @endforeach
                @endif
                
              </ul>
            </div>
            {{-- <div class="pagination-area">
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
            </div> --}}
          </div>
        </div>
        <aside class="sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          <div class="block shop-by-side">
            <div class="sidebar-bar-title">
              <h3>
                @if (isset($data['category_name']) && !empty($data['category_name']))
                {{$data['category_name']->category_name}}
                @endif
              </h3>
            </div>
            <div class="block-content">
              <p class="block-subtitle">Shopping Options</p>
              <div class="manufacturer-area">
                <h2 class="saider-bar-title">Category</h2>
                <div class="saide-bar-menu">
                  <ul>
                      @if (isset($data['sub_category']) && !empty($data['sub_category']))
                        @foreach ($data['sub_category'] as $subcategory)
                          <li><a href="{{ route('web.product_list',['second_category_id'=>encrypt($subcategory->id)]) }}"><i class="fa fa-angle-right"></i>{{ $subcategory->name }}</a></li>
                        @endforeach
                      @endif
                  </ul>
                </div>
              </div>
              <div class="layered-Category">
                <h2 class="saider-bar-title">Color</h2>
                <div class="layered-content color">
                  <ul class="check-box-list ">
                    @if (isset($data['colors'] ) && !empty($data['colors'] ))
                    @php
                        $count = 1;
                    @endphp
                        @foreach ($data['colors'] as $colors)
                          <li>
                            <input type="checkbox" id="jtv{{$count}}" name="color[]">
                            <label for="jtv{{$count}}"> <span class="button"></span><a style="background:{{$colors->value}}"></a> {{$colors->name}}</label>
                          </li>
                          @php
                              $count++;
                          @endphp
                        @endforeach
                    @endif
                  </ul>
                </div>
              </div>              
              <div class="layered-Category">
                <h2 class="saider-bar-title">Size</h2>
                <div class="layered-content size">
                  <ul class="check-box-list ">
                      @if (isset($data['sizes'] ) && !empty($data['sizes'] ))
                      @php
                          $count = 1;
                      @endphp
                        @foreach ($data['sizes'] as $size)
                          <li>
                          <input type="checkbox" id="size{{$count}}" name="size" value="{{$size->id}}">
                            <label for="size{{$count}}"> <span class="button"></span><a>{{$size->name}}</a> </label>
                          </li>
                          @php
                          $count++;
                          @endphp
                        @endforeach
                      @endif
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
              <div>
                <input type="hidden" id="price-slider" />

                {{-- <ul class="check-box-list">
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
                </ul> --}}
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <!-- Main Container End --> 
@endsection
@section('script')
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

@if(isset($data['price_range']) && !empty($data['price_range']) && !empty($data['price_range']->min_price) && !empty($data['price_range']->max_price))
<script type="text/javascript">
  $("#price-slider").ionRangeSlider({
    min: {{ $data['price_range']->min_price }},
    max: {{ $data['price_range']->max_price }},
    type: 'double',
    prefix: "Rs ",
    prettify: false,
    hasGrid: false,
     onFinish: function (data) {
      var prices = data.from+";"+data.to;
      // filterProduct(prices);
    },
});
</script>
@else
<script type="text/javascript">
  $("#price-slider").ionRangeSlider({
    min: 0,
    max: 1000,
    type: 'double',
    prefix: "Rs ",
    prettify: false,
    hasGrid: false,
    onFinish: function (data) {
      var prices = data.from+";"+data.to;
      // filterProduct(prices);
    },
});
@endif
</script>
@endsection