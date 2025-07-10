 <html lang="bn"
      style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;"
      class="translated-ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="{{asset('static/index/v1/css/index.css')}}">
    <title>TopUp</title>
    <link rel="stylesheet" href="{{asset('d.css')}}">
    <style>
        .w199[data-v-60ee4dfc] {
            width: 31% !important;
        }

        input:focus-visible {
            outline: none;
            border: none;
        }

        .active {
            background: rgb(17, 194, 217) !important;
            color: rgb(255, 255, 255) !important;
        }

        select#channel {
            height: 63px;
        }
    </style>
</head>
<body class="uni-body pagesIndex-recharge">
<uni-app class="uni-app--maxwidth">
    <uni-page data-page="pagesIndex/recharge">
        <uni-page-head uni-page-head-type="default">
            <div class="uni-page-head" style="background-color: rgb(243, 243, 243); color: rgb(0, 0, 0);">
                <div class="uni-page-head-hd" onclick="window.location.href='{{route('dashboard')}}'">
                    <div class="uni-page-head-btn"><i class="uni-btn-icon"
                                                      style="color: rgb(0, 0, 0); font-size: 27px;"><font
                                style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></i>
                    </div>
                    <div class="uni-page-head-ft"></div>
                </div>
                <div class="uni-page-head-bd">
                    <div class="uni-page-head__title" style="font-size: 16px; opacity: 1;"><font
                            style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Recharge</font></font></div>
                </div>
                <div class="uni-page-head-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </uni-page-head>
        <uni-page-wrapper>
            <uni-page-body>
                <uni-view data-v-60ee4dfc="" class="content">
                    <uni-view data-v-60ee4dfc="" class="bgf bdr16 p30 mb30">
                        <uni-view data-v-60ee4dfc="" class="fs32 c3 bold mb30"><font
                                style="vertical-align: inherit;"><font style="vertical-align: inherit;">Recharge
                                Amount</font></font></uni-view>
                        <uni-view data-v-60ee4dfc="" class="flex gap16 wrap">
                            <uni-view data-v-60ee4dfc="" onclick="getAmount(this, 15)"
                                      class="amountItem w199 h84 center bdr8 be fs32 c6"><font
                                    style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">15</font></font></uni-view>
                            <uni-view data-v-60ee4dfc="" onclick="getAmount(this, 30)"
                                      class="amountItem w199 h84 center bdr8 be fs32 c6"><font
                                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">30</font></font>
                            </uni-view>
                            <uni-view data-v-60ee4dfc="" onclick="getAmount(this, 80)"
                                      class="amountItem w199 h84 center bdr8 be fs32 c6"><font
                                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">80</font></font>
                            </uni-view>
                            <uni-view data-v-60ee4dfc="" onclick="getAmount(this, 200)"
                                      class="amountItem w199 h84 center bdr8 be fs32 c6"><font
                                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">200</font></font>
                            </uni-view>
                            <uni-view data-v-60ee4dfc="" onclick="getAmount(this, 500)"
                                      class="amountItem w199 h84 center bdr8 be fs32 c6"><font
                                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">500</font></font>
                            </uni-view>
                            <uni-view data-v-60ee4dfc="" onclick="getAmount(this, 1500)"
                                      class="amountItem w199 h84 center bdr8 be fs32 c6"><font
                                    style="vertical-align: inherit;"><font style="vertical-align: inherit;">1500</font></font>
                            </uni-view>
                            <br>
                            <uni-view data-v-60ee4dfc="" class="w199 h84 center bdr8 be fs32 c6"
                                      style="width: 100% !important;">

                                <input type="number" id="amount" style="width: 100%;padding: 8px 10px;border: none;"
                                       placeholder="Enter recharge amount" name="amount">
                            </uni-view>
                        </uni-view>

                        <select name="payment_method" id="channel" class="uni-input-input">
                            @foreach(\App\Models\PaymentMethod::get() as $el)
                                <option value="{{ $el->name }}">{{ $el->name }}</option>
                            @endforeach
                        </select>
                    </uni-view>

                    <uni-view data-v-60ee4dfc="" class="bg11 h92 cf fs32 bold center mb40" onclick="goPayment()"><font
                            style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Continue</font></font>
                    </uni-view>
                </uni-view>
                <uni-toast data-duration="100000000" class="loading" style="display: none;">
                    <div class="uni-toast"><i class="uni-icon_toast uni-loading"></i>
                        <p class="uni-toast__content"> Loading... </p></div>
                </uni-toast>
            </uni-page-body>
        </uni-page-wrapper>
    </uni-page>
</uni-app>
@include('app.layout.menu')
@include('alert-message')
<script>
    function getAmount(_this, amount) {
        document.querySelector('input[name="amount"]').value = amount;

        var elements = document.querySelectorAll('.item')
        for (let i = 0; i < elements.length; i++) {
            if (elements[i].querySelector('div').classList.contains('active')) {
                elements[i].querySelector('div').classList.remove('active')
            }
        }
        _this.querySelector('div').classList.add('active')
    }

    function goPayment(){
        var amount = document.getElementById('amount').value;  // Accessing the input by its ID
        var methods = document.querySelector('select[name="payment_method"]').value;

        if (methods == ''){
            message("Select payment channel");
            return 0;
        }
        if (amount == ''){
            message("Enter recharge amount");
            return 0;
        }

        window.location.href='{{url('user/payment')}}'+"/"+amount+"/"+methods
    }
</script>
</body>
</html>
