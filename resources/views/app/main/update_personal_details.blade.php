<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="google" content="notranslate">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{asset('public')}}/h5/assets/37EV4dkYCo2aa8fbf3.css">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="{{asset('public')}}/h5/assets/9rtp3LPZM073134c2c.css">
    <link rel="stylesheet" href="{{asset('public')}}/h5/assets/xNrjMIpshIcf1599ad.css">
    <link rel="stylesheet" href="{{asset('public')}}/h5/assets/UXfmfjOs0t26b32348.css">
    <link rel="stylesheet" href="{{asset('public')}}/h5/assets/ghrRqmgXVOfead4154.css">
    <link rel="stylesheet" href="{{asset('public')}}/h5/assets/qK5wr7LV3jb190a2cb.css">
    <link rel="stylesheet" href="{{asset('public')}}/h5/assets/p2FQ6oerIu7f8faf3d.css">
    <link rel="stylesheet" href="{{asset('public')}}/h5/assets/E9fDjMIPlB79473880.css">
    <style>
        :root {
            --primary: #09c497;
        }

        #app {
            background: #237cd7;
        }

        .checker {
            width: 62%;
            position: absolute;
            left: 0;
            z-index: 22;
            top: 0;
        }
    </style>
</head>
<body class="">

<div id="app" data-v-app="" class="a-t-1 no-1">
    <div class="van-config-provider">
        <div data-v-13c60ef2="" class="box-border min-h-full w-full pt-45px"><!---->
            <div data-v-be21edee="" data-v-13c60ef2="" class="navigation" style="">
                <div data-v-be21edee="" class="navigation-content">
                    <div data-v-be21edee="" class="h-full flex cursor-pointer items-center justify-between">
                        <div data-v-be21edee="" onclick="window.location.href='{{route('my.profile')}}'"
                             class="icon i-material-symbols-arrow-back-ios-new-rounded"></div>
                        <div data-v-be21edee="">Update profile</div>
                        <div data-v-be21edee="" class="opacity-0"> h</div>
                    </div>
                </div>
            </div><!---->
            <form action="{{route('setup.gateway.submit')}}" method="post"> @csrf
                <div data-v-8a7ff68f="" class="withdraw-wrap p-$mg">
                    <div data-v-8a7ff68f="" class=":uno: container-card relative rd-$card-radius p-$mg c-$btn-text">
                        <div data-v-8a7ff68f="" class="base-input is-number">
                            <div class="input-box">
                                <div class="input-left-slot"></div>
                                <input type="text" placeholder="Enter realname" value="{{auth()->user()->name}}" class="w-full" required name="name">
                                <div class="input-right-slot"></div>
                            </div>
                        </div>

                        <div data-v-8a7ff68f="" class="base-input is-number">
                            <div class="input-box">
                                <div class="input-left-slot"></div>
                                <input type="text" placeholder="Enter realname" value="{{auth()->user()->name}}" class="w-full" required name="name">
                                <div class="input-right-slot"></div>
                            </div>
                        </div>

                        <div data-v-8a7ff68f="" class="base-input is-number">
                            <div class="input-box">
                                <div class="input-left-slot"></div>
                                <input type="text" placeholder="Enter realname" value="{{auth()->user()->name}}" class="w-full" required name="name">
                                <div class="input-right-slot"></div>
                            </div>
                        </div>


                        <a onclick="submitBank()" data-v-8a7ff68f="" class=":uno: base-main-btn flex items-center justify-center" style="margin-top: 20px;">
                            <div class="base-main-btn-content">
                                <span data-v-8a7ff68f="">Confirm</span>
                            </div>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('alert-message')
</body>
</html>
