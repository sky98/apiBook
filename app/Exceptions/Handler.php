<?php

namespace App\Exceptions;


use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
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
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof MethodNotAllowedHttpException)
            return $this->errorResponse(405, 'Method not allowed');

        if($exception instanceof NotFoundHttpException)
            return $this->errorResponse(404, 'Not Found');
            
        if($exception instanceof ModelNotFoundException)
            return $this->errorXML();
            
        return parent::render($request, $exception);
    }

    protected function errorResponse($status, $message)
    {
        return response()->json([
                'status'        => 'error',
                'response code' =>  $status,
                'data'          =>  null,
                'message'       =>  $message,
            ],$status);
    }

    protected function errorXML(){
        $xml = "<?xml version='1.0' encoding='utf-8' standalone='yes' ?>\n";
        $xml .= "<Libros>\n";
        $xml .= "   Error libro no encontrado\n";
        $xml .= "</Libros>\n";
        return response($xml,404)->header("Content-type","text/xml");
    }
}
