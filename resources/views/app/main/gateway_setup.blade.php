<html lang="en">
<head> 
  <meta charset="UTF-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Bank Info</title> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/card.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/loading/loading.css') }}"> 
</head> 
<body> 
  <div class="centeritem"> 
    <div class="flex_be header"> 
      <div class="flex_sta"> 
        <img class="backpage" src="{{ asset('uploads/material/back.png') }}" alt=""> 
        <h6>Bank Info</h6> 
      </div>
      <form action="{{route('setup.gateway.submit')}}" method="post">
        @csrf
        <div class="balancebox"> 
          <div class="flex_re"> 
            <p>Balance</p> 
            <img src="{{ asset('profelar/profelar_pay.png') }}" alt=""> 
          </div> 
          <span>{{ price(auth()->user()->balance) }}</span> 
        </div> 
      </div> 
      <input type="hidden" id="TOKEN" value="dc95c3851d02bb04600ed79f6c3ff84e"> 
      <img src="{{ asset('uploads/material/bank.png') }}" class="bank" alt=""> 
      <span class="lable">Account Holder's Name</span> 
      <input class="inputbox" name="name" value="" type="text" placeholder="Enter your account holder's name"> 
      <span class="lable">Bank Name</span> 
      <div class="flex_be inputbox" style="padding-right: 16px; position: relative;"> 
        <select name="gateway_name" id="payment_method">
          @foreach(\App\Models\PaymentMethod::get() as $element)
            <option value="{{$element->name}}">{{$element->name}}</option>
          @endforeach
        </select>
        <img class="selecticon" src="{{ asset('uploads/material/select.png') }}" alt=""> 
      </div> 
      <span class="lable">Bank Account Number</span> 
      <input class="inputbox" type="number" name="gateway_number" value="" placeholder="Enter your bank account number"> 
      <div class="submit" onclick="submitBank()">Submit</div> 
    </div>
  </form>

  @include('app.layout.menu')

  <img style="position: fixed; display: none; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%;" src="{{ asset('public/loading.gif') }}" class="loading" alt="">
  <div class="layui-layer-move"></div>

  @include('alert-message')

  <script>
    function submitBank() {
      document.querySelector('.loading').style.display = 'block';
      document.querySelector('form').submit();
    }
  </script>
</body>
</html>