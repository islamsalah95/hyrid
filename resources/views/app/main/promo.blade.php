<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Daily promo bonus</title>
    <link href="{{asset('public')}}/Lay/css/layui.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/main.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/meun.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/checkin.css')}}">
</head>
<body style="background-size: 100% auto; background: #fff; ">
<div class="indexdiv"></div>
<div style=" position: fixed; top: 50%; left: 50%; transform: translate(-50%,-50%); text-align: center; margin: 0 auto; z-index: 102; height:320px; width: 100%; max-width:450px;  display:none; "
     id="noctie">
    <div style="position: relative; width: 100%; text-align: center; background: none; height: auto; margin: 0 auto; width: 80%; background: #fff; background-size: 100% 100%; height: 290px; border-radius: 10px; color: #000; margin-top: 10px; ">
        <div style="background: rgb(0,203,227); height: 120px; border-radius: 8px; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; ">
            <img src="{{asset('public')}}/imgss/a1.png" style="height: 120px;">
        </div>
        <div style="width:88%;position:relative; margin:0 auto;  height:auto; overflow:hidden;border:0px;  padding-top:25px; font-size:12px;line-height:19px; text-align:center; ">
            <div style="max-height: 120px; overflow: scroll; font-size: 12px !important;"><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        prize
                    </font></font>
                <div style="color:#e90b0b; margin-top:15px; font-weight:bold; font-size:18px;"><font
                        style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            +MAD 2.00
                        </font></font></div>
            </div>
        </div>
        <div style="width:100%; text-align:center; margin-top:15px;">
            <button class="cmbtn" id="close" style="height: 40px; width: 40px; border: 0px; width:80%; "><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        OK
                    </font></font></button>
        </div>
    </div>
</div>
<div style="width: 100%; margin: 0 auto; background: #c73544; border-bottom: 0px solid #117546; " class="top">
    <div style="float:left; text-align:left; line-height:46px;width:50%;" id="btnClose">
        <img onclick="window.location.href='{{route('dashboard')}}'" style="width: 20px;margin-left: 10px;margin-top: 15px;" src="{{asset('public/left.png')}}" alt="">
    </div>
    <font class="topname" style="color: #fff;"><font style="vertical-align: inherit;"><font
                style="vertical-align: inherit;">
                Daily check-in
            </font></font></font>
    <div style="float:right; text-align:right; line-height:46px;width:50%;">
    </div>
</div>
<div style=" max-width:450px; margin:0 auto;">
    <div style=" height:auto;  width:100%; margin:0 auto; background:#fff;  overflow:hidden; margin-top:50px;  ">
        <div style="background: #f1f1f1;">
            <img src="{{asset('public')}}/check.png" style="width:100%;">
        </div>
        <div style="width: 100%; max-width: 450px; background: #fff; height: 220px; padding-top: 15px; width: 100%; line-height: 35px; color: #000; text-align: center; font-size: 13px; border: 0px; border-radius: 20px; height: auto; overflow: hidden;">

            <div style="background: #c73544; height: 70px; ">
                <div style="width: 100%; height:70px; line-height:70px; text-align: center; height: auto; overflow: hidden; color: #fff">
                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            {{env('APP_NAME')}} Check-in Bonus: </font></font><font id="dayss"
                                                                       style="font-weight: bold; color: #fff;"><font
                            style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{price(setting('checkin'))}}</font></font></font>
                </div>
            </div>

            <div style="background: #fff; width: 95%; margin: 0 auto; border-radius: 20px; margin-top:25px; padding-bottom:15px; padding-top:15px;">

                <div style="height: auto; overflow: hidden;">
                    <div style="width: 50%; float: left; ">
                        <div style="color: #1476ff; font-size: 20px; font-family: DengXian; "><font
                                style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;"></font></font><font id="amount">{{price(auth()->user()->balance)}}</font></div>
                        <div style="color: #6D6D6D; font-size: 12px;"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">account balance</font></font></div>
                    </div>

                    <div style="width: 50%; float: left;">
                        <div style="color: #1476ff; font-size: 20px; font-family: DengXian; "><font
                                style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;"></font></font><font id="check_income">
                                <?php
                                    $totalCheckin = \App\Models\Checkin::where('user_id', auth()->id())->sum('amount');
                              ?>
                                {{price($totalCheckin)}}
                            </font></div>
                        <div style="color: #6D6D6D; font-size: 12px;"><font style="vertical-align: inherit;"><font
                                    style="vertical-align: inherit;">Total Check-in</font></font></div>
                    </div>
                </div>
            </div>

            <div style="width:100%;position:relative; margin:0 auto; margin-top:30px;height:auto;overflow:hidden;border:0px;">
                <div id="checkin"
                     onclick="checkin()"
                     style="width: 70%; margin: 0 auto; text-align: center; height: 40px; line-height: 40px; color: #fff; border-radius: 100px; background: #c73544; ">
                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Confirm
                        </font></font></div>
            </div>
        </div>
    </div>
    <div style=" width:100%; margin-top:10px;  height: auto; overflow: hidden; ">
        <div style="color: #000; width: 70%; margin: 0 auto; margin-top: 25px; font-weight: bold; text-align: left; height: 30px; line-height: 30px; font-size: 14px; ">
            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Check-in rules
                </font></font></div>
        <div style="margin-top:10px; text-align:center; color:#999;width:100%; font-size:12px; ">
            <div style=" padding:10px; text-align:left; width: 70%; margin:0 auto; font-size: 12px; "><font
                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        1. Daily free gift worth {{price(setting('checkin'))}} </font></font><br><br><font style="vertical-align: inherit;"><font
                        style="vertical-align: inherit;">
                        2. You can check in once a day. </font></font><br><br><font style="vertical-align: inherit;"><font
                        style="vertical-align: inherit;">
                        3. After 24.00 every day, you can check in again.</font></font><br><br>
            </div>
        </div>
    </div>
</div>
@include('alert-message')
<img style="position: fixed;
    display: none;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;" src="{{asset('public/loading.gif')}}" class="loading" alt="">
<script>
    function checkin(){
        document.querySelector('.loading').style.display = 'block';
        window.location.href='{{route('user.checkin')}}'
    }
</script>

</body>
</html>
