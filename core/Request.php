<?php

namespace Core;

class Request
{
    /**
     * Request constructor.
     * @param string $path
     * @param array $query
     * @param array $request
     * @param array $cookies
     * @param array $files
     * @param array $server
     */
    public function __construct(
        private string $path,
        private array $query,
        private array $request,
        private array $cookies,
        private array $files,
        private array $server,
    ){}

    public static function createFromGlobals(): Request
    {
        return new self($_SERVER['PATH_INFO'] ?? "/", $_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
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

    /**
     * @return array
     */
    public function getCookie(): array
    {
        return $this->cookies;
    }

    /**
     * @return array
     */
    public function getCookies(): array
    {
        return $this->cookies;
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @return array
     */
    public function getServer(): array
    {
        return $this->server;
    }
}