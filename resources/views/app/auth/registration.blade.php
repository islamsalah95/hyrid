<html lang="en">
<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Sign up</title> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/login.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/loading/loading.css') }}"> 
</head> 
<body>
  <form action="{{url('register')}}" method="post" class="register-form" id="register-form">
    @csrf
    <img class="loginbanner" src="{{ asset('profelar/profelar_login.png') }}" alt=""> 
    <div class="centeritem"> 
      <div class="flex_be tabnav"> 
        <a class="login" onclick="window.location.href='{{url('login')}}'" >Login</a> 
        <a class="login active" onclick="window.location.href='{{url('#')}}'" >Sign up</a> 
      </div> 
      <span class="label">Mobile number</span> 
      <div class="inputbox flex_sta">
        +20 
        <input type="text" name="phone" class="check_number_func_1" maxlength="10" id="phone" placeholder="Enter your Mobile number"> 
      </div>
      <!-- Hidden Referral Input Field -->
      <input type="hidden" name="ref_by" value="{{ old('ref_by', $ref_by ?? '') }}">

      <span class="label">Password</span> 
      <input class="inputbox" type="password" name="password" id="password" placeholder="Password ( ≥6 characters )"> 
      <span class="label">Captcha</span> 
      <div class="flex_be inputbox"> 
        <input type="text" class="otpipt check_number_func_1" maxlength="4" name="captcha" id="opt" placeholder="Enter Captcha"> 
        <img src="{{$code['img']}}" onclick="this.src='{{$code['img']}}&t=' + new Date().getTime()" alt=""> 
      </div> 
      <div class="submit" type="button" onclick="login(event)">
        Submit
      </div> 
      <input type="hidden" id="is_otp" value="0"> 
      <input type="hidden" id="TOKEN" value="ec5b6133a18ad44983b63a2cb6c95500"> 
    </div>

    <!-- Loading animation -->
    <div class="loadingClass" style="display: none;">
      <div class="spinner"></div>
      <p>Success...</p>
    </div>

    @include('loading')
    @include('alert-message')

    <style>
      /* Loading animation styles */
      .loadingClass {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        font-size: 18px;
        z-index: 9999;
      }
      .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #fff;
        border-top: 4px solid transparent;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin-bottom: 15px;
      }
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    </style>

    <script>
      function login(event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        const varificationCode = '{{$code['code']}}';
        const phone = document.querySelector('input[name="phone"]').value;
        const password = document.querySelector('input[name="password"]').value;
        const code = document.querySelector('#opt').value;

        if (!phone) {
          message('Please enter a valid phone number.');
          return;
        }

        if (!code || code !== varificationCode) {
          message('Invalid verification CAPTCHA.');
          return;
        }

        if (!password) {
          message('Please enter your login password.');
          return;
        }

        // Show loading animation
        document.querySelector('.loadingClass').style.display = 'flex';

        // Submit the form after validation
        document.querySelector('#register-form').submit();
      }
    </script>
  </form>
</body>
</html>
