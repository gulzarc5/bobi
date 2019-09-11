@extends('web.templet.master')
@section('title','product')

@section('content')
<style type="text/css">
.sall{
  font-size: 20px; border: 1px solid #80808069; 
  background-color: #80808069; 
  border-radius: 5px; 
  padding: 7px 10px 7px 10px;     
  position: relative;
  top: 9px;
  }
 .sall1{
  font-size: 12px; 
  margin-left: 30px;
  margin-left: 42px;
  margin-top: -14px;
  } 
  .view{
    font: italic bold 14px/30px Georgia, serif;
  }
</style>
<div class="gap">
</div>
<div class="container">
 <div class="col-md-12" style="display: flex;">
   <div class="col-md-11" style="margin-left: -26px;">
    <p> <i class="fa fa-user sall"></i> chinmayee</p>
    <p class="sall1">Guwahati, Assam</p>
</div>
<div class="col-md-1" style="margin-top: 25px; margin-left: 26px;">
  <a href="{{url('product_category')}}" class="view">View all</a>
  </div>
</div>
<hr>
</div>
<div class="container">
  <div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="{{url('product_details')}}">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Drifire Lightweight Tubular Short Sleeve Shirt - Made in USA
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>115
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Diesel Not So Basic Brown Leather Analog Mens Watch DZ1206
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>102
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Metal Portable Bar Table w/ Carrying Case - Metal Construction Party
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>72
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Alpine Swiss Beck Mens Suede Chukka Desert Boots Lace Up Shoes Crepe Sole Oxford
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>129
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>3 left
            </li>
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>-50%
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">72 Sq Ft Black Foam Interlocking Exercise Protective Tile Flooring Gym Floor Mat
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-old"><i class="fa fa-rupee" style="font-size:16px"></i>130
            </span>
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>65
            </span>
          </div>
          <ul class="product-caption-feature-list">
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">LG G Flex D959 - 32GB - Titan Silver GSM Unlocked Android Smartphone (B)
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>147
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>-40%
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Lenovo ThinkPad 11e 11.6" Notebook, AMD A4-6210 1.8GHz, 4GB RAM, 500GBHDD, W7Pro
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-old"><i class="fa fa-rupee" style="font-size:16px"></i>74
            </span>
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>45
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="gap">
</div>
<hr>
<div class="container">
 <div class="col-md-12" style="display: flex;">
   <div class="col-md-11" style="margin-left: -26px;">
    <p> <i class="fa fa-user sall"></i> Vishal</p>
    <p class="sall1">Guwahati, Assam</p>
</div>
<div class="col-md-1" style="margin-top: 25px; margin-left: 26px;">
  <a href="{{url('product_category')}}" class="view">View all</a>
  </div>
</div>
<hr>
</div>
<div class="container">
  <div class="owl-carousel owl-loaded owl-nav-out" data-options='{"items":5,"loop":true,"nav":true}'>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Drifire Lightweight Tubular Short Sleeve Shirt - Made in USA
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>115
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Diesel Not So Basic Brown Leather Analog Mens Watch DZ1206
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>102
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Metal Portable Bar Table w/ Carrying Case - Metal Construction Party
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>72
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Alpine Swiss Beck Mens Suede Chukka Desert Boots Lace Up Shoes Crepe Sole Oxford
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>129
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>3 left
            </li>
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>-50%
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">72 Sq Ft Black Foam Interlocking Exercise Protective Tile Flooring Gym Floor Mat
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-old"><i class="fa fa-rupee" style="font-size:16px"></i>130
            </span>
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>65
            </span>
          </div>
          <ul class="product-caption-feature-list">
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>hot
          </li>
        </ul>
        <div class="product-img-wrap">
          <img class="product-img" src="{{asset('src/img/test_product/man_fashion/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">LG G Flex D959 - 32GB - Titan Silver GSM Unlocked Android Smartphone (B)
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>147
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="owl-item">
      <div class="product  owl-item-slide">
        <ul class="product-labels">
          <li>-40%
          </li>
        </ul>
        <div class="product-img-wrap">
         <img class="product-img" src="{{asset('src/img/test_product/man_fashion/2.jpg')}}" alt="Image Alternative text" title="Image Title" />
        </div>
        <a class="product-link" href="product-Details">
        </a>
        <div class="product-caption">
          <ul class="product-caption-rating">
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li class="rated">
              <i class="fa fa-star">
              </i>
            </li>
            <li>
              <i class="fa fa-star">
              </i>
            </li>
          </ul>
          <h5 class="product-caption-title">Lenovo ThinkPad 11e 11.6" Notebook, AMD A4-6210 1.8GHz, 4GB RAM, 500GBHDD, W7Pro
          </h5>
          <div class="product-caption-price">
            <span class="product-caption-price-old"><i class="fa fa-rupee" style="font-size:16px"></i>74
            </span>
            <span class="product-caption-price-new"><i class="fa fa-rupee" style="font-size:16px"></i>45
            </span>
          </div>
          <ul class="product-caption-feature-list">
            <li>Free Shipping
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection