<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
require_once './vendor/autoload.php';

use Vagrant\Tree\Routes\Route;
use Vagrant\Tree\Routes\Middleware;
use Vagrant\Tree\Database\Adapter;

Adapter::setup('mysql:dbname=tree', 'homestead', 'secret');

class HelloMiddleware extends Middleware
{
    public static function porcess()
    {
        return false;
    }
}

Route::add('get', '/', function(){
    echo 'Hello World';
}, [ HelloMiddleware::class ]);

Route::add('get', '/posts/{id}', function($id) {
    if($post = Adapter::getAll('SELECT * FROM posts WHERE `id` = ?', [$id])) {
        return var_dump($post);
    }
    http_response_code(404);
});

Route::run();
?>

</body>
</html>
