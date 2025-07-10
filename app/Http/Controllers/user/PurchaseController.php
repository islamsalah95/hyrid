<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Mining;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserLedger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //
    public function purchase_vip($id)
    {
        $vip = Package::find($id);

        if ($vip->is_default == 1)
        {
            return redirect()->route('vip')->with('error', "This VIP is default when you registered in our platform");
        }

        //Check vip validity available
        $v =  Purchase::where('user_id', Auth::id())->where('package_id', $vip->id)->where('validity', 'valid')->first();
        if ($v){
            return redirect()->route('vip')->with('error', "This vip already activate");
        }


        return view('app.main.my_vip.vip_details', compact('vip'));
    }

    public function purchaseConfirmation($id)
    {
        $package = Package::find($id);
        $user = Auth::user();

        //Check status
        if ($package->status != 'active')
        {
            return back()->with('error', "In-Active");
        }

        if ($package){
            if ($package->price <= $user->balance){
                User::where('id', $user->id)->update([
                    'balance'=> $user->balance - $package->price,
                ]);

                //Purchase Table Create
                $purchase = new Purchase();
                $purchase->user_id = Auth::id();
                $purchase->package_id = $package->id;
                $purchase->amount = $package->price;
                $purchase->hourly = ($package->commission_with_avg_amount / $package->validity) / 24;
                $purchase->daily_income = $package->commission_with_avg_amount / $package->validity;
                $purchase->date = now()->addHours(24);
                $purchase->validity = Carbon::now()->addDays($package->validity);
                $purchase->status = 'active';
                $purchase->save();

                $first_ref = User::where('ref_id', Auth::user()->ref_by)->first();
                if ($first_ref){
                    $amount = $package->price * setting('first_ref') / 100;
                    User::where('id', $first_ref->id)->update([
                        'balance' => $first_ref->balance + $amount
                    ]);

                    $ledger = new UserLedger();
                    $ledger->user_id = $first_ref->id;
                    $ledger->get_balance_from_user_id = $user->id;
                    $ledger->reason = 'commission';
                    $ledger->perticulation = 'Commission from '. $user->username;
                    $ledger->amount = $amount;
                    $ledger->debit = $amount;
                    $ledger->status = 'approved';
                    $ledger->step = 'first';
                    $ledger->date = date('d-m-Y H:i');
                    $ledger->save();

                    $second_ref = User::where('ref_id', $first_ref->ref_by)->first();
                    if ($second_ref){
                        $amount = $package->price * setting('second_ref') / 100;
                        User::where('id', $second_ref->id)->update([
                            'balance' => $second_ref->balance + $amount
                        ]);

                        $ledger = new UserLedger();
                        $ledger->user_id = $second_ref->id;
                        $ledger->get_balance_from_user_id = $user->id;
                        $ledger->reason = 'commission';
                        $ledger->perticulation = 'Commission from '. $user->username;
                        $ledger->amount = $amount;
                        $ledger->debit = $amount;
                        $ledger->status = 'approved';
                        $ledger->step = 'second';
                        $ledger->date = date('d-m-Y H:i');
                        $ledger->save();

                         $third_ref = User::where('ref_id', $second_ref->ref_by)->first();
                         if ($third_ref){
                             $amount = $package->amount * setting('third_ref') / 100;
                             User::where('id', $third_ref->id)->update([
                                 'balance' => $third_ref->balance + $amount
                             ]);

                             $ledger = new UserLedger();
                             $ledger->user_id = $third_ref->id;
                             $ledger->get_balance_from_user_id = $user->id;
                             $ledger->reason = 'commission';
                             $ledger->perticulation = 'Commission from '. $user->username;
                             $ledger->amount = $amount;
                             $ledger->debit = $amount;
                             $ledger->status = 'approved';
                             $ledger->step = 'third';
                             $ledger->date = date('d-m-Y H:i');
                             $ledger->save();
                         }
                    }
                }

                return redirect()->back()->with('success', "Successful");
            }else{
                return back()->with('error', "Insufficient Balance");
            }
        }else{
            return back()->with('error', "This is default vip");
        }
    }

    protected function ref_user($ref_by)
    {
        return User::where('ref_id', $ref_by)->first();
    }
}
