<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class TextoRotativoRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\TextoRotativo";
    /**
     * @return array
     */
    public function traerTodosActivosOrdenadosPorId($cantidad,$offset,$orientacion)
    {
      //En el select, debe ser el nombre del campo como esta en Entities
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('tr.id,tr.asunto,tr.descripcion,tr.activo,tr.creacion,tr.modificacion')
      ->from($this->entity, 'tr')
      // ->where("tr.activo=1")
      ->orderBy('tr.id', (($orientacion==TRUE)?'DESC':'ASC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);

      // ->setParameter(1, 1);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    public function traerTodosActivosOrdenadosPorIdApptv($cantidad,$offset,$orientacion)
    {
      //En el select, debe ser el nombre del campo como esta en Entities
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('tr.id,tr.asunto,tr.descripcion,tr.activo,tr.creacion,tr.modificacion')
      ->from($this->entity, 'tr')
      ->where("tr.activo=1")
      ->orderBy('tr.id', (($orientacion==TRUE)?'DESC':'ASC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);

      // ->setParameter(1, 1);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    // //Agregar textoRotativo
    public function agregar($datos)
    {
      //creamos una instancia de la entidad textoRotativo
      $textoRotativo = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->asunto)){
        $textoRotativo->setAsunto($datos->asunto);
      }
      if(!empty($datos->descripcion)){
        $textoRotativo->setDescripcion($datos->descripcion);
      }

      $textoRotativo->setActivo($datos->activo);

      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($textoRotativo);
      $this->_em->flush();
    }

    //Actualizar textoRotativo
    public function actualizar($id,$datos)
    {
      //------------------
        $fechaModificacion = new \DateTime("now");
      //-----------------
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'tr');

      if(!empty($datos->asunto)){
        $qb->set('tr.asunto', '?1')
        ->setParameter(1, $datos->asunto);
      }
      if(!empty($datos->descripcion)){
        $qb->set('tr.descripcion', '?2')
        ->setParameter(2, $datos->descripcion);
      }
      $qb->set('tr.activo', '?3')
      ->setParameter(3, $datos->activo);

      //-----------------------
      $qb->set('tr.modificacion', '?4')
      ->setParameter(4, $fechaModificacion);
      //-----------------------
      $qb->where('tr.id = ?5')
        ->setParameter(5, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }
}
