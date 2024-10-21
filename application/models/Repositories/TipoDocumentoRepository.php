<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class TipoDocumentoRepository
 * @package Repositories
 */
class TipoDocumentoRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\TipoDocumento";
    //Entities relation
  //  private $departamento= "Entities\\Departamento";

    // //Listado TipoPersona
    public function traerTodosOrdenadoPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('td.id,td.nomenclatura,td.descripcion,td.creacion,td.modificacion')
      ->from($this->entity, 'td')
      ->orderBy('td.id', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    // //Agregar TipoPersona
    public function agregar($datos)
    {
      //creamos una instancia de la entidad Ciudad
      $tipodocumento = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->nomenclatura)){
        $tipodocumento->setNomenclatura($datos->nomenclatura);
      }
      if(!empty($datos->descripcion)){
        $tipodocumento->setDescripcion($datos->descripcion);
      }
      //guardamos la entidad en la tabla Ciudad
      $this->_em->persist($tipodocumento);
      $this->_em->flush();
    }
    //Actualizar TipoPersona
    public function actualizar($id,$datos)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'td');

      if(!empty($datos->nomenclatura)){
        $qb->set('td.nomenclatura', '?1')
        ->setParameter(1, $datos->nomenclatura);
      }

      if(!empty($datos->descripcion)){
        $qb->set('td.descripcion', '?2')
        ->setParameter(2, $datos->descripcion);
      }
      $qb->where('td.id = ?3')
        ->setParameter(3, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }


    //Traer tipos documentos para selectores MODULO ClIENTES
    public function traerTipoDocumentosOrdenadasPorNombre($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('td.id,td.nomenclatura, td.descripcion')
      ->from($this->entity, 'td')
      ->orderBy('td.nomenclatura', (($orientacion==TRUE)?'DESC':'ASC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      // print_r($results);
      // var_dump($results);
      return $results;
    }

}
