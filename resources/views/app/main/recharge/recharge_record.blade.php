 <html lang="en">
 <head> 
  <meta charset="UTF-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Payment Record</title> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/paymentrecord.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/loading/loading.css') }}"> 
 </head> 
 <body> 
  <div class="centeritem"> 
   <div class="flex_be header"> 
    <div class="flex_sta"> 
     <img class="backpage" src="{{ asset('uploads/material/back.png') }}" alt=""> 
     <h6>Payment Record</h6> 
    </div> 
    <div class="balancebox"> 
     <div class="flex_re"> 
      <p>Balance</p> 
      <img src="{{ asset('profelar/profelar_pay.png') }}" alt=""> 
     </div> 
     <span>{{price(auth()->user()->balance)}}</span> 
    </div> 
   </div> 
   <input type="hidden" id="TOKEN" value="e5eb7fcddf4f4dce5701589e7fea01b6"> 
   <div class="aboutorder"> 
    <div class="flex_sta"> 
     <img src="{{ asset('uploads/material/tz.png') }}" alt=""> 
     <p>About Payment Record</p> 
    </div> 
    <p>Due to the excessive number of orders, please upload your payment voucher after you pay for the order, so that our staff can match it more quickly and accurately.</p> 
   </div> 
   <div class="tableoutter"> 
    <table rules="all"> 
     <thead> 
      <tr> 
       <th>Time</th>
                <th>No*</th>
                <th>Amount</th>
                <th>State</th>
            </tr>
            </thead>
            <tbody class="data-list">  
            @foreach(\App\Models\Deposit::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)<tr>
                <td class="timebar">{{$element->created_at}}</td>
                <td>{{$element->order_id}}</td>
                <td>{{price($element->amount)}}</td>
                <td class="confirming"><a class="upload">{{$element->status}}</a></td></tr>            <tr>
                @endforeach
                <!--<td class="timebar">2025-02-05 18:43:44</td>
                <td>Z17387522244675462</td>
                <td>₱200</td>
                <!--<td class="confirming">CONFIRMING<a href="/money/payment_img.html?id=112" class="upload">Upload</a></td></tr>            <tr>
                <td class="timebar">2025-02-05 18:43:25</td>
                <td>Z17387522052704064</td>
                <td>₱300</td>
                <td class="confirming">CONFIRMING<a href="/money/payment_img.html?id=111" class="upload">Upload</a></td></tr></tbody>-->
        </table>
    </div>
</div>
   </div> 
  </div> 
   @include('app.layout.menu')
    </div>
   </div>
  </div>
 </body>
</html>