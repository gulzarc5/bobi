@extends('admin.template.admin_master')

@section('content')
<style>.dispatch-order input{width: 100%;padding: 8px 10px;margin-bottom: 18px;border: 1px solid #bbb;}</style>
<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Processing Orders  <b><button onclick="export_excel()"><i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 20px; color:#FF9800"></i></button></b></h2>
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
                              {{-- <th>Order Status</th> --}}
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
                ajax: "{{ route('admin.ajax_processing_orders') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'u_name', name: 'u_name' ,searchable: true},
                    {data: 'total', name: 'total' ,searchable: true},                 
                    {data: 'quantity', name: 'quantity',orderable: false, searchable: false},   
                    { data: 'payment_method', name: 'payment_method',orderable: false, searchable: false},
                    { data: 'payment_status', name: 'payment_status',orderable: false, searchable: false},  
                    // { data: 'status', name: 'status',orderable: false, searchable: false}, 
                    { data: 'created_at', name: 'created_at', searchable: true},            
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>


<script>
    function export_excel(){
    window.location.href = "{{route('admin.processing_orders_excel')}}";
  }
</script>

<script>
    function dispatchOrder(id){
        var order_id = $("#order"+id).val();
        var awbno = $("#awb"+id).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{ url('admin/order/dispatch/Update/')}}"+"/"+order_id+"/"+awbno,
            success:function(data){
                $('.mod'+id).modal('hide');
                $("#btn"+id).html('Order Processed');
            }
        });       

        console.log('#mod'+id);
    }
</script>
    
 @endsection