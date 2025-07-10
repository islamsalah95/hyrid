<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}-history</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
<style>
    .record_card {
        background: #40408f;
        box-shadow: 0px 0px 8px 1px #ffffff1a;
        padding: 8px 15px;
        border-radius: 8px;
        margin: 5px 0;
    }
    body {
        height: 100vh;
    }
</style>
<style>
    .menu-area{
        display: none;
    }
    .recharge {
        display: flex;
        align-items: center;
        justify-content: space-around;
        width: 100%;
    }
    .recharge h4 {
        background: transparent;
        font-weight: 500;
    }
    body {
        background: #60d333;
    }
    .recharge h4 {
        background: transparent;
        font-weight: 500;
        color: #fff;
    }
    div {
        color: #fff;
    }
    .payment_method li {
        border-bottom: 1px solid #000000cf;
    }

    .record_card {
        background: transparent;
        border: 1px solid #09c497;
    }
    img.notFound {
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }
</style>
@include('alert-message')
<div>
    <div class="aboutpage" data-v-00a2d0b3="">

        <div style="display: flex;justify-content: space-between;padding: 12px;">
            <div><img src="https://img.icons8.com/ios-glyphs/30/000000/chevron-left.png" style="width: 15px;" onclick="window.location.href='{{route('profile')}}'" alt=""></div>
            <div>Refer Commission History</div>
            <div></div>
        </div>

        @if(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'commission')->orderBydesc('id')->count() > 0)
            <div class="record_lit" style="width: 95%;margin: auto;">
                @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'commission')->orderBydesc('id')->get() as $element)
                    <div class="record_item" style="background: #30412a;padding: 15px;border-radius: 8px;margin-bottom: 10px;">
                        <div style="display: flex;justify-content: space-between; border-bottom: 2px solid #fff6;padding-bottom: 5px;">
                            <div style="color: #fff;font-size: 16px;display: flex;">
                                <img style="width:25px;margin-right: 9px;margin-top: -5px;" src="data:image/png;base64,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" alt="">
                                <span>Refer Commission ({{$element->step}})</span>
                            </div>

                            <div style="color: #fff;font-size: 15px;">
                                {{$element->created_at}}
                            </div>
                        </div>

                        <div style="display: flex;justify-content: space-between">
                            <h4 style="font-size: 18px;color: #ffd500;margin-top: 5px;font-weight: bold;margin-bottom: 2px;">+{{price($element->amount)}}</h4>
                            <p style="color: #fff;font-size: 16px;margin-top: 8px;margin-bottom: 0">
                                {{$element->perticulation}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center;margin-top: 50px;">
                <img src="{{asset('public/not.png')}}" class="notFound" alt="">
            </div>
        @endif
    </div>
</div>
</body>
</html>
