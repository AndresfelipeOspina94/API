<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Sesiones extends REST_Controller
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
  ------------- Sesiones  APP tv-------------
  ----------------------------------*/
  function listado_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\Sesiones")->traerTodosActivosOrdenadosPorId($cantidad,$offset,FALSE);
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
  ------------- Sesiones  APP tv-------------
  ----------------------------------*/
  function listado2_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\Sesiones")->traerTodosActivosOrdenadosPorIdTV($cantidad,$offset,FALSE);
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

  //---------------------------
  //Selectores de estado sesion
  //---------------------------
  function estados_get($cantidad=null,$offset=null,$random=null)
  {
      //Determinar cantidad y offset
      if($cantidad=="todos"){
        $cantidad=null;
        $offset=null;
      }
      //---------------------
      $queryRespuesta = $this->doctrine->em->getRepository("Entities\\Estadossesion")->traerEstadoActivosOrdenadosPorId($cantidad,$offset,FALSE);
      //----------------------------------------------
      if(empty($queryRespuesta)){
        $queryRespuesta=null;
      }
      // print_r($queryRespuesta);
      $respuesta=array('datos'=>$queryRespuesta);
     $this->response($queryRespuesta, 200);
  }

  //---------------------------
  //---Historial sesion---
  //---------------------------
  function historial_get($id)
  {
    // //--------------------------------------------------
    $historial = $this->doctrine->em->getRepository("Entities\\Historialsesion")->traerHistorialPorSesion($id);
    // //----------------------------------------------
    if(empty($historial)){
      $historial=null;
    }
    // print_r($queryRespuesta);
    $respuesta=array('datos'=>$historial);
    $this->response($historial, 200);
  }

  //---------------------------
  //---Cerrar sesion---
  //---------------------------
  function cerrarsesion_get($id_sesion)
  {
    // //--------------------------------------------------
    $cerrar = $this->doctrine->em->getRepository("Entities\\Sesiones")->SesionCerrar($id_sesion);
    // //----------------------------------------------
    // if(empty($cerrar)){
    //   $cerrar=null;
    // }
    if( !empty($cerrar))
    {
      $resultado=array('numero_filas'=>count($cerrar),'listado'=>$cerrar);
    }
    else
    {
        $resultado=array('numero_filas'=>count($cerrar),'listado'=>null);
    }
    // print_r($queryRespuesta);
    // $respuesta=array('datos'=>$resultado);
    // $this->response($respuesta, 200);
      $this->response($resultado, 200);
  }


  //-------------------------
  //---Agregar sesion---
  //-------------------------
  function sesion_post()
  {
    //-------------------------------
    //Recoge datos de petición POST
    $datos=(object)$this->post('sesion');
    //var_dump($datos);
    $paciente = $this->doctrine->em->getRepository("Entities\\Pacientes")->verificarPaciente($datos->cedula);
    // //--------------------------------------------------------------
    if (!empty($paciente)) {
      // //----------------------
      $sesionActiva= $this->doctrine->em->getRepository("Entities\\Sesiones")->verificarSesion($paciente[0]['id']);

      //  if ($datos->cedula == $paciente[0]['cedula'] || $datos->codigo == $sesionActiva[0]['codigo']  ) {
      //     var_dump("Paciente activo");
      //  }
      //----------------------
       if (!empty($sesionActiva) ) {
          // var_dump("Paciente activo");
          $datos='error1';
       }
       else{
           //-----------------------------
            $verificarCodigo= $this->doctrine->em->getRepository("Entities\\Sesiones")->verificarCodigo($datos->codigo);
            //-----------------------------------------------------
           if (!empty($verificarCodigo)) {
               // var_dump("codigo esta activo con otro paciente");
                $datos='error2';

           }else{
                 //var_dump("visita nueva y crear sesion");
                $daticos = array(
                 'paciente' => $paciente[0]['id'],
                 'codigo'=>$datos->codigo,
                 'detalle'=>$datos->detalle,
                 'estadoActual'=>$datos->estados_obj,
                 'activo'=>$datos->activo,
                );
                $sesion = $this->doctrine->em->getRepository("Entities\\Sesiones")->agregarSesion((object)$daticos);
                //----------------------------------
                $updatepaciente = $this->doctrine->em->getRepository("Entities\\Pacientes")->actualizar(1,$datos);
                //-----------------------------------
                $newSesion = $this->doctrine->em->getRepository("Entities\\Sesiones")->verificarSesion($paciente[0]['id']);
                //----------------------------------------------
                $datosSesion = array(
                   'id_sesion' => $newSesion[0]['id'],
                   'id_estadosesion'=>$datos->estados_obj,
                );
                //-----------------------------------------
                $historial = $this->doctrine->em->getRepository("Entities\\Historialsesion")->agregarHistorial((object)$datosSesion);
             }
        }

    }else{
      // Paciente nuevo y verifica si el codifo esta activo en la sesion
       $verificarCodigo= $this->doctrine->em->getRepository("Entities\\Sesiones")->verificarCodigo($datos->codigo);

          if (!empty($verificarCodigo)) {
                // var_dump("codigo esta activo, asigne uno propio");
                $datos='error2';
          }else{
             //var_dump("paciente nuevo, crear sesion e historial");
             $newPaciente = $this->doctrine->em->getRepository("Entities\\Pacientes")->agregar($datos);
             //----------------------------------------
             $paciente = $this->doctrine->em->getRepository("Entities\\Pacientes")->verificarPaciente($datos->cedula);
             //-------------------------------------------------------
             $daticos = array(
                'paciente' => $paciente[0]['id'],
                'codigo'=>$datos->codigo,
                'detalle'=>$datos->detalle,
                'estadoActual'=>$datos->estados_obj,
                'activo'=>$datos->activo,
             );
             //---------------------------------------
             $sesion = $this->doctrine->em->getRepository("Entities\\Sesiones")->agregarSesion((object)$daticos);
             //--------------------------------------
             $newSesion = $this->doctrine->em->getRepository("Entities\\Sesiones")->verificarSesion($paciente[0]['id']);
             //----------------------------------------------
             $datosSesion = array(
                'id_sesion' => $newSesion[0]['id'],
                'id_estadosesion'=>$datos->estados_obj,
             );
             //-----------------------------------
             $historial = $this->doctrine->em->getRepository("Entities\\Historialsesion")->agregarHistorial((object)$datosSesion);
          }
    }

    //----------------------------------------------
    //----------------------------------------------
   $respuesta=array('datos'=>$datos);
   $this->response($respuesta, 200);
    //--------------------------------------
  }

  //---------------------------
  //---Modoficar sesion---
  //---------------------------
  function sesion_put()
  {
    //--------------------------------------------------
    $datos=(object)$this->put('sesion');
    $sesion = $this->doctrine->em->getRepository("Entities\\Sesiones")->actualizar($datos->id,$datos);
    //----------------------------------------------
    $paciente = $this->doctrine->em->getRepository("Entities\\Pacientes")->actualizar($datos->id_paciente,$datos);
    //--------------------------------------------
     $Sesion = $this->doctrine->em->getRepository("Entities\\Sesiones")->traerSesionPorId($datos->id_paciente);
    //--------------------------------------
    if ($datos->estadoactual != $Sesion[0]['estadoactual'] ) {
        //var_dump("si se cambia estado visita");
        $datosSesionUpdate = array(
           'id_sesion' => $Sesion[0]['id'],
           'id_estadosesion'=>$datos->estados_obj,
        );
        $historial = $this->doctrine->em->getRepository("Entities\\Historialsesion")->agregarHistorial((object)$datosSesionUpdate);
    }
    //----------------------------------------------
    // if(empty($usuario)){
    //   $usuario=null;
    // }
    $respuesta=array('datos'=>$datos);
    $this->response($respuesta, 200);
    //--------------------------------------
  }
  //---------------------------
  //---Eliminar sesion---
  //---------------------------
  function sesion_delete($id_sesion)
  {
    //--------------------------------------------------
    $sesion = $this->doctrine->em->getRepository("Entities\\Sesiones")->findOneBy(["id" => $id_sesion]);
    $this->doctrine->em->remove($sesion);
    //----------------------------------------------
    //----------------------------------------------
    if(empty($sesion)){
      $sesion=null;
    }
    $respuesta=array('datos'=>$sesion);
    $this->doctrine->em->flush();
    $this->response($respuesta, 200);
    //--------------------------------------
  }

  //---------------------------
  //---Iniciar Sesión app paciente---
  //---------------------------
  function iniciarsesionapp_post()
  {
    //--------------------------------------------------
    $cedula=$this->post('cedula');
    $codigo=$this->post('codigo');
    $usuario = $this->doctrine->em->getRepository("Entities\\Sesiones")->iniciarSesion($cedula,$codigo);
    //----------------------------------------------
    //----------------------------------------------
    if(empty($usuario)){
      $usuario=null;
    }
    $respuesta=array('datos'=>$usuario);
    $this->response($respuesta, 200);
    //--------------------------------------
  }

}
?>
