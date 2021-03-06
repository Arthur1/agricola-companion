<?php

namespace App\Exceptions;

use Exception;

class InvalidActionException extends Exception
{
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return response()->json(
            [
                'message' => $this->message
            ],
            422
        );
    }
}
