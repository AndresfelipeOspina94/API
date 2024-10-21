<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Usuarios extends REST_Controller
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
    ------------- Usuarios -------------
    ----------------------------------*/
    function listado_get($cantidad=null,$offset=null,$random=null)
    {
      if($cantidad=="todos"){
        $cantidad=null;
        $offset=null;
      }
      $users = $this->doctrine->em->getRepository("Entities\\Usuario")->traerTodosOrdenadoPorId($cantidad,$offset,FALSE);
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
    //---------------------------
    //---Agregar Usuario---
    //---------------------------
    function usuario_post()
    {
      //-------------------------------
      //Recoge datos de petición POST
      $datos=(object)$this->post('usuario');
      //-------------------------------
      $token=md5(time());
      //--------------------------------------------------
      $usuario = $this->doctrine->em->getRepository("Entities\\Usuario")->agregarUsuario($datos,$token);
      //----------------------------------------------
      $key=$this->doctrine->em->getRepository("Entities\\Keys")->agregar($token);
      //----------------------------------------------
      $respuesta=array('datos'=>$datos);
      $this->response($respuesta, 200);
      //--------------------------------------
    }
    //---------------------------
    //---Modoficar Usuario---
    //---------------------------
    function usuario_put()
    {
      //--------------------------------------------------
      $datos=(object)$this->put('usuario');
      $usuario = $this->doctrine->em->getRepository("Entities\\Usuario")->actualizarUsuario($datos->id,$datos);
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
    //---Eliminar usuario---
    //---------------------------
    function usuario_delete($id_usuario)
    {
      //--------------------------------------------------
      $usuario = $this->doctrine->em->getRepository("Entities\\Usuario")->findOneBy(["id" => $id_usuario]);
      $this->doctrine->em->remove($usuario);
      //----------------------------------------------
      //----------------------------------------------
      if(empty($usuario)){
        $usuario=null;
      }
      $respuesta=array('datos'=>$usuario);
      $this->doctrine->em->flush();
      $this->response($respuesta, 200);
      //--------------------------------------
    }
    //---------------------------
    //---Iniciar Sesión---
    //---------------------------
    function iniciarsesion_post()
    {
      //--------------------------------------------------
      $email=$this->post('email');
      $password=md5($this->post('password'));
      $usuario = $this->doctrine->em->getRepository("Entities\\Usuario")->iniciarSesion($email,$password);
      //----------------------------------------------
      //----------------------------------------------
      if(empty($usuario)){
        $usuario=null;
      }
      $respuesta=array('datos'=>$usuario);
      $this->response($respuesta, 200);
      //--------------------------------------
    }
    //----------------------------------------
    //-------Funciones
    function crearToken($dato){
      return md5($dato.time());
    }
    //---------------------------
    //Selectores de perfiles administrativos
    //---------------------------
    function perfiles_get($cantidad=null,$offset=null,$random=null)
    {
        //Determinar cantidad y offset
        if($cantidad=="todos"){
          $cantidad=null;
          $offset=null;
        }
        //---------------------
        $perfil = $this->doctrine->em->getRepository("Entities\\Usuario")->traerPerfilesOrdenadosPorId($cantidad,$offset,FALSE);
        //----------------------------------------------
        if(empty($perfil)){
          $perfil=null;
        }
        $respuesta=array('datos'=>$perfil);
       $this->response($respuesta, 200);
    }
}
?>
