<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Chats extends REST_Controller
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
  ------------- Todos Chats Agrupados-------------
  ----------------------------------*/
  function listado_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\Chats")->traerTodosOrdenadoPorIdAgrupados($cantidad,$offset,TRUE);
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
  ------------- Traer  Chats por Paciente -----------
  ------------ Paciente Apptv -----------------------
  ----------------------------------*/

  function pacientechat_get($idpaciente,$idsesion)
  {
    // //--------------------------------------------------
    $chat = $this->doctrine->em->getRepository("Entities\\Chats")->traerChatsPorIdPaciente($idpaciente,$idsesion);
    // //----------------------------------------------
    if(empty($chat)){
      $chat=null;
    }
    // print_r($queryRespuesta);
    $respuesta=array('datos'=>$chat);
    $this->response($chat, 200);
  }

  /* ---------------------------------
  ------------- Traer  Chats por Admin -----------
  ------------ Admin Apptv -----------------------
  ----------------------------------*/
  function adminchat_get($idsesion)
  {
    // //--------------------------------------------------
    $chat = $this->doctrine->em->getRepository("Entities\\Chats")->traerChatsPorIdAdmin($idsesion);
    // //----------------------------------------------
    if(empty($chat)){
      $chat=null;
    }
    // print_r($queryRespuesta);
    $respuesta=array('datos'=>$chat);
    $this->response($chat, 200);
  }

  //-------------------------
  //---Agregar Chats---
  //-------------------------
  function chat_post()
  {
    //-------------------------------
    //Recoge datos de petición POST
    $meta = $_POST;
    $datos=(object)$meta['datos'];
    if(!empty($_FILES)){
      $filename = $_FILES['file']['name'];

      $filetype = $_FILES['file']['type'];
      $tipo_archivo = explode(".",$filename);
      $prefijo = substr(md5(uniqid(rand())),0,6);
      $nombre_file = $tipo_archivo[0]."_".$prefijo."_".date("y-m-d").".".$tipo_archivo[1];
      $archivo = $_SERVER['DOCUMENT_ROOT']."/".MEDIADIRECTORIO."chat/".$nombre_file;
      move_uploaded_file($_FILES['file']['tmp_name'] , $archivo);

      $daticos = array(
       'id_sesion' => $datos->id_sesion,
       'id_paciente'=>$datos->id_paciente,
       'mensaje'=>$datos->mensaje,
       'foto' =>$nombre_file,
       'visto'=>$datos->visto,
       'id_admin'=>$datos->id_admin,
      );
    }else{
      $daticos = array(
       'id_sesion' => $datos->id_sesion,
       'id_paciente'=>$datos->id_paciente,
       'mensaje'=>$datos->mensaje,
       'visto'=>$datos->visto,
       'id_admin'=>$datos->id_admin,
      );
    }
    //-------------------------------

    //--------------------------------------------------
    $chat = $this->doctrine->em->getRepository("Entities\\Chats")->agregar((object)$daticos);
    //----------------------------------------------
    //----------------------------------------------
    $respuesta=array('datos'=>$datos);
    $this->response($respuesta, 200);
    //--------------------------------------
  }

  //---------------------------
  //---Modoficar Chats---
  //---------------------------
  function chat_put()
  {
    //--------------------------------------------------
    $datos=(object)$this->put('chats');

    $daticos = array(
     'id_sesion' => $datos->sesion,
     'id_paciente'=>$datos->paciente,
     'mensaje'=>$datos->mensaje,
     'visto'=>1,
     'id_admin'=>$datos->admin,

    );
    $chat = $this->doctrine->em->getRepository("Entities\\Chats")->actualizar($datos->id,(object)$daticos);
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
  //---Modoficar Chats---
  //---------------------------
  function chat2_put()
  {
    //--------------------------------------------------
    $datos=(object)$this->put('chats');
    //print_r($datos);
    $daticos = array(
     'id_sesion' => $datos->id_sesion,
     'visto'=>1,
     'id_admin'=>0,

    );
    $chat = $this->doctrine->em->getRepository("Entities\\Chats")->actualizar2((object)$daticos);
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
  //---Eliminar Chats---
  //---------------------------
  function chat_delete($id_paciente)
  {
    //--------------------------------------------------
    $chat = $this->doctrine->em->getRepository("Entities\\Chats")->findOneBy(["id" => $id_paciente]);
    $this->doctrine->em->remove($chat);
    //----------------------------------------------
    //----------------------------------------------
    if(empty($chat)){
      $chat=null;
    }
    $respuesta=array('datos'=>$chat);
    $this->doctrine->em->flush();
    $this->response($respuesta, 200);
    //--------------------------------------
  }


}
?>
