
@extends('admin.template.admin_master')

@section('style')
<link href="{{asset('admin/src_files/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">

@endsection

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add New Color</h2>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content">
                        @if(isset($color) && !empty($color))
                            {{Form::model($color, ['method' => 'post','route'=>'admin.updateCategory'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.add_color_name']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Color Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
			                        <strong>{{ $errors->first('name') }}</strong>
			                    </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            
                            {{ Form::label('value', 'Select Color')}} 
                            <div class="input-group demo2">
                            {{ Form::text('value','#39c914',array('class' => 'form-control','placeholder'=>'Select Color Value')) }}
                            <span class="input-group-addon"><i></i></span>
                        </div>
                            @if($errors->has('value'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            @if(isset($color) && !empty($color))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            
                        </div>
                        {{ Form::close() }}

                        <div style="display: flex;justify-content: center;">
                            @if (Session::has('message'))
                            <div class="alert alert-success" style="width: 350px;">{{ Session::get('message') }}</div>
                            @endif @if (Session::has('error'))
                            <div class="alert alert-danger" style="width: 350px;">{{ Session::get('error') }}</div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Main Category List</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Color name</th>
                                    <th class="column-title">Color</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Action</th>
                            </thead>

                            <tbody>

                            	@if(isset($colors) && !empty($colors) && count($colors) > 0)
                            	@php
                            		$count = 1;
                            	@endphp

                            	@foreach($colors as $color)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                    <td class=" ">{{ $color->name }}</td>
                                    <td class=" "><div class="circle_green" style="padding: 10px 11px;        background: {{ $color->value }};"></div></td>
                                    <td class=" ">
                                        @if($color->status == '1')
                                            <button class='btn btn-primary'>Enabled</button>
                                        @else
                                             <button class='btn btn-warning'>Disabled</button>
                                        @endif
                                    	
                                    <td class=" ">
                                        <a href="#" class="btn btn-success">Enable</a>
                                        <a href="#" class="btn btn-danger">Disable</a>
                                        <a href="{{route('admin.editCategory',['id' => $color->id])}}" class="btn btn-warning">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                	<tr>
	                                    <td colspan="5" style="text-align: center">Sorry No Data Found</td>
                                	</tr>
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

 @section('script')
  <script src="{{asset('admin/src_files/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
 @endsection