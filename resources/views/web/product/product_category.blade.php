@extends('web.templet.master')
@section('title','product')

@section('content')
<div class="container">
  <header class="page-header">
    <h1 class="page-title">Woman Handbags
    </h1>
    <ol class="breadcrumb page-breadcrumb">
      <li>
        <a href="#">Home
        </a>
      </li>
      <li>
        <a href="#">Fasion
        </a>
      </li>
      <li>
        <a href="#">Women
        </a>
      </li>
      <li>
        <a href="#">Accessories
        </a>
      </li>
      <li class="active">Handbags
      </li>
    </ol>
    <ul class="category-selections clearfix">
      <li>
        <a class="fa fa-th-large category-selections-icon active" href="#">
        </a>
      </li>
      <li>
        <a class="fa fa-th-list category-selections-icon" href="#">
        </a>
      </li>
      <li>
        <span class="category-selections-sign">Sort by :
        </span>
        <select class="category-selections-select">
          <option selected>Newest First
          </option>
          <option>Best Sellers
          </option>
          <option>Trending Now
          </option>
          <option>Best Raited
          </option>
          <option>Price : Lowest First
          </option>
          <option>Price : Highest First
          </option>
          <option>Title : A - Z
          </option>
          <option>Title : Z - A
          </option>
        </select>
      </li>
      <li>
        <span class="category-selections-sign">Items :
        </span>
        <select class="category-selections-select">
          <option>9 / page
          </option>
          <option selected>12 / page
          </option>
          <option>18 / page
          </option>
          <option>All
          </option>
        </select>
      </li>
    </ul>
  </header>
  <div class="row">
    <div class="col-md-3">
      <aside class="category-filters category-filters-color">
        <div class="category-filters-section">
          <h3 class="widget-title-sm">Category
          </h3>
          <ul class="cateogry-filters-list">
            <li>
              <a href="#">Backpack Style
              </a>
            </li>
            <li>
              <a href="#">Clutch
              </a>
            </li>
            <li>
              <a href="#">Evening Bag
              </a>
            </li>
            <li>
              <a href="#">Hobo
              </a>
            </li>
          </ul>
        </div>
        <div class="category-filters-section">
          <h3 class="widget-title-sm">Price
          </h3>
          <input type="text" id="price-slider" />
        </div>
        <div class="category-filters-section">
          <h3 class="widget-title-sm">Saller
          </h3>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Chinmayee
              <!-- <span class="category-filters-amount">(55)
              </span> -->
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Vishal
              <!-- <span class="category-filters-amount">(76)
              </span> -->
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Bhaskar
            </label>
          </div>
        </div>
        <div class="category-filters-section">
          <h3 class="widget-title-sm">Brand
          </h3>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Chanel
              <span class="category-filters-amount">(51)
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Coach
              <span class="category-filters-amount">(18)
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Dooney &amp; Bourke
              <span class="category-filters-amount">(20)
              </span>
            </label>
          </div>
        </div>
        <div class="category-filters-section">
          <h3 class="widget-title-sm">Material
          </h3>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Canvas
              <span class="category-filters-amount">(70)
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Cotton
              <span class="category-filters-amount">(25)
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Crocodile/Alligator
              <span class="category-filters-amount">(68)
              </span>
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input class="i-check" type="checkbox" />Faux Leather
              <span class="category-filters-amount">(21)
              </span>
            </label>
          </div>
        </div> 
    </aside>
    </div>
    <div class="col-md-9">
      <div class="row" data-gutter="15">
        <div class="col-md-4">
          <div class="product ">
            <ul class="product-labels">
            </ul>
            <div class="product-img-wrap">
              <img class="product-img-primary" src="{{asset('src/img/test_product/woman_bags/4.jpg')}}" alt="Image Alternative text" title="Image Title" />
              <img class="product-img-alt" src="{{asset('src/img/test_product/woman_bags/4-a.jpg')}}" alt="Image Alternative text" title="Image Title" />
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
                <li class="rated">
                  <i class="fa fa-star">
                  </i>
                </li>
                <li>
                  <i class="fa fa-star">
                  </i>
                </li>
              </ul>
              <h5 class="product-caption-title">Vera Bradley Vera Tote Bag
              </h5>
              <div class="product-caption-price">
                <span class="product-caption-price-new">Rs 126
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
        <div class="col-md-4">
          <div class="product ">
            <ul class="product-labels">
            </ul>
            <div class="product-img-wrap">
              <img class="product-img-primary" src="{{asset('src/img/test_product/woman_bags/3.jpg')}}" alt="Image Alternative text" title="Image Title" />
              <img class="product-img-alt" src="{{asset('src/img/test_product/woman_bags/3-a.jpg')}}" alt="Image Alternative text" title="Image Title" />
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
              <h5 class="product-caption-title">Dooney & Bourke Pebble Grain Lexington
              </h5>
              <div class="product-caption-price">
                <span class="product-caption-price-new">Rs 74
                </span>
              </div>
              <ul class="product-caption-feature-list">
                <li>Free Shipping
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="product ">
            <ul class="product-labels">
            </ul>
            <div class="product-img-wrap">
              <img class="product-img-primary" src="{{asset('src/img/test_product/woman_bags/5.jpg')}}" alt="Image Alternative text" title="Image Title" />
              <img class="product-img-alt" src="{{asset('src/img/test_product/woman_bags/5-a.jpg')}}" alt="Image Alternative text" title="Image Title" />
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
              <h5 class="product-caption-title">Dooney & Bourke Pebble Grain Hobo
              </h5>
              <div class="product-caption-price">
                <span class="product-caption-price-new">Rs 139
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
      <div class="row" data-gutter="15">
        <div class="col-md-4">
          <div class="product ">
            <ul class="product-labels">
            </ul>
            <div class="product-img-wrap">
              <img class="product-img-primary" src="{{asset('src/img/test_product/woman_bags/6.jpg')}}" alt="Image Alternative text" title="Image Title" />
              <img class="product-img-alt" src="{{asset('src/img/test_product/woman_bags/6-a.jpg')}}" alt="Image Alternative text" title="Image Title" />
            </div>
            <a class="product-link" href="#">
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
              <h5 class="product-caption-title">Dooney & Bourke Claremont Dover
              </h5>
              <div class="product-caption-price">
                <span class="product-caption-price-new">Rs 142
                </span>
              </div>
              <ul class="product-caption-feature-list">
                <li>Free Shipping
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="product ">
            <ul class="product-labels">
              <li>hot
              </li>
            </ul>
            <div class="product-img-wrap">
              <img class="product-img-primary" src="{{asset('src/img/test_product/woman_bags/1.jpg')}}" alt="Image Alternative text" title="Image Title" />
              <img class="product-img-alt" src="{{asset('src/img/test_product/woman_bags/1-a.jpg')}}" alt="Image Alternative text" title="Image Title" />
            </div>
            <a class="product-link" href="#">
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
              <h5 class="product-caption-title">Dooney & Bourke Chevron Large Slim Wristlet
              </h5>
              <div class="product-caption-price">
                <span class="product-caption-price-new">Rs 83
                </span>
              </div>
              <ul class="product-caption-feature-list">
                <li>Free Shipping
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="product ">
            <ul class="product-labels">
              <li>hot
              </li>
            </ul>
            <div class="product-img-wrap">
              <img class="product-img-primary" src="{{asset('src/img/test_product/woman_bags/8.jpg')}}" alt="Image Alternative text" title="Image Title" />
              <img class="product-img-alt" src="{{asset('src/img/test_product/woman_bags/8-a.jpg')}}" alt="Image Alternative text" title="Image Title" />
            </div>
            <a class="product-link" href="#">
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
              <h5 class="product-caption-title">Vera Bradley Mandy Tote Bag
              </h5>
              <div class="product-caption-price">
                <span class="product-caption-price-new">Rs 140
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
      <div class="row">
        <div class="col-md-6">
          <p class="category-pagination-sign">58 items found in Cell Phones. Showing 1 - 12
          </p>
        </div>
        <div class="col-md-6">
          <nav>
            <ul class="pagination category-pagination pull-right">
              <li class="active">
                <a href="#">1
                </a>
              </li>
              <li>
                <a href="#">2
                </a>
              </li>
              <li>
                <a href="#">3
                </a>
              </li>
              <li>
                <a href="#">4
                </a>
              </li>
              <li>
                <a href="#">5
                </a>
              </li>
              <li class="last">
                <a href="#">
                  <i class="fa fa-long-arrow-right">
                  </i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection