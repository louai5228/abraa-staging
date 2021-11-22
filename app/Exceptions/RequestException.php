<?php

namespace App\Exceptions;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Exception;
use Throwable;

class RequestException extends Exception
{
    protected $message;
    protected $detailed_error;
    protected $code;
    protected $isLogin;

    public function __construct($message = "",$detailed_error = null, $code = 400,$isLogin = false, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
        $this->detailed_error = $detailed_error;
        $this->code = $code;
        $this->isLogin = $isLogin;
    }

    public function render(Request $request)
    {
        return response()->json(Helpers::createErrorResponse(json_decode($this->message,true),$this->detailed_error,$this->code,$this->isLogin), $this->code);
    }
}
