<?php
namespace Controllers;

use \Models\Utils;
use \Models\Response;
use \Models\Link;
use \Models\Comentario;

class MainC {
  public static function addLink($data) {
    $fields = ['url', 'desc'];
    if (!Utils::validateData($data, $fields)) {
      return Response::BadRequest(Utils::implodeFields($fields));
    }
    $url = Link::where('url', $data['url'])->count();
    if ($url > 0) {
      return Response::Unauthorized('url duplicado', 'Al parecer ya compartieron ese Link.');
    }
    $url = Link::create([
      'url'   => $data['url'],
      'dsc'   => $data['desc'],
      'fecha' => date('Y-m-d'),
      'hora'  => date('h:i:s')
    ]);
    return Response::OK('ok', 'Gracias por compartir tu link', $url);
  }
  public static function addComment($data) {
    $fields = ['username', 'content', 'linkId'];
    if (!Utils::validateData($data, $fields)) {
      return Response::BadRequest(Utils::implodeFields($fields));
    }
    $link = Link::find($data['linkId']);
    if (!$link) {
      return Response::BadRequest('No existe el id: '.$data['linkId']);
    }
    $comment = $link->comentarios()->create([
      'username'  => $data['username'],
      'cont'      => $data['content'],
      'fecha'     => date('Y-m-d'),
      'hora'      => date('h:i:s')
    ]);
    return Response::OK('ok', 'Gracias por su comentario', $comment);
  }
  public static function getLinks() {
    $links = Link::orderBy('id', 'desc')->withCount('comentarios')->get();
    return Response::OK('ok', 'lista de links obetenidos', $links);
  }
  public static function getLinkDetails($id) {
    $link = Link::find($id);
    if (!$link) {
      return Response::BadRequest('no existe el id: '.$id);
    }
    $link->comentarios;
    return $link;
  }
}