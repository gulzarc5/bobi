@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
 
  <div class="container" style="margin-top: 20px;">
    @if (isset($orders) && count($orders) > 0)
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table  table-shopping-cart">
                    <thead>
                        <tr class="tabletr">
                            <th class="text-center">SI</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Order Id</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Color</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Quatity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Shipping Charge</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Order Status</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)                        
                            <tr class="text-center">
                                <td class="text-center">1</td>
                                <td class="table-shopping-cart-img text-center">
                                    <a href="#">
                                        <img src="{{asset('images/product/thumb/'.$item->p_image.'')}}" alt="Image Alternative text" title="Image Title" />
                                    </a>
                                </td>
                                <td class="text-center">{{ $item->id }}</td>
                                
                                <td class="text-center">{{ $item->p_name }}</td>
                                <td class="text-center"><span style=" height: 25px;width: 25px;background-color: {{ $item->c_value }};border-radius: 50%;display: inline-block;"></span></td>
                                <td class="table-shopping-cart-title text-center">{{ $item->size }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center">₹{{ number_format($item->rate,2,".",'')}}</td>
                                <td class="text-center">₹{{ number_format($item->shipping_charge,2,".",'')}}</td>
                                <td class="text-center">₹{{ number_format(($item->total+$item->shipping_charge),2,".",'')}}</td>
                                <td class="text-center">
                                    {{-- <button type="submit" class="btn btn-primary">Return</button> --}}
                                    @if ($item->order_status == '1')
                                        <button type="button" class="btn btn-warning">pending</button>
                                    @elseif($item->order_status == '2')
                                        <button type="button" class="btn btn-info">Dispatched</button><br>
                                        Courier Consignment Number : <strong>{{$item->consignment_no}}</strong><br>
                                        <u><a href="https://www.aftership.com/couriers/delhivery" style="color:blue" target="_blank">Click Here To Track Your Order</a></u>
                                    @elseif($item->order_status == '3')
                                        <button type="button" class="btn btn-success">Delivered</button>
                                        <br>
                                        Courier Consignment Number : <strong>{{$item->consignment_no}}</strong><br>
                                        <u><a href="https://www.aftership.com/couriers/delhivery" style="color:blue" target="_blank">Click Here To Track Your Order</a></u>
                                    @elseif($item->order_status == '4')
                                        <button type="button" class="btn btn-danger">Cancelled</button>
                                    @elseif($item->order_status == '5')
                                        <button type="button" class="btn btn-default">Return</button>
                                    @elseif($item->order_status == '6')
                                        <button type="button" class="btn btn-info">Ready To Dispatched</button>
                                    @endif                                   
                                </td>                               
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString()}}</td>
                                <td>
                                    @if ($item->order_status == '1' || $item->order_status == '2' || $item->order_status == '6' )
                                <a href="{{ route('web.order_cancel',['order_detail_id'=>encrypt($item->id)])}}" class="btn btn-danger">Cancel Order</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
        <ul class="list-inline">
            <li><a class="btn btn-default" href="{{route('web.index')}}">Continue Shopping</a>
            </li>
        </ul>
    @else
        <div class="container" style="margin-bottom: 20px;">
            <div class="text-center"><i class="fa fa-history" style="font-size: 100px;color: gray;"></i>
                <p class="lead">Order history empty</p><a class="btn btn-primary btn-lg" href="#">Start Shopping <i class="fa fa-long-arrow-right"></i></a>
            </div>
            <div class="gap"></div>
        </div>
    @endif
        </div>

  <!-- Main Container End --> 
@endsection