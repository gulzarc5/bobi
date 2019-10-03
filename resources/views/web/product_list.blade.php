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
              <h2 class="col-md-6">
                @if (isset($data['category_name'] ) && !empty($data['category_name'] ))
                    {{$data['category_name']->category_name}} > {{ $data['category_name']->second_cat_name }}
                    <input type="hidden" id="category_id_filter" value="{{$data['category_name']->second_cat_id}}">
                @endif
              </h2>
              <div class="col-md-6">
                  <select style="float:right;width: 200px;" id="product_sort" class="form-control" onchange="filterProduct();">
                      <option value="low">Price Low To High</option>
                      <option value="high">Price High To Low</option>
                      <option value="newest">Newest First</option>
                      <option value="title_asc">Title A-Z</option>
                      <option value="title_dsc">Title Z-A</option>
                      
                  </select>
                  <span style="float:right;float: right;padding-top: 6px;padding-right: 12px;font-variant: small-caps;font-weight: bold;">Sort By</span>
              </div>
              
            </div><hr>

            {{--//////////////////////////////////// Products //////////////////////////////////--}}
            <div class="product-grid-area">
              <ul class="products-grid" id="product_list">
                @if (isset($data['product_list']) && !empty($data['product_list']))
                  @foreach ($data['product_list'] as $product)
                    <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                      <div class="product-item">
                        <div class="item-inner">
                          <div class="product-thumbnail">
                            <div class="pr-img-area"> 
                              <a  href="{{ route('web.product_detail',['product_id' => encrypt($product->id)])}}">
                                <figure><img class="first-img" src="{{asset('images/product/thumb/'.$product->main_image.'')}}" alt=""></figure>
                              </a> 
                            </div>
                          </div>
                          <div class="item-info">
                            <div class="info-inner">
                              <div class="item-title"> 
                                <a href="{{ route('web.product_detail',['product_id' => encrypt($product->id)])}}">
                                  {{ $product->name }}
                                 </a> </div>
                              <div class="item-content">
                                <div class="item-price">
                                  <div class="price-box"> <span class="regular-price"> <span class="price">
                                    Rs. {{ number_format($product->min_price,2,".",'') }}
                                    </span> </span> </div>
                                </div>
                                <div class="pro-action flex-center">
                                  <div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>
                                  @if (isset($product->min_price))
                                  {{ Form::open(['method' => 'post','route'=>'web.add_cart']) }}
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>
                                  {{ Form::close() }}
                                  @endif
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
              {{--//////////////////////////////////// Categories //////////////////////////////////--}}
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
              {{--//////////////////////////////////// Designers //////////////////////////////////--}}
              <div class="layered-Category">
                <h2 class="saider-bar-title">Designers</h2>
                <div class="layered-content color">
                  <ul class="check-box-list ">
                    @if (isset($data['designers'] ) && !empty($data['designers'] ))
                    @php
                        $count = 1;
                    @endphp
                        @foreach ($data['designers'] as $designer)
                          <li>
                          <input type="checkbox" id="design{{$count}}" value="{{ $designer->id }}" name="designer" onclick="designersCheckbox();">
                            <label for="design{{$count}}"> <span class="button"></span> {{ $designer->name }}</label>
                          </li>
                          @php
                              $count++;
                          @endphp
                        @endforeach
                    @endif
                  </ul>
                </div>
              </div> 
              {{--//////////////////////////////////// Colors //////////////////////////////////--}}
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
                          <input type="checkbox" id="color{{$count}}" name="color" value="{{ $colors->id }}" onclick="colorsCheckbox();">
                            <label for="color{{$count}}"> <span class="button"></span><a style="background:{{$colors->value}}"></a> {{$colors->name}}</label>
                          </li>
                          @php
                              $count++;
                          @endphp
                        @endforeach
                    @endif
                  </ul>
                </div>
              </div>    
              {{--//////////////////////////////////// Sizes //////////////////////////////////--}}          
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
                          <input type="checkbox" id="size{{$count}}" name="size" value="{{$size->id}}" onclick="sizesCheckbox();">
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
          {{--//////////////////////////////////// Price Range //////////////////////////////////--}}
          <div class="block product-price-range ">
            <div class="sidebar-bar-title">
              <h3>Price</h3>
            </div>
            {{-- <div class="block-content"> --}}
              <div>
                <input type="hidden" id="price-slider" />

              {{-- </div> --}}
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <!-- Main Container End --> 
@endsection
@section('script')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

@if(isset($data['price_range']) && !empty($data['price_range']) && !empty($data['price_range']->min_price) && !empty($data['price_range']->max_price))
  <script>
    $("#price-slider").ionRangeSlider({
      min: '{{ $data['price_range']->min_price }}',
      max: '{{ $data['price_range']->max_price }}',
      type: 'double',
      prefix: "Rs ",
      prettify: false,
      hasGrid: false,
      onFinish: function (data) {
        var prices = data.from+";"+data.to;
        filterProduct(prices);
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
        filterProduct(prices);
      },
  });
  </script>
@endif

<script>
  $(".iCheck-helper").click(function () { 
    filterProduct();
  })

  function designersCheckbox() {
    filterProduct();
  }

  function sizesCheckbox() {
    filterProduct();
  }

  function colorsCheckbox() {
    filterProduct();
  }

  function filterProduct(prices) {
      var category_id_filter = $("#category_id_filter").val();

      var sort = $("#product_sort").val();    

      var filter_color = $("input[name='color']:checked").map(function(){return $(this).val();}).get();

      var filter_designers = new Array();
      $("input:checkbox[name=designer]:checked").each(function(){
          filter_designers.push($(this).val());
      });
     
      var filter_sizes = new Array();
      $("input:checkbox[name=size]:checked").each(function(){
          filter_sizes.push($(this).val());
      });

      // console.log("Designers "+filter_designers);
      // console.log("colors "+filter_color);
      // console.log("category "+category_id_filter);
      // console.log("Price "+prices);
      // console.log("sizes "+filter_sizes);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $.ajax({
        type:"POST",
        url:"{{ route('web.product_filter')}}",
        data:{
          "_token": "{{ csrf_token() }}",
          category:category_id_filter,
          prices:prices,
          colors:filter_color,
          designers:filter_designers,
          sizes:filter_sizes,
          sort:sort,
        },
        beforeSend:function() { 
             $('#myModal').modal('show');
             $("#myModal").removeClass("mfp-hide");
        },
        complete:function() {
          $('#myModal').modal('hide');
          $("#myModal").addClass("mfp-hide");
        },
        success:function(data){
           
            
            var response = data;
            // console.log(data);
            if (response.products) {
              product_Html(response.products);
            }
        }
    });
  }

  function product_Html(products){
    var products_html = '';
    
    if (products.length > 0) {
      $.each(products, function(key,products){
        var product_route = '{{route('web.product_detail',['product_id' => encrypt(':id')])}}';
        product_route = product_route.replace(':id', products.id);
        products_html += '<li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 ">'+
                      '<div class="product-item">'+
                        '<div class="item-inner">'+
                          '<div class="product-thumbnail">'+
                            '<div class="pr-img-area">'+
                              '<a  href="'+product_route+'">'+
                                '<figure><img class="first-img" src="{{asset('images/product/thumb/')}}'+'/'+products.main_image+'" alt=""></figure>'+
                              '</a>'+
                            '</div>'+
                          '</div>'+
                          '<div class="item-info">'+
                            '<div class="info-inner">'+
                              '<div class="item-title">'+
                                '<a href="'+product_route+'">'+products.name+'</a> </div>'+
                              '<div class="item-content">'+
                                '<div class="item-price">'+
                                  '<div class="price-box"> <span class="regular-price"> <span class="price">'+
                                      products.min_price+'.00</span> </span> </div>'+
                                '</div>'+
                                '<div class="pro-action flex-center">'+
                                  '<div class="mt-button add_to_wishlist" > <a href="wishlist.html"> <i class="pe-7s-like"></i> </a> </div>'+
                                  '<button type="button" class="add-to-cart"> <i class="pe-7s-cart"></i><span> Add to Cart</span> </button>'+
                                '</div>'+
                              '</div>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</li>';
      })

    }
    $("#product_list").html(products_html);
  }
</script>






@endsection