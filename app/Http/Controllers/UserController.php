<?php
declare(strict_types=1);
namespace APP\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use App\Http\Requests\UserRegisterPost;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class UserController extends Controller
{
    /**
     * トップページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('/user/register');
    }
    
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function validator(array $data)
    {
        return Validator::make($data,[
            'name' => ['required', 'string', 'max:128'],
            'email' => ['required', 'string', 'email', 'max:254'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }
    /**
     * 会員登録処理
     * 
     */
    public function register(UserRegisterPost $request)
    {
        // validat済
        $datum = $request->validated();
        
        return UserModel::create([
            'name' => $datum['name'],
            'email' => $datum['email'],
            'password' => Hash::make($datum['password']),
        ]);

/*
        $datum = $request->validated();
        
        //$datum['user_id'] = Auth::id();
        
        $datum['password'] = Hash::make($datum['password']);
        //var_dump($datum); exit;
*/
/*        // 認証
        if (Auth::attempt($datum) === false) {
            return back()
                   ->withInput() // 入力値の保持
                   ->withErrors(['auth' => 'emailかパスワードに誤りがあります。',]) // エラーメッセージの出力
                   ;
        }
*/
        // テーブルへのINSERT
        try {
            $r = UserModel::create($datum);
    } catch(\Throwable $e) {
        // XXX 本当はログに書く等の処理をする。今回は一端「出力する」だけ
        echo $e->getMessage();
        exit;
    }

    // ユーザの登録成功
    $request->session()->flash('front.user_register_success', true);
    
    //
    //$request->session()->regenerate();
    //return redirect()->intended('./login');
    //
    return redirect('/login');
   //}
        //
        //$request->session()->regenerate();
        //return redirect()->intended('/task/list');
    }
}