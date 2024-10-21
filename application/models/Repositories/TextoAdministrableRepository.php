<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class TextoAdministrableRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\TextoAdministrable";
    /**
     * @return array
     */
    public function traerTodosActivosOrdenadosPorId($cantidad,$offset,$orientacion)
    {
      //En el select, debe ser el nombre del campo como esta en Entities
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('ta.id,ta.agradecimiento,ta.orientacion,ta.creacion,ta.modificacion')
      ->from($this->entity, 'ta')
      ->orderBy('ta.id', (($orientacion==TRUE)?'DESC':'ASC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      // ->where("s.estado=?1")
      // ->setParameter(1, 1);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    // //Agregar textoRotativo
    public function agregar($datos)
    {
      //creamos una instancia de la entidad textoRotativo
      $TextoAdministrable = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->agradecimiento)){
        $TextoAdministrable->setAgradecimiento($datos->agradecimiento);
      }
      if(!empty($datos->orientacion)){
        $TextoAdministrable->setOrientacion($datos->orientacion);
      }
      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($TextoAdministrable);
      $this->_em->flush();
    }

    //Actualizar textoRotativo
    public function actualizar($id,$datos)
    {
      //------------------
        $fechaModificacion = new \DateTime("now");
      //-----------------
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'ta');

      if(!empty($datos->agradecimiento)){
        $qb->set('ta.agradecimiento', '?1')
        ->setParameter(1, $datos->agradecimiento);
      }
      if(!empty($datos->orientacion)){
        $qb->set('ta.orientacion', '?2')
        ->setParameter(2, $datos->orientacion);
      }
      //-----------------------
      $qb->set('ta.modificacion', '?3')
      ->setParameter(3, $fechaModificacion);
      //-----------------------
      $qb->where('ta.id = ?4')
        ->setParameter(4, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }
}
