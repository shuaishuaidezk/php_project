<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\MustVerifyEmail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
/*        $rules = [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ];
        $messages = [
            'title.required' => '请填写文章标题',
            'title.unique' => '文章标题不能重复',
            'title.max' => '文章标题不能超过255个字符',
            'body.required' => '请填写文章内容',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('post/create')->withErrors($validator)->withInput();
        }*/

//        $rules = [
//            'name' => 'rerequired|string|max:255'  ,
//            'username' => 'required|string|max:255|min6|unique:users',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => ['required', 'confirmed', Rules\Password::defaults()],
//        ];
//        $message = [
//            'name.required' => 'you need to fill in "name". ',
//            'username.required'=> 'you need to fill in "username"',
//            'username.min6'
//        ];
        $request->validate([
            'name' => 'required|string|max:255',
//            'username' => 'required|string|max:255|min:6|unique:users',
            'username'=>[
                'required',
                'string',
                'max:255',
                'min:6',
                'unique:users',
                'regex:/^[A-Za-z0-9_]+$/'
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);



        event(new Registered($user));

        Auth::login($user);
        //return redirect()->route('test');
        return redirect(RouteServiceProvider::HOME);
    }
    public function rules(){

    }

}
