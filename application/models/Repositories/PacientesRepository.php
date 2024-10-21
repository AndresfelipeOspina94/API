<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class PacientesRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Pacientes";
    private $estadossesion = "Entities\\Estadossesion";
    /**
     * @return array
     */
    public function traerTodosActivosOrdenadosPorId($cantidad,$offset,$orientacion)
    {
      //En el select, debe ser el nombre del campo como esta en Entities
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('p.id,p.nombres,p.apellidos,p.cedula,p.estadoactual,p.creacion,p.modificacion')
      ->addSelect('e.nombre as estado')
      ->from($this->entity, 'p')
      ->innerJoin($this->estadossesion, 'e', 'WITH', $qb->expr()->eq('p.estadoactual', 'e.id'))
      ->orderBy('p.id', (($orientacion==TRUE)?'DESC':'ASC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      // ->where("p.estado=?1")
      // ->setParameter(1, 1);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    //verificar la existencia del paciente
    public function verificarPaciente($cedula)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('p.id,p.nombres,p.apellidos,p.estadoactual ,p.cedula,p.creacion,p.modificacion')
      ->from($this->entity, 'p')
      ->where("p.cedula=?1")
      ->setParameter(1, $cedula);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }


    // //Agregar Paciente
    public function agregar($datos)
    {
      //creamos una instancia de la entidad Paciente
      $paciente = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->nombres)){
        $paciente->setNombres($datos->nombres);
      }
      if(!empty($datos->apellidos)){
        $paciente->setApellidos($datos->apellidos);
      }
      if(!empty($datos->cedula)){
        $paciente->setCedula($datos->cedula);
      }
      if(!empty($datos->estadoactual)){
        $estado= (object)$datos->estadoactual;
        $paciente->setEstadoactual($estado->id);
      }
      // if(!empty($datos->codigo)){
      //   $paciente->setCodigo($datos->codigo);
      // }
      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($paciente);
      $this->_em->flush();
    }

    //Actualizar Paciente
    public function actualizar($id,$datos)
    {
      //------------------
      $fechaModificacion = new \DateTime("now");
      //-----------------
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'p');

      if(!empty($datos->nombres)){
        $qb->set('p.nombres', '?1')
        ->setParameter(1, $datos->nombres);
      }
      if(!empty($datos->apellidos)){
        $qb->set('p.apellidos', '?2')
        ->setParameter(2, $datos->apellidos);
      }
      if(!empty($datos->cedula)){
        $qb->set('p.cedula', '?3')
        ->setParameter(3, $datos->cedula);
      }
      if(!empty($datos->estados_obj)){
        $estado= (object)$datos->estados_obj;
        $qb->set('p.estadoactual', '?4')
        ->setParameter(4, $estado->id);
      }
      //-----------------------
      $qb->set('p.modificacion', '?5')
      ->setParameter(5, $fechaModificacion);
      //-----------------------

      $qb->where('p.id = ?6')
        ->setParameter(6, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }

   //  //-------------------------------------
   // //---Busqueda por Paciente---
   // //-------------------------------------
   //  public function busquedaOrdenadaPorId($busqueda,$orientacion)
   //  {
   //    $qb = $this->_em->createQueryBuilder();
   //    $qb
   //    ->select('p.id,p.nombres,p.apellidos,p.cedula,p.creacion,p.modificacion')
   //    ->from($this->entity, 'p')
   //    ->orderBy('p.id', (($orientacion==TRUE)?'ASC':'DESC'))
   //    ->where($qb->expr()->orX(
   //      $qb->expr()->like('p.nombres', '?1'),
   //      $qb->expr()->like('p.apellidos', '?2')
   //    ))
   //    ->setParameter(1, '%'.$busqueda.'%')
   //    ->setParameter(2, '%'.$busqueda.'%');
   //    $q = $qb->getQuery();
   //    $results = $q->getArrayResult();
   //    return $results;
   //  }
}
