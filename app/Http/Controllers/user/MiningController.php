<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Mining;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\UserLedger;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MiningController extends Controller
{

    public function earning()
    {
        //Check Validity
        $myVips = Purchase::where('user_id', auth()->id())->where('status', 'active')->get();
        foreach ($myVips as $element){
            $p = Purchase::where('id', $element->id)->first();
            $ex_date = new Carbon($p->validity);
            if ($ex_date->isPast()){
                $p->status = 'inactive';
                $p->save();
            }
        }
        
        $dayliIncome = Package::whereIn('id', my_vips())->get();
        $dayliIncomeAmount = 0;
        foreach($dayliIncome as $income){
            $dayliIncomeAmount = $dayliIncomeAmount + ($income->commission_with_avg_amount / $income->validity);
        }


        return view('app.main.earning', compact('dayliIncomeAmount'));
    }

    public function mining()
    {
        return redirect()->route('user.mining.my');
        $datas = Purchase::with('package')->where('user_id', Auth::id())->where('validity', 'valid')->get();

        return view('app.main.mining.index', compact('datas'));
    }


    public function receive()
    {

        $user = User::where('id', auth()->id())->first();
        $amount = $user->receive_able_amount;
        if ($amount > 0){
            $user->balance = $user->balance + $amount;
            $user->receive_able_amount = 0;
            $user->save();

            $ledger = new UserLedger();
            $ledger->user_id = $user->id;
            $ledger->get_balance_from_user_id = $user->id;
            $ledger->reason = 'my_commission';
            $ledger->perticulation = 'Congratulations';
            $ledger->amount = $amount;
            $ledger->debit = $amount;
            $ledger->status = 'approved';
            $ledger->date = date('d-m-Y H:i');
            $ledger->save();

            return back()->with('success', 'Received.');
        }else{
            return back()->with('success', 'Not Eligible');
        }
    }

    public function tutorial()
    {
        $datas = Package::where('status', 'active')->get();
        return view('app.main.tutorial', compact('datas'));
    }
}
