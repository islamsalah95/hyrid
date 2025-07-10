<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Deposit;
use App\Models\UserLedger;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller
{
    public function withdraw()
    {
        if (Auth::user()->gateway_name == null && Auth::user()->gateway_number == null) {
            return redirect()->route('user.card');
        }
        return view('app.main.withdraw.index');
    }

    public function usdt_withdraw()
    {
        return view('app.main.withdraw.usdt');
    }

    public function withdrawConfirmSubmit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'amount' => 'required|numeric'
        ]);
        if ($request->amount == '' || $request->amount < 1) {
            return back()->with('error', 'Withdraw Amount required.');
        }

        if (Auth::user()->gateway_name == null && Auth::user()->gateway_number == null) {
            return back()->with('success', 'Please setup your bank');
        }

        $minimum_withdraw = setting('minimum_withdraw');
        $maximum_withdraw = setting('maximum_withdraw');
        $withdraw_charge = setting('withdraw_charge');

        $user = Auth::user();

        if ($request->amount <= $user->balance) {
            if ($request->amount >= $minimum_withdraw) {
                if ($request->amount <= $maximum_withdraw) {
                    $charge = 0;
                    if ($withdraw_charge > 0) {
                        $charge = ($request->amount * $withdraw_charge) / 100;
                    }

                    //Update User Balance
                    $balance = $user->balance - $request->amount;
                    User::where('id', $user->id)->update([
                        'balance' => $balance
                    ]);

                    //Withdraw
                    $withdrawal = new Withdrawal();
                    $withdrawal->payment_method = Auth::user()->gateway_name;
                    $withdrawal->user_id = $user->id;
                    $withdrawal->number = Auth::user()->gateway_number;
                    $withdrawal->amount = $request->amount;
                    $withdrawal->currency = 'Bangladesh';
                    $withdrawal->charge = $charge;
                    $withdrawal->final_amount = $request->amount - $charge;
                    $withdrawal->status = 'pending';

                    //User Ledger
                    if ($withdrawal->save()) {
                        $ledger = new UserLedger();
                        $ledger->user_id = $user->id;
                        $ledger->reason = 'withdraw_request';
                        $ledger->perticulation = 'Your withdraw request status is pending please wait for admin approval or communication with us.';
                        $ledger->amount = $request->amount;
                        $ledger->debit = $request->amount - $charge;
                        $ledger->status = 'pending';
                        $ledger->date = date('d-m-Y H:i');
                        $ledger->save();
                    }
                    return back()->with('success', 'Withdraw send successfully.');
                } else {
                    return back()->with('error', 'Maximum Withdraw ' . price($maximum_withdraw));
                }
            } else {
                return back()->with('error', 'Minimum Withdraw ' . price($minimum_withdraw));
            }
        } else {
            return back()->with('error', 'Your sufficient balance is low.');
        }
    }


    public function withdrawConfirmSubmitUSDT(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'amount' => 'required|numeric'
        ]);
        if ($validate->fails()) {
            return back()->with('error', $validate->errors());
        }

        if (!Auth::user()->usdt_password || !Auth::user()->usdt_number || !Auth::user()->usdt_name) {
            return back()->with('success', 'Please setup your bank');
        }

        if (Auth::user()->usdt_password != $request->password) {
            return back()->with('success', 'This password not match');
        }

        $user = Auth::user();

        if ($request->amount <= $user->balance) {
            if (($request->amount / setting('rate')) >= setting('minimum_withdraw_usdt')) {
                if (($request->amount / setting('rate')) <= setting('maximum_withdraw_usdt')) {
                    $charge = 0;
                    if (setting('withdraw_charge') > 0) {
                        $charge = setting('withdraw_charge_usdt');
                    }

                    //Update User Balance
                    $balance = $user->balance - $request->amount;
                    User::where('id', $user->id)->update([
                        'balance' => $balance
                    ]);

                    //Withdraw
                    $withdrawal = new Withdrawal();
                    $withdrawal->payment_method_id = Auth::user()->gateway_method;
                    $withdrawal->user_id = $user->id;
                    $withdrawal->number = Auth::user()->usdt_number;
                    $withdrawal->amount = $request->amount;
                    $withdrawal->usdt = ($request->amount / setting('rate')) - $charge;
                    $withdrawal->currency = 'Bangladesh';
                    $withdrawal->charge = $charge;
                    $withdrawal->final_amount = 0;
                    $withdrawal->status = 'pending';

                    //User Ledger
                    if ($withdrawal->save()) {
                        $ledger = new UserLedger();
                        $ledger->user_id = $user->id;
                        $ledger->reason = 'withdraw_request';
                        $ledger->perticulation = 'Your withdraw request status is pending please wait for admin approval or communication with us.';
                        $ledger->amount = $request->amount;
                        $ledger->is_usdt = 'yes';
                        $ledger->debit = $request->amount - $charge;
                        $ledger->status = 'pending';
                        $ledger->date = date('d-m-Y H:i');
                        $ledger->save();
                    }
                    return back()->with('success', 'Withdraw request send successfully. Please wait for admin approval.');
                    return response()->json(['status' => true, 'message' => 'Withdraw request send successfully. Please wait for admin approval.']);
                } else {
                    return back()->with('error', 'Withdraw amount must be less then ' . setting('maximum_withdraw'));
                    return response()->json(['status' => false, 'message' => 'Withdraw amount must be less then ' . $payment->maximum_withdraw_usdt]);
                }
            } else {
                return back()->with('error', 'Withdraw amount must be greater then ' . setting('maximum_withdraw'));
                return response()->json(['status' => false, 'message' => 'Withdraw amount must be greater then ' . $payment->minimum_withdraw_usdt]);
            }
        } else {
            return back()->with('error', 'Your sufficient balance is low.');
            return response()->json(['status' => false, 'message' => 'Your sufficient balance is low.']);
        }
    }

    public function withdrawPreview()
    {
        $withdraws = Withdrawal::with('payment_method')->where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('app.main.withdraw.withdraw-preview', compact('withdraws'));
    }
}
