<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Feeds extends REST_Controller
{
  public function __construct($config = 'rest')
  {
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      //header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
      header("Access-Control-Allow-Origin: *");
      header('Access-Control-Allow-Credentials: true');
      // header('Access-Control-Request-Headers: x-requested-with');
      header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
          header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
          header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

      exit(0);
    }
    //
    parent::__construct();
  }
  /* ---------------------------------
  ------------- Feeds -------------
  ----------------------------------*/
  function listado_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\Feeds")->traerFeeds($cantidad,$offset,FALSE);
    if( !empty($listado))
    {
      $respuesta=array('numero_filas'=>count($listado),'listado'=>$listado);
    }
    else
    {
        $respuesta=array('numero_filas'=>count($listado),'listado'=>null);
    }
    // echo json_encode($users);
    $this->response($respuesta, 200);
  }

  /* ---------------------------------
  ------------- Feeds Consumidos AppTV-------------
  ----------------------------------*/
  function listado2_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\Feeds")->traerFeeds($cantidad,$offset,FALSE);
    $listado2=array();
    /* Ciclo para consumir cada XML */
    foreach ($listado as $value) {
      $xmlfile = $value['url'];
      $file_headers = @get_headers($value['url']);
      if($file_headers && $file_headers[0] != 'HTTP/1.0 404 Not Found'){
        $content = file_get_contents($value['url']);
        $feeds = new SimpleXMLElement($content);
        foreach ($feeds->channel->item as $itemfeed) {
          $asunto=(string)$itemfeed->title;
          $descripcion=(string)$itemfeed->description;
          $descripcion=str_replace("&nbsp;","",$descripcion);
          array_push($listado2,array("asunto"=>$asunto,"descripcion"=>$descripcion));
        }
      }
    }
    $respuesta=array('numero_filas'=>count($listado2),'listado'=>$listado2);
    $this->response($respuesta, 200);
  }

  //-------------------------
  //---Agregar feeds---
  //-------------------------
  function feeds_post()
  {
    //-------------------------------
    //Recoge datos de petición POST
    $datos=(object)$this->post('feeds');
    //-------------------------------
    //--------------------------------------------------
    $feeds = $this->doctrine->em->getRepository("Entities\\Feeds")->agregar($datos);
    //----------------------------------------------
    //----------------------------------------------
    $respuesta=array('datos'=>$datos);
    $this->response($respuesta, 200);
    //--------------------------------------
  }

  //---------------------------
  //---Modoficar feeds---
  //---------------------------
  function feeds_put()
  {
    //--------------------------------------------------
    $datos=(object)$this->put('feeds');
    $feeds = $this->doctrine->em->getRepository("Entities\\Feeds")->actualizar($datos->id,$datos);
    //----------------------------------------------
    //----------------------------------------------
    // if(empty($usuario)){
    //   $usuario=null;
    // }
    $respuesta=array('datos'=>$datos);
    $this->response($respuesta, 200);
    //--------------------------------------
  }
  //---------------------------
  //---Eliminar feeds---
  //---------------------------
  function feeds_delete($id_feeds)
  {
    //--------------------------------------------------
    $feeds = $this->doctrine->em->getRepository("Entities\\Feeds")->findOneBy(["id" => $id_feeds]);
    $this->doctrine->em->remove($feeds);
    //----------------------------------------------
    //----------------------------------------------
    if(empty($feeds)){
      $feeds=null;
    }
    $respuesta=array('datos'=>$feeds);
    $this->doctrine->em->flush();
    $this->response($respuesta, 200);
    //--------------------------------------
  }
}
?>
