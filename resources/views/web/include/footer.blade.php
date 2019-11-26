  <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-3 col-xs-12">
            <div class="footer-logo"><a href="index.html"><img src="{{asset('web/images/logo.png')}}" alt="fotter logo"></a> </div>
            <div class="social">
              <ul class="inline-mode">
                <li class="social-network fb"><a title="Connect us on Facebook" target="_blank" href="https://www.facebook.com/"><i class="icon-social-facebook icons"></i></a></li>
                <li class="social-network googleplus"><a title="Connect us on Google+" target="_blank" href="https://plus.google.com/"><i class="icon-social-google icons"></i></a></li>
                <li class="social-network tw"><a title="Connect us on Twitter" target="_blank" href="https://twitter.com/"><i class="icon-social-twitter icons"></i></a></li>
                <li class="social-network linkedin"><a title="Connect us on Linkedin" target="_blank" href="https://www.pinterest.com/"><i class="icon-social-linkedin icons"></i></a></li>
                <li class="social-network rss"><a title="Connect us on Instagram" target="_blank" href="https://instagram.com/"><i class="icon-social-pinterest icons"></i></a></li>
                <li class="social-network instagram"><a title="Connect us on Instagram" target="_blank" href="https://instagram.com/"><i class="icon-social-instagram icons"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-md-2 col-xs-12 collapsed-block">
            <div class="footer-links">
              <h3 class="links-title">Information<a class="expander visible-xs" href="#TabBlock-1">+</a></h3>
              <div class="tabBlock" id="TabBlock-1">
                <ul class="list-links list-unstyled">
                  <li><a href="#s">Delivery Information</a></li>
                  <li><a href="#">Discount</a></li>
                  <li><a href="sitemap.html">Sitemap</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                  <li><a href="faq.html">FAQs</a></li>
                  <li><a href="#">Terms &amp; Condition</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-2 col-xs-12 collapsed-block">
            <div class="footer-links">
              <h3 class="links-title">Insider<a class="expander visible-xs" href="#TabBlock-3">+</a></h3>
              <div class="tabBlock" id="TabBlock-3">
                <ul class="list-links list-unstyled">
                  <li><a href="sitemap.html"> Sites Map </a></li>
                  <li><a href="#">News</a></li>
                  <li><a href="#">Trends</a></li>
                  <li><a href="about_us.html">About Us</a></li>
                  <li><a href="{{ route('web.contact')}}">Contact Us</a></li>
                  <li><a href="#">My Orders</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-2 col-xs-12 collapsed-block">
            <div class="footer-links">
              <h3 class="links-title">Service<a class="expander visible-xs" href="#TabBlock-4">+</a></h3>
              <div class="tabBlock" id="TabBlock-4">
                <ul class="list-links list-unstyled">
                  <li><a href="account_page.html">Account</a></li>
                  <li><a href="wishlist.html">Wishlist</a></li>
                  <li><a href="shopping_cart.html">Shopping Cart</a></li>
                  <li><a href="{{ route('web.returnpolicy')}}">Return Policy</a></li>
                  <li><a href="#">Special</a></li>
                  <li><a href="#">Lookbook</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 col-xs-12 collapsed-block">
            <div class="footer-links">
              <h3 class="links-title">Contact Us<a class="expander visible-xs" href="#TabBlock-5">+</a></h3>
              <div class="tabBlock" id="TabBlock-5">
                <div class="footer-description"> 
                  Address: BIBIBOBI MARKET SERVICES (OPC)<br>PVT LTD.,House No. 453, Halwa Gaon, Dhekial, Golaghat, Golaghat, Assam - 785621<br>
                  E-mail: support@bibibobi.com.<br>
                  Phone: +91-6003499455 <BR>
                  CIN : U52510AS2019OPC019304
                </div>
                <div class="footer-description"> 
                  Monday-Friday: 8.30 a.m. - 5.30 p.m.<br>
                  Saturday: 9.00 a.m. - 2.00 p.m.<br>
                  Sunday: Closed 
                </div>
                <div class="payment">
                  <ul>
                    <li><a href="#"><img title="Visa" alt="Visa" src="{{asset('web/images/visa.png')}}"></a></li>
                    <li><a href="#"><img title="Paypal" alt="Paypal" src="{{asset('web/images/paypal.png')}}"></a></li>
                    <li><a href="#"><img title="Discover" alt="Discover" src="{{asset('web/images/discover.png')}}"></a></li>
                    <li><a href="#"><img title="Master Card" alt="Master Card" src="{{asset('web/images/master-card.png')}}"></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-contact"></div>
      <div class="footer-coppyright">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-xs-12 coppyright"> Copyright © 2019 <a href="#"> Bibibobi </a>. All Rights Reserved. || Developed By <a href="https://www.webinfotech.net.in/">Webinfotech</a></div>
            <div class="col-sm-6 col-xs-12">
              <ul class="footer-company-links">
                <li> <a href="{{route('web.privacy')}}">Privacy Policy</a> </li>
                <li>|</li>
                <li> <a href="#">Terms &amp; Condition</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <a href="#" id="back-to-top" title="Back to top"><i class="fa fa-angle-up"></i></a> 
    
    <!-- End Footer --> 
  </div>

  <!-- JS --> 

  <!-- jquery js --> 
  <script type="text/javascript" src="{{asset('web/js/jquery.min.js')}}"></script> 
  
  <!-- bootstrap js --> 
  <script type="text/javascript" src="{{asset('web/js/bootstrap.min.js')}}"></script> 

  <!-- owl.carousel.min js --> 
  <script type="text/javascript" src="{{asset('web/js/owl.carousel.min.js')}}"></script> 

  <!-- jquery.mobile-menu js --> 
  <script type="text/javascript" src="{{asset('web/js/mobile-menu.js')}}"></script> 

  <!--jquery-ui.min js --> 
  <script type="text/javascript" src="{{asset('web/js/jquery-ui.js')}}"></script> 

  <!-- main js --> 
  <script type="text/javascript" src="{{asset('web/js/main.js')}}"></script> 
  <!-- <script type="text/javascript" src="html/js/main.js"></script>  -->

  <!-- countdown js --> 
  <script type="text/javascript" src="{{asset('web/js/countdown.js')}}"></script> 

  <!-- Slider Js --> 
  <script type="text/javascript" src="{{asset('web/js/revolution-slider.js')}}"></script> 
  <script type="text/javascript" src="{{asset('web/js/jquery.bxslider.js')}}"></script>
  <script type="text/javascript" src="{{asset('web/js/jquery.flexslider.js')}}"></script>
  <script type="text/javascript" src="{{asset('web/js/cloud-zoom.js')}}"></script> 
  <script type="text/javascript" src="{{asset('web/js/jquery.magnifying-zoom.js')}}"></script>
