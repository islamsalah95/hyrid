<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('static/index/v1/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('static/index/v1/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('static/index/v1/css/swiper/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/index/v1/css/details.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/loading.css') }}">
</head>

<body>
    <div class="centeritem">
        <div class="flex_be">
            <div>
                <img class="logoimg" src="{{ asset('profelar/profelar_logo.png') }}" alt="">
                <p class="userid">ID {{auth()->user()->phone}}</p>
            </div>
            <div class="flex1">
                <div class="flex_re">
                    <p class="balance">Balance</p>
                    <img class="coin" src="{{ asset('profelar/profelar_pay.png') }}" alt="">
                </div>
                <span class="userbalance">{{price(auth()->user()->balance)}}</span>
            </div>
        </div>

        <!-- Swiper for banners -->
        <div class="swiper banner">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    
                    @foreach(\App\Models\VipSlider::get() as $element)
                    <img src="{{asset($element->photo)}}"  alt="">
                </div>@endforeach
               <!-- <div class="swiper-slide">
                    <img src="/uploads/material/20240517/8ee457aac5f99510220045e134d431d2.png" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="/uploads/material/20240517/2b4fc8cea6a96a61441581f79f3dc745.png" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="/uploads/material/20240517/81a4b6c26c9904590cdebc814aa2476e.png" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="/uploads/material/20240517/8ee457aac5f99510220045e134d431d2.png" alt="Banner Image 3">
                </div>-->
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="flex_be">
            <a href="{{url('user/recharge')}}" class="service">
                <img src="{{ asset('profelar/profelar_pay.png') }}" alt="">
                <p class="marigntop1"> Recharge </p>
            </a>
            <a class="service" href="{{ url('money/withdraw.html') }}">
                <img src="{{ asset('ui3/wi.jpg') }}" alt="">
                <p class="marigntop1">Withdraw</p>
            </a>
            <a class="referral" href="{{ url('share/share.html') }}">
                <div class="flex_sta">
                    <div class="referralimg">
                        <img src="{{ asset('profelar/profelar_ref.png') }}" alt="">
                    </div>
                    <p>Referral <br> Program</p>
                </div>
            </a>
        </div>

        <div class="flex_sta title">
            <img src="{{ asset('uploads/material/titleicon.png') }}" alt="">
            <h4>Product</h4>
        </div>

        <ul class="productlist">
            @foreach(\App\Models\Package::where('status', 'active')->get() as $element)
            <li>
                <div class="flex_be listname">
                    <img src="{{ asset('profelar/profelar_logo.png') }}" alt="">
                    <p> {{$element->name}} </p>
                </div>
                <img class="productimg" src="{{asset($element->photo)}}" alt="">
                <div class="flex_be">
                    <div class="leftbox">
                        <p>Price</p>
                        <span> {{price($element->price)}} </span>
                        <p>Daily Revenue</p>
                        <div class="flex_sta">
                            <span>28%</span>
                            <p class="marginlr">|</p>
                            <span> {{price($element->commission_with_avg_amount / $element->validity)}} </span>
                        </div>
                        <a class="details" onclick="window.location.href='{{route('package.details', $element->id)}}'">Detail</a>
                    </div>
                    <div class="leftbox">
                        <p>Duration</p>
                        <span> {{$element->validity}} <a>days</a></span>
                        <p>Total Revenue</p>
                        <div class="flex_sta">
                            <span>840%</span>
                            <p class="marginlr">|</p>
                            <span> {{price($element->commission_with_avg_amount )}} </span>
                        </div>
                        <a class="buy" onclick="window.location.href='{{route('purchase.confirmation', $element->id)}}'">Buy</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="coverbg"></div>
    <div class="payment">
        <div class="topbar"></div>
        <div class="flex_cen">
            <img class="icons" src="{{ asset('uploads/material/coins.png') }}" alt="">
            <h3>Payment Amount</h3>
        </div>
        <h2 class="product-money"></h2>
        <div class="linebar"></div>
        <div class="flex_sta title">
            <img src="{{ asset('profelar/profelar_pay.png') }}" alt="">
            <h4>Please select payment method</h4>
        </div>
        <ul class="flex_be">
            <li class="getway flex_be active" data-type="1" data-platform="QePay">
                <p>Gateway 1</p>
                <div class="point">
                    <div class="inner"></div>
                </div>
            </li>
            <li class="getway flex_be" data-type="1" data-platform="AkPay">
                <p>Gateway 2</p>
                <div class="point">
                    <div class="inner"></div>
                </div>
            </li>
        </ul>
        <div class="paybtn buyBtn">Buy</div>
    </div>
    @include('alert-message')
    @include('app.layout.menu')

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript">
        // Swiper for banners
        var swiper = new Swiper(".banner", {
            loop: true,
            speed: 600,
            effect: "fade",
            grabCursor: true,
            parallax: true,
            autoplay: {
                delay: 3000,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        // Display the welcome notice modal on page load
        window.onload = function () {
            let notice = document.querySelector(".welcome-notice");
            if (notice) {
                notice.classList.remove("hide");
            }
        };

        // Close the welcome notice when "Got It!" is clicked
        let closeNotice = document.getElementById("closeNotice");
        if (closeNotice) {
            closeNotice.addEventListener("click", function () {
                document.querySelector(".welcome-notice").classList.add("hide");
            });
        }
    </script>

</body>

</html>