@extends('web.templet.master')
@section('content')
<!-- Main Container -->
  <section class="main-container col1-layout">
    <div class="main container">
      <div class="row">
        <section class="col-main col-sm-12">
          <div id="contact" class="page-content page-contact">
            <div class="page-title">
              <h2>Contact Us</h2>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6" id="contact_form_map">
                <h3 class="page-subheading">Let's get in touch</h3>
                <br/>
                <ul class="store_info">
                  <li><i class="icon-home icons"></i>7064 Golaghat , Assam</li>
                  <li><i class="icon-phone icons"></i><span>+ 012 315 678 1234</span></li>
                  <li><i class="icon-printer icons"></i><span>+39 0035 356 765</span></li>
                  <li><i class="icon-envelope-open icons"></i>Email: <span><a href="mailto:support@bibibobi.com">support@bibibobi.com</a></span></li>
                </ul>
              </div>
              <div class="col-sm-6">
                <h3 class="page-subheading">Make an enquiry</h3>
                <div class="contact-form-box">
                  <div class="form-selector">
                    <label>Name</label>
                    <input type="text" class="form-control input-sm" id="name" />
                  </div>
                  <div class="form-selector">
                    <label>Email</label>
                    <input type="text" class="form-control input-sm" id="email" />
                  </div>
                  <div class="form-selector">
                    <label>Phone</label>
                    <input type="text" class="form-control input-sm" id="phone" />
                  </div>
                  <div class="form-selector">
                    <label>Message</label>
                    <textarea class="form-control input-sm" rows="10" id="message"></textarea>
                  </div>
                  <div class="form-selector">
                    <button class="button"><i class="icon-paper-plane icons"></i>&nbsp; <span>Send Message</span></button>
                    &nbsp; <a href="#" class="button">Clear</a> </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
  <section>
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3567.7827368898693!2d93.39718641451361!3d26.591346280253283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3744475816a285f5%3A0xc1612733e72068aa!2sKaziranga+National+Park!5e0!3m2!1sen!2sin!4v1562046434606!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>
    @endsection