<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
  public function render($request, Throwable $exception)
  {
    if ($exception instanceof TokenMismatchException) {
      return redirect()->route('login')
        ->with('error', 'Su sesión ha expirado. Por favor ingrese nuevamente.');
    }

    return parent::render($request, $exception);
  }
}
