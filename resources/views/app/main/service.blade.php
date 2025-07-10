<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="{{asset('public')}}/Lay/css/layui.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/main.css" rel="stylesheet">
    <style type="text/css">
        .topname {
            line-height: 46px;
            font-size: 14px;
            width: 75%;
            text-align: center;
            color: #fff;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
            font-weight: bold;
        }

        div {
            cursor: pointer;
        }

        .typeitem {
            color: #888;
            float: left;
            margin-left: 3%;
            cursor: pointer;
            font-family: 黑体;
            font-size: 13px;
            margin-top: 10px;
            margin-bottom: 2px;
        }

        .typeitemover {
            margin-top: 10px;
            color: #085efa;
            border-bottom: 1px solid #085efa;
            margin-bottom: 1px;
            float: left;
            margin-left: 3%;
            cursor: pointer;
            font-family: 黑体;
            font-size: 13px;
        }
    </style>
</head>
<body style="background-size: 100% auto; background: #f1f1f1;">
<div style="width: 100%; margin: 0 auto; background: #c73544; border-bottom: 0px solid #117546; " class="top">
    <div style="float:left; text-align:left; line-height:46px;width:50%;" id="btnClose">
        <img onclick="window.location.href='{{route('dashboard')}}'"
             style="width: 20px;margin-left: 10px;margin-top: 15px;" src="{{asset('public/left.png')}}" alt="">
    </div>
    <font class="topname" style="color: #fff"><font style="vertical-align: inherit;"><font
                style="vertical-align: inherit;">
                Customer service
            </font></font></font>
    <div style="float:right; text-align:right; line-height:46px;width:50%;">

    </div>
</div>
<div style=" max-width:450px; margin:0 auto;">
    <div
        style="width: 100%; margin: 0 auto; text-align: center; margin-top: 50px; position: relative; height: auto; overflow: hidden; ">
        <img src="{{asset('public')}}/ui3/css.png" style=" width:100%;">
    </div>
    <div
        style="width: 100%; margin: 0 auto; background: #fff; height: 55px; margin-top: 10px; line-height: 55px;  height: auto; overflow: hidden;display: flex;align-items: center;"
        onclick="window.location.href='{{setting('telegram')}}'"
        id="btn1">
        <div style="float:left;width:25%; text-align:center;">
            <img src="{{asset('public')}}/ui1/kf/3.png" style="height:35px;">
        </div>
        <div style="float:left;width:65%;"><font style="vertical-align: inherit;"><font
                    style="vertical-align: inherit;">Telegram</font></font></div>
        <div style="float:left;width:10%;">
            <img src="{{asset('public')}}/ui/jt.png" style="height:20px;">
        </div>
    </div>

    <div
        style="width: 100%; margin: 0 auto; background: #fff; height: 55px; margin-top: 10px; line-height: 55px;  height: auto; overflow: hidden;display: flex;align-items: center;"
        onclick="window.location.href='{{setting('telegram_channel')}}'"
        id="btn3">
        <div style="float:left;width:25%; text-align:center;">
            <img src="{{asset('public')}}/ui1/kf/3.png" style="height:35px;">
        </div>
        <div style="float:left;width:65%;"><font style="vertical-align: inherit;"><font
                    style="vertical-align: inherit;">Telegram channel</font></font></div>
        <div style="float:left;width:10%;">
            <img src="{{asset('public')}}/ui/jt.png" style="height:20px;">
        </div>
    </div>

    <div
        style="width: 100%; margin: 0 auto; background: #fff; height: 55px; margin-top: 10px; line-height: 55px; height: auto; overflow: hidden;display: flex;align-items: center;"
        onclick="window.location.href='{{setting('telegram_group')}}'"
        id="btn4">
        <div style="float:left;width:25%; text-align:center;">
            <img src="{{asset('public')}}/ui1/kf/3.png" style="height:35px;">
        </div>
        <div style="float:left;width:65%;"><font style="vertical-align: inherit;"><font
                    style="vertical-align: inherit;">Telegram group</font></font></div>
        <div style="float:left;width:10%;">
            <img src="{{asset('public')}}/ui/jt.png" style="height:20px;">
        </div>
    </div>

    <div
        style="width: 100%; margin: 0 auto; background: #fff; height: 55px; margin-top: 10px; line-height: 55px; display:none; "
        id="btn5">
        <div style="float:left;width:25%; text-align:center;">
            <img src="{{asset('public')}}/ui1/kf/2.png" style="height:35px;">
        </div>
        <div style="float:left;width:65%;"><font style="vertical-align: inherit;"><font
                    style="vertical-align: inherit;">WhatsApp group</font></font></div>
        <div style="float:left;width:10%;">
            <img src="{{asset('public')}}/ui/jt.png" style="height:20px;">
        </div>
    </div>

    <div
        style="width: 100%; margin: 0 auto; background: #fff; height: auto; overflow: hidden; margin-top: 10px; margin-bottom:15px; ">
        <div
            style="padding: 15px; color: #272727; font-size: 20px; font-family: DengXian; padding-bottom: 5px; text-align: center; "
            id="kefutime">9:00-20:30
        </div>
        <div
            style="padding: 10px; color: #272727; padding-top: 0px; font-size: 14px; text-align: center; font-family: DengXian; ">
            <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Customer service time online
                </font></font></div>
        <div style="padding:25px; color:#000; padding-top:0px; font-size:12px; text-align:left; " id="kfinfo"><p
                class="p1"
                style="margin-top: 0px; margin-bottom: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 13px; line-height: normal; ">
            <span class="s1"
                  style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; line-height: normal;"></span>
            </p>
            <p class="p1"
               style="margin-top: 0px; margin-bottom: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 13px; line-height: normal; ">
                1. If you have any questions about us, please contact the customer service via the Internet and we will
                answer all your questions.
            </p>
            <br>
            <p class="p1"
               style="margin-top: 0px; margin-bottom: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 13px; line-height: normal; ">
                2. If you didn't respond to the online customer service at the right time, please wait patiently. This
                is because there are many messages. You will work as an online freelancer based on your connections to a worker who has lost a job in a job .
                Thank you for understanding and support!
            </p>
            <p class="p1"
               style="margin-top: 0px; margin-bottom: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 13px; line-height: normal; ">
                <span class="s1"
                      style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; line-height: normal;"></span><br>
            </p>
            <p><br></p></div>

    </div>
</div>
</body>
</html>
