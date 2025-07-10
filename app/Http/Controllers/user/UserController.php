<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\BonusLedger;
use App\Models\Deposit;
use App\Models\Notice;
use App\Models\Package;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use App\Models\Recharge;
use App\Models\Task;
use App\Models\TaskRequest;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\VipSlider;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        $packages = Package::where('status', 'active')->get();
        $vips = my_vips();

        $sliders = VipSlider::where('page_type', 'home_page')->where('status', 'active')->get();
        $vipUsers = Purchase::with('user', 'package')->orderByDesc('id')->where('package_id', '>', 1)->orderByDesc('id')->get()->random(Purchase::where('package_id', '>', 1)->get()->count());

        return view('app.main.index', compact('sliders', 'vipUsers', 'packages', 'vips'));
    }
    public function commission()
    {
        return view('app.main.commission');
    }
    public function refer_commission()
    {
        return view('app.main.refer_commission');
    }

    public function vip()
    {
        $sliders = VipSlider::where('page_type', 'vip_page')->where('status', 'active')->get();
        $vips = Package::where('status', 'active')->get();
        $vids = my_vips();
        return view('app.main.vip', compact('sliders', 'vips', 'vids'));
    } 
    public function package_details($id)
    {
        $package = Package::find($id);
        return view('app.main.package_details', compact('package'));
    }

    public function profile()
    {
        return view('app.main.profile');
    }

    public function promo()
    {
        return view('app.main.promo');
    }

    public function promo_history()
    {
        return view('app.main.promo_history');
    }

    public function history()
    {
        return view('app.main.history');
    }

    public function account()
    {
        return view('app.main.account');
    }

    public function recharge()
    {
        return view('app.main.recharge.index');
    }

    public function recharge_method()
    {
        return view('app.main.recharge.index_method');
    }

    public function deposit_confirm(Request $request){
        $model = new Deposit();
        $model->user_id = Auth::id();
        $model->method_name = $request->paymethod;
        $model->order_id = rand(00000000,99999999);
        $model->transaction_id = $request->transaction_id;
        $model->number = $request->phone_number;
        $model->amount = $request->amount;
        $model->charge_amount = 0;
        $model->final_amount = $request->amount;
        $model->date = date('d-m-Y H:i:s');
        $model->status = 'pending';
        $model->save();
        return redirect()->route('user.recharge')->with('success', 'Successful');
    }

    public function update_profile(Request $request)
    {
        $user = User::find(Auth::id());
        $path = uploadImage(false ,$request, 'photo', 'upload/profile/', 200, 200 ,$user->photo);
        $user->photo = $path ?? $user->photo;

        $user->update();
        return redirect()->route('my.profile')->with('success', 'Successful');
    }

    public function personal_details()
    {
        return view('app.main.update_personal_details');
    }


    public function email()
    {
        return view('app.main.email');
    }


    public function email_submit(Request $request)
    {
        User::where('id', Auth::id())->update(['email'=> $request->email, 'name'=> $request->name]);
        return redirect()->back()->with('success', 'Success');
    }



    public function mobile_recharge_list()
    {
        return view('app.main.mobile_recharge_list');
    }

    public function mobile_recharge_submit(Request $request)
    {
        $deposit = Deposit::where('user_id', auth()->id())->where('status', 'approved')->first();
        if (!$deposit){
            return redirect()->back()->with('success', 'First deposit.');
        }

        if ($request->amount != 50){
            return redirect()->back()->with('success', 'Mobile recharge must be '.price(50));
        }

        if ($request->amount <= auth()->user()->balance){
            $user = User::where('id', \auth()->id())->first();
            $user->balance = $user->balance - $request->amount;
            $user->save();

            $recharge = new Recharge();
            $recharge->user_id = Auth::id();
            $recharge->operator = $request->operator;
            $recharge->number = $request->number;
            $recharge->amount = $request->amount;
            $recharge->save();
            return redirect()->back()->with('success', 'Mobile recharge success');
        }else{
            return redirect()->back()->with('success', 'Low Balance.');
        }
    }

    public function personal_details_submit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'=> 'required',
            'methods'=> 'required',
            'number'=> 'required',
        ]);
        if ($validate->fails()){return redirect()->route('user.personal-details')->withErrors($validate->errors());}

        $user = User::find(Auth::id());

        $user->name = $request->name;
        $user->gateway_number = $request->number;
        $user->gateway_method = $request->methods;
        $user->update();
        return redirect()->route('user.personal-details')->with('success', 'Successfully updated your personal details and credentials');
    }

    public function bonus_ledger()
    {
        $datas = BonusLedger::with(['bonus', 'user'])->where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('app.main.bonus.bonus-preview', compact('datas'));
    }

    public function payment_ledger()
    {
        $payments = Deposit::where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('app.main.recharge.payment-preview', compact('payments'));
    }

    public function withdraw_ledger()
    {
        $withdraws = Withdrawal::with('payment_method')->where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('app.main.withdraw.withdraw-preview', compact('withdraws'));
    }

    public function balance_ledger()
    {
        $pending_withdraw = Withdrawal::where('user_id', Auth::id())->where('status', 'pending')->orderByDesc('id')->get()->pluck('amount')->sum();
        $pending_payment = Deposit::where('user_id', Auth::id())->where('status', 'pending')->orderByDesc('id')->get()->pluck('amount')->sum();
        return view('app.main.balance_ledger', compact('pending_withdraw', 'pending_payment'));
    }

    public function secret()
    {
        return view('app.main.secret');
    }

    public function password()
    {
        return view('app.main.password');
    }

    public function changepassword(Request $request)
    {
        if (Hash::check($request->current_password, Auth::user()->password)){
            if ($request->new_password == $request->confirm_password)
            {
                User::where('id', Auth::id())->update([
                    'password'=> Hash::make($request->new_password)
                ]);
                return back()->with('error', 'Password successfully changed.');
            }else{
                return back()->with('error', 'Confirm password does not match');
            }
        }else{
            return back()->with('error', 'Current password incorrect');
        }
    }

    public function emailVerification($email)
    {
        $email = base64_decode($email);
        $user = User::where('email', $email)->first();
        if ($user){
            return view('app.auth.verify', compact('user'));
        }else{
            return redirect()->route('register')->with('error','Registration failed. please try again');
        }
    }

    public function verified_to_login($user_id, $code)
    {
        $user = User::where('id', $user_id)->first();
        if ($user && $user->code == $code)
        {
            User::where('id', $user->id)->update([
                'email_verified_at'=> Carbon::now()
            ]);

            //Create Purchase record
            $p = Package::where('is_default', '1')->first();
            $model = new Purchase();
            $model->user_id = $user_id;
            $model->package_id = $p ? $p->id : 1;
            $model->amount = $p ? $p->price : 0;
            $model->date = Carbon::now();
            $model->status = 'active';
            $model->save();

            $ledger = new UserLedger();
            $ledger->user_id = $user_id;
            $ledger->reason = 'purchase_package';
            $ledger->perticulation = 'Congratulations already activate default vip for registered in our platform.';
            $ledger->amount = $p ? $p->price : 0;
            $ledger->credit = $p ? $p->price : 0;
            $ledger->status = 'pending';
            $ledger->date = date('d-m-Y H:i');
            $ledger->save();

            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'You are successfully logged in.');
        }else{
            return redirect()->route('register')->with('error','Registration failed. please try again');
        }
    }

    public function verification_time_out($user_id)
    {
        User::find($user_id)->delete();
        return redirect()->route('register')->with('error','Registration failed. please try again');
    }


    public function notice()
    {
        $datas = Notice::where('status', 'active')->orderByDesc('id')->get();
        return view('app.main.notice', compact('datas'));
    }



    public function task()
    {

        //First Level
        $first_level_users = User::where('ref_by', auth()->user()->ref_id)->get();

        //Get Second Level
        $second_level_users_ids = [];
        foreach ($first_level_users as $element) {
            $users = User::where('ref_by', $element->ref_id)->get();
            foreach ($users as $user){
                array_push($second_level_users_ids, $user->id);
            }
        }
        $second_level_users = User::whereIn('id', $second_level_users_ids)->get();

        //Get Third Level
        $third_level_users_ids = [];
        foreach ($second_level_users as $element) {
            $users = User::where('ref_by', $element->ref_id)->get();
            foreach ($users as $user){
                array_push($third_level_users_ids, $user->id);
            }
        }
        $third_level_users = User::whereIn('id', $third_level_users_ids)->get();

        $first_ids = $first_level_users->pluck('id'); //first
        $second_ids = $second_level_users->pluck('id'); //Second
        $third_ids = $third_level_users->pluck('id'); //Third

        $totalDeposit1 = Deposit::whereIn('user_id', array_merge($first_ids->toArray()))->where('status', 'approved')->sum('amount');
        $totalDeposit2 = Deposit::whereIn('user_id', array_merge($second_ids->toArray()))->where('status', 'approved')->sum('amount');
        $totalDeposit3 = Deposit::whereIn('user_id', array_merge($third_ids->toArray()))->where('status', 'approved')->sum('amount');
        $totalDeposit = $totalDeposit1 + $totalDeposit2 + $totalDeposit3;

        return view('app.main.task', compact('totalDeposit'));
    }

    public function apply_task_commission($task_id){
        $task = Task::where('id', $task_id)->first();
        if ($task){

            //First Level
            $first_level_users = User::where('ref_by', auth()->user()->ref_id)->get();

            //Get Second Level
            $second_level_users_ids = [];
            foreach ($first_level_users as $element) {
                $users = User::where('ref_by', $element->ref_id)->get();
                foreach ($users as $user){
                    array_push($second_level_users_ids, $user->id);
                }
            }
            $second_level_users = User::whereIn('id', $second_level_users_ids)->get();

            //Get Third Level
            $third_level_users_ids = [];
            foreach ($second_level_users as $element) {
                $users = User::where('ref_by', $element->ref_id)->get();
                foreach ($users as $user){
                    array_push($third_level_users_ids, $user->id);
                }
            }
            $third_level_users = User::whereIn('id', $third_level_users_ids)->get();

            $first_ids = $first_level_users->pluck('id'); //first
            $second_ids = $second_level_users->pluck('id'); //Second
            $third_ids = $third_level_users->pluck('id'); //Third

            $totalDeposit1 = Deposit::whereIn('user_id', array_merge($first_ids->toArray()))->where('status', 'approved')->sum('amount');
            $totalDeposit2 = Deposit::whereIn('user_id', array_merge($second_ids->toArray()))->where('status', 'approved')->sum('amount');
            $totalDeposit3 = Deposit::whereIn('user_id', array_merge($third_ids->toArray()))->where('status', 'approved')->sum('amount');
            $totalDeposit = $totalDeposit1 + $totalDeposit2 + $totalDeposit3;

            if ($totalDeposit >= $task->invest){
                $model = new TaskRequest();
                $model->task_id = $task->id;
                $model->user_id = \auth()->id();
                $model->team_invest = $task->invest;
                $model->team_size = $task->team_size;
                $model->bonus = $task->bonus;
                $model->save();

                User::where('id', \auth()->id())->update([
                    'balance'=> \auth()->user()->balance + $task->bonus
                ]);

                return redirect('task')->with('success', 'Request sent successful.');
            }else{
                return redirect('task')->with('error', 'Please improve your team invest.');
            }
        }
        return back();
    }
    public function task_history()
    {
        return view('app.main.task_history');
    }

    public function card()
    {
        return view('app.main.gateway_setup');
    }

    public function setupGatewayView(Request $request)
    {
        $method = $request->pay_method;
        $number = $request->number;

        //send email for verification
        if ($method != '' && $number != '')
        {
            $code = rand(000000,999999);
            session()->put('code', $code);
            $data = ['method'=> $method, 'number'=> $number, 'code'=> $code];
            $user = \auth()->user();

            return view('app.main.gateway_setup_otp', compact('method', 'number'));
        }else{
            return back()->with('error', 'something went wrong');
        }
    }



    public function setupGateway(Request $request)
    {
        User::where('id',Auth::id())->update([
            'name'=> $request->name,
            'gateway_number'=> $request->gateway_number,
            'gateway_name'=> $request->gateway_name,
        ]);
        return redirect()->route('user.withdraw');
    }


    public function setupGatewayUsdt(Request $request)
    {
        User::where('id',Auth::id())->update([
            'usdt_name'=> $request->usdt_name,
            'usdt_number'=> $request->usdt_number,
            'usdt_password'=> $request->usdt_password,
        ]);
        return redirect()->back()->with('success','USDT bank setup successful.');
    }

    public function invite()
    {
        return view('app.main.invite');
    }

    public function service()
    {
        return view('app.main.service');
    }


    public function about()
    {
        return view('app.main.about');
    }


    public function download_apk(){
        $file= public_path('onsemi.apk');
        return response()->file($file ,[
            'Content-Type'=>'application/vnd.android.package-archive',
            'Content-Disposition'=> 'attachment; filename="onsemi.apk"',
        ]) ;
    }


    public function share()
    {
        return view('app.main.share');
    }


}
