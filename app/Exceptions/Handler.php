<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
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
    'current_password',
    'password',
    'password_confirmation',
  ];

  /**
   * Register the exception handling callbacks for the application.
   *
   * @return void
   */
  public function register()
  {
    $this->reportable(function (Throwable $e) {
      //
    });

    // 419 PAGE EXPIRED (token CSRF expiré) : redirection avec message au lieu d'afficher la page 419
    $this->renderable(function (TokenMismatchException $e, Request $request) {
      if ($request->expectsJson()) {
        return response()->json(['message' => __('Votre session a expiré. Veuillez rafraîchir la page et réessayer.')], 419);
      }
      $message = __('Votre session a expiré. Veuillez réessayer.');
      if (str_contains($request->path(), 'login-submit')) {
        return redirect()->route('user.login')->with('error', $message);
      }
      return redirect()->back()->withInput($request->except('password', '_token'))->with('error', $message);
    });
  }

  /**
   * Convert an authentication exception into a response.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Illuminate\Auth\AuthenticationException  $exception
   * @return \Illuminate\Http\Response
   */
  protected function unauthenticated($request, AuthenticationException $exception)
  {
    if ($request->expectsJson()) {
      return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    // Rediriger vers la bonne route selon le contexte
    if (Route::is('admin.*')) {
      return redirect()->route('admin.login');
    }

    if (Route::is('seller.*')) {
      return redirect()->route('seller.login');
    }

    // Par défaut, rediriger vers la route user.login
    return redirect()->route('user.login');
  }
}
