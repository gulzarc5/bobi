@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
  @if (isset($orders) && !empty($orders))
    <div class="row">
        <div class="x_panel">
          <div class="x_title">
            <h2>Order Details of Order - {{$orders->id}}
              @if ($orders->status == '1')
                <a class="btn btn-warning">Pending</a>
              @elseif ($orders->status == '2')
                <a class="btn btn-info">Dispatched</a>
              @elseif ($orders->status == '3')
                <a class="btn btn-success">Delivered</a>
              @elseif ($orders->status == '4')
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
                <div class="col-md-4 invoice-col">
                    <table class="table table-striped">
                     <caption>Order Details</caption>
                     <tr>
                       <th>Payment Method : </th>
                       <td>
                         @if ($orders->payment_method == '1')
                             Cash On Delivery
                         @else
                             Online
                         @endif
                       </td>
                     </tr>
                     <tr>
                       <th>Payment Status : </th>
                       <td>
                          @if ($orders->payment_status == '1')
                             Pending
                          @else
                             Paid
                          @endif
                       </td>
                     </tr>
                     <tr>
                       <th>Total Quantity : </th>
                     <td>{{ $orders->quantity }}</td>
                     </tr>
                     <tr>
                       <th>Total Amount : </th>
                       <td> ₹{{ number_format($orders->amount,2,".",'')}} </td>
                     </tr>
                   </table>
                 </div>

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
                        <th>Id</th>
                        <th>Title</th>
                        <th>Seller</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Designer</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      @if (isset($order_details) && count($order_details) > 0 )
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($order_details as $item)
                          <tr>
                            <td>{{$count++}}</td>
                            <td><img src="{{asset('images/product/thumb/'.$item->image.'')  }}" height="150px" width="120px"></td>
                            <td>{{$item->product_id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->seller_name}}</td>
                            <td>{{$item->size}}</td>
                            <td><span style=" height: 25px;width: 25px;background-color: {{$item->color_value}};border-radius: 50%;display: inline-block;"></span></td>
                            <td>{{$item->designer}}</td>
                            <td>₹{{ number_format($item->rate,2,".",'')}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>₹{{ number_format($item->total,2,".",'')}}</td>
                            <td>{{$item->order_date}}</td>
                            <td>
                              @if ($item->order_status == '1')
                                <a class="btn btn-warning">Pending</a>
                              @elseif ($item->order_status == '2')
                                <a class="btn btn-info">Dispatched</a>
                              @elseif ($item->order_status == '3')
                                <a class="btn btn-success">Delivered</a>
                              @elseif ($item->order_status == '4')
                                <a class="btn btn-danger">Cancelled</a>
                              @else
                                <a class="btn btn-default">Return</a>
                              @endif
                            </td>
                            <td>
                                @if ($item->order_status == '1')
                                  <a href="{{ route('admin.order_dispatch',['order_details_id' => encrypt($item->id)]) }}" class="btn btn-info">Dispatch</a>
                                  <a href="{{ route('admin.order_status_update',['order_id' => encrypt($item->order_id),'order_details_id' => encrypt($item->id),'status' => encrypt(4)]) }}" class="btn btn-danger">Cancel</a>
                                @elseif ($item->order_status == '2')
                                  <a href="{{ route('admin.order_status_update',['order_id' => encrypt($item->order_id),'order_details_id' => encrypt($item->id),'status' => encrypt(3)]) }}" class="btn btn-success">Delivered</a>
                                  <a href="{{ route('admin.order_status_update',['order_id' => encrypt($item->order_id),'order_details_id' => encrypt($item->id),'status' => encrypt(4)]) }}" class="btn btn-danger">Cancel</a>
                                @else
                                  <a class btn btn-primary>Order Processed</a>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                          
                      @endif
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