<?php

namespace Vagrant\Tree\Routes;

class RequestContext 
{
    public $method;
    public $path;
    public $handler;
    public $middlewares;

    public function __construct($method, $path, $handler, $middlewares = [])
    {
        $this->method = $method; // get, post
        $this->path = $path; // '/'
        $this->handler = $handler; // callback func
        $this->middlewares = $middlewares; 
    }

    /**
     * 
     * ex ) $this->path = /posts/{id} => /posts/1;
     */
    public function match($url)
    {
        $urlParts = explode('/', $url);
        $urlPartternParts = explode('/', $this->path);
    
        if(count($urlParts) === count($urlPartternParts)) {
            $urlParams = [];

            foreach($urlPartternParts as $key => $part) {
            
                if(preg_match('/^\{.*\}$/', $part)) {
                    $urlParams[$key] = $part;
                }else {
                    // 
                    if($urlParts[$key] !== $part) {
                        return null;
                    }
                }
            }

            return count($urlParams) < 1 ? 
                [] : 
                array_map(fn ($k) => $urlParts[$k], array_keys($urlParams))
            ;
        }
    }

    public function runMiddlewares()
    {
        foreach($this->middlewares as $middleware) {
            if(! $middleware::process()) {
                return false;
            }
        }
        return true;
    }
}