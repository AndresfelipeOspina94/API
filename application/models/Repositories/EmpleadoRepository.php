<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class EmpleadoRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Empleado";
    //Entities relation
    private $usuario= "Entities\\Usuario";
    private $ciudad= "Entities\\Ciudad";
    /**
     * @return array
     */

     //-------------------------------------
    //---Busqueda por Empleado---
    //-------------------------------------
     public function busquedaOrdenadaPorId($busqueda,$orientacion)
     {
       $qb = $this->_em->createQueryBuilder();
       $qb
       ->select('c.id,c.ciudad as id_ciudad,c.nombres,c.apellidos,c.tipodocumento as id_tipodocumento,c.tipocliente,c.documento,c.emailprincipal,c.telefono,c.telefonoalternativo,c.creacion,c.modificacion')
       ->addSelect('ci.nombre as ciudad')
       ->from($this->entity, 'c')
       ->innerJoin($this->ciudad, 'ci', 'WITH', $qb->expr()->eq('c.ciudad', 'ci.id'))
       ->orderBy('c.id', (($orientacion==TRUE)?'ASC':'DESC'))
       ->where($qb->expr()->orX(
         $qb->expr()->like('c.nombres', '?1'),
         $qb->expr()->like('c.apellidos', '?2')
       ))
       ->setParameter(1, '%'.$busqueda.'%')
       ->setParameter(2, '%'.$busqueda.'%');
       $q = $qb->getQuery();
       $results = $q->getArrayResult();
       return $results;
     }
     //-----------------------------------------
    //---Traer clientes ordenados por id---
    //-----------------------------------------
    public function traerTodosOrdenadoPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('c.id,c.ciudad as id_ciudad,c.nombres,c.apellidos,c.tipodocumento as id_tipodocumento,c.tipocliente as id_tipocliente,c.documento,c.emailprincipal,c.telefono,c.telefonoalternativo,c.creacion,c.modificacion')
      ->addSelect('ci.nombre as ciudad')
      ->from($this->entity, 'c')
      ->innerJoin($this->ciudad, 'ci', 'WITH', $qb->expr()->eq('c.ciudad', 'ci.id'))
      ->orderBy('c.id', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

    //-------------------------------------
    //---Agregar cliente-------------------
    //-------------------------------------
    public function agregar($datos)
    {
      //creamos una instancia de la entidad Cliente
      $cliente = new $this->entity;
      //establecemos las propiedades a través de los setters
      if(!empty($datos->nombres)){
        $cliente->setNombres($datos->nombres);
      }
      if(!empty($datos->apellidos)){
        $cliente->setApellidos($datos->apellidos);
      }
      if(!empty($datos->emailprincipal)){
        $cliente->setEmailprincipal($datos->emailprincipal);
      }
      if(!empty($datos->imagen)){
        $cliente->setImagen($datos->imagen);
      }

      if(!empty($datos->tipodocumento)){
        $tipodocumento=(object)$datos->tipodocumento;
        $cliente->setTipodocumento($tipodocumento->id);
      }
      if(!empty($datos->documento)){
        $cliente->setDocumento($datos->documento);
      }

      if(!empty($datos->ciudad)){
        $ciudad=(object)$datos->ciudad;
        $cliente->setCiudad($ciudad->id);
      }
      // $tipocliente=(object)$datos->tipocliente;
      // if(!empty($tipocliente->id)){
      //   $cliente->setTipocliente($tipocliente->id);
      // }
      if(!empty($datos->telefono)){
        $cliente->setTelefono($datos->telefono);
      }
      if(!empty($datos->telefonoalternativo)){
        $cliente->setTelefonoalternativo($datos->telefonoalternativo);
      }
      if(!empty($datos->direccion)){
        $cliente->setDireccion($datos->direccion);
      }
      //guardamos la entidad en la tabla Clientes
      $this->_em->persist($cliente);
      $this->_em->flush();
    }
    //-------------------------------------
    //---Actualizar cliente----------------
    //-------------------------------------
    public function actualizar($id,$datos)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'c');
      if(!empty($datos->nombres)){
        $qb->set('c.nombres', '?1')
        ->setParameter(1, $datos->nombres);
      }
      if(!empty($datos->apellidos)){
        $qb->set('c.apellidos', '?2')
        ->setParameter(2, $datos->apellidos);
      }
      if(!empty($datos->tipodocumento_objeto)){
        $tipodocumento=(object)$datos->tipodocumento_objeto;
        $qb->set('c.tipodocumento', '?3')
        ->setParameter(3, $tipodocumento->id);
      }
      if(!empty($datos->documento)){
        $qb->set('c.documento', '?4')
        ->setParameter(4, $datos->documento);
      }
      if(!empty($datos->ciudad)){
        $ciudad=(object)$datos->ciudad;
        $qb->set('c.ciudad', '?5')
        ->setParameter(5, $ciudad->id);
      }
      // $tipocliente=(object)$datos->tipocliente_objeto;
      // if(!empty($tipocliente->id)){
      //   $qb->set('c.tipocliente', '?6')
      //   ->setParameter(6, $tipocliente->id);
      // }
      if(!empty($datos->telefono)){
        $qb->set('c.telefono', '?8')
        ->setParameter(8, $datos->telefono);
      }
      if(!empty($datos->telefonoalternativo)){
        $qb->set('c.telefonoalternativo', '?9')
        ->setParameter(9, $datos->telefonoalternativo);
      }
      if(!empty($datos->emailprincipal)){
        $qb->set('c.emailprincipal', '?10')
        ->setParameter(10, $datos->emailprincipal);
      }
      if(!empty($datos->direccion)){
        $qb->set('c.direccion', '?11')
        ->setParameter(11, $datos->direccion);
      }
      if(!empty($datos->imagen)){
        $qb->set('c.imagen', '?12')
        ->setParameter(12, $datos->imagen);
      }
      $qb->where('c.id = ?13')
        ->setParameter(13, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }

    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
     //-------------------------------------
     //---Encontrar cliente por email---
     //-------------------------------------
     public function encontrarPorEmail($email)
     {
         $user=$this->_em->getRepository($this->entity)->findOneBy(["emailprincipal" => $email]);
         $arrayCliente=array();
         if(!empty($user)){
           $arrayCliente=array(
             'id' => $user->getId(),
             'nombres' => $user->getNombres(),
             'apellidos' => $user->getApellidos(),
             'documento' => $user->getDocumento(),
             'email' => $user->getEmailprincipal(),
             'creacion' => $user->getCreacion(),
             'modificacion' => $user->getModificacion()
            );
         }
         return $arrayCliente;
     }
     //-------------------------------------
     //---Encontrar cliente por documento---
     //-------------------------------------
     public function encontrarPorDocumento($documento)
     {
         $user=$this->_em->getRepository($this->entity)->findOneBy(array("documento" => $documento));
         $arrayCliente=array();
         if(!empty($user)){
           $arrayCliente=array(
              'id' => $user->getId(),
              'nombres' => $user->getNombres(),
              'apellidos' => $user->getApellidos(),
              'documento' => $user->getDocumento(),
              'email' => $user->getEmailprincipal(),
              'creacion' => $user->getCreacion(),
              'modificacion' => $user->getModificacion()
            );
         }
         return $arrayCliente;
     }
      //-----------------------------------------
      //---Traer clientes ordenados por nombre---
      //-----------------------------------------
      public function traerTodosOrdenadoPorNombreCompleto($cantidad,$offset,$orientacion)
      {
        $qb = $this->_em->createQueryBuilder();
        $qb
        ->select('c.id,c.ciudad as id_ciudad,c.nombres,c.apellidos, c.tipodocumento as id_tipodocumento,,c.tipocliente as id_tipocliente,c.documento,c.emailprincipal,c.telefono,c.telefonoalternativo,c.creacion,c.modificacion')
        ->addSelect('ci.nombre as ciudad')
        ->from($this->entity, 'c')
        ->innerJoin($this->ciudad, 'ci', 'WITH', $qb->expr()->eq('c.ciudad', 'ci.id'))
        ->orderBy('c.apellidos', (($orientacion==TRUE)?'ASC':'DESC'))
        ->orderBy('c.nombres', (($orientacion==TRUE)?'ASC':'DESC'))
        ->setFirstResult($offset)
        ->setMaxResults($cantidad);
        $q = $qb->getQuery();
        $results = $q->getArrayResult();
        return $results;
      }
       //-----------------------------------------
      //---Traer clientes ordenados por fecha creación---
      //-----------------------------------------
      public function traerTodosOrdenadoPorCreacion($cantidad,$offset,$orientacion)
      {
        $qb = $this->_em->createQueryBuilder();
        $qb
        ->select('c.id,c.ciudad as id_ciudad,c.nombres,c.apellidos,c.tipodocumento as id_tipodocumento ,,c.tipocliente as id_tipocliente,c.documento,c.emailprincipal,c.telefono,c.telefonoalternativo,c.creacion,c.modificacion')
        ->addSelect('ci.nombre as ciudad')
        ->from($this->entity, 'c')
        ->innerJoin($this->ciudad, 'ci', 'WITH', $qb->expr()->eq('c.ciudad', 'ci.id'))
        ->orderBy('c.creacion', (($orientacion==TRUE)?'ASC':'DESC'))
        ->setFirstResult($offset)
        ->setMaxResults($cantidad);
        $q = $qb->getQuery();
        $results = $q->getArrayResult();
        return $results;
      }



}
