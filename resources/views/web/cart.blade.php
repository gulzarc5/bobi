@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
  <section>
      <div class="nav-drict">
          <ul>
              <li class="active"><h6>Cart </h6></li>
              <li class="divider"></li>
              <li><h6>Shiping </h6></li>
              <li class="divider"></li>
              <li><h6>Payment</h6></li>
          </ul>
      </div>
  </section>
  <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <table class="table table table-shopping-cart">
                        <thead>
                            <tr class="tabletr ">
                                <th class="text-center">SI</th>
                                <th class="text-center">Product</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Quatity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Action</th>
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
                                   <button type="submit" class="fa fa-close table-shopping-remove" ></button>
                                    <button type="submit" class="fa fa-check table-shopping-check"></>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    <div class="gap gap-small"></div>
                </div>
                <div class="col-md-2">
                    <ul class="shopping-cart-total-list">
                        <li><span>Subtotal</span><span>$2199</span>
                        </li>
                        <li><span>Shopping</span><span>Free</span>
                        </li>
                        <li><span>Taxes</span><span>$0</span>
                        </li>
                        <li><span>Total</span><span>$2199</span>
                        </li>
                    </ul><a class="btn btn-primary " href="#" >Checkout</a>
                </div>
            </div>
            <ul class="list-inline">
                <li><a class="btn btn-default" href="#">Continue Shopping</a>
                </li>
                <li><a class="btn btn-default" href="#">Update Bag</a>
                </li>
            </ul>
        </div>
  <!-- Main Container End --> 
@endsection