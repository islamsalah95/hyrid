<html xmlns="http://www.w3.org/1999/xhtml" style="font-size: 55.2px;">
<head><title>
        Earning
    </title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('public')}}/ui/css/common.css">
    <link rel="stylesheet" href="{{asset('public')}}/ui/css/signin.css">
    <link href="{{asset('public')}}/ui/css/swiper.min.css" rel="stylesheet">
    <link href="{{asset('public')}}/ui/css/lease.css" rel="stylesheet">
    <script src="{{asset('public')}}/ui/js/jquery-2.1.4.min.js"></script>
    <script src="{{asset('public')}}/ui/js/common.js"></script>
    <script src="{{asset('public')}}/ui/js/swiper.min.js"></script>
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

    <style>
        .mask-tips > div .text p {
            text-align: center;
            font-size: .24rem;
            line-height: .39rem;
            color: #ffffff;
            font-weight: 400;
            margin: 1px;
        }
    </style>

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

        .v_title {
            font-size: 12px;
            position: absolute;
            top: 0;
            right: 18px;
            border-bottom: none !important;
        }
        .lease .item>li {
            background: #fff;
            border-radius: .20rem;
            position: relative;
            margin-bottom: .2rem;
            list-style: none;
            box-shadow: 0px 5px 10px #0000001f;
            padding: 0 8px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('public')}}/basic.css">
</head>
<body style="visibility: visible;">
<form method="post" action="" id="form1">
    <div>
        <div class="lease wrap">
            <div class="navbar">
                <span></span>
                <span>{{env('APP_NAME')}}</span>
                <span></span>
            </div>

            <div style="width: 100%;height: 50px;"></div>
            @foreach(\App\Models\Package::whereIn('id', my_vips())->where('status', 'active')->get() as $key=>$element)
                <?php
                $myPackage = \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element->id)->where('status', 'active')->first();
                ?>
                <ul class="item" style=" padding: 0px; margin: 0px; position: relative;">
                    <li>
                        <div>
                            <div>
                                <img src="{{asset($element->photo)}}" alt="">
                            </div>
                            <div>
                                <h2>
                                    <div>{{$element->name}}</div>
                                    <div><span>{{$element->validity}} Days</span></div>
                                </h2>
                            </div>
                        </div>

                        <div class="v_title" style="font-size:10px;">Next Added Time: {{$myPackage->date}}</div>

                        <ul>
                            <li>
                                <h4>{{price($element->commission_with_avg_amount / $element->validity)}}</h4>
                                <p>Daily income</p>
                            </li>
                            <li>
                                <h4>{{price($element->commission_with_avg_amount)}}</h4>
                                <p>Total income</p>
                            </li>
                            <li>
                                <h4>{{price(($element->commission_with_avg_amount / $element->validity) * 30)}}</h4>
                                <p>Monthly Income</p>
                            </li>
                            <li>
                                <h4 class="active">{{price($element->price)}}</h4>
                                <p>Price</p>
                            </li>
                        </ul>
                        @if($myPackage)
                            <p style="background: #2f4d23;">Activate Product</p>
                        @else
                            <p onclick="window.location.href='{{route('purchase.confirmation', $element->id)}}'">Purchase Now</p>
                        @endif
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
    @include('alert-message')
    @include('app.layout.menu')
</form>

<script src="{{asset('public')}}/ui/js/owl.carousel.min.js"></script>
<script src="{{asset('public')}}/ui/js/jquery.magnific-popup.min.js"></script>
</body>
</html>
