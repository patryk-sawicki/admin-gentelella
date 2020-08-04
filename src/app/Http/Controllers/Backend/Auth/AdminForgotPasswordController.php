<?php

namespace LiteCode\AdminGentelella\App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Password;

class AdminForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm(Request $request)
    {
        $status=$request->session()->get('status');
        return view(config('adminauth.view.passwords_email'), compact('status'));
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    /*
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email-admin');
    }*/
}
