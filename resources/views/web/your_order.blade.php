@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
 
  <div class="container" style="margin-top: 20px;">
            <div class="row">
                <div class="col-md-12">
                    <table class="table  table-shopping-cart">
                        <thead>
                            <tr class="tabletr">
                                <th class="text-center">SI</th>
                                <th class="text-center">Product</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Quatity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                              <td class="text-center">1</td>
                                <td class="table-shopping-cart-img text-center">
                                    <a href="#">
                                        <img src="images/category/first_category/11.jpg" alt="Image Alternative text" title="Image Title" />
                                    </a>
                                </td>
                                <td class="table-shopping-cart-title text-center"><a href="#">Gucci </a>
                                </td>
                                <td class="text-center">Green</td>
                                <td class="text-center">L</td>
                                <td class="text-center">
                                    <input class="form-control table-shopping-qty" type="number" value="1" />
                                </td>
                                <td class="text-center">$499</td>
                                <td class="text-center">$499</td>
                                <td class="text-center">
                                   <button type="submit" class="btn btn-primary">Return</button>
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </td>
                            </tr>
                             <tr class="text-center">
                              <td class="text-center">1</td>
                                <td class="table-shopping-cart-img text-center">
                                    <a href="#">
                                        <img src="images/category/first_category/11.jpg" alt="Image Alternative text" title="Image Title" />
                                    </a>
                                </td>
                                <td class="table-shopping-cart-title text-center"><a href="#">Gucci </a>
                                </td>
                                <td class="text-center">Green</td>
                                <td class="text-center">L</td>
                                <td class="text-center">
                                    <input class="form-control table-shopping-qty" type="number" value="1" />
                                </td>
                                <td class="text-center">$499</td>
                                <td class="text-center">$499</td>
                               <td class="text-center">
                                   <button type="submit" class="btn btn-primary">Return</button>
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </td>
                            </tr>
                             <tr class="text-center">
                              <td class="text-center">1</td>
                                <td class="table-shopping-cart-img text-center">
                                    <a href="#">
                                        <img src="images/category/first_category/11.jpg" alt="Image Alternative text" title="Image Title" />
                                    </a>
                                </td>
                                <td class="table-shopping-cart-title text-center"><a href="#">Gucci </a>
                                </td>
                                <td class="text-center">Green</td>
                                <td class="text-center">L</td>
                                <td class="text-center">
                                    <input class="form-control table-shopping-qty" type="number" value="1" />
                                </td>
                                <td class="text-center">$499</td>
                                <td class="text-center">$499</td>
                                <td class="text-center">
                                   <button type="submit" class="btn btn-primary">Return</button>
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <ul class="list-inline">
                <li><a class="btn btn-default" href="#">Continue Shopping</a>
                </li>
                {{-- <li><a class="btn btn-default" href="#">Update Bag</a>
                </li> --}}
            </ul>
<div class="container" style="margin-bottom: 20px;">
   <div class="text-center"><i class="fa fa-history" style="font-size: 100px;color: gray;"></i>
       <p class="lead">Order history empty</p><a class="btn btn-primary btn-lg" href="#">Start Shopping <i class="fa fa-long-arrow-right"></i></a>
   </div>
   <div class="gap"></div>
</div>
        </div>

  <!-- Main Container End --> 
@endsection