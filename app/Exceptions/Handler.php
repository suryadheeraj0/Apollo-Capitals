<?php

namespace App\Exceptions;

use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Request $request, Throwable $e) {

            // Handle 404 Not Found
            if ($e instanceof NotFoundHttpException) {
                return response()->view('errors.404', [], 404);
            }

            // Handle 403 Forbidden
            if ($e instanceof AuthorizationException) {
                return response()->view('errors.403', [], 403);
            }

             //parent method to handle other exceptions in the default way
            return parent::render($request, $e);

        });

        

         
    }
}
