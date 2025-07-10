<html lang="en">
 <head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Withdraw</title> 
  <link rel="stylesheet" href="/static/index/v1/css/main.css"> 
  <link rel="stylesheet" href="/static/index/v1/css/withdraw.css"> 
  <link rel="stylesheet" href="/static/loading/loading.css"> 
 </head> 
 <body>
  <div class="centeritem"> 
   <div class="flex_be header"> 
    <div class="flex_sta"> 
     <img class="backpage" src="/uploads/material/back.png" alt=""> 
     <h6>Withdraw</h6> 
    </div>
    <form action="{{route('user.withdraw-confirm-submit')}}" method="post">
            @csrf
    <div class="balancebox"> 
     <div class="flex_re"> 
      <p>Balance</p> 
      <img src="/profelar/profelar_pay.png" alt=""> 
     </div> 
     <span>{{price(auth()->user()->balance)}}</span> 
    </div> 
   </div> 
   <input type="hidden" id="TOKEN" value="351eb883b7d82ce84bd71401c9d7e9b3"> 
   <div class="balanceall"> 
    <p>ID {{auth()->user()->phone}}</p> 
    <h4>{{price(auth()->user()->balance)}}</h4> 
    <div class="flex_cen"> 
     <img src="/profelar/profelar_pay.png" alt=""> 
     <p>Balance</p> 
    </div> 
   </div> 
   <h3 class="amount">Amount</h3> 
   <div class="inputbox flex_be"> 
    <p>{{setting('currency')}}</p> 
    <input class="check_number_func" name="amount" placeholder="Please enter the withdrawal amount"> 
    <!-- <input class="check_number_func" id="money" name="" placeholder="" /> --> 
   </div> 
   <div class="process"> 
    <p>Processing Time：7×24h</p> 
    <p>Min Withdrawl：{{setting('currency')}}100</p> 
    <p>Fees：None</p> 
   </div> 
   <div class="withdrawbtn" id="Submit" onclick="submitWithdraw()">
    Withdraw
   </div> 
   <div class="flex_sta title"> 
    <img src="/uploads/material/infoicon.png" alt=""> 
    <h4>Withdraw Record</h4> 
   </div> 
   <div class="tableoutter"> 
    <table rules="all"> 
     <thead> 
      <tr> 
       <th>Time</th> 
       <th>Amount</th> 
       <th>State</th> 
      </tr> 
     </thead>
     @foreach(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
     <tbody class="data-list"></tbody>
     <td>{{$element->created_at}}</td>
     <td>{{price($element->amount)}}</td>
     <td class="success-status">{{$element->status}}</td>
   </div>
   @endforeach
   <div class="nothing empty" style="display: none;"> 
    <img src="/uploads/material/nothing.png" alt=""> 
    <p>No Record</p> 
   </div> 
  </div> 
  </div>
  @include('alert-message')
<div class="layui-layer-move"></div>
<img style="position: fixed;
    display: none;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;" src="{{asset('public/loading.gif')}}" class="loading" alt="">
<script>
    function submitWithdraw(){
        document.querySelector('.loading').style.display = 'block';
        document.querySelector('form').submit();
    }
</script>
</body>
</html>