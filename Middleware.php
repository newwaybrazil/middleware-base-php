<?php

namespace App\Middlewares;

abstract class Middleware
{
    private $next;

    public function setNext(
        Middleware $middleware
    ): Middleware {
        $this->next = $middleware;
        return $middleware;
    }

    public function handle(
        array $data
    ): array {
        if ($this->next) {
            return $this->next->handle(
                $data
            );
        }
        return $data;
    }

    public function setStep(
        array $data,
        string $step
    ): array {
        $data['step'][] = $step;
        return $data;
    }
}