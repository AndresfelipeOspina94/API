<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class HistorialsesionRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Historialsesion";
    private $estadossesion = "Entities\\Estadossesion";
    /**
     * @return array
     */

    public function traerHistorialPorSesion($id)
    {
      //En el select, debe ser el nombre del campo como esta en Entities
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('h.id as historial,h.sesion as id_sesion,h.estadosesion as id_estado,h.creacion as fechaestado')
      ->addSelect('e.nombre as estado')
      ->from($this->entity, 'h')
      ->innerJoin($this->estadossesion, 'e', 'WITH', $qb->expr()->eq('h.estadosesion', 'e.id'))
      ->orderBy('h.creacion', 'ASC')
      ->where($qb->expr()->eq('h.sesion', '?1'))
      ->setParameter(1,$id);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }


    // //Agregar Historial
    public function agregarHistorial($datos)
    {

      //creamos una instancia de la entidad textoRotativo
      $historial = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->id_sesion)){
        $historial->setSesion($datos->id_sesion);
      }
      if(!empty($datos->id_estadosesion)){
        $estado= (object)$datos->id_estadosesion;
        $historial->setEstadosesion($estado->id);
      }
      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($historial);
      $this->_em->flush();
    }



}
