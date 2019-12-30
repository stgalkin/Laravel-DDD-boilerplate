<?php
namespace App\Assembly\Exceptions;

/**
 * Class NotFoundException
 * @package App\Assembly\Exceptions
 */
class NotFoundException extends \Exception
{
    /**
     * @inheritDoc
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
