<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Textorotativo extends REST_Controller
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
  ------------- Texto rotativo -------------
  ----------------------------------*/
  function listado_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\TextoRotativo")->traerTodosActivosOrdenadosPorId($cantidad,$offset,FALSE);
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
  ------------- Texto rotativo Apptv -------------
  ----------------------------------*/
  function listado2_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\TextoRotativo")->traerTodosActivosOrdenadosPorIdApptv($cantidad,$offset,FALSE);
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
  //-------------------------
  //---Agregar textoRotativo---
  //-------------------------
  function textoRotativo_post()
  {
    //-------------------------------
    //Recoge datos de petición POST
    $datos=(object)$this->post('textoRotativo');
    //-------------------------------
    //--------------------------------------------------
    $textoRotativo = $this->doctrine->em->getRepository("Entities\\TextoRotativo")->agregar($datos);
    //----------------------------------------------
    //----------------------------------------------
    $respuesta=array('datos'=>$datos);
    $this->response($respuesta, 200);
    //--------------------------------------
  }

  //---------------------------
  //---Modoficar textoRotativo---
  //---------------------------
  function textoRotativo_put()
  {
    //--------------------------------------------------
    $datos=(object)$this->put('textoRotativo');
    $textoRotativo = $this->doctrine->em->getRepository("Entities\\TextoRotativo")->actualizar($datos->id,$datos);
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
  //---Eliminar textoRotativo---
  //---------------------------
  function textoRotativo_delete($id_textoRotativo)
  {
    //--------------------------------------------------
    $textoRotativo = $this->doctrine->em->getRepository("Entities\\TextoRotativo")->findOneBy(["id" => $id_textoRotativo]);
    $this->doctrine->em->remove($textoRotativo);
    //----------------------------------------------
    //----------------------------------------------
    if(empty($textoRotativo)){
      $textoRotativo=null;
    }
    $respuesta=array('datos'=>$textoRotativo);
    $this->doctrine->em->flush();
    $this->response($respuesta, 200);
    //--------------------------------------
  }
}
?>
