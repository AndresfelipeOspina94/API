<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Perfiles extends REST_Controller
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
    //-------Perfiles-----------------
    //--------------------------------
    function listado_get($cantidad=null,$offset=null,$random=null)
    {
      if($cantidad=="todos"){
        $cantidad=null;
        $offset=null;
      }
      $users = $this->doctrine->em->getRepository("Entities\\PerfilAdministrativo")->traerTodosOrdenadoPorId($cantidad,$offset,FALSE);
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
    //---Agregar perfil------
    //-----------------------
    function perfil_post()
    {
      //-------------------------------
      //Recoge datos de petición POST
      $datos=(object)$this->post('perfil');
      //-------------------------------      
      //--------------------------------------------------      
      $usuario = $this->doctrine->em->getRepository("Entities\\PerfilAdministrativo")->agregar($datos);
      //----------------------------------------------
      //----------------------------------------------
      $respuesta=array('datos'=>$datos);
      $this->response($respuesta, 200);
      //--------------------------------------      
    }
    //---------------------------
    //---Modoficar perfil---
    //---------------------------
    function perfil_put()
    {
      //--------------------------------------------------
      $datos=(object)$this->put('perfil');
      $perfil = $this->doctrine->em->getRepository("Entities\\PerfilAdministrativo")->actualizar($datos->id,$datos);
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
    //---Eliminar perfil---
    //---------------------------
    function perfil_delete($id_perfil)
    {
      //--------------------------------------------------
      $perfil = $this->doctrine->em->getRepository("Entities\\PerfilAdministrativo")->findOneBy(["id" => $id_perfil]);
      $this->doctrine->em->remove($perfil);      
      //----------------------------------------------
      //----------------------------------------------
      if(empty($perfil)){
        $perfil=null;
      }
      $respuesta=array('datos'=>$perfil);
      $this->doctrine->em->flush();
      $this->response($respuesta, 200);
      //--------------------------------------
    }
}
?>
