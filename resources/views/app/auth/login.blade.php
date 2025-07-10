 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title>
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/login.css') }}">
  <link rel="stylesheet" href="{{ asset('static/loading/loading.css') }}">
 </head>

 <body>
     <form action="{{ url('login') }}" method="post">
         @csrf
         <img class="loginbanner" src="{{ asset('profelar/profelar_login.png') }}" alt="">
         <div class="centeritem">
             <div class="flex_be tabnav">
                 <a class="login active" onclick="window.location.href='{{ url('#') }}'">Login</a>
                 <a class="login" onclick="window.location.href='{{ url('register') }}'">Sign up</a>
             </div>
             <span class="label">Mobile number</span>
             <div class="inputbox flex_sta">
                 +63
                 <input type="text" class=" check_number_func_1" maxlength="10" name="phone"
                     placeholder="Enter your Mobile number">
             </div>
             <span class="label">Password</span>
             <input class="inputbox" type="password" name="password" placeholder="Password ( ≥6 characters )">
             <div class="submit" id="loginBtn" onclick="login()">
                 Submit
             </div>
         </div>
     </form>

     <div class="loading"
         style="
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
         <img src="{{ asset('loading.gif') }}" style="width: 100%;" alt="">
     </div>
     </div>
     @include('alert-message')
     <script>
         function login() {
             document.querySelector('.loading').style.display = 'block';
             document.querySelector('form').submit();
         }
     </script>
 </body>

 </html>
