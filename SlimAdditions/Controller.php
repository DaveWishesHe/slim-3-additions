<?php

namespace SlimAdditions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Controller
{
    protected $request;
    protected $response;
    protected $params = array();

    public function __construct(\Slim\Container $container)
    {
        $this->request = $container['request'];
        $this->response = $container['response'];
    }

    protected function header($header, $value = null)
    {
        if (is_null($value)) {
            return $this->request->getHeader($header);
        } else {
            $this->response = $this->response->withHeader($header, $value);
        }
    }

    protected function params($param = null)
    {
        if (empty($this->params)) {
            $query_string = $this->request->getQueryParams();
            $body = $this->request->getParsedBody();
            $body = !is_null($body) ? $body : array();
            $this->params = array_merge($query_string, $body);
        }

        return is_null($param) ? $this->params : $this->params[$param];
    }

    public function render($data, $status = 200, $encoding_options = 0)
    {
        return is_null($data) ? $this->response->withStatus($status) : $this->response->withJson($data, $status, $encoding_options);
    }
}
