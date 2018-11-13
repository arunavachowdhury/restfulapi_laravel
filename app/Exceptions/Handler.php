<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiResponser;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;




class Handler extends ExceptionHandler
{
    use ApiResponser;
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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
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
    public function render($request, Exception $exception)
    {
        if($exception instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($exception,$request);
        }
        elseif($exception instanceof ModelNotFoundException){
            return $this->Error('Does not exists Model with the specified identifier',404);
        }
        elseif($exception instanceof AuthenticationException){
            return $this->unauthenticated($request,$exception);
        }
        elseif($exception instanceof AuthorizationException){
            return $this->Error($exception->getMessage(),403);
        }
        elseif($exception instanceof NotFoundHttpException){
            return $this->Error('The specified URL not found',404);
        }
        elseif($exception instanceof MethodNotAllowedException){
            return $this->Error('The specified method for the request is invalid',405);
        }
        elseif($exception instanceof HttpException){
            return $this->Error($exception->getMessage(),$exception->getStatusCode());
        }
        elseif($exception instanceof QueryException){
            $errorCode = $exception->errorInfo[1];
            if($errorCode == 1451) {
                return $this->Error('Cannot remove this resource parmanently. It is retlated with any other resource', 409);
            }
        }
        return $this->Error('Try again later',500);
    }

    
    
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->errors();
        return $this->Error($errors, 422);
    }
}
