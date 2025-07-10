 <html lang="en">
 <head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Product Detail</title> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/swiper/swiper.min.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/details.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/loading/loading.css') }}"> 
  <style>
        img{
            width: 100%;
        }
        .infomation p span{
            text-wrap: wrap !important;
        }
    </style> 
 </head> 
 <body> 
  <div class="centeritem"> 
   <div class="flex_be header"> 
    <div class="flex_sta"> 
     <img class="backpage" src="{{ asset('uploads/material/back.png') }}" alt=""> 
     <h6>Product Detail</h6> 
    </div> 
    <div class="balancebox"> 
     <div class="flex_re"> 
      <p>Balance</p> 
      <img src="{{ asset('profelar/profelar_pay.png') }}" alt=""> 
     </div> 
     <span>{{price(auth()->user()->balance)}}</span> 
    </div> 
   </div> 
   <input type="hidden" id="TOKEN" value="2ac701b4a653ae894c2b6cb98dab770b"> 
   <img class="productimg" src="{{asset($package->photo)}}" alt=""> 
   <h5 class="goodsname">{{$package->name}}</h5> 
   <div class="goodsdetail"> 
    <p>Duration: <span>{{$package->validity}}</span> days </p> 
    <p>Daily ROI: <span>28%</span></p> 
    <p>Daily Revenue: <span>{{price($package->commission_with_avg_amount / $package->validity)}}</span></p> 
    <p>Total Revenue: <span>{{price($package->commission_with_avg_amount)}}</span></p> 
   </div> 
   <div class="flex_sta title"> 
    <img src="{{ asset('uploads/material/infoicon.png') }}" alt=""> 
    <h4>Details</h4> 
   </div> 
   <div class="infomation"> 
    <p style="text-align:center"><img src="{{ asset('uploads/ueditor/image/20240520/1716175644248689.png') }}" title="1716175644248689.png" alt="image 60.png"></p>
    <p><br></p>
    <p><span style="white-space:pre-wrap;">"For everyone, like no one!" Citroën is a popular brand aiming to make mobility accessible to everyone. With comfort and simplicity at the heart of our customer experience, we bring innovative vehicles, services and mobility solutions that are daring and sustainable. </span></p>
    <p><span style="white-space:pre-wrap;"><br></span></p>
    <p><span style="white-space:pre-wrap;"><br></span></p> 
   </div> 
  </div> 
  <div class="buybtn" onclick="window.location.href='{{route('purchase.confirmation', $package->id)}}'">
   Buy
  </div> 
  <div class="coverbg"></div> 
  <div class="payment"> 
   <div class="topbar"></div> 
   <div class="flex_cen"> 
    <img class="icons" src="{{ asset('uploads/material/coins.png') }}" alt=""> 
    <h3>Payment Amount</h3> 
   </div> 
   <h2>₱200</h2> 
   <div class="linebar"></div> 
   <div class="flex_sta title"> 
    <img src="{{ asset('profelar/profelar_pay.png') }}" alt=""> 
    <h4>Please select payment method</h4> 
   </div> 
   <ul class="flex_be"> 
    <li class="getway flex_be active" data-type="1" data-platform="QePay"> <p>Gateway 1</p> 
     <div class="point"> 
      <div class="inner"></div> 
     </div> </li> 
    <li class="getway flex_be " data-type="1" data-platform="AkPay"> <p>Gateway 2</p> 
     <div class="point"> 
      <div class="inner"></div> 
     </div> </li> 
   </ul> 
   <div class="paybtn buyBtn">
    Buy
   </div> 
  </div> 
  <div class="loader" style="
    position: fixed;
    display: none;
    top: 50%;
    z-index: 99;
    width: 143px;
    border-radius: 15px;
    overflow: hidden;
    left: 50%;
    transform: translate(-50%, -50%);
">
    <img src="{{asset('public/loader.webp')}}" style="width: 100%;" alt="">
</div>
@include('alert-message')
<script>
    function buyPackage(id){
        document.querySelector('.loader').style.display='block';
        window.location.href= '{{url('purchase/confirmation')}}'+"/"+id+"/"+"package";
    }
</script>
</body>
</html>