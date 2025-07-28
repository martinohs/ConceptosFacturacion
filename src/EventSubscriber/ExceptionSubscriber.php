<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly Environment $twig,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', -10],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        //TODO -> debería haber un check del entorno.. 
        // return; //-> descomentar para ver los mensajes de error en dev.

        $throwable = $event->getThrowable();
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        $template = 'error/500.html.twig';

        if ($throwable instanceof HttpExceptionInterface) {
            $statusCode = $throwable->getStatusCode();
            $customTemplate = '';
            if ($statusCode === 500 ){
                $customTemplate = "error/500.html.twig";
            } else {
                $customTemplate = "error/40X.html.twig";
            }
            if ($this->twig->getLoader()->exists($customTemplate)) {
                $template = $customTemplate;
            }
        }
        
        $response = new Response(
            $this->twig->render($template, [
                'exception' => $throwable, 
                'statusCode' =>$statusCode]),
            $statusCode
        );

        $event->setResponse($response);
    }
}