<html>
<head>
    <meta charset="utf-8">
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="{{asset('public')}}/Lay/css/layui.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/pass.css')}}">
</head>
<body style="background-size: 100% auto; background: #f1f1f1;">
<div style="display: flex;justify-content: space-between;align-items: center;background: #c73544;padding-bottom: 11px;">
    <div>
        <img onclick="window.location.href='{{route('dashboard')}}'" style="width: 20px;margin-left: 10px;margin-top: 10px;" src="{{asset('public/left.png')}}" alt="">
    </div>
    <div style="margin-top: 10px;">Change Password</div>
    <div></div>
</div>
<form action="{{route('user.change.password')}}" method="post">
    @csrf
    <div style=" max-width:450px; margin:0 auto;  ">
        <div class="layui-form layui-tab-content" style="padding:5px 10px; margin-top:50px;">
            <div class="layui-form layui-tab-content" style="padding: 10px 0;">
                <form class="layui-form">
                    <div class="layui-form layui-form-pane">
                        <div class="layui-form-item layui-form-text">
                            <div class="layui-input-block" style="">
                                <div style="margin: 10px; line-height:20px; color:#808080;   margin-top:0px;">
                                    <br>
                                    <div class="layui-form layui-form-pane">
                                        <div class="layui-form-item" style="height:48px;">
                                            <div class="inputdiv">
                                                <img style="width: 20px;height: 20px;margin-top: 7px;"
                                                     src="https://img.icons8.com/ios-glyphs/30/password--v1.png" alt="">
                                                <input type="password" id="oldpassword" maxlength="20"
                                                       name="current_password"
                                                       placeholder="Old password to log in" class="layui-input"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="layui-form-item" style="height:48px;">
                                            <div class="inputdiv">
                                                <img style="width: 20px;height: 20px;margin-top: 7px;"
                                                     src="https://img.icons8.com/ios-glyphs/30/password--v1.png" alt="">
                                                <input type="password" id="password1" maxlength="20"
                                                       name="new_password"
                                                       placeholder="New login password" class="layui-input"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="layui-form-item" style="height:48px;">
                                            <div class="inputdiv">
                                                <img style="width: 20px;height: 20px;margin-top: 7px;"
                                                     src="https://img.icons8.com/ios-glyphs/30/password--v1.png" alt="">
                                                <input type="password" id="password2" maxlength="20"
                                                       name="confirm_password"
                                                       placeholder="New login password" class="layui-input"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="layui-form-item" style="height:48px;">
                                            <font style="vertical-align: inherit;"><font
                                                    style="vertical-align: inherit;"><input class="layui-btn"
                                                                                            id="confirm"
                                                                                            value="Confirm changes"
                                                                                            style="width: 100%; border: 0px; color: #fff; background: #c73544; height: 45px; line-height: 45px; border-radius: 25px; "
                                                                                            onclick="submitPassword()"
                                                                                            type="button"></font></font>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
@include('alert-message')
<img style="position: fixed;
    display: none;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;" src="{{asset('public/loading.gif')}}" class="loading" alt="">
<script>
    function submitPassword() {
        document.querySelector('.loading').style.display = 'block';
        document.querySelector('form').submit();
    }
</script>

</body>
</html>
