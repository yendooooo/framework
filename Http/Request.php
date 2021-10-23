<?php

namespace Vagrant\Tree\Http;

class Request 
{
    public static function getMethod()
    {
        return filter_input(INPUT_POST, '_method') ?: $_SERVER['REQEUST_METHOD'];
    }
}