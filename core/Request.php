<?php

namespace Core;

class Request
{
    /**
     * Request constructor.
     * @param string $path
     */
    public function __construct(
        private string $path
    ){}

    public static function createFromGlobals(): Request
    {
        return new self($_SERVER['PATH_INFO'] ?? "/");
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}