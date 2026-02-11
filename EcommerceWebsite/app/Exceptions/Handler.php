<?php 

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            Log::warning('Page not found: ' . $request->url());
            return response()->view('errors.404', [], 404); 
        }

        return parent::render($request, $exception);
    }
}
