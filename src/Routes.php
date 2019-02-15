<?php

namespace Kernel;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use \Slim\App;

$app = new App();
$app->get('/', function (RequestInterface $req,  ResponseInterface $res, $args = []) {
    return $res->withStatus(500)->write('Teste');
});