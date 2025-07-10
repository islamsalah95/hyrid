<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public $route = 'admin.setting';
    public function index()
    {
        $data = Setting::find(1);
        return view('admin.pages.setting.index', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $model = Setting::findOrFail(1);
        $model->minimum_withdraw = $request->minimum_withdraw;
        $model->maximum_withdraw = $request->maximum_withdraw;
        $model->withdraw_charge = $request->withdraw_charge;
        $model->minimum_recharge = $request->minimum_recharge;

        $path = uploadImage(false ,$request, 'logo', 'upload/logo/', 200, 200 ,$model->logo);
        $model->logo = $path ?? $model->logo;

        $model->first_ref = $request->first_ref;
        $model->second_ref = $request->second_ref;
        $model->third_ref = $request->third_ref;

        $model->currency = $request->currency;
        $model->notice = $request->notice;

        $model->telegram = $request->telegram;
        $model->telegram_group = $request->telegram_group;
        $model->telegram_channel = $request->telegram_channel;
        $model->checkin = $request->checkin;

        $model->update();
        return redirect()->route($this->route.'.index')->with('success', 'Settings Updated Successfully.');
    }
}
