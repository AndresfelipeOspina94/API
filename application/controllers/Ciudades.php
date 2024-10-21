<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Ciudades extends REST_Controller
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
    //--------------------------------
    //-------Ciuadaes-----------------
    //--------------------------------
    function prueba_get($cantidad=null,$random=null)
    {
      print_r($this->doctrine->em);
    }
    //---------------------------
    //---Listado ciudad---
    //---------------------------
    function listado_get($cantidad=null,$offset=null,$random=null)
    {
      if($cantidad=="todos"){
        $cantidad=null;
        $offset=null;
      }
      $users = $this->doctrine->em->getRepository("Entities\\Ciudad")->traerTodosOrdenadoPorId($cantidad,$offset,FALSE);
      if( !empty($users))
      {
        $respuesta=array('numero_filas'=>count($users),'listado'=>$users);
      }
      else
      {
          $respuesta=array('numero_filas'=>count($users),'listado'=>null);
      }
      // echo json_encode($users);
      $this->response($respuesta, 200);
    }
    //-----------------------
    //---Agregar ciudad------
    //-----------------------
    function ciudad_post()
    {
      //-------------------------------
      //Recoge datos de petición POST
      $datos=(object)$this->post('ciudad');
      //-------------------------------
      //--------------------------------------------------
      $usuario = $this->doctrine->em->getRepository("Entities\\Ciudad")->agregar($datos);
      //----------------------------------------------
      //----------------------------------------------
      $respuesta=array('datos'=>$datos);
      $this->response($respuesta, 200);
      //--------------------------------------
    }
    //---------------------------
    //---Modoficar ciudad---
    //---------------------------
    function ciudad_put()
    {
      //--------------------------------------------------
      $datos=(object)$this->put('ciudad');
      $ciudad = $this->doctrine->em->getRepository("Entities\\Ciudad")->actualizar($datos->id,$datos);
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
    //---Eliminar ciudad---
    //---------------------------
    function ciudad_delete($id_ciudad)
    {
      //--------------------------------------------------
      $ciudad = $this->doctrine->em->getRepository("Entities\\Ciudad")->findOneBy(["id" => $id_ciudad]);
      $this->doctrine->em->remove($ciudad);
      //----------------------------------------------
      //----------------------------------------------
      if(empty($ciudad)){
        $ciudad=null;
      }
      $respuesta=array('datos'=>$ciudad);
      $this->doctrine->em->flush();
      $this->response($respuesta, 200);
      //--------------------------------------
    }
    //---------------------------
    //Selectores de departamento
    //---------------------------
    function departamentos_get($cantidad=null,$offset=null,$random=null)
    {
        //Determinar cantidad y offset
        if($cantidad=="todos"){
          $cantidad=null;
          $offset=null;
        }
        //---------------------
        $queryRespuesta = $this->doctrine->em->getRepository("Entities\\Departamento")->traerDepartamentosOrdenadasPorNombre($cantidad,$offset,FALSE);
        //----------------------------------------------
        if(empty($queryRespuesta)){
          $queryRespuesta=null;
        }
        // print_r($queryRespuesta);
        $respuesta=array('datos'=>$queryRespuesta);
       $this->response($queryRespuesta, 200);
    }
}
?>
