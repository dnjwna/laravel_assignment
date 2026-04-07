<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     * 
     * Di sini kita mendaftarkan global error handler.
     * Setiap jenis exception ditangkap dan diformat menjadi response JSON yang konsisten.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            // Hanya tangani request yang mengharapkan JSON (API request)
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->handleApiException($e, $request);
            }
        });
    }

    private function handleApiException(Throwable $e, $request)
    {
        if ($e instanceof ValidationException) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $e->errors(),
            ], 400);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized: Silakan login terlebih dahulu',
            ], 401);
        }

        if ($e instanceof ModelNotFoundException) {
            $model = class_basename($e->getModel());
            return response()->json([
                'status'  => 'error',
                'message' => "{$model} tidak ditemukan",
            ], 404);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Endpoint tidak ditemukan',
            ], 404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'status'  => 'error',
                'message' => 'HTTP method tidak diizinkan untuk endpoint ini',
            ], 405);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'Terjadi kesalahan pada server',
            // Tampilkan detail error hanya di mode development
            'detail'  => config('app.debug') ? $e->getMessage() : null,
        ], 500);
    }
}