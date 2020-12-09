<?php


namespace Core;


class Response
{


    /**
     * Response constructor.
     * @param string $body
     * @param int $code
     * @param array $headers
     */
    public function __construct(
        public string $body = '',
        public int $code = 200,
        public array $headers = []
    ){}

    public function send(){
        foreach ($this->headers as $header => $value) {
            header("$header: $value");
        }
        http_response_code($this->code);
        echo $this->body;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }
}