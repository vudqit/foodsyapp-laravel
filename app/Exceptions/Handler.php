<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use \App\Traits\ApiResponser; 
use \Illuminate\Validation\ValidationException; 
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use \Illuminate\Auth\Access\AuthorizationException; 
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use \Symfony\Component\HttpKernel\Exception\HttpException;
use \Illuminate\Database\QueryException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that should not be reported.
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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($exception->getModel()));
            return $this->notFoundResponse('Model is not found');
        }

        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->insufficientPrivilegesResponse($exception->getMessage()); 
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->notFoundResponse('The specified URL cannot be found'); 
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->notAllowedHttpResponse('The specified method for the request is invalid'); 
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage()); 
        }

        if ($exception instanceof QueryException) {
            //dd($exception);
            $errorCode = $exception->errorInfo[1]; 
        
            switch ($errorCode) {
                case 1062:
                    return $this->notAcceptQueryResponse('The resource is available');
                    break;
                case 1451: 
                    return $this->notAcceptQueryResponse('Cannot remove this resource permanently. It is related with any other resource');
                    break; 
                default:
                    return $this->notAcceptQueryResponse('Something error with your query. Try again', $exception->getMessage());
                    break;
            }
        }

        if(config('app.debug')) {
            return parent::render($request, $exception);
        }

        return $this->unexpectedExceptionResponse('Unexpected exception. Try later', $exception->getMessage());
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->unauthenticatedResponse('Unauthenticated');
    }

        /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        return $this->validationErrorResponse($errors);
    }
}
