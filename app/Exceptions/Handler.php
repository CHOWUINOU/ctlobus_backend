<?php

namespace App\Exceptions;
use Illuminate\Auth\AuthenticationException;

use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

/*protected function unauthenticated($request, AuthenticationException $exception)
{
    return $request->expectsJson()
        ? response()->json(['message' => 'Non authentifié.'], 401)
        : response()->json(['message' => 'Non authentifié.'], 401);
}

*/
   public function render($request,  $exception)
{
    if ($exception instanceof ThrottleRequestsException) {
        $retryAfter = $exception->getHeaders()['Retry-After'] ?? 60;

        return response()->json([
            'success' => false,
            'message' => 'Trop de tentatives. Veuillez réessayer dans ' . $retryAfter . ' seconde(s).',
        ], Response::HTTP_TOO_MANY_REQUESTS);
    }

    return parent::render($request, $exception);
}


    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
