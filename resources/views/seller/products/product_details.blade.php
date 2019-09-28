@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
  @if(isset($product) && !empty($product))
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Product Details</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <table class="table table-striped">
                    <caption>Product Deails</caption>
                    <tr>
                      <th style="width:150px;">Name : </th>
                      <td>{{ $product->name }}</td>
                    </tr>

                    @if(!empty($product->tag_name))
                      <tr>
                        <th>Tag Name : </th>
                        <td>{{ $product->tag_name }}</td>
                      </tr>
                    @endif

                    @if(!empty($product->size_wearing) && !empty($product->fit_wearing) )
                      <tr>
                        <th>Size & Fit : </th>
                        <td>{{ $product->size_wearing }}  & {{ $product->fit_wearing }}</td>
                      </tr>
                    @endif
                    <tr>
                      <th>Designer : </th>
                      <td>{{ $product->brand_name }}</td>
                    </tr>
                    <tr>
                      <th>Catgory : </th>
                      <td> {{ $product->c_name }} </td>
                    </tr>
                    <tr>
                      <th>First Category : </th>
                      <td> {{ $product->first_c_name }} </td>
                    </tr>
                    <tr>
                      <th>Second Category : </th>
                      <td> {{ $product->second_c_name }} </td>
                    </tr>

                    @if(!empty($product->short_description))
                    <tr>
                      <th>Short Description : </th>
                      <td>{{ $product->short_description }}</td>
                    </tr>
                    @endif

                    @if(!empty($product->long_description))
                    <tr>
                      <th>Long Description : </th>
                      <td>{{ $product->long_description }}</td>
                    </tr>
                    @endif

                  </table>
                </div>
                <div class="col-sm-6 invoice-col">
                   <table class="table table-striped">
                    <caption>Seller Deails</caption>
                    <tr>
                      <th>Seller Name : </th>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Mobile No : </th>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Email : </th>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Address : </th>
                      <td></td>
                    </tr>
                  </table>

                  @if(!empty($product->main_image))
                    <table class="table table-striped">
                      <caption>Product Image</caption>                     
                        <tr>
                          <td colspan="2"><img src="{{ asset('images/product/'.$product->main_image.'')}}" height="100px" width="100px"></td>
                        </tr>                   
                    </table>
                  @endif

                </div>
              </div>
              <!-- /.row -->
              <hr>
              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table">
                  <h5>Size Details</h5>
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Size</th>
                        <th>MRP</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($sizes) && !empty($sizes))
                      @php
                      $count = 1;
                      @endphp
                        @foreach($sizes as $size)
                        <tr>
                          <td>{{ $count++ }}</td>
                          <td> {{ $size->s_name }} </td>
                          <td> {{ $size->mrp }} </td>
                          <td> {{ $size->price }} </td>
                          <td> {{ $size->stock }} </td>
                          <td>
                            @if($size->status == '1')
                              <a class="btn btn-sm btn-success">Enabled</a>
                            @else
                              <a class="btn btn-sm btn-danger">Disabled</a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-xs-12 table">
                  <h5>Color Details</h5>
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($colors) && !empty($colors))
                        @php
                        $count_color = 1;
                        @endphp
                        @foreach($colors as $color)
                          <tr>
                            <td> {{ $count_color++ }} </td>
                            <td> {{ $color->c_name }} </td>
                            <td><div class="circle_green" style="padding: 10px 11px; background:{{ $color->c_value }}"></div></td>
                            <td>
                               @if($color->status == '1')
                                  <a class="btn btn-sm btn-success">Enabled</a>
                                @else
                                  <a class="btn btn-sm btn-danger">Disabled</a>
                                @endif
                            </td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
                <div class="col-xs-12 table">
                  <h5>Varient Details</h5>
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                       @if(isset($varients) && !empty($varients))
                        @php
                        $count_varient = 1;
                        @endphp
                        @foreach($varients as $varient)
                          <tr>
                            <td> {{ $count_varient++ }} </td>
                            <td> {{ $varient->v_name }} </td>
                            <td> {{ $varient->v_value }} </td>
                            <td>
                              @if($varient->status == '1')
                                  <a class="btn btn-sm btn-success">Enabled</a>
                                @else
                                  <a class="btn btn-sm btn-danger">Disabled</a>
                                @endif
                            </td>
                          </tr>
                       @endforeach
                      @endif

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
                <button class="btn btn-primary" onclick="javascript:window.close()">Window Close</button>
              </div>
              <!-- /.row -->
            </section>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>


 @endsection

@section('script')
     

    
 @endsection