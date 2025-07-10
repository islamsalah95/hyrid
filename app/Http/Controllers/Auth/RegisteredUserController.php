<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationMail;
use App\Models\Admin;
use App\Models\Checkin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
     public function create(Request $request)
    {
        $vari_const_sources = [
            's1'=> [
                'code'=> '8955',
                'img'=> asset('public/code/1.png')
            ],
            's2'=> [
                'code'=> '7183',
                'img'=> asset('public/code/2.png')
            ],
            's3'=> [
                'code'=> '4060',
                'img'=> asset('public/code/3.png')
            ],
            's4'=> [
                'code'=> '5726',
                'img'=> asset('public/code/4.png')
            ],
            's5'=> [
                'code'=> '0009',
                'img'=> asset('public/code/5.png')
            ],
            's6'=> [
                'code'=> '5408',
                'img'=> asset('public/code/6.png')
            ],
            's7'=> [
                'code'=> '5076',
                'img'=> asset('public/code/7.png')
            ],
            's8'=> [
                'code'=> '0133',
                'img'=> asset('public/code/8.png')
            ],
            's9'=> [
                'code'=> '4153',
                'img'=> asset('public/code/9.png')
            ],
            's10'=> [
                'code'=> '7329',
                'img'=> asset('public/code/10.png')
            ],
            's11'=> [
                'code'=> '0738',
                'img'=> asset('public/code/11.png')
            ],
            's12'=> [
                'code'=> '6163',
                'img'=> asset('public/code/12.png')
            ],
            's13'=> [
                'code'=> '6444',
                'img'=> asset('public/code/13.png')
            ],
            's14'=> [
                'code'=> '9436',
                'img'=> asset('public/code/14.png')
            
            ],
            's15'=> [
                'code'=> '2336',
                'img'=> asset('public/code/15.png')
            ]
        ];
        $index = rand(1, count($vari_const_sources));
        $code = $vari_const_sources['s'.(string)$index];

        $ref_by = $request->query('inviteCode');
        return view('app.auth.registration', compact('ref_by', 'code'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required'],
            //'confirm_password' => ['required'],
        ]);

        if ($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }

        //if ($request->confirm_password != $request->password){
            //return redirect()->back()->with('error', 'Confirm password not match.');
       // }

        $checkPhone = User::where('phone', $request->phone)->first();
        if ($checkPhone){
            return redirect()->back()->with('error', 'Already have an account.');
        }

        $user = User::create([
            'name' => 'u'.$request->phone,
            'username' => env('APP_NAME'),
            'ref_id' => date('d').rand(999999,111111),
            'ref_by' => $request->ref_by ?? env('APP_NAME'),
            'email' => 'user'.rand(0,999999).\Str::random(2).'@gmail.com',
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'type' => 'user',
            'balance' => 0,
            'code' => $request->code,
            'remember_token' => Str::random(30),
        ]);

        if ($user){
            $model = new Checkin();
            $model->user_id = $user->id;
            $model->date = now();
            $model->amount = 0;
            $model->save();

            Auth::login($user);
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error', 'Something wrong.');
        }
    }
}
