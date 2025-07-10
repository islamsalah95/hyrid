 <html lang="en">
 <head> 
  <meta charset="UTF-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Referral Program</title> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/index/v1/css/share.css') }}"> 
  <link rel="stylesheet" href="{{ asset('static/loading/loading.css') }}"> 
 </head> 
 <body> 
  <div class="centeritem"> 
   <div class="flex_be header"> 
    <div class="flex_sta"> 
     <img class="backpage" src="{{ asset('uploads/material/back.png') }}" alt=""> 
     <h6>Referral Program</h6> 
    </div> 
    <div class="balancebox"> 
     <div class="flex_re"> 
      <p>Balance</p> 
      <img src="{{ asset('profelar/profelar_pay.png') }}" alt=""> 
     </div> 
     <span>{{price(auth()->user()->balance)}}</span> 
    </div> 
   </div> 
   <input type="hidden" id="TOKEN" value="5c06e1816f9cd5f7625b22369d45088f"> 
   <img class="giftimg" src="{{ asset('uploads/material/gift.png') }}" alt=""> 
   <h5>Refer and Earn</h5> 
   <h3 class="number"> 30% + 4% + 1% </h3> 
   <p class="textinfo"> Earn 30% commission of level 1 referrals' deposit amount immediately right after his payment. Make sure they register through your referral link. Earn 4% commission of level 2 referrals' deposit amount immediately right after his payment. Earn 1% commission of level 3's.</p> 
   <div class="www">
    {{url('register').'?inviteCode='.auth()->user()->ref_id}}')
   </div> 
   <div class="flex_cen copybtn copy-href" onclick="copyLink('{{url('register').'?inviteCode='.auth()->user()->ref_id}}')"> 
    <img src="{{ asset('uploads/material/copy.png') }}" alt=""> 
    <p>Copy Link</p> 
   </div> 
  </div> 
  @include('app.layout.menu') 

@include('alert-message')
<script>
    function copyLink(text)
    {
        const body = document.body;
        const input = document.createElement("input");
        body.append(input);
        input.style.opacity = 0;
        input.value = text.replaceAll(' ', '');
        input.select();
        input.setSelectionRange(0, input.value.length);
        document.execCommand("Copy");
        input.blur();
        input.remove();
        message('Copied success..')
    }


    function receivedReward(condition){
        if (condition == true){
            window.location.href='{{url('user.received.reward')}}';
        }else {
            message('Target not eligible.')
        }
    }

    function closeCheckIn(){
        var checkinOverLay = document.querySelector('.checkinOverLay');
        var checkinOverBlock = document.querySelector('.checkinOverBlock');

        checkinOverLay.style.display = 'none';
        checkinOverBlock.style.display = 'none';
    }

    function openCheckIn(){
        var checkinOverLay = document.querySelector('.checkinOverLay');
        var checkinOverBlock = document.querySelector('.checkinOverBlock');

        checkinOverLay.style.display = 'block';
        checkinOverBlock.style.display = 'block';
    }

    function checkin(){
        closeCheckIn()
        var code = document.querySelector('input[name="code"]').value;
        window.location.href='{{url('submit-bonus-amount')}}'+"/"+code
    }


    function getDeposirreward(url){
        document.querySelector('.loader').style.display='block';
        window.location.href=url
    }
</script>
</body>
</html>