<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Tipodocumentos extends REST_Controller
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
    //-------Tipos Documentos-----------
    //--------------------------------
    function prueba_get($cantidad=null,$random=null)
    {
      print_r($this->doctrine->em);
    }
    //---------------------------
    //---Listado Tipos Documentos---
    //---------------------------
    function listado_get($cantidad=null,$offset=null,$random=null)
    {
      if($cantidad=="todos"){
        $cantidad=null;
        $offset=null;
      }
      $users = $this->doctrine->em->getRepository("Entities\\TipoDocumento")->traerTodosOrdenadoPorId($cantidad,$offset,FALSE);
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
    //---Agregar Tipos Documentos------
    //-----------------------
    function tipodocumento_post()
    {
      //-------------------------------
      //Recoge datos de petición POST
      $datos=(object)$this->post('tipodocumento');
      //-------------------------------
      //--------------------------------------------------
      $usuario = $this->doctrine->em->getRepository("Entities\\TipoDocumento")->agregar($datos);
      //----------------------------------------------
      //----------------------------------------------
      $respuesta=array('datos'=>$datos);
      $this->response($respuesta, 200);
      //--------------------------------------
    }
    //---------------------------
    //---Modoficar Tipos Documentos---
    //---------------------------
    function tipodocumento_put()
    {
      //--------------------------------------------------
      $datos=(object)$this->put('tipodocumento');
      $tipodocumento = $this->doctrine->em->getRepository("Entities\\TipoDocumento")->actualizar($datos->id,$datos);
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
    //---Eliminar Tipos Documentos---
    //---------------------------
    function tipodocumento_delete($id_departamento)
    {
      //--------------------------------------------------
      $tipodocumento = $this->doctrine->em->getRepository("Entities\\TipoDocumento")->findOneBy(["id" => $id_departamento]);
      $this->doctrine->em->remove($tipodocumento);
      //----------------------------------------------
      //----------------------------------------------
      if(empty($tipodocumento)){
        $tipodocumento=null;
      }
      $respuesta=array('datos'=>$tipodocumento);
      $this->doctrine->em->flush();
      $this->response($respuesta, 200);
      //--------------------------------------
    }


}
?>
