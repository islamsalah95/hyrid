<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\BonusLedger;
use App\Models\Checkin;
use App\Models\Mining;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserLedger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GetBonusController extends Controller
{
    //
    public function index()
    {
        $data = Bonus::where('status', 'active')->first();
        return view('app.main.bonus.index', compact('data'));
    }

    public function gift()
    {
        return view('app.main.gift.index');
    }

    public function submitBonusCode(Request $request)
    {
        Validator::make($request->all(), [
            'bonus_code' => 'required'
        ]);

        $code = $request->bonus_code;
        $bonus = Bonus::where('status', 'active')->first();
        $user = Auth::user();
        if ($bonus) {
            if ($code == $bonus->code) {
                //Check this bonus use this user.
                $checkBonusUses = BonusLedger::where('bonus_id',$bonus->id )->where('user_id', $user->id)->first();
                if ($checkBonusUses){
                    return redirect()->route('user.promo')->with('error', 'Already use');
                }

                if ($bonus->counter < $bonus->set_service_counter) {
                    User::where('id', $user->id)->update([
                        'balance'=> $user->balance + $bonus->amount,
                    ]);

                    //User Ledger
                    $ledger = new UserLedger();
                    $ledger->user_id = $user->id;
                    $ledger->reason = 'bonus';
                    $ledger->perticulation = 'Congratulations '.$user->name. ' get amount of '.price($bonus->amount);
                    $ledger->amount = $bonus->amount;
                    $ledger->debit = $bonus->amount;
                    $ledger->status = 'approved';
                    $ledger->date = date('d-m-Y H:i');
                    $ledger->save();

                    Bonus::where('id', $bonus->id)->update([
                        'counter'=> $bonus->counter + 1
                    ]);

                    $bonus_ledger = new BonusLedger();
                    $bonus_ledger->user_id = $user->id;
                    $bonus_ledger->bonus_id = $bonus->id;
                    $bonus_ledger->amount = $bonus->amount;
                    $bonus_ledger->bonus_code = $request->bonus_code;
                    $bonus_ledger->save();

                    return redirect()->route('user.promo')->with('success', 'Amount '.price($bonus->amount));
                } else {
                    return redirect()->route('user.promo')->with('error', 'Bonus fulfil');
                }
            } else {
                return redirect()->route('user.promo')->with('error', 'Code invalid');
            }
        } else {
            return redirect()->route('user.promo')->with('error', 'Not available');
        }
    }

    public function preview()
    {
        $datas = BonusLedger::with(['bonus', 'user'])->where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('app.main.bonus.bonus-preview', compact('datas'));
    }

    public function checkin(Request $request)
    {
        // check this user already check it
        $check = Checkin::where('user_id', Auth::user()->id)->orderByDesc('id')->first();
        if ($check && now()->greaterThanOrEqualTo($check->date)){

            //Create checkin record
            $model = new Checkin();
            $model->user_id = Auth::id();
            $model->date = now()->addHours(24);
            $model->amount = setting('checkin');
            $model->save();

            User::where('id', Auth::user()->id)->update([
                'balance'=> Auth::user()->balance + setting('checkin'),
            ]);

            return redirect()->back()->with('success', 'You have received daily checkin bonus');
        }

        return redirect()->back()->with('success', 'Daily once. you can get this checkin bonus.');
    }

    public function checkin_ledger()
    {
        $checkins = Checkin::where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('app.main.checkin-ledger', compact('checkins'));
    }
}
