<?php

namespace app\Http\Controllers\Auth;

//use app\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // 認証に関するリクエストを利用する
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use AuthenticatesUsers;

    // ログイン試行回数の制限を設ける
    protected $maxAttempts = 2; // 試行回数
    protected $decayMinutes = 1; // ロック時間１分

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/posts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    // ユーザ名とメールの両方でログイン出来るようにする。
    protected function attemptLogin(Request $request)
    {
    $username = $request->input($this->username());
    $password = $request->input('password');

    if(filter_var($username, \FILTER_VALIDATE_EMAIL)) {
        $credentials = ['email' => $username, 'password' => $password];
    } else {
        $credentials = [$this->username() => $username, 'password' => $password];
    }

    return $this->guard()->attempt($credentials, $request->filled('remember'));
    }

    public function username(){
        return 'name';
    }

    // ログアウトを行う。
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
        return redirect('/posts');
    }
}
