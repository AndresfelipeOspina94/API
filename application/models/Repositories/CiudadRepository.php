<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class CiudadRepository
 * @package Repositories
 */
class CiudadRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Ciudad";
    //Entities relation
    private $departamento= "Entities\\Departamento";

    //Listado Ciudad
    public function traerTodosOrdenadoPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('c.id,c.nombre,c.departamento as id_departamento,c.creacion,c.modificacion')
      ->addSelect('d.nombre as departamento')
      ->from($this->entity, 'c')
      ->leftJoin($this->departamento, 'd', 'WITH', $qb->expr()->eq('c.departamento', 'd.id'))
      ->orderBy('c.id', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    //Agregar Ciudad
    public function agregar($datos)
    {
      //creamos una instancia de la entidad Ciudad
      $ciudad = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->nombre)){
        $ciudad->setNombre($datos->nombre);
      }
      $departamento=(object)$datos->departamento;
      if(!empty($departamento->id)){
        $ciudad->setDepartamento($departamento->id);
      }
      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($ciudad);
      $this->_em->flush();
    }

    //Actualizar Ciudad
    public function actualizar($id,$datos)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'c');
      if(!empty($datos->nombre)){
        $qb->set('c.nombre', '?1')
        ->setParameter(1, $datos->nombre);
      }

      if(!empty($datos->departamento)){
        $departamento=(object)$datos->departamento;
        $qb->set('c.departamento', '?2')
        ->setParameter(2, $departamento->id);
      }

      $qb->where('c.id = ?3')
        ->setParameter(3, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }

    //Traer Ciudades para selectores MODULO ClIENTES
    public function traerCiudadesOrdenadosPorNombre($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('c.id,c.nombre,c.departamento')
      ->addSelect('d.nombre as departamento')
      ->addSelect('d.id as id_departamento')
      ->from($this->entity, 'c')
      ->leftJoin($this->departamento, 'd', 'WITH', $qb->expr()->eq('c.departamento', 'd.id'))
      ->orderBy('c.nombre', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      // print_r($results);
      // var_dump($results);
      return $results;
    }
}
