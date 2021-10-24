<?php

namespace Vagrant\Tree;

use Vagrant\Tree\Support\ServiceProvider;

class Application
{
    private $providers = [];

    public function __construct($providers = [])
    {
        $this->providers = $providers;
        array_walk($this->providers, fn ($providers) => $providers->register());
    }

    public function boot()
    {
        array_walk($this->providers, fn($provider) => $provider->boot());
    }
}