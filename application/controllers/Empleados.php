<?php if (!defined('BASEPATH')) die();
date_default_timezone_set("America/Bogota");
require(APPPATH.'/libraries/REST_Controller.php');
class Empleados extends REST_Controller
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
    //----------------------
    //---Búsqueda clientes
    //----------------------

    function busqueda_get($busqueda=null,$random=null)
    {
      $clientes = $this->doctrine->em->getRepository("Entities\\Empleado")->busquedaOrdenadaPorId($busqueda,FALSE);
      if( !empty($clientes))
      {
        $respuesta=array('numero_filas'=>count($clientes),'listado'=>$clientes);
      }
      else
      {
          $respuesta=array('numero_filas'=>count($clientes),'listado'=>null);
      }
      $this->response($respuesta, 200);
    }
    //---------------
    function listado_get($cantidad=null,$offset=null,$random=null)
    {
      if($cantidad=="todos"){
        $cantidad=null;
        $offset=null;
      }
      $users = $this->doctrine->em->getRepository("Entities\\Empleado")->traerTodosOrdenadoPorId($cantidad,$offset,FALSE);
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
    //---Agregar Empleado------
    //-----------------------
    function empleado_post($con_imagen=null)
    {
      //-------------------------------
      if(!empty($con_imagen)){
        //-------------------------------
        //Recoge datos de petición POST
        $meta = $_POST;
        $tmp=(object)$meta['datos'];
        $datos=(object)$tmp->empleado;
        //-------------------------------
        $fecha = new DateTime();
        $timestamp=$fecha->getTimestamp();
        //---------------------------------------------
        if(!empty($_FILES)) {
          $filename = $_FILES['file']['name'];
          $filetype = $_FILES['file']['type'];
          // $destination = $meta['targetPath'] . $filename;
          $tipo_archivo=explode(".",$filename);
          move_uploaded_file( $_FILES['file']['tmp_name'] , $_SERVER['DOCUMENT_ROOT']."/".MEDIADIRECTORIO."empleados/".$timestamp.".".$tipo_archivo[1] );
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
      $slider = $this->doctrine->em->getRepository("Entities\\Empleado")->agregar($datos);
      //----------------------------------------------
      //----------------------------------------------
      $respuesta=array('datos'=>$datos);
      $this->response($respuesta, 200);
      //--------------------------------------
    }

    //-----------------------
    //---Modificar Empleado------
    //-----------------------
    function empleadofoto_post($con_imagen=null)
    {
      //-------------------------------
      if(!empty($con_imagen)){
        //-------------------------------
        //Recoge datos de petición POST
        $meta = $_POST;
        $tmp=(object)$meta['datos'];
        $datos=(object)$tmp->empleado;
        //-------------------------------
        $fecha = new DateTime();
        $timestamp=$fecha->getTimestamp();
        //---------------------------------------------
        if(!empty($_FILES)) {
          $filename = $_FILES['file']['name'];
          $filetype = $_FILES['file']['type'];
          // $destination = $meta['targetPath'] . $filename;
          $tipo_archivo=explode(".",$filename);
          move_uploaded_file( $_FILES['file']['tmp_name'] , $_SERVER['DOCUMENT_ROOT']."/".MEDIADIRECTORIO."empleados/".$timestamp.".".$tipo_archivo[1] );
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
      $slider = $this->doctrine->em->getRepository("Entities\\Empleado")->actualizar($datos->id,$datos);
      //----------------------------------------------
      //----------------------------------------------
      $respuesta=array('datos'=>$datos);
      $this->response($respuesta, 200);
      //--------------------------------------
    }

    //---------------------------
    //---Eliminar cliente---
    //---------------------------
    function empleado_delete($id_cliente)
    {
      //--------------------------------------------------
      $cliente = $this->doctrine->em->getRepository("Entities\\Empleado")->findOneBy(["id" => $id_cliente]);
      $this->doctrine->em->remove($cliente);
      //----------------------------------------------
      //----------------------------------------------
      if(empty($cliente)){
        $cliente=null;
      }
      $respuesta=array('datos'=>$cliente);
      $this->doctrine->em->flush();
      $this->response($respuesta, 200);
      //--------------------------------------
    }

    //---------------------------
    //Selectores de ciudades
    //---------------------------
    function ciudades_get($cantidad=null,$offset=null,$random=null)
    {
        //Determinar cantidad y offset
        if($cantidad=="todos"){
          $cantidad=null;
          $offset=null;
        }
        //---------------------
        $queryRespuesta = $this->doctrine->em->getRepository("Entities\\Ciudad")->traerCiudadesOrdenadosPorNombre($cantidad,$offset,FALSE);
        //----------------------------------------------
        if(empty($queryRespuesta)){
          $queryRespuesta=null;
        }
        // print_r($queryRespuesta);
        $respuesta=array('datos'=>$queryRespuesta);
       $this->response($queryRespuesta, 200);
    }

    //---------------------------
    //Selectores de tipos documentos
    //---------------------------
    function tiposdocumentos_get($cantidad=null,$offset=null,$random=null)
    {
        //Determinar cantidad y offset
        if($cantidad=="todos"){
          $cantidad=null;
          $offset=null;
        }
        //---------------------
        $queryRespuesta = $this->doctrine->em->getRepository("Entities\\TipoDocumento")->traerTipoDocumentosOrdenadasPorNombre($cantidad,$offset,FALSE);
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
