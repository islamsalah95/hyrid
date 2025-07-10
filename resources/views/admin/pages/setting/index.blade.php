@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.setting.insert')}}" method="POST" enctype="multipart/form-data">@csrf
                    <input type="hidden" name="id" value="{{$data ? $data->id : ''}}">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div>{{$data ? 'Update' : 'Create New'}} Settings</div>
                                </div>
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <fieldset class="form-group">
                                                    <label for="basicInputFile">Upload Logo <small>{Suggestion:
                                                            size 200X200(px)}</small> </label>
                                                    <div class="custom-file">
                                                        <input type="file" name="logo"
                                                               class="custom-file-input is-valid" id="inputGroupFile01"
                                                               @if(!$data) required
                                                               @else @endif onchange="showPreview(event)">
                                                        <label class="custom-file-label" for="inputGroupFile01">Choose
                                                            file</label>
                                                        <div class="valid-feedback">
                                                            <i class="bx bx-radio-circle"></i>
                                                            Note: Package image mandatory
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="image_preview">
                                                    <img
                                                        src="{{$data ? asset(view_image($data->logo)) :  asset(not_found_img())}}"
                                                        id="file-ip-1-preview" class="rounded" alt="Preview Image"
                                                        style="width: 100px;height: 100px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="minimum_withdraw">minimum withdraw</label>
                                        <input type="text" class="form-control is-valid"
                                               name="minimum_withdraw" id="minimum_withdraw"
                                               placeholder="minimum_withdraw"
                                               value="{{$data ? $data->minimum_withdraw : old('minimum_withdraw')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="maximum_withdraw">maximum withdraw</label>
                                        <input type="text" class="form-control is-valid"
                                               name="maximum_withdraw" id="maximum_withdraw"
                                               placeholder="minimum_withdraw"
                                               value="{{$data ? $data->maximum_withdraw : old('maximum_withdraw')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="withdraw_charge">withdraw charge(%)</label>
                                        <input type="text" class="form-control is-valid"
                                               name="withdraw_charge" id="minimum_withdraw"
                                               placeholder="10%"
                                               value="{{$data ? $data->withdraw_charge : old('withdraw_charge')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="minimum_recharge">Minimum recharge</label>
                                        <input type="text" class="form-control is-valid"
                                               name="minimum_recharge" id="minimum_recharge"
                                               placeholder=""
                                               required
                                               value="{{$data ? $data->minimum_recharge : old('minimum_recharge')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="checkin">Checkin</label>
                                        <input type="text" class="form-control is-valid"
                                               name="checkin" id="checkin"
                                               placeholder=""
                                               required
                                               value="{{$data ? $data->checkin : old('checkin')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="first_ref">First refer commission(%)</label>
                                        <input type="text" class="form-control is-valid"
                                               name="first_ref" id="first_ref"
                                               placeholder="%"
                                               required
                                               value="{{$data ? $data->first_ref : old('first_ref')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="second_ref">Second refer commission(%)</label>
                                        <input type="text" class="form-control is-valid"
                                               name="second_ref" id="second_ref"
                                               placeholder="%"
                                               required
                                               value="{{$data ? $data->second_ref : old('second_ref')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="third_ref">Third refer commission(%)</label>
                                        <input type="text" class="form-control is-valid"
                                               name="third_ref" id="third_ref"
                                               placeholder="%"
                                               required
                                               value="{{$data ? $data->third_ref : old('third_ref')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="currency">Currency sign</label>
                                        <input type="text" class="form-control is-valid"
                                               name="currency" id="currency"
                                               required
                                               placeholder="%"
                                               value="{{$data ? $data->currency : old('currency')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="notice">Notice</label>
                                        <input type="text" class="form-control is-valid"
                                               name="notice" id="notice"
                                               required
                                               placeholder=""
                                               value="{{$data ? $data->notice : old('notice')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <label for="telegram">Telegram</label>
                                        <input type="text" class="form-control is-valid"
                                               name="telegram" id="telegram"
                                               placeholder="Telegram Link"
                                               value="{{$data ? $data->telegram : old('telegram')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="telegram_group">Telegram group</label>
                                        <input type="text" class="form-control is-valid"
                                               name="telegram_group" id="telegram_group"
                                               placeholder="Telegram Link"
                                               value="{{$data ? $data->telegram_group : old('telegram_group')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="telegram_channel">Telegram channel</label>
                                        <input type="text" class="form-control is-valid"
                                               name="telegram" id="telegram_channel"
                                               placeholder="Telegram Link"
                                               value="{{$data ? $data->telegram_channel : old('telegram_channel')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Submit Button -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div style="margin-top: .7rem !important">
                                        Submit Your Setting Information
                                    </div>
                                    <div>
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bx bx-plus"></i>{{$data ? 'Update' : 'Submit'}} </button>
                                        </div>
                                    </div>
                                </div>
                            </h6>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreviewFavicon(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("favicon");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
