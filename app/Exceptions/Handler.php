<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;
use App\Libraries\SendResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\UnAuthorizedRequestException;
use Illuminate\Database\QueryException;
use App\Libraries\APIResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;


use Throwable;

class Handler extends ExceptionHandler
{
    use APIResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
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
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Throwable $e)
    {
        // return $this->sendResponse(401, null, ['Unauthorized Request'], 401);
        
        //  return parent::render($request, $e);
        $url = str_replace('index.php/','',$request->fullUrl());
        if (strpos($url, '/public/api')) {

            // dd($e instanceof UnAuthorizedRequestException);

            if ($e instanceof NotFoundHttpException) {
                Log::alert($e->getMessage());
                return $this->sendResponse(404, null, ['Invalid url']);
            } elseif ($e instanceof UnAuthorizedRequestException) { 
                // dd($this->sendResponse(401, null, ['Unauthorized Request'], 401));
                // Log::alert('Unauthorized Request'); 
                return $this->sendResponse(401, null, ['Unauthorized Request'], 401);
            } elseif ($e instanceof ModelNotFoundException) {
                Log::error($e->getMessage());
                return $this->sendResponse(404, null, ['Resource Not Found'], 404);
            } elseif ($e instanceof QueryException) {
                Log::critical($e->getMessage());
                return $this->sendResponse(500, null, ['Internal Server Error'], 500);
            } elseif ($e instanceof MethodNotAllowedHttpException) {
                Log::critical($e->getMessage());

                return $this->sendResponse(405, null, ['HTTP Method Not Allowed'], 405);
            } elseif ($e instanceof UnAuthorizedRequestException) {
                Log::critical($e->getMessage());
                return $this->sendResponse(405, null, ['User not found'], 405);
            } else {
                Log::error($e->getMessage());
                return $this->sendResponse(500, null, [$e->getMessage()], $e->getCode());
            }
        } else {
            
            if ($e instanceof NotFoundHttpException) {
                Log::alert($e->getMessage());
                return Redirect('error/error404');
            } else {
                Log::error($e->getMessage());
                return   Redirect('error/error500');
            }
        }
    }
}
