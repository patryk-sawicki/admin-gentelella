<?php

namespace LiteCode\AdminGentelella\app\Http\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class AdminauthHandler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $guard = $exception->guards()[0];
            switch ($guard) {
                case 'admin':
                    $login = 'admin.login';
                    return redirect()->route($login);
                    break;
                default:
                    $login = 'login';
                    return redirect()->route($login);
                    break;
            }
            return redirect()->route($login);
        }
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            //return response()->json(['User have not permission for this page access.']);
            return redirect()->back()->with('warning','ATENTION! You have no permission on that page and have been redirected back!');;
        }

//        $class = get_class($exception);
//
//        switch($class) {
//            case 'Illuminate\Auth\AuthenticationException':
//                $guard = array_get($exception->guards(), 0);
//                switch ($guard) {
//                    case 'admin':
//                        $login = 'admin.login';
//                        break;
//                    default:
//                        $login = 'login';
//                        break;
//                }
//
//                return redirect()->route($login);
//        }

        return parent::render($request, $exception);
    }
}
