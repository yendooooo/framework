<?php
require_once './vendor/autoload.php';
use Vagrant\Tree\Database\Adapter;

Adapter::setup('mysql:dbname=tree', 'homestead', 'secret');




