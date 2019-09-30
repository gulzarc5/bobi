@extends('seller.template.seller_master')

@section('content')
<style>

</style>

<div class="right_col" role="main">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        @if (isset($dealing_category) && !empty($dealing_category) && empty($status))
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>My Dealing Category</h2>
                            <div class="clearfix"></div>
                        </div>
        
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">                
                                            <th class="column-title">Sl No. </th>
                                            <th class="column-title">Main category</th>
                                            <th class="column-title">Sub category</th>
                                            <th class="column-title">Action</th>
                                    </thead>
        
                                    <tbody>
        
                                        @if(isset($dealing_category) && !empty($dealing_category) && count($dealing_category) > 0)
                                        @php
                                            $count = 1;
                                        @endphp
        
                                        @foreach($dealing_category as $category)
                                        <tr class="even pointer">
                                            <td class=" ">{{ $count++ }}</td>
                                            <td class=" ">{{ $category->category_name }}</td>
                                            <td class=" ">{{ $category->f_cat_name }}</td>
                                                
                                            <td class=" "> 
                                                <a href="{{ route('seller.MyCategoryDelete',['category_id' => encrypt($category->id)]) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" style="text-align: center">Sorry No Data Found</td>
                                            </tr>
                                        @endif
                                        
                                        <tr>
                                            <td colspan="4" style="text-align: center"><a href="{{ route('seller.MyCategoryForm',['status' => encrypt(1)]) }}" class="btn btn-success">Add New Dealing Category</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12 col-xs-12" style="margin-top:50px;">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>My Dealing Category</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div>
                        @if (Session::has('message'))
                            <div class="alert alert-success" >{{ Session::get('message') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif

                    </div>
                    <div>
                        <div class="x_content">
                    
                            {{ Form::open(['method' => 'post','route'=>'seller.MyCategoryUpdate']) }}
                            
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    @if (isset($categories) && !empty($categories))
                                    @php
                                    $count=1;  
                                    @endphp
                                        @foreach ($categories as $main_category)
                                            <div class="col-md-12 col-sm-12 col-xs-12 mb-3 clear-fix-cat">
                                                <label for="name" style="font-size:20px;">{{ $main_category['category'] }}</label>
                                            </div>
                                            @foreach ($main_category['first_category'] as $first_cat)
                                                @if ($first_cat['status'] == 1)
                                                    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                                        <input type="checkbox" name="deal_cat[]" id="cat{{$count}}" value="{{$first_cat['id']}}" class="flat" /> {{$first_cat['name']}}
                                                    </div>
                                                    @php
                                                        $count++;  
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif                                                            
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group" id="seller_btn">
                                <button type="submit"  class="btn btn-success" >Save</button>
                                <a href="{{ route('seller.MyCategoryForm') }}"  class="btn btn-warning" >Back</a> 
                            </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

 


        
    