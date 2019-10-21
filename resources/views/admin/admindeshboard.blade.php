@extends('admin.template.admin_master')

@section('content')

  <div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
        <div class="count green">{{ $deshboard_data['users_count'] }}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Total Sellers</span>
        <div class="count green">{{ $deshboard_data['seller_count'] }}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i> Total Sub Category</span>
          <div class="count green">{{ $deshboard_data['second_cat_count'] }}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Products</span>
        <div class="count green">{{ $deshboard_data['product_count'] }}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Orders</span>
        <div class="count green">{{ $deshboard_data['orders_count'] }}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Pending Orders</span>
        <div class="count green">{{ $deshboard_data['pending_orders_count'] }}</div>
      </div>
      
    </div>
    <!-- /top tiles -->

    <div class="row">
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
                            @if (isset($deshboard_data['last_ten_orders']) && count($deshboard_data['last_ten_orders']))
                              @php
                                  $count = 1;
                              @endphp
                                @foreach ($deshboard_data['last_ten_orders'] as $item)
                                    <tr>
                                      <td>{{ $count++ }}</td>
                                      <td>{{ $item->id }}</td>
                                      <td>{{ $item->u_name }}</td>
                                      <td>{{ $item->quantity }}</td>
                                      <td>{{ number_format($item->amount,2,".",'')}}</td>
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

                  {{--//////////// Last Ten Sellers //////////////--}}
                  <div class="table-responsive">
                      <h2>Last 10 Registered Sellers</h2>
                      <table class="table table-striped jambo_table bulk_action">
                          <thead>
                              <tr class="headings">                
                                  <th class="column-title">Sl No. </th>
                                  <th class="column-title">Name</th>
                                  <th class="column-title">Email</th>
                                  <th class="column-title">Mobile No</th>
                                  <th class="column-title">Varification Status</th>
                                  <th class="column-title">Date</th>
                              </tr>
                          </thead>

                          <tbody>
                            @if (isset($deshboard_data['last_ten_sellers']) && count($deshboard_data['last_ten_sellers']))
                              @php
                                  $count = 1;
                              @endphp
                                @foreach ($deshboard_data['last_ten_sellers'] as $item)
                                    <tr>
                                      <td>{{ $count++ }}</td>
                                      <td>{{ $item->name }}</td>
                                      <td>{{ $item->email }}</td>
                                      <td>{{ $item->mobile }}</td>
                                      <td>
                                        @if ($item->verification_status == '1')
                                          <a class="btn btn-warning">Kyc Pending</a>
                                        @elseif($item->verification_status == '2')
                                          <a class="btn btn-info">Under Review</a>
                                        @else
                                          <a class="btn btn-success">Verified</a>
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

 @endsection