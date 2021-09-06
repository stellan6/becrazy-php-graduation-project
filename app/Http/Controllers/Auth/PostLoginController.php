<?php
namespace App\Http\Controllers\Auth;

class PostLoginController extends LoginController
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/post/list';
}
