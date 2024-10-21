<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class SesionesRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Sesiones";
    private $paciente = "Entities\\Pacientes";
    private $historial = "Entities\\Historialsesion";
    private $estadossesion = "Entities\\Estadossesion";
    /**
     * @return array
     */

    // traer para APP TV & ADMIN APP TV
    public function traerTodosActivosOrdenadosPorId($cantidad,$offset,$orientacion)
    {
      //---------------------
      $fecha = new \DateTime("now");
      $fecha->sub(new \DateInterval('P1D'));
      //----------------
      //En el select, debe ser el nombre del campo como esta en Entities
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('s.id,s.paciente as id_paciente,s.codigo,s.detalle,s.creacion,s.modificacion,s.estadoactual,s.activo')
      ->addSelect('p.nombres,p.apellidos,p.cedula')
      ->addSelect('e.nombre as estado')
      ->from($this->entity, 's')
      ->innerJoin($this->paciente, 'p', 'WITH', $qb->expr()->eq('s.paciente', 'p.id'))
      ->innerJoin($this->estadossesion, 'e', 'WITH', $qb->expr()->eq('s.estadoactual', 'e.id'))
      ->orderBy('s.creacion', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad)
      ->where('s.estadoactual != ?2')
      // ->where('s.fechadealta <=?1')
      // ->orwhere('s.estadoactual < ?2')
      // ->setParameter(1,$fecha)
      ->setParameter(2,5);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    // traer para APP TV & ADMIN APP TV
    public function traerTodosActivosOrdenadosPorIdTV($cantidad,$offset,$orientacion)
    {
      //---------------------
      $fecha = new \DateTime("now");
      $fecha->sub(new \DateInterval('P1D'));
      //----------------
      //En el select, debe ser el nombre del campo como esta en Entities
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('s.id,s.paciente as id_paciente,s.codigo,s.detalle,s.creacion,s.modificacion,s.estadoactual,s.activo')
      ->addSelect('p.nombres,p.apellidos,p.cedula')
      ->addSelect('e.nombre as estado')
      ->from($this->entity, 's')
      ->innerJoin($this->paciente, 'p', 'WITH', $qb->expr()->eq('s.paciente', 'p.id'))
      ->innerJoin($this->estadossesion, 'e', 'WITH', $qb->expr()->eq('s.estadoactual', 'e.id'))
      ->orderBy('s.creacion', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad)
      ->where('s.estadoactual != ?2')
      ->andwhere('s.activo != 0')
      // ->where('s.fechadealta <=?1')
      // ->orwhere('s.estadoactual < ?2')
      // ->setParameter(1,$fecha)
      ->setParameter(2,5);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    //login Usuario en Paciente TV
    public function iniciarSesion($cedula,$codigo)
    {
      //----------------
      $fecha = date('Y-m-d H:i:s');
      //----------------
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('s.id as id_sesion, s.paciente as id_paciente ,s.codigo,s.detalle,s.estadoactual,s.activo as id_estado,s.fechadealta,s.creacion,s.modificacion')
      ->addSelect('p.id,p.cedula,p.nombres,p.apellidos,p.creacion,p.modificacion,p.estadoactual')
      ->addSelect('e.nombre as estado')
      ->from($this->entity, 's')
      ->innerJoin($this->paciente, 'p', 'WITH', $qb->expr()->eq('s.paciente', 'p.id'))
      ->innerJoin($this->estadossesion, 'e', 'WITH', $qb->expr()->eq('s.estadoactual', 'e.id'))
      ->where("p.cedula=?1 AND s.codigo=?2")
      // ->andWhere("s.estadoactual !=?3")
      ->andwhere("s.fechadealta IS NULL OR s.fechadealta >=?4 ")
      ->setParameter(1, $cedula)
      ->setParameter(2, $codigo)
      // ->setParameter(3, 5)
      ->setParameter(4, $fecha);
      $q = $qb->getQuery();
      // var_dump($qb->getDql());
      $results = $q->getOneOrNullResult();
      return $results;
    }


    public function SesionCerrar($idsesion)
    {
      //----------------
      $fecha = date('Y-m-d H:i:s');
      //----------------
      //En el select, debe ser el nombre del campo como esta en Entities
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('s.id as id_sesion, s.paciente as id_paciente ,s.fechadealta')
      ->from($this->entity, 's')
      ->orderBy('s.id', 'ASC')
      ->where("s.id=?1 AND s.fechadealta <=?2")
      ->setParameter(1,$idsesion)
      ->setParameter(2, $fecha);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }


    // //Agregar sesion
    public function agregarSesion($datos)
    {
      //creamos una instancia de la entidad textoRotativo
      $sesion = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->paciente)){
        $sesion->setPaciente($datos->paciente);
      }
      if(!empty($datos->codigo)){
        $sesion->setCodigo($datos->codigo);
      }
      //var_dump($datos);
      if(!empty($datos->activo) || $datos->activo==false){
        $sesion->setActivo($datos->activo);
      }
      if(!empty($datos->detalle)){
        $sesion->setDetalle($datos->detalle);
      }
      if(!empty($datos->estadoActual)){
        $estado= (object)$datos->estadoActual;
        $sesion->setEstadoactual($estado->id);
      }
      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($sesion);
      $this->_em->flush();
    }


    //Actualizar sesion
    public function actualizar($id,$datos)
    {
      // Fecha de Alta
      $fecha = date('Y-m-d H:i:s');
      $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
      $fechadeAlta = date ( 'Y-m-d H:i:s' , $nuevafecha );
      //------------------
        $fechaModificacion = new \DateTime("now");
      //-----------------
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 's');

      if(!empty($datos->codigo)){
        $qb->set('s.codigo', '?1')
        ->setParameter(1, $datos->codigo);
      }
      if(!empty($datos->detalle)){
        $qb->set('s.detalle', '?2')
        ->setParameter(2, $datos->detalle);
      }
      if(!empty($datos->estados_obj)){
        $estado= (object)$datos->estados_obj;
        $qb->set('s.estadoactual', '?4')
        ->setParameter(4, $estado->id);

        if ($estado->id == 5) {
          $qb->set('s.fechadealta', '?3')
          ->setParameter(3, $fechadeAlta);
        }
      }
      //var_dump($datos->activo);
        $qb->set('s.activo', '?7')
        ->setParameter(7, $datos->activo);
      //-----------------------
      $qb->set('s.modificacion', '?5')
      ->setParameter(5, $fechaModificacion);
      //-----------------------
      $qb->where('s.id = ?6')
        ->setParameter(6, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }

    //verificar la existencia del paciente
    public function verificarSesion($id_paciente)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('s.id,s.paciente,s.codigo,s.detalle,s.creacion,s.modificacion,s.estadoactual,s.activo')
      ->from($this->entity, 's')
      // ->where("s.paciente=?1")
      ->where("s.paciente=?1 and s.estadoactual !=5")
      ->setParameter(1, $id_paciente);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    //verificar la existencia del codigo y si esta activo
    public function verificarCodigo($codigo)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('s.id,s.paciente,s.codigo,s.detalle,s.creacion,s.modificacion,s.estadoactual,s.activo')
      ->from($this->entity, 's')
      ->where("s.codigo=?1 and s.estadoactual !=5")
      ->setParameter(1, $codigo);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    //traer las sesiones por id de paciente y verifica si cambia el estado actual
    public function traerSesionPorId($id_paciente)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('s.id,s.paciente,s.codigo,s.detalle,s.creacion,s.modificacion,s.estadoactual,s.activo')
      ->from($this->entity, 's')
      ->where("s.paciente=?1 ")
      ->orderBy('s.creacion','DESC')
      ->setParameter(1, $id_paciente);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    //Listado visitas finalizadas
    public function traerVisitasFinalizadas($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('s.id,s.paciente,s.codigo,s.detalle,s.creacion,s.modificacion,s.estadoactual,s.activo')
      ->addSelect('p.nombres,p.apellidos,p.cedula')
      ->addSelect('e.nombre as estado')
      ->from($this->entity, 's')
      ->innerJoin($this->paciente, 'p', 'WITH', $qb->expr()->eq('s.paciente', 'p.id'))
      ->innerJoin($this->estadossesion, 'e', 'WITH', $qb->expr()->eq('s.estadoactual', 'e.id'))
      ->where("s.estadoactual=?1")
      ->setParameter(1,5)
      ->orderBy('s.id', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }



}
