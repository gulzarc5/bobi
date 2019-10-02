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
  <section class="blog_post" style="margin: 0">
    <div class="container">       
      <!-- row -->
      <div class="row">         
        <!-- Center colunm-->
        <div class="col-xs-12 col-sm-9" id="center_column">
          <div class="center_column">
            <ul class="blog-posts">
              <li class="post-item">
                <article class="entry">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="entry-thumb"><a>
                        <figure><img src="{{asset('web/images/products/img01.jpg')}}" alt="Blog"></figure>
                        </a> </div>
                    </div>
                    <div class="col-sm-9">
                      <h3 class="entry-title"><a href="blog_single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                      <div class="entry-meta-data"> <span class="author"> <i class="pe-7s-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="pe-7s-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="pe-7s-comment"></i>&nbsp; 3 </span> <span class="date"><i class="pe-7s-date"></i>&nbsp; 2017-08-05</span> </div>
                      <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                      <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.  Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                      <a href="#" class="button read-more">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                  </div>
                </article>
              </li>
              <li class="post-item">
                <article class="entry">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="entry-thumb"><a>
                        <figure><img src="{{asset('web/images/products/img02.jpg')}}" alt="Blog"></figure>
                        </a> </div>
                    </div>
                    <div class="col-sm-9">
                      <h3 class="entry-title"><a href="blog_single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                      <div class="entry-meta-data"> <span class="author"> <i class="pe-7s-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="pe-7s-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="pe-7s-comment"></i>&nbsp; 3 </span> <span class="date"><i class="pe-7s-date"></i>&nbsp; 2017-08-05</span> </div>
                      <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                      <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.  Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                      <a href="#" class="button read-more">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                  </div>
                </article>
              </li>
              <li class="post-item">
                <article class="entry">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="entry-thumb"><a>
                        <figure><img src="{{asset('web/images/products/img03.jpg')}}" alt="Blog"></figure>
                        </a> </div>
                    </div>
                    <div class="col-sm-9">
                      <h3 class="entry-title"><a href="blog_single_post.html">Aliquam Et Metus Pharetra, Bibendum Massa</a></h3>
                      <div class="entry-meta-data"> <span class="author"> <i class="pe-7s-user"></i>&nbsp; by: <a href="#">Admin</a></span> <span class="cat"> <i class="pe-7s-folder"></i>&nbsp; <a href="#">News, </a> <a href="#">Promotions</a> </span> <span class="comment-count"> <i class="pe-7s-comment"></i>&nbsp; 3 </span> <span class="date"><i class="pe-7s-date"></i>&nbsp; 2017-08-05</span> </div>
                      <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>&nbsp; <span>(5 votes)</span></div>
                      <div class="entry-excerpt">Donec Vitae Hendrerit Arcu, Sit Amet Faucibus Nisl. Cras Pretium Arcu Ex. Aenean Posuere Libero Eu Augue Condimentum Rhoncus.  Aenean Posuere Libero Eu Augue Condimentum Rhoncus.</div>
                      <a href="#" class="button read-more">Read more&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
                  </div>
                </article>
              </li>
            </ul>
          </div>
        </div>
        <!-- ./ Center colunm --> 
        <!-- Right colunm -->
        <aside class="right sidebar col-sm-3 col-xs-12">
          <div class="sidebar-checkout block">
            <div class="sidebar-bar-title">
              <h3>Your Checkout</h3>
            </div>
            <div class="block-content">
              <dl>
                <dt class="complete"> Billing Address <span class="separator">|</span> <a href="#">Change</a> </dt>
                <dd class="complete">
                  <address>
                  Deo Jone<br>
                  Company Name<br>
                  7064 Lorem <br>
                  Ipsum <br>
                  Vestibulum 0 666/13<br>
                  United States<br>
                  T: 12345678 <br>
                  F: 987654
                  </address>
                </dd>
                <dt class="complete"> Shipping Address <span class="separator">|</span> <a href="#">Change</a> </dt>
                <dd class="complete">
                  <address>
                  Deo Jone<br>
                  Company Name<br>
                  7064 Lorem <br>
                  Ipsum <br>
                  Vestibulum 0 666/13<br>
                  United States<br>
                  T: 12345678 <br>
                  F: 987654
                  </address>
                </dd>
                <dt class="complete"> Shipping Method <span class="separator">|</span> <a href="#">Change</a> </dt>
                <dd class="complete"> Flat Rate - Fixed <br>
                  <span class="price">$15.00</span> </dd>
                <dt> Payment Method </dt>
              </dl>
              <a href="{{ route('web.shipping')}}"><button class="button"><i class="fa fa-angle-double-right"></i>&nbsp; <span>Proceed To Checkout</span></button></a>
            </div>
          </div>
        </aside>
        <!-- ./right colunm --> 
      </div>
      <!-- ./row--> 
    </div>
  </section>
  <!-- Main Container End --> 
@endsection