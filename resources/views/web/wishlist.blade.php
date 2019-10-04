@extends('web.templet.master')
@section('content')
<div class="container">
  <main class="grid" style="margin-top: 10px;margin-bottom: 10px;">
    @if (isset($wish_data) && !empty($wish_data) && count((array)$wish_data) > 0 )
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
    @endif
    
    {{-- <article>
      <img src="https://vangogh.teespring.com/v3/image/EzMTyEjKh-lwGS0DEHSCd31VwRE/480/560.jpg" alt="tshirt photo">
      <div class="text">
        <h3>Police Unit K-9</h3>
        <div class="price-box" style="margin-top: 15px;">
          <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $456.00 </span> </p>
          <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $567.00 </span> </p>
        </div>
        <div style="display: flex; margin-left: 25%;margin-top: 6%;" >
        <a href="" class="btn btn-primary ">Add to cart</a>
        <a href="" class="btn btn-danger " style="margin-left: 5px;">Remove</a>
    	</div>
      </div>
    </article>
    <article>
      <img src="https://vangogh.teespring.com/v3/image/bK43tppPNyqAOvmwmpzkMQxbvCo/480/560.jpg" alt="tshirt photo">
      <div class="text">
        <h3>Police Unit K-9</h3>
        <div class="price-box" style="margin-top: 15px;">
          <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $456.00 </span> </p>
          <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $567.00 </span> </p>
        </div>
        <div style="display: flex; margin-left: 25%;margin-top: 6%;" >
        <a href="" class="btn btn-primary ">Add to cart</a>
        <a href="" class="btn btn-danger " style="margin-left: 5px;">Remove</a>
    	</div>
      </div>
    </article> --}}
</main>
</div>
@endsection