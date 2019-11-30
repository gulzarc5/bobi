<!doctype html>
<html lang="en">
  <head>
      <!-- Basic page needs -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Bibibobi</title>
  <!-- Mobile specific metas  -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="images/fab.png">
  <!-- CSS Style -->
  <link rel="stylesheet" href="{{asset('web/css/url.css')}}">

    <style>img{width: 100%;margin: 10px auto!important;}.flot-r{float: right;}.flot-l{float: left;}.width-30{width:30%}.row{margin: 0;border-bottom: 1px solid #333}.bdr-botm{border-bottom:none}.bdr-r{border-right: 1px solid #333;}.bdr-l{border-left: 1px solid #333;}.main-content{padding: 10px 0}.content-body{border:1px solid #333;background-color: #fff}.font-15{font-size: 15px}.cap{text-transform: uppercase;}p,h3{margin: 5px 0;}.ptb-30{padding: 30px 0}.bar{display: flex;margin: auto;}p{color: #333;}</style>
  </head>
  <body>
      <!-- Main Content -->
      <section class="main-content">
        <div class="container">
          <div class="row bdr-botm">
            <div class="col-md-3 col-xs-2"></div>
            @if ($data && !empty($data))
            <div class="col-md-6 col-xs-8">
              <div class="content-body">
                <div class="row">
                  <div class="col-xs-6"> <h4 style="margin-top:14px">{{$data['cl']}}</h4></div>
                  <div class="col-xs-6 bdr-l"><img style="width: 44%;height: 40px;display: flex;" src="{{$data['delhivery_logo']}}"></div>
                </div> 
                <div class="row">
                  <div class="col-xs-12"><img class="width-30 bar" src="{{$data['barcode']}}"></div>
                  <div class="col-xs-6"> <p class="font-15 flot-l">{{$data['pin']}}</p></div>
                  <div class="col-xs-6"> <p class="font-15 flot-r"><strong>{{$data['sort_code']}}</strong></p></div>
                </div>
                <div class="row">
                  <div class="col-xs-9">
                    <h5>Shiping Address :</h5>
                    <h4 class="cap">{{$data['name']}}</h4>
                    <p>{{$data['address']}}<br>
                    <p>{{$data['destination']}}<br>
                    <p><strong>PIN:{{$data['pin']}}</strong></p>
                  </div>
                  <div class="col-xs-3 bdr-l" style="height: 120px;"> <h4 style="position: absolute;top: 45px;left: 32px;" class="font-15 flot-r"><strong class="cap">{{$data['pt']}}</strong></h4></div>
                </div>
                <div class="row">
                  <div class="col-xs-7 bdr-r">
                    <p class="cap"><strong>Seller:</strong> {{$data['snm']}}</p>
                    <p><strong>Address:</strong> {{$data['sadd']}}</p>
                  </div>
                  <div class="col-xs-5"></div>
                </div> 
                <div class="row">
                  <div class="col-xs-7 bdr-r">
                    <p class="cap"><strong>Product</strong></p>
                  </div>
                  <div class="col-xs-5">
                    <div class="row bdr-botm">
                      <div class="col-xs-6 bdr-r"><p class="cap"><strong>Price</strong></p></div>
                      <div class="col-xs-6"><p class="cap"><strong>Total</strong></p></div>
                    </div>  
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-7 bdr-r">
                    <p class="cap ptb-30"><strong>{{$data['prd']}}</strong></p>
                  </div>
                  <div class="col-xs-5">
                    <div class="row bdr-botm">
                      <div class="col-xs-6 bdr-r"><p class="cap ptb-30"><strong>₹{{number_format($data['rs'],2,".",'')}}</strong></p></div>
                      <div class="col-xs-6"><p class="cap ptb-30"><strong>₹{{number_format($data['rs'],2,".",'')}}</strong></p></div>
                    </div>  
                  </div>
                </div> 
                <div class="row">
                  <div class="col-xs-7 bdr-r">
                    <p class="cap"><strong>Total</strong></p>
                  </div>
                  <div class="col-xs-5">
                    <div class="row bdr-botm">
                      <div class="col-xs-6 bdr-r"><p class="cap"><strong>₹{{number_format($data['rs'],2,".",'')}}</strong></p></div>
                      <div class="col-xs-6"><p class="cap"><strong>₹{{number_format($data['rs'],2,".",'')}}</strong></p></div>
                    </div>  
                  </div>
                </div> 
                <div class="row">
                  <div class="col-xs-12"><img class="width-30 bar" src="{{$data['oid_barcode']}}"></div>
                </div>
                <div class="row bdr-botm">
                  <div class="col-xs-12"><p><strong>Return Address:</strong> {{$data['radd']}} - {{$data['rcty']}} - {{$data['rpin']}}</p></div>
                </div>   
              </div>
            </div>
            @endif
            <div class="col-md-3 col-xs-2"></div>
          </div>        
        </div>
      </section>
      <!-- Main Content -->

  
  </body>
</html>
<script>
    window.print();document_focus = true;
    setInterval(function() { if (document_focus === true) { window.close(); }  }, 300);
</script>