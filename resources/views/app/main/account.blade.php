<html xmlns="http://www.w3.org/1999/xhtml" style="font-size: 48.5333px;">
<head><title>
        Account Record
    </title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('public')}}/css/common.css">
    <link rel="stylesheet" href="{{asset('public')}}/css/signin.css">
    <link href="{{asset('public')}}/css/swiper.min.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/lease.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&amp;display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Prompt', sans-serif;
        }

        table, th, td {
            font-size: 12px !important;
            padding: 10px;
            border-top: 1px solid #eee;
        }

        table {
            width: 100%;
            padding: 16px 3px;
            text-align: center;
        }

        tbody {
            width: 100%;
            padding: 0px;
            margin: 0px;
            text-align: center;
        }

        input:focus {
            outline: none !important;
            border-color: #719ECE;
        }
    </style>

    <link href="{{asset('public')}}/css/Revenue.css" rel="stylesheet">

    <style>
        .kf {
            width: 1.1rem;
            height: 1.1rem;
            background: #FFFFFF;
            -webkit-box-shadow: 0px 0px 0.2rem rgb(0 0 0 / 10%);
            box-shadow: 0px 0px 0.2rem rgb(0 0 0 / 10%);
            border-radius: 50%;
            position: fixed;
            right: 0.3rem;
            top: 60%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            z-index: 29;
        }

        .kf i {
            width: 0.5rem;
            height: 0.5rem;
            background: url({{asset('public')}}/img/download.png) no-repeat;
            background-size: 0.5rem 0.5rem;
        }


        .boxs {
            background-image: linear-gradient(to bottom right, #60d333, #60d333);
            border-radius: 5px;
            padding: 10px;
            color: white;
            margin: 10px;

        }

        .desc {
            float: left;
            background: transparent;

        }

        .time {
            float: left;
            color: #fff;
            background: transparent;
        }

        .amo {
            float: right;
            color: #FF2100;
            background: transparent;
            margin-top: 15px;
        }
        .recharge-wrap {
            min-height: 100vh;
            background: #60d333;
            padding-top: 1rem;
        }
    </style>
    <link rel="stylesheet"
          href="data:text/css;base64,Ym9keXsKICAgICAgICBmb250LWZhbWlseTogJ1JvYm90bycsIHNhbnMtc2VyaWY7CiAgICAgICAgYmFja2dyb3VuZDojZWVlZGVlOwogICAgfQogICAgLmJveHsKICAgIGJhY2tncm91bmQ6d2hpdGU7CiAgICBtYXJnaW46MTBweDsKICAgIGJveC1zaGFkb3c6MHB4IDBweCA2cHggZ3JleTsKICAgIGJvcmRlci1yYWRpdXM6MTBweDsKICAgIHBhZGRpbmc6MTJweDsKY29sb3I6I2ExYTFhMTsKZm9udC1zaXplOjE2cHg7CmxpbmUtaGVpZ2h0OjIwMCU7CmZvbnQtd2VpZ2h0OmJvbGQ7Cgp9Ci5oZWFkZXJ7CiAgICBiYWNrZ3JvdW5kOiMyZjk4ZmY7CiAgICBwYWRkaW5nOjEwcHg7CiAgICBwb3NpdGlvbjpmaXhlZDsKICAgIHRvcDowOwogICAgbGVmdDowOwogICAgd2lkdGg6MTAwJTsKICAgIGNvbG9yOndoaXRlOwogICAgZm9udC13ZWlnaHQ6OTAwOwogICAgdGV4dC1hbGlnbjpjZW50ZXI7CiAgICBmb250LXNpemU6MTdweDsKfQouaGVhZGVyIGl7CiAgICBmbG9hdDpsZWZ0Owp9Ci5oZWFkZXIgc3BhbnsKICAgcG9zaXRpb246YWJzb2x1dGU7CiAgIHJpZ2h0OjI1cHg7CiAgIG1hcmdpbi10b3A6LTIwcHg7CiAgIGZvbnQtd2VpZ2h0OjEwMDsKICAgZm9udC1zaXplOjE1cHg7Cn0KLmFtb3BsdXN7CiAgICBmb250LXdlaWdodDoxMDA7CiAgICBjb2xvcjojMDhmZjgzOwogICAgZm9udC1zaXplOjI0cHg7CiAgICBmbG9hdDpyaWdodDsKICAgIG1hcmdpbi10b3A6MTBweDsKICAgIG1hcmdpbi1yaWdodDoxMHB4Owp9Ci5hbW9taW51c3sKICAgIGZvbnQtd2VpZ2h0OjEwMDsKICAgIGNvbG9yOnJlZDsKICAgIGZvbnQtc2l6ZToyNHB4OwogICAgZmxvYXQ6cmlnaHQ7CiAgICBtYXJnaW4tdG9wOjEwcHg7CiAgICBtYXJnaW4tcmlnaHQ6MTBweDsKfQ==">
</head>
<body style="visibility: visible;">
<form method="get" action="" id="form1">
    <div>
        <div class="recharge-wrap">
            <div class="navbar">
				<span onclick="onBack()">
					<i></i>
				</span>
                <span>Account Statment</span>
                <span>
				</span>
            </div>
            <p class="tips">
                Here You Get All Information About Your Account. For Example: Investment, Recharge, Withdraw, Investment
                Earning.
            </p>
            <div class="box">
                <table class=" head2" id="BindTableTeam">
                </table>
                <div class="boxs">
                    <span class="amo">+upcomming...</span> <span class="desc">Register Reward</span><br><span class="time">{{auth()->user()->created_at}}</span><br>
                </div>
            </div>
        </div>
        <div style="padding:30px"></div>

        @include('app.layout.menu')


    </div>
</form>
</body>
</html>
