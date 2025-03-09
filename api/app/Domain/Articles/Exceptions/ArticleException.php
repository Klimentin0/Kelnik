<?php

namespace App\Domain\Articles\Exceptions;

use Exception;

class ArticleException extends Exception
{
    public function __construct(string $message = 'Article error occurred', int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
