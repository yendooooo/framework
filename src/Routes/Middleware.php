<?php

namespace Vagrant\tree\Routes;

abstract class Middleware
{
    abstract public static function process();
}