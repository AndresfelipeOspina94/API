<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class PerfilesRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\PerfilAdministrativo";
    /**
     * @return array
     */
    //Agregar Perfil
    public function agregar($datos)
    {
      //creamos una instancia de la entidad Perfil
      $perfil = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->nombre)){
        $perfil->setNombre($datos->nombre);
      }
      if(!empty($datos->permisos)){
        $perfil->setPermisos($datos->permisos);
      }
      //guardamos la entidad en la tabla Perfiles
      $this->_em->persist($perfil);
      $this->_em->flush();
    }
    //Actualizar Perfil
    public function actualizar($id,$datos)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'p');
      if(!empty($datos->nombre)){
        $qb->set('p.nombre', '?1')
        ->setParameter(1, $datos->nombre);
      }
      if(!empty($datos->permisos)){
        $qb->set('p.permisos', '?2')
        ->setParameter(2, $datos->permisos);
      }
      $qb->where('p.id = ?3')
        ->setParameter(3, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }
    //traer Perfiles con sus Join
    public function traerTodosOrdenadoPorNombreCompleto($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('p.id,p.nombre,p.permisos,p.creacion,p.modificacion')
      ->from($this->entity, 'p')
      ->orderBy('p.nombre', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }
    public function traerTodosOrdenadoPorCreacion($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('p.id,p.nombre,p.permisos,p.creacion,p.modificacion')
      ->from($this->entity, 'p')
      ->orderBy('p.creacion', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }
    public function traerTodosOrdenadoPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('p.id,p.nombre,p.permisos,p.creacion,p.modificacion')
      ->from($this->entity, 'p')
      ->orderBy('p.id', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

}
