@extends('web.templet.master')
@section('content')
<div class="container">
  @if (isset($wish_data) && !empty($wish_data) && count((array)$wish_data) > 0 )
  <main class="grid" style="margin-top: 10px;margin-bottom: 10px;">
    
    @foreach ($wish_data as $wish_list)
      <article>
        <img src="{{ asset('images/product/thumb/'.$wish_list['image'].'')}}" alt="tshirt photo">
        <div class="text">
          <h3>{{$wish_list['title']}}</h3>
          <div class="price-box" style="margin-top: 15px;">
            <p class="special-price"> <span class="price-label">Special Price</span> <span class="price">Rs. {{ number_format($wish_list['price'],2,".",'') }}</span> </p>
            <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> >Rs. {{ number_format($wish_list['mrp'],2,".",'') }} </span> </p>
          </div>
          <div style="display: flex; margin-left: 25%;margin-top: 6%;" >
          <a href="{{ route('web.move_wish_list',['list_id' => encrypt($wish_list['wish_id'])]) }}" class="btn btn-primary ">Move to cart</a>
          <a href="{{ route('web.delete_wish_list',['list_id' => encrypt($wish_list['wish_id'])]) }}" class="btn btn-danger " style="margin-left: 5px;">Remove</a>
        </div>
        </div>
      </article>
    @endforeach
    
  </main>
  @else
  <div class="container" style="margin-bottom: 20px;">
    <div class="text-center"><i class="fa fa-heart-o" style="font-size: 100px;color: gray;"></i>
        <p class="lead">You haven't Fill Your Shopping Cart Yet</p><a class="btn btn-primary btn-lg" href="{{route('web.index')}}">Start Shopping <i class="fa fa-long-arrow-right"></i></a>
    </div>
    <div class="gap"></div>
  </div>
  @endif
</div>
@endsection