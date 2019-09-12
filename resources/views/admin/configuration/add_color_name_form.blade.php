
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
                            {{ Form::open(['method' => 'post','route'=>'admin.add_color']) }}
                        @endif
                        <div class="form-group">
                            {{ Form::label('category', 'Select Category')}}
                            @if(isset($main_category) && !empty($main_category))
                                {!! Form::select('category', $main_category, null, ['class' => 'form-control','placeholder'=>'Please Select Category','id'=>'category']) !!}
                            @else
                                {!! Form::select('category',array('' => 'Please Select Main Category'),null, ['class' => 'form-control']) !!}
                            @endif

                            @if($errors->has('category'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            {{ Form::label('first_category', 'Select First Category')}}
                            @if(!empty($second_category->first_category_id))
                            {!! Form::select('first_category',array($second_category->first_category_id => $second_category->firstCategory->name),null, ['class' => 'form-control','id'=>'first_category']) !!}
                            @else
                            {!! Form::select('first_category',array('' => 'Please Select First Sub Category'),null, ['class' => 'form-control','id'=>'first_category']) !!}
                            @endif

                            @if($errors->has('first_category'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('first_category') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div id="colors">
                            <div class="form-group col-md-5">
                                {{ Form::label('name', 'Color Name')}} 
                                {{ Form::text('color_name[]',null,array('class' => 'form-control','placeholder'=>'Enter Category name')) }}
                            </div>
                            <div class="form-group col-md-5">
                                
                                {{ Form::label('value', 'Select Color')}} 
                                <div class="input-group demo2">
                                    {{ Form::text('color_value[]','#39c914',array('class' => 'form-control','placeholder'=>'Select Color Value')) }}
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-sm btn-info" onclick="addColor()" type="button" style="margin-top: 25px;">Add More</button>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
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
</div>


 @endsection

 @section('script')
  <script src="{{asset('admin/src_files/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
     <script type="text/javascript">
        $(document).ready(function(){

            $("#category").change(function(){
                var category = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('/admin/first/Category/')}}"+"/"+category+"",
                    success:function(data){
                        console.log(data);
                        var cat = JSON.parse(data);
                        $("#first_category").html("<option value=''>Please Select Sub Category</option>");

                        $.each( cat, function( key, value ) {
                            $("#first_category").append("<option value='"+key+"'>"+value+"</option>");
                        });

                    }
                });
            });

        })
        var coloradd = 1;
        function addColor() {
            var html = '<div id="color_div'+coloradd+'">'+
                            '<div class="form-group col-md-5">'+
                                '<label for="name">Color Name</label>'+
                                '<input class="form-control" placeholder="Enter Category name" name="color_name[]" type="text" id="name">'+
                            '</div>'+
                            '<div class="form-group col-md-5">'+
                                '<label for="value">Select Color</label>'+
                                '<div class="input-group demo2 colorpicker-element">'+
                                    '<input class="form-control" placeholder="Select Color Value" name="color_value[]" type="text" value="#39c914" id="value">'+
                                    '<span class="input-group-addon"><i style="background-color: rgb(57, 201, 20);"></i></span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2">'+
                                '<button class="btn btn-sm btn-danger" onclick="removeColor('+coloradd+')" type="button" style="margin-top: 25px;">Remove</button>'+
                            '</div>'+
                        '</div>';
            $("#colors").append(html);
            coloradd++;
        }

        function removeColor(colorid) {
            $("#color_div"+colorid).remove();
        }
    </script>
 @endsection