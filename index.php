<?php
require_once './vendor/autoload.php';

use Vagrant\Tree\Routes\Route;
use Vagrant\Tree\Routes\Middleware;
use Vagrant\Tree\Database\Adaptor;
use Vagrant\Tree\Session\DatabaseSessionHandler;

/**
 * 1. 데이터베이스 연결
 * 2. 세션 켜는 일
 * 3. 에러 핸들러 등록하기
 * 4. 환경 설정하기
 */



Adaptor::setup('mysql:dbname=tree', 'homestead', 'secret');

session_set_save_handler(new DatabaseSessionHandler());
session_start();

$_SESSION['message'] = 'hello world';
$_SESSION['foo'] = new stdClass();

/*
 *
 *
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
    if($post = Adaptor::getAll('SELECT * FROM posts WHERE `id` = ?', [$id])) {
        return var_dump($post);
    }
    http_response_code(404);
});

Route::run();
*/

