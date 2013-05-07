<?php

/**
* 
*/
class Response
{
    public function redirect ($uri) {
        header("Location: $uri");
        exit;
    }
}

/**
* 
*/
class Request
{
    public $uri;

    public function __construct()
    {
        $this->uri = reset(explode('?', $_SERVER['REQUEST_URI']));
    }
}
