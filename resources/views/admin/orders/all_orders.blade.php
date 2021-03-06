@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>All Orders</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Order Id</th>
                              <th>Order By</th>
                              <th>Amount</th>
                              <th>Quantity</th>
                              <th>Payment Method</th>
                              <th>Payment Status</th>
                              <th>Order Status</th>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>                       
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
     
     <script type="text/javascript">
         $(function () {
    
            var table = $('#size_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.ajax_order_all') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'u_name', name: 'u_name' ,searchable: true},
                    {data: 'amount', name: 'amount' ,searchable: true},                 
                    {data: 'quantity', name: 'quantity',orderable: false, searchable: false},   
                    { data: 'payment_method', name: 'payment_method',orderable: false, searchable: false},
                    { data: 'payment_status', name: 'payment_status',orderable: false, searchable: false},  
                    { data: 'status', name: 'status',orderable: false, searchable: false}, 
                    { data: 'created_at', name: 'created_at', searchable: true},            
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>
    
 @endsection