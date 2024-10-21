<?php
namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package Repositories
 */
class UsuarioRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $entity = "Entities\\Usuario";
    private $key = "Entities\\Keys";
    //Entities relation
    private $cliente= "Entities\\Empleado";
    private $perfiladministrativo= "Entities\\PerfilAdministrativo";
    private $ciudad= "Entities\\Ciudad";
    /**
     * @return array
     */

    //login Usuario
    public function iniciarSesion($email,$password)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('u.id as id_usuario,u.perfiladministrativo as id_perfil,u.token,u.creacion,u.modificacion,u.estado')
      ->addSelect('c.id as id_cliente,c.ciudad as id_ciudad,c.nombres,c.apellidos,c.documento,c.emailprincipal,c.telefono,c.telefonoalternativo')
      ->addSelect('p.nombre as perfil,p.permisos')
      ->addSelect('ci.nombre as ciudad')
      ->from($this->entity, 'u')
      ->innerJoin($this->cliente, 'c', 'WITH', $qb->expr()->eq('u.cliente', 'c.id'))
      ->innerJoin($this->perfiladministrativo, 'p', 'WITH', $qb->expr()->eq('u.perfiladministrativo', 'p.id'))
      ->innerJoin($this->ciudad, 'ci', 'WITH', $qb->expr()->eq('c.ciudad', 'ci.id'))
      ->where("c.emailprincipal=?1 AND u.password=?2")
      ->andWhere("u.estado=?3")
      ->setParameter(1, $email)
      ->setParameter(2, $password)
      ->setParameter(3, 1);
      $q = $qb->getQuery();
      // var_dump($qb->getDql());
      $results = $q->getOneOrNullResult();
      return $results;
    }
    //listados Usuario
    public function traerTodosOrdenadoPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('u.id,u.perfiladministrativo as id_perfil,u.token,u.creacion,u.modificacion,u.estado')
      ->addSelect('c.ciudad as id_ciudad,c.nombres,c.apellidos,c.documento,c.emailprincipal,c.telefono,c.telefonoalternativo')
      ->addSelect('p.nombre as perfil')
      ->addSelect('ci.nombre as ciudad')
      ->from($this->entity, 'u')
      ->innerJoin($this->cliente, 'c', 'WITH', $qb->expr()->eq('u.cliente', 'c.id'))
      ->innerJoin($this->perfiladministrativo, 'p', 'WITH', $qb->expr()->eq('u.perfiladministrativo', 'p.id'))
      ->innerJoin($this->ciudad, 'ci', 'WITH', $qb->expr()->eq('c.ciudad', 'ci.id'))
      ->orderBy('u.id', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

      //Agregar Usuario
      public function agregarUsuario($datos,$token)
      {
        //creamos una instancia de la entidad Usuario
        $usuario = new $this->entity;
        //establecemos las propiedades a través de los setters
        if(!empty($datos->perfiladministrativo)){
          $perfiladministrativo=(object)$datos->perfiladministrativo;
          $usuario->setPerfiladministrativo($perfiladministrativo->id);
        }
        if(!empty($datos->password)){
          $usuario->setPassword(md5($datos->password));
        }
        if(!empty($datos->estado)){
        $usuario->setEstado(intval($datos->estado));
         }
        if(!empty($datos->cliente)){
          $cliente=(object)$datos->cliente;
          $usuario->setCliente($cliente->id);
        }
        $usuario->setToken($token);
        //guardamos la entidad en la tabla Usuarios
        $this->_em->persist($usuario);
        $this->_em->flush();
        //-------------------
      }
    //Actualizar Usuario
    public function actualizarUsuario($id,$datos)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb->update($this->entity, 'u');

      $perfiladministrativo=(object)$datos->perfiladministrativo_objeto;
      if(!empty($perfiladministrativo->id)){
        $qb->set('u.perfiladministrativo', '?1')
        ->setParameter(1, $perfiladministrativo->id);
      }
      if(!empty($datos->password)){
        $qb->set('u.password', '?2')
        ->setParameter(2, md5($datos->password));
      }
      $qb->set('u.estado', '?3')
      ->setParameter(3, intval($datos->estado));

      // $cliente=(object)$datos->cliente;
      // if(!empty($cliente->id)){
      //   $qb->set('u.cliente', '?4')
      //   ->setParameter(4, $cliente->id);
      // }
      if(!empty($datos->token)){
        $qb->set('u.token', '?4')
        ->setParameter(4, $datos->token);
      }
      $qb->where('u.id = ?5')
        ->setParameter(5, $id);
      $q=$qb->getQuery();
      $p = $q->execute();
    }
    //Traer perfiles administrativos para selectores MODULO USUARIOS
    public function traerPerfilesOrdenadosPorId($cantidad,$offset,$orientacion)
    {
      $qb = $this->_em->createQueryBuilder();
      $qb
      ->select('p')
      ->from($this->perfiladministrativo, 'p')
      ->orderBy('p.id', (($orientacion==TRUE)?'ASC':'DESC'))
      ->setFirstResult($offset)
      ->setMaxResults($cantidad);
      $q = $qb->getQuery();
      $results = $q->getArrayResult();
      return $results;
    }

}
