@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
  @if (isset($order_details) && !empty($order_details))
    <div class="row">
        <div class="x_panel">
          <div class="x_title">
            <h2>Order Details of Order - {{$order_details->id}}
              @if ($order_details->order_status == '1')
                <a class="btn btn-warning">Pending</a>
              @elseif ($order_details->order_status == '2')
                <a class="btn btn-info">Dispatched</a>
              @elseif ($order_details->order_status == '3')
                <a class="btn btn-success">Delivered</a>
              @elseif ($order_details->order_status == '4')
                <a class="btn btn-danger">Cancelled</a>
              @else
              <a class="btn btn-default">Return</a>
              @endif
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              <div class="row invoice-info">
                @if (isset($user_details) && !empty($user_details))
                  <div class="col-md-4 invoice-col">
                    <table class="table table-striped">
                      <caption>User Deails</caption>
                      <tr>
                        <th style="width:150px;">Name : </th>
                        <td>{{ $user_details->u_name }}</td>
                      </tr>
                    
                        <tr>
                          <th>Email : </th>
                          <td>{{ $user_details->email }}</td>
                        </tr>
                    
                        <tr>
                          <th>Mobile Number : </th>
                          <td>{{ $user_details->mobile }}</td>
                        </tr>

                        <tr>
                          <th>Address : </th>
                          <td>{{ $user_details->address }}, {{ $user_details->state }}, {{ $user_details->city }}-{{ $user_details->pin }}</td>
                        </tr>
                      
                    </table>
                  </div>
                  <div class="col-md-4 invoice-col"></div>
                  @if (isset($shipping_address) && !empty($shipping_address))    
                    <div class="col-md-4 invoice-col">
                      <table class="table table-striped">
                        <caption>Shipping Address</caption>
                        <tr>
                          <th>Name : </th>
                          <td>{{ $user_details->u_name }}</td>
                        </tr>
                        <tr>
                          <th>Mobile No : </th>
                          <td>{{ $user_details->email }}</td>
                        </tr>
                        <tr>
                          <th>Email : </th>
                          <td>{{ $user_details->mobile }}</td>
                        </tr>
                        <tr>
                          <th>Address : </th>
                          <td>{{ $shipping_address->address }}, {{ $shipping_address->state }}, {{ $shipping_address->city }}-{{ $shipping_address->pin }}</td>
                        </tr>
                      </table>
                    </div>
                  @endif
                @endif
               

              </div>
              
              {{--////////////// Product Details /////////////--}}
              <hr>
                <div class="col-xs-12 table table-responsive">
                  <h5> Product Details </h5>
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Product</th>
                        <th>Product Id</th>
                        <th>Title</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td><img src="{{asset('images/product/thumb/'.$order_details->image.'')  }}" height="150px" width="120px"></td>
                        <td>{{$order_details->product_id}}</td>
                        <td>{{$order_details->p_name}}</td>
                        <td>{{$order_details->size}}</td>
                        <td><span style=" height: 25px;width: 25px;background-color: {{$order_details->c_value}};border-radius: 50%;display: inline-block;"></span></td>
                        <td>₹{{ number_format($order_details->rate,2,".",'')}}</td>
                        <td>{{$order_details->quantity}}</td>
                        <td>₹{{ number_format($order_details->total,2,".",'')}}</td>
                        <td>{{ \Carbon\Carbon::parse($order_details->created_at)->toDayDateTimeString()}}</td>
                        <td>
                          @if ($order_details->order_status == '1')
                            <a class="btn btn-warning">Pending</a>
                          @elseif ($order_details->order_status == '2')
                            <a class="btn btn-info">Dispatched</a>
                          @elseif ($order_details->order_status == '3')
                            <a class="btn btn-success">Delivered</a>
                          @elseif ($order_details->order_status == '4')
                            <a class="btn btn-danger">Cancelled</a>
                          @else
                            <a class="btn btn-default">Return</a>
                          @endif
                        </td>
                        <td>
                            @if ($order_details->order_status == '1')
                            
                              <a href="{{ route('seller.order_dispatch',['order_details_id' => encrypt($order_details->id)]) }}" class="btn btn-info">Dispatch</a>
                              <a href="{{ route('seller.order_status_update',['order_id' => encrypt($order_details->order_id),'order_details_id' => encrypt($order_details->id),'status' => encrypt(4)]) }}" class="btn btn-danger">Cancel</a>
                            @elseif ($order_details->order_status == '2')
                              <a href="{{ route('seller.order_status_update',['order_id' => encrypt($order_details->order_id),'order_details_id' => encrypt($order_details->id),'status' => encrypt(3)]) }}" class="btn btn-success">Delivered</a>
                              <a href="{{ route('seller.order_status_update',['order_id' => encrypt($order_details->order_id),'order_details_id' => encrypt($order_details->id),'status' => encrypt(4)]) }}" class="btn btn-danger">Cancel</a>
                            @else
                              <a class btn btn-primary>Order Processed</a>
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              {{-- ////////////////End Product Details///////////// --}}

                <button class="btn btn-primary" onclick="javascript:window.close()">Window Close</button>
              <!-- /.row -->
            </section>
          </div>
        </div>
    </div>
  @endif

</div>


@endsection

@section('script')
     

    
 @endsection