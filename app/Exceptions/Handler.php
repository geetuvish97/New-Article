<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;
use Tymon\JWTAuth\Exceptions\InvalidClaimException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\PayloadException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function(Exception $e, $request) {
            return $this->handleException($request, $e);
        });
    }
    public function handleException($request, Exception $exception)
    {
        $config = config()->all();
        $refresh_ttl = $config['jwt']['refresh_ttl'];

        $message = new \stdClass;
        $message->message = __('validation.invalid_data');
        if ($exception instanceof InvalidClaimException) {
            $message->errors = [
                'jwt_token' => [__('jwt.jwt_auth')],
            ];
            return response()->json($message, 422);
        }

        if ($exception instanceof PayloadException) {
            $message->errors = [
                'jwt_token' => [__('validation.jwt_payload_factory')],
            ];
            return response()->json($message, 422);
        }

        if ($exception instanceof TokenBlacklistedException) {
            $message->token_blacklisted = 1;
            $message->errors = [
                'jwt_token' => [__('jwt.token_blacklisted')],
            ];
            return response()->json($message, 401);
        }

        if ($exception instanceof TokenExpiredException) {
            $dataRaw = explode(".", $request->bearerToken());
            $dataRaw = base64_decode($dataRaw[1]);
            $now = time();
            $dataRaw = json_decode($dataRaw);
            $tokenBlackListTime = ($dataRaw->iat) + ($refresh_ttl * 60);
            if ($tokenBlackListTime < $now) {
                $message->token_blacklisted = 1;
                $message->errors = [
                    'jwt_token' => [__('jwt.token_blacklisted')],
                ];
            } else {
                $message->jwt_expired = 1;
                $message->errors = [
                    'jwt_token' => [__('jwt.jwt_expired')],
                ];
            }
            return response()->json($message, 401);
        }

        if ($exception instanceof TokenInvalidException) {
            $message->errors = [
                'jwt_token' => [__('jwt.token_invalid')],
            ];
            return response()->json($message, 401);
        }

        if ($exception instanceof JWTException) {
            $message->errors = [
                'jwt_token' => [__('jwt.token_not_parsed')],
            ];
            return response()->json($message, 401);
        }
    }
}
