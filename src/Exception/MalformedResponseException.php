<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Exception;

use Answear\SpeedyBundle\Response\ErrorResponse;

class MalformedResponseException extends \RuntimeException
{
    /**
     * @var ErrorResponse|mixed
     */
    private $response;

    public function __construct(string $message, $response, ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);

        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
