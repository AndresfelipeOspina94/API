<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class SliderRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Slider";
    /**
     * @return array
     */

    //MOSTRAR TODOS ACTIVOS APPTV
    public function traerTodosActivosOrdenadosPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('sl.id,sl.imagenslider,sl.videoslider,sl.tiempopermanencia,sl.creacion,sl.modificacion,sl.estado')
      ->from($this->entity, 'sl')
      ->orderBy('sl.id', (($orientacion==TRUE)?'DESC':'ASC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad)
      ->where("sl.estado=?1")
      ->setParameter(1, 1);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }
    //MOSTRAR TODOS ACTIVOS Y INACTIVOS ADMIN APPTV
    public function traerTodosOrdenadosPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('sl.id,sl.imagenslider,sl.videoslider,sl.tiempopermanencia,sl.creacion,sl.modificacion,sl.estado')
      ->from($this->entity, 'sl')
      ->orderBy('sl.id', (($orientacion==TRUE)?'DESC':'ASC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      // ->where("sl.estado=?1")
      // ->setParameter(1, 1);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }
    // //Agregar slider
    public function agregar($datos)
    {
      //creamos una instancia de la entidad textoRotativo
      $slider = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->tiempopermanencia)){
        $slider->setTiempopermanencia($datos->tiempopermanencia);
      }
      if(!empty($datos->imagen)){
        $slider->setImagen($datos->imagen);
      }
      $slider->setVideoslider($datos->videoslider);
      $slider->setEstado(intval($datos->estado === 'true'? true: false));
      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($slider);
      $this->_em->flush();
    }

    public function actualizar($id,$datos)
    {
      //------------------
      $fechaModificacion = new \DateTime("now");
      //-----------------

      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'sl');

      if(!empty($datos->imagen)){
        $qb->set('sl.imagenslider', '?1')
        ->setParameter(1, $datos->imagen);
      }
      $qb->set('sl.videoslider', '?2')
      ->setParameter(2, $datos->videoslider);
      if(!empty($datos->tiempopermanencia)){
        $qb->set('sl.tiempopermanencia', '?3')
        ->setParameter(3, $datos->tiempopermanencia);
      }
      if(!empty($datos->estado)){
        $qb->set('sl.estado', '?4')
        ->setParameter(4, intval($datos->estado === 'true'? true: false));
       }
       //-----------------------
       $qb->set('sl.modificacion', '?5')
       ->setParameter(5, $fechaModificacion);
       //-----------------------

      $qb->where('sl.id = ?6')
        ->setParameter(6, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }
}
