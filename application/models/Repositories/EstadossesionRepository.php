<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class EstadossesionRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Estadossesion";

    /**
     * @return array
     */

    //Listado estados sesiones
    public function traerEstadoActivosOrdenadosPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('es.id,es.nombre,es.creacion,es.modificacion')
      ->from($this->entity, 'es')
      ->orderBy('es.id', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

}
