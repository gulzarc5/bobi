
@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Dispatch Order</h2>
                    <div class="clearfix"></div>
                </div>

                 <div>
                    @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>
                @if (isset($order_details_id) && !empty($order_details_id))
                    <div>
                        <div class="x_content">
                            {{ Form::open(['method' => 'post','route'=>'seller.order_dispatch_update']) }}
                            <input type="hidden" name="order_details_id" value="{{ $order_details_id}}">
                            <div class="form-group">
                                {{ Form::label('transaction_no', 'Consignment Number')}} 
                                {{ Form::text('transaction_no',null,array('class' => 'form-control','placeholder'=>'Enter Transaction No')) }}
                                @if($errors->has('transaction_no'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('transaction_no') }}</strong>
                                    </span> 
                                @enderror
                            </div>

                            <div class="form-group">
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                                <a href="{{ route('seller.order_view',['order_details_id'=>encrypt($order_details_id)]) }}" class="btn btn-warning">Back</a>
                            </div>
                            {{ Form::close() }}
                        
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>


 @endsection