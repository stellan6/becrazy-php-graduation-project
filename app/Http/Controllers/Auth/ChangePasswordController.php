<?php
 
namespace App\Http\Controllers\Auth;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
 
class ChangePasswordController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  protected function validator(array $data)
  {
      return Validator::make($data, [
          'new_password' => 'required|string|min:6|confirmed',
      ]);
  }
 
  public function edit()
  {
    return view('auth.passwords.edit')
            ->with('user', \Auth::user());
  }
 
  public function update(Request $request)
  {
    // ID のチェック
    //（ここでエラーになることは通常では考えられない）
    if ($request->id != \Auth::user()->id) {
      return redirect('/home')
              ->with('warning', '致命的なエラーです');
    }
    $user = \Auth::user();
    // 現在のパスワードを確認
    if (!password_verify($request->current_password, $user->password)) {
      return redirect('/password/change')
              ->with('warning', 'パスワードが違います');
    }
    // Validation（6文字以上あるか，2つが一致しているかなどのチェック）
    $this->validator($request->all())->validate();
    // パスワードを保存
    $user->password = bcrypt($request->new_password);
    $user->save();
    return redirect('/home')
            ->with('status', 'パスワードを変更しました');
  }
}













