 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Settings</title>
     <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}">
     <link rel="stylesheet" href="{{ asset('static/index/v1/css/me.css') }}">
     <link rel="stylesheet" href="{{ asset('static/loading/loading.css') }}">
 </head>

 <body>
     <div class="centeritem">
         <div class="flex_be header">
             <div class="flex_sta">
                 <img class="backpage" src="{{ asset('uploads/material/back.png') }}" alt="">
                 <h6>Settings</h6>
             </div>
             <div class="balancebox">
                 <div class="flex_re">
                     <p>Balance</p>
                     <img src="{{ asset('profelar/profelar_pay.png') }}" alt="">
                 </div>
                 <span>{{ price(auth()->user()->balance) }}</span>
             </div>
         </div>
         <input type="hidden" id="TOKEN" value="75cb01a73bc7c05e6a93f9aa9b2eae68">
         <div class="balanceall">
             <p>ID {{ auth()->user()->phone }}</p>
             <h4>{{ price(auth()->user()->balance) }}</h4>
             <div class="flex_cen">
                 <img src="{{ asset('profelar/profelar_pay.png') }}" alt="">
                 <p>Balance</p>
             </div>
         </div>
         <ul class="menu">
             <li> <a href="{{ url('money/withdraw.html') }}" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/a6bddd6ced90fceaf43cbed3994824fc.png') }}"
                             alt="">
                         <p>Withdraw</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a> </li>
             <li> <a href="{{ url('card') }}" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/2b83de405c0c2b1739c294389a870aa0.png') }}"
                             alt="">
                         <p>Bank Info</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a> </li>
             <li> <a href="{{ url('order/index') }}" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/abe47186764f9b69b52043861c56c389.png') }}"
                             alt="">
                         <p>Order</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a> </li>
             <li> <a href="{{ url('recharge/history') }}" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/c2cb0acc8f597a5cc425cb9a062c2cef.png') }}"
                             alt="">
                         <p>Payment Record</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a> </li>
             <li> <a href="{{ url('share/share.html') }}" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/95756902d3007b1a56deb91552abe7ce.png') }}"
                             alt="">
                         <p>Referral Program</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a> </li>
             <li> <a href="{{ url('team/bonus') }}" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/a1925630d504337d6b8cf12202a79e8e.png') }}"
                             alt="">
                         <p>My Team</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a> </li>
             <!--<li> <a href="/index/faq" class="flex_be">
      <div class="flex_sta">
       <img class="menuicon" src="\uploads\material\20240516\373cfe371648554bbbc16469999fd171.png" alt="">
       <p>FAQ</p>
      </div> <img class="moreicon" src="/uploads/material/more.png" alt=""> </a> </li>-->
             <li> <a href="{{ url('index/aboutus') }}" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/25706e4355446d60bc924c5b6c2e5e13.png') }}"
                             alt="">
                         <p>About us</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a> </li>
             {{--  <li>
                <a href="https://t.me/hyipmarketglobalDeveloper" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/19292a9e809c39864b84bb56183d0f3e.png') }}"
                             alt="">
                         <p>Discussion Group</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a>
                </li>  --}}
             {{--  <li>
                <a href="https://t.me/hyipmarketglobalDeveloper" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/c333df313872e7dc4b40542db181314c.png') }}"
                             alt="">
                         <p>Subscribe To Our Channel</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a>
                </li>  --}}
             <li> <a onclick="window.location.href='{{ url('logout') }}'" class="flex_be">
                     <div class="flex_sta">
                         <img class="menuicon"
                             src="{{ asset('uploads/material/20240516/dfde8c839b001d5f025fca1bf3d4a5e3.png') }}"
                             alt="">
                         <p>Log out</p>
                     </div> <img class="moreicon" src="{{ asset('uploads/material/more.png') }}" alt="">
                 </a> </li>
         </ul>
     </div>
     @include('app.layout.menu')
 </body>

 </html>
