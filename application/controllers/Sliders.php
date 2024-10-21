<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Sliders extends REST_Controller
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
  ------------- Slider  APPTV-------------
  ----------------------------------*/
  function listado_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\Slider")->traerTodosActivosOrdenadosPorId($cantidad,$offset,FALSE);
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
  ------------- Slider ADMIN APPTV-------------
  ----------------------------------*/
  function listadoTodos_get($cantidad=null,$offset=null,$random=null)
  {
    if($cantidad=="todos"){
      $cantidad=null;
      $offset=null;
    }
    $listado = $this->doctrine->em->getRepository("Entities\\Slider")->traerTodosOrdenadosPorId($cantidad,$offset,FALSE);
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

    //-----------------------
    //---Agregar slider------
    //-----------------------
    function slider_post($con_imagen=null)
    {
      //-------------------------------
      if(!empty($con_imagen)){
        //-------------------------------
        //Recoge datos de petición POST
        $meta = $_POST;
        $tmp=(object)$meta['datos'];
        $datos=(object)$tmp->slider;
        //-------------------------------
        $fecha = new DateTime();
        $timestamp=$fecha->getTimestamp();
        //---------------------------------------------
        if(!empty($_FILES)) {
          $filename = $_FILES['file']['name'];
          $filetype = $_FILES['file']['type'];
          // $destination = $meta['targetPath'] . $filename;
          $tipo_archivo=explode(".",$filename);
          move_uploaded_file( $_FILES['file']['tmp_name'] , $_SERVER['DOCUMENT_ROOT']."/".MEDIADIRECTORIO."sliders/".$timestamp.".".$tipo_archivo[1] );
          //---------------------------------
          $slider_imagen=$timestamp.".".$tipo_archivo[1];
          $datos->imagen=$slider_imagen;
        }
      }
      else{
        //-------------------------------
        //Recoge datos de petición POST
        $datos=(object)$this->post('datos');
        //-------------------------------
      }
      //--------------------------------------------------
      $slider = $this->doctrine->em->getRepository("Entities\\Slider")->agregar($datos);
      //----------------------------------------------
      //----------------------------------------------
      $respuesta=array('datos'=>$datos);
      $this->response($respuesta, 200);
      //--------------------------------------
    }

    //-----------------------
    //---Modificar slider------
    //-----------------------
    function sliderfoto_post($con_imagen=null)
    {
      //-------------------------------
      if(!empty($con_imagen)){
        //-------------------------------
        //Recoge datos de petición POST
        $meta = $_POST;
        $tmp=(object)$meta['datos'];
        $datos=(object)$tmp->slider;
        //-------------------------------
        $fecha = new DateTime();
        $timestamp=$fecha->getTimestamp();
        //---------------------------------------------
        if(!empty($_FILES)) {
          $filename = $_FILES['file']['name'];
          $filetype = $_FILES['file']['type'];
          // $destination = $meta['targetPath'] . $filename;
          $tipo_archivo=explode(".",$filename);
          move_uploaded_file( $_FILES['file']['tmp_name'] , $_SERVER['DOCUMENT_ROOT']."/".MEDIADIRECTORIO."sliders/".$timestamp.".".$tipo_archivo[1] );
          //---------------------------------
          $slider_imagen=$timestamp.".".$tipo_archivo[1];
          $datos->imagen=$slider_imagen;
        }
      }
      else{
        //-------------------------------
        //Recoge datos de petición POST
        $datos=(object)$this->post('datos');
        //-------------------------------
      }
      //--------------------------------------------------
      $slider = $this->doctrine->em->getRepository("Entities\\Slider")->actualizar($datos->id,$datos);
      //----------------------------------------------
      //----------------------------------------------
      $respuesta=array('datos'=>$datos);
      $this->response($respuesta, 200);
      //--------------------------------------
    }

    //---------------------------
    //---Eliminar slider---
    //---------------------------
    function slider_delete($id_slider)
    {
      //--------------------------------------------------
      $slider = $this->doctrine->em->getRepository("Entities\\Slider")->findOneBy(["id" => $id_slider]);
      $this->doctrine->em->remove($slider);
      //----------------------------------------------
      //----------------------------------------------
      if(empty($slider)){
        $slider=null;
      }
      $respuesta=array('datos'=>$slider);
      $this->doctrine->em->flush();
      $this->response($respuesta, 200);
      //--------------------------------------
    }
}
?>
