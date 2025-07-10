<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BonusController;
use App\Http\Controllers\admin\CommonController;
use App\Http\Controllers\admin\ManageUserController;
use App\Http\Controllers\admin\ManageWithdrawController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\PaymentMethodController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\admin\VipSliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\GetBonusController;
use App\Http\Controllers\user\MiningController;
use App\Http\Controllers\user\OnepayController;
use App\Http\Controllers\user\PurchaseController;
use App\Http\Controllers\user\TeamController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\WithdrawController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('clear', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return 'Cached Clear';
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('throttle:limit-check')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.login');
        });
        Route::get('login', [AdminController::class, 'login'])->name('admin.login');
        Route::post('login', [AdminController::class, 'login_submit'])->name('admin.login-submit');
    });

    Route::prefix('admin/controller')->middleware('admin')->group(function () {
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        //All Table Status
        Route::post('/table/status', [CommonController::class, 'status']);

        //ADMIN PROFILE
        Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('change/password', [AdminController::class, 'change_password'])->name('admin.changepassword');
        Route::post('check/password', [AdminController::class, 'check_password'])->name('admin.check.password');
        Route::post('change/password', [AdminController::class, 'change_password_submit'])->name('admin.changepasswordsubmit');
        Route::get('profile/update', [AdminController::class, 'profile_update'])->name('admin.profile.update');
        Route::post('profile/update', [AdminController::class, 'profile_update_submit'])->name('admin.profile.update-submit');

        //Notice
        Route::get('recharge', [AdminController::class, 'index_recharge'])->name('admin.recharge.index');
        Route::post('recharge/status/{id}', [AdminController::class, 'index_recharge_status'])->name('recharge.status.change');

        //Manage Customers
        Route::get('customers', [ManageUserController::class, 'customers'])->name('admin.customer.index');
        Route::get('customers/status/{id}', [ManageUserController::class, 'customersStatus'])->name('admin.customer.status');
        Route::get('customers/login/{id}', [ManageUserController::class, 'user_acc_login'])->name('admin.customer.login');
        Route::post('customers/change-password', [ManageUserController::class, 'user_acc_password'])->name('admin.customer.change-password');
        Route::get('search/user', [ManageUserController::class, 'search'])->name('admin.search.user');
        Route::get('search/user/action', [ManageUserController::class, 'searchSubmit'])->name('admin.search.submit');
        Route::post('provide/bonus/code', [ManageUserController::class, 'bonusCode'])->name('admin.customer.bonus');

        //Purchase Record
        Route::get('purchase/record', [ManageUserController::class, 'purchaseRecord'])->name('admin.purchase.index');


        Route::get('salary', [AdminController::class, 'salaryView'])->name('admin.salary');
        Route::get('salary-submit', [AdminController::class, 'salary'])->name('admin.salary.submit');
        Route::get('developer', [AdminController::class, 'developer'])->name('admin.developer.index');



        //VIP
        Route::get('package', [PackageController::class, 'index'])->name('admin.package.index');
        Route::get('package/create/{id?}', [PackageController::class, 'create'])->name('admin.package.create');
        Route::post('package/insert-update', [PackageController::class, 'insert_or_update'])->name('admin.package.insert');
        Route::delete('package/delete/{id}', [PackageController::class, 'delete'])->name('admin.package.delete');
        Route::get('package/view/{id}', [PackageController::class, 'view'])->name('admin.package.view');


        Route::get('task', [TaskController::class, 'index'])->name('admin.task.index');
        Route::get('task/create/{id?}', [TaskController::class, 'create'])->name('admin.task.create');
        Route::post('task/insert-update', [TaskController::class, 'insert_or_update'])->name('admin.task.insert');
        Route::delete('task/delete/{id}', [TaskController::class, 'delete'])->name('admin.task.delete');
        Route::get('task/request', [TaskController::class, 'task_request'])->name('admin.task.request.index');
        Route::get('task/request/status/{task_re_id}/{status}', [TaskController::class, 'task_request_status'])->name('task.request.status');

        //bonus
        Route::get('bonus', [BonusController::class, 'index'])->name('admin.bonus.index');
        Route::get('bonus/status/{id}', [BonusController::class, 'status'])->name('admin.bonus.status');
        Route::get('bonus/create/{id?}', [BonusController::class, 'create'])->name('admin.bonus.create');
        Route::post('bonus/insert-update', [BonusController::class, 'insert_or_update'])->name('admin.bonus.insert');
        Route::delete('bonus/delete/{id}', [BonusController::class, 'delete'])->name('admin.bonus.delete');
        Route::get('bonus/uses', [BonusController::class, 'bonuslist'])->name('admin.bonuslist.index');//Customer bonus uses

        Route::get('balance-customization/{condition}', [ManageUserController::class, 'customizationBalance'])->name('admin.customization.balance');

        Route::get('balance-customizat/ww/{condition}', [ManageUserController::class, 'customizationBalancewwww'])->name('admin.customization.balancewww');

        //VIP slider
        Route::get('vipslider', [VipSliderController::class, 'index'])->name('admin.vipslider.index');
        Route::get('vipslider/create/{id?}', [VipSliderController::class, 'create'])->name('admin.vipslider.create');
        Route::post('vipslider/insert-update', [VipSliderController::class, 'insert_or_update'])->name('admin.vipslider.insert');
        Route::delete('vipslider/delete/{id}', [VipSliderController::class, 'delete'])->name('admin.vipslider.delete');

        //Payment
        Route::get('method', [PaymentMethodController::class, 'index'])->name('admin.method.index');
        Route::get('method/create/{id?}', [PaymentMethodController::class, 'create'])->name('admin.method.create');
        Route::post('method/insert-update', [PaymentMethodController::class, 'insert_or_update'])->name('admin.method.insert');
        Route::delete('method/delete/{id}', [PaymentMethodController::class, 'delete'])->name('admin.method.delete');

        Route::get('customer/pending/payment', [ManageUserController::class, 'pendingPayment'])->name('admin.payment.pending');
        Route::get('customer/approved/payment', [ManageUserController::class, 'approvedPayment'])->name('admin.payment.approved');
        Route::get('customer/rejected/payment', [ManageUserController::class, 'rejectedPayment'])->name('admin.payment.rejected');
        Route::post('customer/payment/status/{id}', [ManageUserController::class, 'paymentStatus'])->name('payment.status.change');

        //Handle Customer Withdraw
        Route::get('customer/pending/withdraw', [ManageWithdrawController::class, 'pendingWithdraw'])->name('admin.withdraw.pending');
        Route::get('customer/approved/withdraw', [ManageWithdrawController::class, 'approvedWithdraw'])->name('admin.withdraw.approved');
        Route::get('customer/rejected/withdraw', [ManageWithdrawController::class, 'rejectedWithdraw'])->name('admin.withdraw.rejected');
        Route::post('customer/withdraw/status/{id}', [ManageWithdrawController::class, 'withdrawStatus'])->name('withdraw.status.change');

        //Settings
        Route::get('setting', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::post('setting/insert-update', [SettingController::class, 'insert_or_update'])->name('admin.setting.insert');

        //List
        Route::get('mining/with-customer', [ManageUserController::class, 'continue_mining'])->name('admin.mining_purchase.index');
    });

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('email-verification-confirm/{e}', [UserController::class, 'emailVerification']);
    Route::get('verified-login/{user_id}/{v_code}', [UserController::class, 'verified_to_login']);
    Route::get('user-verification_time_out/{user_id}', [UserController::class, 'verification_time_out']);

    Route::middleware(['auth', 'validity'])->group(function () {
        Route::get('/index/index', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/order/index', [UserController::class, 'vip'])->name('vip');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('user/update/profile', [UserController::class, 'update_profile'])->name('user.update.profile');
        Route::get('member/mine', [UserController::class, 'profile'])->name('profile');

        Route::get('my-personal-details', [UserController::class, 'personal_details'])->name('user.personal-details');
        Route::post('my-personal-details', [UserController::class, 'personal_details_submit'])->name('user.personal-details-submit');

        //Withdraw
        Route::get('money/withdraw.html', [WithdrawController::class, 'withdraw'])->name('user.withdraw');
        Route::post('withdraw-confirm-submit', [WithdrawController::class, 'withdrawConfirmSubmit'])->name('user.withdraw-confirm-submit');
        Route::get('usdt/withdraw', [WithdrawController::class, 'usdt_withdraw'])->name('usdt_withdraw');
        Route::get('withdraw-preview', [WithdrawController::class, 'withdrawPreview'])->name('user.withdraw.preview');

        //GET BONUS
        Route::get('get-bonus', [GetBonusController::class, 'index'])->name('user.get.bonus');
        Route::post('submit-bonus', [GetBonusController::class, 'submitBonusCode'])->name('user.submit-bonus');
        Route::get('submit-checkin', [GetBonusController::class, 'checkin'])->name('user.checkin');
        Route::post('submit-secret_submit', [GetBonusController::class, 'secret_submit'])->name('user.secret_submit');
        Route::get('get-bonus-preview', [GetBonusController::class, 'preview'])->name('user.bonus-preview');
        Route::post('spin.get-amount', [GetBonusController::class, 'preview'])->name('user.spin.amount.submit');



        //Ledger
        Route::get('bonus/ledger', [UserController::class, 'bonus_ledger'])->name('user.bonus.ledger');
        Route::get('withdraw/ledger', [UserController::class, 'withdraw_ledger'])->name('user.withdraw.ledger');
        Route::get('change/password', [UserController::class, 'password'])->name('user.change-password');
        Route::post('my/change/password', [UserController::class, 'changepassword'])->name('user.change.password');

        //Purchase VIP
        Route::get('purchase/vip/{id}', [PurchaseController::class, 'purchase_vip'])->name('user.purchase.vip');
        Route::get('purchase/confirmation/{id}', [PurchaseController::class, 'purchaseConfirmation'])->name('purchase.confirmation');
        Route::get('/package-details/{id}', [UserController::class, 'package_details'])->name('package.details');

        Route::get('user/recharge', [UserController::class, 'recharge'])->name('user.recharge');
        Route::get('user/payment/{amount}', [OnepayController::class, 'paymentMethod']);
        Route::get('user/payment/{amount}/{method}', [OnepayController::class, 'payment_confirm']);
        Route::post('user/payment/submit', [OnepayController::class, 'depositSubmit'])->name('depositSubmit');
        Route::post('/deposit-confirm', [UserController::class, 'deposit_confirm'])->name('deposit_confirm');
        Route::get('recharge/history', [OnepayController::class, 'recharge_record'])->name('recharge.history.preview');
        Route::post('user/payment/submit', [OnepayController::class, 'depositSubmit'])->name('depositSubmit');
        //invite
        Route::get('/share/share.html', [UserController::class, 'invite'])->name('user.invite');
        Route::get('/service', [UserController::class, 'service'])->name('service');
        Route::get('/index/aboutus', [UserController::class, 'about'])->name('about');
        Route::get('/promo', [UserController::class, 'promo'])->name('user.promo');
        Route::get('/promo/history', [UserController::class, 'promo_history'])->name('promo.history');
        Route::get('/history', [UserController::class, 'history'])->name('history');

        //Notice
        Route::get('/task', [UserController::class, 'task'])->name('task');
        Route::get('apply-for-task-commission/{id}', [UserController::class, 'apply_task_commission']);
        Route::get('task/history', [UserController::class, 'task_history'])->name('task.history');

        Route::get('/card', [UserController::class, 'card'])->name('user.card');
        Route::post('/setup/gateway', [UserController::class, 'setupGateway'])->name('setup.gateway.submit');

        //Team
        Route::get('team/bonus', [TeamController::class, 'team'])->name('user.team');
        Route::get('my-account', [UserController::class, 'account'])->name('account.info');

        Route::get('invite_bonus', [UserController::class, 'invite_bonus'])->name('user.invite-bonus');

        //Help Center
        Route::get('help-center', [UserController::class, 'help_center'])->name('help.center');

        Route::get('commission', [UserController::class, 'commission'])->name('commission');
        Route::get('refer_commission', [UserController::class, 'refer_commission'])->name('refer_commission');

        Route::get('earning', [MiningController::class, 'earning'])->name('earning');
        Route::get('receive', [MiningController::class, 'receive'])->name('user.receive');

        //Apk
        Route::get('download-apk', [UserController::class, 'download_apk'])->name('user.download.apk');
    });
    require __DIR__ . '/auth.php';
});

Route::get('interest', [AdminController::class, 'interest']);

