<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Textoadministrable extends REST_Controller
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
  ------------- Texto Administrable -------------
  ----------------------------------*/
  function listado_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\TextoAdministrable")->traerTodosActivosOrdenadosPorId($cantidad,$offset,FALSE);
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
  //---Agregar Texto Administrable---
  //-------------------------
  function textoAdministrable_post()
  {
    //-------------------------------
    //Recoge datos de petición POST
    $datos=(object)$this->post('textoAdmin');
    //-------------------------------
    //--------------------------------------------------
    $textoAdministrable = $this->doctrine->em->getRepository("Entities\\TextoAdministrable")->agregar($datos);
    //----------------------------------------------
    //----------------------------------------------
    $respuesta=array('datos'=>$datos);
    $this->response($respuesta, 200);
    //--------------------------------------
  }

  //---------------------------
  //---Modoficar textoRotativo---
  //---------------------------
  function textoAdministrable_put()
  {
    //--------------------------------------------------
    $datos=(object)$this->put('textoAdmin');
    $textoAdministrable = $this->doctrine->em->getRepository("Entities\\TextoAdministrable")->actualizar($datos->id,$datos);
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
  function textoAdministrable_delete($id_textoAdmin)
  {
    //--------------------------------------------------
    $textoAdministrable = $this->doctrine->em->getRepository("Entities\\TextoAdministrable")->findOneBy(["id" => $id_textoAdmin]);
    $this->doctrine->em->remove($textoAdministrable);
    //----------------------------------------------
    //----------------------------------------------
    if(empty($textoAdministrable)){
      $textoAdministrable=null;
    }
    $respuesta=array('datos'=>$textoAdministrable);
    $this->doctrine->em->flush();
    $this->response($respuesta, 200);
    //--------------------------------------
  }


}
?>
