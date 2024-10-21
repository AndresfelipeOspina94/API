<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Pacientes extends REST_Controller
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
    $listado = $this->doctrine->em->getRepository("Entities\\Pacientes")->traerTodosActivosOrdenadosPorId($cantidad,$offset,FALSE);
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
  //---Agregar Pacientes---
  //-------------------------
  function paciente_post()
  {
    //-------------------------------
    //Recoge datos de petición POST
    $datos=(object)$this->post('paciente');
    //-------------------------------
    //--------------------------------------------------
    $paciente = $this->doctrine->em->getRepository("Entities\\Pacientes")->agregar($datos);
    //----------------------------------------------
    //----------------------------------------------
    $respuesta=array('datos'=>$datos);
    $this->response($respuesta, 200);
    //--------------------------------------
  }

  //---------------------------
  //---Modoficar Pacientes---
  //---------------------------
  function paciente_put()
  {
    //--------------------------------------------------
    $datos=(object)$this->put('paciente');
    $paciente = $this->doctrine->em->getRepository("Entities\\Pacientes")->actualizar($datos->id,$datos);
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
  //---Eliminar Pacientes---
  //---------------------------
  function paciente_delete($id_paciente)
  {
    //--------------------------------------------------
    $paciente = $this->doctrine->em->getRepository("Entities\\Pacientes")->findOneBy(["id" => $id_paciente]);
    $this->doctrine->em->remove($paciente);
    //----------------------------------------------
    //----------------------------------------------
    if(empty($paciente)){
      $paciente=null;
    }
    $respuesta=array('datos'=>$paciente);
    $this->doctrine->em->flush();
    $this->response($respuesta, 200);
    //--------------------------------------
  }

  // //----------------------
  // //---Búsqueda Pacientes
  // //----------------------
  // function busqueda_get($busqueda=null,$random=null)
  // {
  //   $paciente = $this->doctrine->em->getRepository("Entities\\Pacientes")->busquedaOrdenadaPorId($busqueda,FALSE);
  //   if( !empty($paciente))
  //   {
  //     $respuesta=array('numero_filas'=>count($paciente),'listado'=>$paciente);
  //   }
  //   else
  //   {
  //       $respuesta=array('numero_filas'=>count($paciente),'listado'=>null);
  //   }
  //   $this->response($respuesta, 200);
  // }

}
?>
