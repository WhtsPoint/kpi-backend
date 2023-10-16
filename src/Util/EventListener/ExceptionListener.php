<?php

namespace App\Util\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function __construct(
        protected LoggerInterface $logger
    ) {}

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response = new Response();

        if ($exception instanceof HttpExceptionInterface) {
            $error = $exception->getMessage();
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $this->logger->error($exception);
            $error = 'Internal error';
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $code = $exception->getCode();
        $message = ['error' => $error];

        if ($code !== 0) $message['code'] = $code;

        $response->setContent(
            json_encode($message)
        );

        $response->headers->set('Content-Type', 'application/problem+json');

        $event->setResponse($response);
    }
}