@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    @if (isset($promotional_edit) && !empty($promotional_edit))
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add App Slider</h2>
                    <div class="clearfix"></div>
                </div>

                 <div>
                    @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>

                <div>
                    <div class="x_content">
                            {{Form::model($promotional_edit, ['method' => 'post','route'=>'admin.app_Promotiona_update','enctype'=>'multipart/form-data'])}}
                            {{ Form::hidden('id',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}

                        <div class="form-group">
                            {{ Form::label('type', 'Select Slider Type')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                            @if($errors->has('type'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('slider', 'Select Image')}} 
                            
                            <input type="file" name="slider" class="form-control">
                            @if($errors->has('slider'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('slider') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                                <a href="{{ route('admin.app_promotional') }}" class="btn btn-warning">Back</a>
                            
                        </div>
                        {{ Form::close() }}
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    @endif
    

    <div class="clearfix"></div>
    @if(isset($promotional) && !empty($promotional))
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Slider list</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Name</th>
                                    <th class="column-title">Image</th>
                                    <th class="column-title">Type</th>
                                    <th class="column-title">Action</th>
                            </thead>

                            <tbody>

                                
                                @php
                                    $count = 1;
                                @endphp

                                @if(count($promotional) > 0)
                                @foreach($promotional as $sliders)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                    <td class=" ">{{ $sliders->name }}</td>
                                     <td class=" "><img src="{{asset('images/slider/thumb/'.$sliders->image.'')}}" height="80px"></td>
                                    <td class=" ">
                                        @if($sliders->type == '1')
                                            <button class='btn btn-primary'>App</button>
                                        @else
                                             <button class='btn btn-warning'>Web</button>
                                        @endif
                                    </td>
                                    <td class=" ">    
                                        <a href="{{route('admin.promotional_edit',['id' => encrypt($sliders->id)])}}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" style="text-align: center">Sorry No Data Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif
</div>
 @endsection