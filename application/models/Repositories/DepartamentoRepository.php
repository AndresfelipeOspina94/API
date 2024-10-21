<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class CiudadRepository
 * @package Repositories
 */
class DepartamentoRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Departamento";
    //Entities relation
  //  private $departamento= "Entities\\Departamento";

    // //Listado Departamento
    public function traerTodosOrdenadoPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('d.id,d.nombre,d.creacion,d.modificacion')
      ->from($this->entity, 'd')
      ->orderBy('d.id', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    // //Agregar Ciudad
    public function agregar($datos)
    {
      //creamos una instancia de la entidad Ciudad
      $departamento = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->nombre)){
        $departamento->setNombre($datos->nombre);
      }
      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($departamento);
      $this->_em->flush();
    }
    //Actualizar Ciudad
    public function actualizar($id,$datos)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'd');

      if(!empty($datos->nombre)){
        $qb->set('d.nombre', '?1')
        ->setParameter(1, $datos->nombre);
      }
      $qb->where('d.id = ?2')
        ->setParameter(2, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }


    //Traer Departamentos para selectores MODULO CIUDAD
    public function traerDepartamentosOrdenadasPorNombre($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('d.id,d.nombre as departamento')
      ->from($this->entity, 'd')
      ->orderBy('d.nombre', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      // print_r($results);
      // var_dump($results);
      return $results;
    }
}
