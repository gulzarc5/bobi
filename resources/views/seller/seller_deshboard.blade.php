@extends('seller.template.seller_master')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count">
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Products</span>
            <div class="count green">{{ $dashboard_data['product_count'] }}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Total Orders</span>
            <div class="count green">{{ $dashboard_data['orders_count'] }}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Pending Orders</span>
            <div class="count green">{{ $dashboard_data['pending_orders_count'] }}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Delivered Orders</span>
            <div class="count green">{{ $dashboard_data['delivered_orders_count'] }}</div>
        </div>
    
        
        </div>
        <!-- /top tiles -->

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">				 
                @if(Auth::guard('seller')->user()->verification_status == 1)
                <div class="x_content bs-example-popovers">
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Hello {{ Auth::guard('seller')->user()->name }}</strong> Please Update Your Required Detalis To get All The features of Seler Panel <a href="{{ route('seller.MyprofileForm') }}" style="color:blue; font-weight: bold">Click Here to Update</a href="#">
                </div>
                </div>
                @elseif(Auth::guard('seller')->user()->verification_status == 2)
                    @if (Auth::guard('seller')->user()->seller_deal_status == 1)
                        <div class="x_content bs-example-popovers">
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <strong>Hello {{ Auth::guard('seller')->user()->name }}</strong> Please Update Your Dealing Category To get All The features of Seler Panel <a href="{{ route('seller.MyCategoryForm') }}" style="color:blue; font-weight: bold">Click Here to Update</a href="#">
                            </div>
                        </div>
                    @else
                        <div class="x_content bs-example-popovers">
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Hello {{ Auth::guard('seller')->user()->name }}</strong> Your Acount is Under Review. After Completion of This Process We Will Notify You Through Email/Sms. Thank You
                            </div>
                        </div>
                    @endif   
                @elseif(Auth::guard('seller')->user()->seller_deal_status == 2)
                    <div class="x_content bs-example-popovers">
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>Hello {{ Auth::guard('seller')->user()->name }}</strong> Your Acount is Under Review. After Completion of This Process We Will Notify You Through Email/Sms. Thank You
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                            <div class="x_content">
              
                                {{--//////////// Last Ten Orders //////////////--}}
                                <div class="table-responsive">
                                    <h2>Last 10 Orders</h2>
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">                
                                                <th class="column-title">Sl No. </th>
                                                <th class="column-title">Order id</th>
                                                <th class="column-title">Order By</th>
                                                <th class="column-title">Total Quantity</th>
                                                <th class="column-title">Total Amount</th>
                                                <th class="column-title">Payment Method</th>
                                                <th class="column-title">Date</th>
                                            </tr>
                                        </thead>
              
                                        <tbody>
                                          @if (isset($dashboard_data['last_ten_orders']) && count($dashboard_data['last_ten_orders']))
                                            @php
                                                $count = 1;
                                            @endphp
                                              @foreach ($dashboard_data['last_ten_orders'] as $item)
                                                  <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->u_name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ number_format($item->total,2,".",'')}}</td>
                                                    <td>
                                                      @if ($item->payment_method == '1')
                                                        <a class="btn btn-info">Cash On Delivery</a>
                                                      @else
                                                        <a class="btn btn-success">Online</a>
                                                      @endif
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }}
                                                      </td>
                                                  </tr>
                                              @endforeach
                                          @endif
                                        </tbody>
                                    </table>
                                </div>
              
                            </div>
                        </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

 @endsection