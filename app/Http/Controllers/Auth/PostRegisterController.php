<?php
namespace App\Http\Controllers\Auth;

class PostRegisterController extends RegistersController
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/post/list';
}