</body>
  <!-- Revolution slider --> 
  <script type="text/javascript">
      var setREVStartSize = function() {};


      setREVStartSize();

      function revslider_showDoubleJqueryError(sliderID) {}
      var tpj = jQuery;
      // tpj.noConflict();
      var revapi6;
      tpj(document).ready(function() {
          if (tpj("#rev_slider_6_1").revolution == undefined) {
              revslider_showDoubleJqueryError("#rev_slider_6_1");
          } else {
              revapi6 = tpj("#rev_slider_6_1").show().revolution({
                  sliderType: "standard",
                  sliderLayout: "auto",
                  dottedOverlay: "none",
                  delay: 6000,
                  navigation: {
                      keyboardNavigation: "off",
                      keyboard_direction: "horizontal",
                      mouseScrollNavigation: "off",
                      onHoverStop: "off",
                      touch: {
                          touchenabled: "on",
                          swipe_threshold: 0.7,
                          swipe_min_touches: 1,
                          swipe_direction: "horizontal",
                          drag_block_vertical: false
                      },
                      arrows: {
                          style: "hades",
                          enable: true,
                          hide_onmobile: false,
                          hide_onleave: true,
                          hide_delay: 200,
                          hide_delay_mobile: 1200,
                          tmp: '<div class="tp-arr-allwrapper">	<div class="tp-arr-imgholder"></div></div>',
                          left: {
                              h_align: "left",
                              v_align: "center",
                              h_offset: 20,
                              v_offset: 0
                          },
                          right: {
                              h_align: "right",
                              v_align: "center",
                              h_offset: 20,
                              v_offset: 0
                          }
                      },
                      bullets: {
                          enable: true,
                          hide_onmobile: false,
                          style: "hades",
                          hide_onleave: true,
                          hide_delay: 200,
                          hide_delay_mobile: 1200,
                          direction: "horizontal",
                          h_align: "center",
                          v_align: "bottom",
                          h_offset: 0,
                          v_offset: 20,
                          space: 5,
                          tmp: '<span class="tp-bullet-image"></span>'
                      }
                  },
                  gridwidth: 1100,
                  gridheight: 600,
                  lazyType: "none",
                  shadow: 0,
                  spinner: "spinner0",
                  stopLoop: "off",
                  stopAfterLoops: -1,
                  stopAtSlide: -1,
                  shuffle: "off",
                  autoHeight: "on",
                  disableProgressBar: "on",
                  hideThumbsOnMobile: "off",
                  hideSliderAtLimit: 0,
                  hideCaptionAtLimit: 0,
                  hideAllCaptionAtLilmit: 0,
                  startWithSlide: 0,
                  debugMode: false,
                  fallbacks: {
                      simplifyAll: "off",
                      nextSlideOnWindowFocus: "off",
                      disableFocusListener: false,
                  }
              });
          }
      }); /*ready*/
  </script> 

  <!-- Hot Deals Timer 1--> 
  <script type="text/javascript">
      var dthen1 = new Date("12/25/16 11:59:00 PM");
      start = "08/04/15 03:02:11 AM";
      start_date = Date.parse(start);
      var dnow1 = new Date(start_date);
      if (CountStepper > 0)
          ddiff = new Date((dnow1) - (dthen1));
      else
          ddiff = new Date((dthen1) - (dnow1));
      gsecs1 = Math.floor(ddiff.valueOf() / 1000);

      var iid1 = "countbox_1";
      CountBack_slider(gsecs1, "countbox_1", 1);
  </script>
  <script type='text/javascript'>
    jQuery(document).ready(function() {
    jQuery('#jtv-rev_slider').show().revolution({
    dottedOverlay: 'none',
    delay: 5000,
    startwidth: 1140,
    startheight: 500,
    hideThumbs: 200,
    thumbWidth: 200,
    thumbHeight: 50,
    thumbAmount: 2,
    navigationType: 'thumb',
    navigationArrows: 'solo',
    navigationStyle: 'round',
    touchenabled: 'on',
    onHoverStop: 'on',
    swipe_velocity: 0.7,
    swipe_min_touches: 1,
    swipe_max_touches: 1,
    drag_block_vertical: false,
    spinner: 'spinner0',
    keyboardNavigation: 'off',
    navigationHAlign: 'center',
    navigationVAlign: 'bottom',
    navigationHOffset: 0,
    navigationVOffset: 20,
    soloArrowLeftHalign: 'left',
    soloArrowLeftValign: 'center',
    soloArrowLeftHOffset: 20,
    soloArrowLeftVOffset: 0,
    soloArrowRightHalign: 'right',
    soloArrowRightValign: 'center',
    soloArrowRightHOffset: 20,
    soloArrowRightVOffset: 0,
    shadow: 0,
    fullWidth: 'on',
    fullScreen: 'off',
    stopLoop: 'off',
    stopAfterLoops: -1,
    stopAtSlide: -1,
    shuffle: 'off',
    autoHeight: 'off',
    forceFullWidth: 'on',
    fullScreenAlignForce: 'off',
    minFullScreenHeight: 0,
    hideNavDelayOnMobile: 1500,
    hideThumbsOnMobile: 'off',
    hideBulletsOnMobile: 'off',
    hideArrowsOnMobile: 'off',
    hideThumbsUnderResolution: 0,
    hideSliderAtLimit: 0,
    hideCaptionAtLimit: 0,
    hideAllCaptionAtLilmit: 0,
    startWithSlide: 0,
    fullScreenOffsetContainer: ''
    });
    });
  </script> 
</body>

</html>
