 <html lang="en">
 <head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Order</title> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/order.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/loading/loading.css') }}"> 
 </head> 
 <body> 
  <div class="centeritem"> 
   <div class="flex_be header"> 
    <div class="flex_sta"> 
     <img class="backpage" src="{{ asset('uploads/material/back.png') }}" alt=""> 
     <h6>Order</h6> 
    </div> 
    <div class="balancebox"> 
     <div class="flex_re"> 
      <p>Balance</p> 
      <img src="{{ asset('profelar/profelar_pay.png') }}" alt=""> 
     </div> 
     <span>{{price(auth()->user()->balance)}}</span> 
    </div> 
   </div> 
   <input type="hidden" id="TOKEN" value="dc95c3851d02bb04600ed79f6c3ff84e"> 
   <div class="returned flex_be"> 
    <div class="leftbox"> 
     <h4>0</h4> 
     <p>Already Returned</p> 
    </div> 
    <div class="line"></div> 
    <div class="leftbox"> 
     <h4>0</h4> 
     <p>Daily Income</p> 
    </div> 
   </div> 
   <div class="aboutorder"> 
    <div class="flex_sta"> 
     <img src="{{ asset('uploads/material/tz.png') }}" alt=""> 
     <p>About Order</p> 
    </div> 
    <p>It shows "0/X days" when you've just purchased and activated the product as its first day of operating hasn't ended yet. It will turns to 1/X at the time of 0 PM, which is the time every product returns the daily income to the client's balance.</p> 
   </div> 
   <ul class="orderlist"> 
   @foreach(\App\Models\Package::whereIn('id', my_vips())->get() as $element)
    <li> 
     <div class="flex_be time">
      <div class="flex_sta"> 
       <img src="{{ asset('uploads/material/ordertj.png') }}" alt=""> 
       <p>{{$element->created_at}}</p> 
      </div> 
      <p>{{$element->status}}</p> 
     </div> 
     <div class="orderinfo">
      <img class="logo" src="{{ asset('profelar/profelar_logo.png') }}" alt=""> 
      <div class="flex_be"> 
       <div class="rightbox"> 
        <p>Product</p> 
        <span>{{$element->name}}</span> 
        <p>Daily Revenue</p> 
        <span class="flex_sta">{{price($element->commission_with_avg_amount / $element->validity)}}<p>|</p> {{price($element->commission_with_avg_amount / $element->validity)}} </span> 
        <p>Duration </p> 
        <span> <a>{{($element->validity)}}</a> /{{($element->validity)}} days</span> 
       </div> 
       <div class="rightbox"> 
        <p>Price</p> 
        <span>{{price($element->price)}}</span> 
        <p>Total Revenue</p> 
        <span class="flex_sta">{{price($element->commission_with_avg_amount)}}<p>|</p> {{price($element->commission_with_avg_amount)}} </span> 
        <!--<p>Already Revenue</p> 
        <span class="flex_sta"><a>0%</a> <p>|</p><a>₱10</a> </span> 
       </div>-->
      </div>
     </div> </li>@endforeach
   </ul>
  </div> 
  @include('app.layout.menu')