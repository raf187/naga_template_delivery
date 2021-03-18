<?php

namespace App\Http\Controllers\PayGreenController\Exceptions;

class NotSucceedException extends PaygreenException {
    /**
     * @var string $url
     */
    private $url;
    /**
     * @var mixed $response
     */
    private $response;

    public function __construct($message = "", $url = null, $response = null)
    {
        parent::__construct($message);
        $this->url = $url;
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getResponse(): array
    {
        return $this->response;
    }
}
