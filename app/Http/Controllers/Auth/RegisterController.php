<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:4|max:12',
            'mail' => 'required|string|email|min:4|max:255|unique:users',
            'password' => 'required|string|alpha_num|min:4|max:12|confirmed',
        ],[
            'username.required' => '必須項目です',
            'username.min' => '4文字以上で入力して下さい',
            'username.max' => '12文字以下で入力して下さい',

            'mail.required' => '必須項目です',
            'mail.min' => '4文字以上で入力して下さい',
            'mail.max' => '255文字以下で入力して下さい',
            'mail.unique:users' => 'メールアドレスは利用できません',

            'password.required' => '必須項目です',
            'password.alpha_num' => '半角英数字で入力して下さい',
            'password.min' => '4文字以上で入力して下さい',
            'password.max' => '12文字以下で入力して下さい',
            'password.confirmed' => 'パスワードが一致しません'


        ])->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            $this->validator($data);

            $this->create($data);
            return redirect('added')->with(['name' => $data['username']]);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
