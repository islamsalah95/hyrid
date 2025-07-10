@extends('app.layout.app')
@section('app_content')
    <style>
        .pop_body div {
            background: #40408f;
        }
        .bank_form .custom_input {
            color: #fff;
        }
        .bank_form label {
            color: #fff;
        }
        .bank_form .custom_input:focus {
            background: transparent;
        }
        .invition-chain button {
            background: #2e2e67;
            border: none;
            color: #fff;
            border-radius: 5px;
            text-transform: capitalize;
        }
        .pop_body h4 {
            color: #fff !important;
        }
    </style>
    <div class="mypage-section">
        <div class="container">
            <div style="display: flex;justify-content: space-between;align-items: center;color: #fff;padding: 12px;">
                <div><i class="fa fa-chevron-left"></i></div>
                <div style="font-weight: bold;font-size: 20px;">Mobile Recharge</div>
                <div></div>
            </div>

            <link rel="stylesheet" href="{{asset('public/assets/loading.css')}}">
            <div class="loader_boss" style="display: none">
                <svg class="spinner">
                    <img style="width: 100%;
    position: absolute;
    top: -37px;
    left: 0px;" src="{{asset('public/l1.gif')}}">
                </svg>
            </div>

            <div style="margin-top: 20px;">
                <form action="{{route('mobile.recharge.submit')}}" method="post" class="bank_form">
                    @csrf
                    <div class="form-group">
                        <label for="operator">Recharge Operator</label>
                        <input type="text" name="operator" class="custom_input" id="operator" onclick="openPop()" required value="">
                    </div>
                    <div class="form-group">
                        <label for="number">Recharge Number</label>
                        <input type="text" name="number" class="custom_input" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="number">Recharge Amount</label>
                        <input type="text" name="amount" class="custom_input" value="50" required>
                    </div>

                    <div class="form-group invition-chain">
                        <button type="button" onclick="bankUpdate()">Recharge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .pop_body div {
            background: #000;
            padding: 15px;
            height: 80px;
            width: 81px;
            border-radius: 12px;
            text-align: center;
        }
        .pop_body h4 {
            color: #fff !important;
            font-size: 9px;
        }
    </style>
    <div class="pop" style="z-index: -1;">
        <div class="pop_container">
            <div class="pop_header">
                <div onclick="closePop()">Cancel</div>
                <div style="color: #2e2e67 !important;">Done</div>
            </div>

            <div class="pop_body">
                <div onclick="getBank('banglalink')">
                    <h4>Banglalink</h4>
                </div>
                <div onclick="getBank('graminphone')">
                    <h4>Graminphone</h4>
                </div>
                <div onclick="getBank('airtel')">
                    <h4>Airtel</h4>
                </div>
                <div onclick="getBank('airtel')">
                    <h4>Robi</h4>
                </div>
            </div>
        </div>
    </div>


    <script>
        function bankUpdate()
        {
            document.querySelector('.loader_boss').style.display='block';
            document.querySelector('.bank_form').submit();
        }

        function openPop(){
            document.querySelector('.pop').style.zIndex = '1';
            document.querySelector('.pop_container').classList.add('show_pop');
        }
        function closePop(){
            document.querySelector('.pop_container').classList.remove('show_pop');

            setTimeout(function (){
                document.querySelector('.pop').style.zIndex = '-1';
            },400)
        }

        function getBank(bank){
            document.getElementById('operator').value = bank;
            closePop()
        }
    </script>
@endsection

