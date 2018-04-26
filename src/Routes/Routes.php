<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Controllers\MainC;

$app->get('/', function (Request $req, Response $res)
{
    return $res->withJson('Hello World');
});
$app->post('/link', function (Request $req, Response $res){
    $result = MainC::addLink($req->getParsedBody());
    return $res->withJson($result);
});
$app->post('/comment', function (Request $req, Response $res) {
    $result = MainC::addComment($req->getParsedBody());
    return $res->withJson($result);
});
$app->get('/links', function (Request $req, Response $res) {
    $result = MainC::getLinks();
    return $res->withJson($result);
});
$app->get('/link/{id}', function (Request $req, Response $res, $args) {
    $result = MainC::getLinkDetails($args['id']);
    return $res->withJson($result);
});