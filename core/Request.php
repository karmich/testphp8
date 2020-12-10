<?php

namespace Core;

class Request
{
    /**
     * Request constructor.
     * @param string $path
     * @param array $query
     * @param array $request
     */
    public function __construct(
        private string $path,
        private array $query,
        private array $request,
    ){}

    public static function createFromGlobals(): Request
    {
        return new self($_SERVER['PATH_INFO'] ?? "/", $_GET, $_POST);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * @return array
     */
    public function getRequest(): array
    {
        return $this->request;
    }
}