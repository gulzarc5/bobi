@extends('seller.template.seller_master')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count">
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Products</span>
            <div class="count green">2500</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Total Orders</span>
            <div class="count green">123.50</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Pending Orders</span>
            <div class="count green">2,500</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Delivered Orders</span>
            <div class="count green">4,567</div>
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
    
        </div>
        </div>
    </div>
    <!-- /page content -->

 @endsection