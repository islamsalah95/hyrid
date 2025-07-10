<html>
<head>
    <meta charset="utf-8">
    <title>History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="{{asset('public')}}/Lay/css/layui.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/main.css" rel="stylesheet">
    <style type="text/css">
        .topname {
            line-height: 46px;
            font-weight: bold;
            font-size: 14px;
            width: 75%;
            text-align: center;
            color: #000;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
        }


        .typeitem {
            float: left;
            width: 50%;
            height: auto;
            overflow: hidden;
        }

        .over {
            border-bottom: 1px solid #000;
        }
        p.sposp {
            border: 1px solid #c73544;
            padding: 2px 12px;
            border-radius: 50px;
        }
    </style>

    <link id="layuicss-layer" rel="stylesheet" href="{{asset('public')}}/Lay/css/modules/layer/default/layer.css"
          media="all">
</head>
<body style="background-size: 100% auto; background: #fff;">
<div style="width: 100%; margin: 0 auto; background: #c73544; border-bottom: 0px solid #117546; " class="top">
    <div style="float:left; text-align:left; line-height:46px;width:50%;" id="btnClose" onclick="window.location.href='{{route('profile')}}'">
        <img style="margin-left: 15px;margin-top: 10px;" src="{{asset('public/icons8-chevron-left-30.png')}}" alt="">
    </div>
    <font class="topname" style="color: #fff;"><font style="vertical-align: inherit;"><font
                style="vertical-align: inherit;">
                Record withdrawal
            </font></font></font>
    <div style="float:right; text-align:right; line-height:46px;width:50%;">

    </div>
</div>
<div style=" max-width:450px; margin:0 auto;margin-top: 70px;">

    <div style="">
        <ul>
            @foreach(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
            <li style="    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 5px 10px;
    background: #c7354421;
    padding: 7px 16px;
    border-radius: 7px;">
                <div>
                    <h3 style="font-weight: bold">Withdraw</h3>
                    <p>{{$element->created_at}}</p>
                </div>
                <div>
                    <h3 style="font-weight: bold">{{price($element->amount)}}</h3>
                    <p class="sposp" style="text-transform: capitalize;">{{$element->status}}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
@if(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->count() < 1 )
        <div style=" width:100%;margin:0 auto; position:relative;" id="itemlist">
            <div style="padding:2px; width:100%; margin:0 auto; margin-top:50px;">
                <div style="border-radius: 5px; color:#fff; text-align:center; margin-top:35px;position:relative;"><img
                        src="{{asset('public')}}/imgs/no.png" style=" width:100%;"><br></div>
            </div>
            <div class="layui-flow-more">No More record</div>
        </div>
    @endif
</div>

</body>
</html>
