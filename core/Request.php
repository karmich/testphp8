<?php

namespace Core;

class Request
{
    /**
     * Request constructor.
     * @param string $path
     * @param ParameterBag $query
     * @param ParameterBag $request
     * @param ParameterBag $headers
     * @param ParameterBag $cookies
     * @param array $files
     * @param ParameterBag $server
     */
    public function __construct(
        private string $path,
        private ParameterBag $query,
        private ParameterBag $request,
        private ParameterBag $headers,
        private ParameterBag $cookies,
        private array $files,
        private ParameterBag $server,
    ){}

    public static function createFromGlobals(): Request
    {
        return new self(
            $_SERVER['PATH_INFO'] ?? "/",
            new ParameterBag($_GET),
            new ParameterBag($_POST),
            new ParameterBag(self::getHeaders()),
            new ParameterBag($_COOKIE),
            $_FILES,
            new ParameterBag($_SERVER)
        );
    }

    private static function getHeaders(): array
    {
        $result = [];

        foreach ($_SERVER as $key => $value) {
            if (!str_starts_with($key, 'HTTP_')) {
                continue;
            }

            $prepared = ucfirst(strtolower(substr($key, 5)));
            $result[$prepared] = $value;
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array|ParameterBag
     */
    public function getQuery(): array|ParameterBag
    {
        return $this->query;
    }

    /**
     * @return array|ParameterBag
     */
    public function getRequest(): array|ParameterBag
    {
        return $this->request;
    }

    /**
     * @return array|ParameterBag
     */
    public function getCookies(): array|ParameterBag
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
     * @return array|ParameterBag
     */
    public function getServer(): array|ParameterBag
    {
        return $this->server;
    }
}