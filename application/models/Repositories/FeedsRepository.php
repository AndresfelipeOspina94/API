<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class FeedsRepository
 * @package Repositories
 */
class FeedsRepository extends EntityRepository
{
    /**
     * @var sfing
     */
    private $entity = "Entities\\Feeds";
    /**
     * @return array
     */
    public function traerFeeds($cantidad,$offset,$orientacion)
    {
      //En el select, debe ser el nombre del campo como esta en Entities
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('f.id,f.url,f.creacion,f.modificacion')
      ->from($this->entity, 'f')
      ->orderBy('f.id', (($orientacion==TRUE)?'DESC':'ASC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      // ->where("s.estado=?1")
      // ->setParameter(1, 1);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    // //Agregar feeds
    public function agregar($datos)
    {
      //creamos una instancia de la entidad feeds
      $feeds = new $this->entity;
      if(!empty($datos->url)){
        $feeds->setUrl($datos->url);
      }
      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($feeds);
      $this->_em->flush();
    }

    //Actualizar feeds
    public function actualizar($id,$datos)
    {
      //------------------
      $fechaModificacion = new \DateTime("now");
      //-----------------
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'f');

      if(!empty($datos->url)){
        $qb->set('f.url', '?1')
        ->setParameter(1, $datos->url);
      }
      //-----------------------
      $qb->set('f.modificacion', '?2')
      ->setParameter(2, $fechaModificacion);
      //-----------------------
      $qb->where('f.id = ?3')
        ->setParameter(3, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }
}
